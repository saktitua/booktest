<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\AuditTrail;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportExport;
use App\Models\DetailReport;
use App\Models\Question;
use DB;
use Mpdf\Tag\Q;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      
        $last =  Question::latest()->first();
        // dd($last);
        if(Auth()->user()->can('Print Report')){
            return view("report.index");
        }else{
            abort(404, 'Page not found');
        }
    }

    public function getAjax(request $request){
        $boot  = null;
        $total = null;
        $from = date('Y-m-d',strtotime($request->from));
        $to =   date('Y-m-d',strtotime($request->to));
        $column     = array('nama_cabang','jenis_layanan','nama_petugas','nama_nasabah','tanggal','reason','total_point');
        $limit      = $request->input('length');
        $start      = $request->input('start');
        $order      = $column[$request->input('order.0.column')];
        $dir        = $request->input('order.0.dir');
        
        $temp = Report::join('cabang','report.cabang_id','=','cabang.id')
            ->join('users','report.user_id','=','users.id')
            ->join('roles','report.role_id','=','roles.id')
            ->select("report.id","cabang.nama_cabang","roles.name as jenis_layanan","report.nama_petugas","report.nama as nama_nasabah",'report.date',"report.reason","report.created_at","report.id as actions","report.id as total_point")
            ->whereBetween('report.date',[$from,$to]);
        $total = $temp->count();
        $totalFiltered = $total;
        if(empty($request->input('search.value'))){
            $boot = $temp->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir)
            ->get();
        }else{
            $search = $request->input('search.value');
            $boot   = $temp->whereRaw("users.name LIKE '%$search%' OR report.nama LIKE '%$search%' OR cabang.nama_cabang LIKE '%$search%' OR roles.name LIKE '%$search%'")
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();
            $total  = $temp->whereRaw("users.name LIKE '%$search%' OR report.nama LIKE '%$search%' OR cabang.nama_cabang LIKE '%$search%' OR roles.name LIKE '%$search%'")
                    ->count();
            $totalFiltered = $total;
        }

  
    

        $data = array();
        if(!empty($boot)){
            foreach($boot as $key => $die){
                $totalpoint = DetailReport::where('report_id',$die->id)->sum('point');

                $obj['nama_cabang']     = $die->nama_cabang;
                $obj['jenis_layanan']   = $die->jenis_layanan;
                $obj['nama_petugas']    = $die->nama_petugas;
                $obj['nama_nasabah']    = $die->nama_nasabah;
                $obj['reason']          = $die->reason;
                $obj['created_at']      = date('m/d/Y',strtotime($die->date));
                $obj['total_point']     = '<a href="javascript:;" data-href="'.route('report.show',$die->id).'" class="btn-report-detail" title="Klik untuk lihat detail pertanyan dan jawaban">'."Lihat Detail Report".'</a>';
                
                $data [] = $obj;
            }
        }
        $json_data = array(
            "draw"              =>intval($request->input('draw')),
            "recordsTotal"      =>intval($total),
            "recordsFiltered"   =>$totalFiltered,
            "data"              =>$data,
        );
        echo json_encode($json_data);   
    }

    public function export(request $request){
    
        $reports = DB::table('report')
        ->join('cabang','report.cabang_id','=','cabang.id')
        ->join('roles','report.role_id','=','roles.id')
        ->join('users','report.user_id','=','users.id')
        ->select('report.id','report.nama','report.date','cabang.nama_cabang','report.reason','roles.name as jenis_layanan','users.name as petugas')
        ->whereBetween('date',[date('Y-m-d',strtotime($request->from_date)),date('Y-m-d',strtotime($request->to_date))])
        ->get();
        if(count($reports)<1 ){
            return redirect()->back()->with(['danger'=>'Data yang di export tidak ada']);
        }
        $question = DB::table('report_detail')->join('question','report_detail.question','=','question.question')->groupBy('report_detail.question')->select('question.question','report_detail.point','question.id as id_question')->whereBetween('report_detail.date',[date('Y-m-d',strtotime($request->from_date)),date('Y-m-d',strtotime($request->to_date))])->get(); 
        foreach($reports as $key => $die){ 
            foreach($question as $k => $d){
                $points = DB::table('report_detail')->select('point')->where('question',$d->question)->where('report_id',$die->id)->first(); 
                $arrpoint[$k] =[
                    'question' =>$d->question,
                    'point' =>isset($points->point) ? $points->point : " ",
                ];
                $arrquestion[$k] =[
                    'question' =>$d->question,
                ];
            }
            $pointArr[] = [
                'date'=>date('d M Y',strtotime($die->date)),
                'nama'=>$die->nama,
                'kritik_saran'=>$die->reason,
                'jenis_layanan'=>$die->jenis_layanan,
                'petugas'=>$die->petugas,
                'nama_cabang'=>$die->nama_cabang,
                'point'=>$arrpoint,
            ];
            $questionArr [] =[
                'questions'=>$arrquestion,
            ]; 
        }
        $report =[
            'nasabah'=>$pointArr,
            'questions'=>$arrquestion,
        
        ];
        $from = $request->from_date;
        $to   = $request->to_date;

        if($request->submit ==='pdf'){
            $payStub= new PDF();
            $customPaper = array(0,0,720,1440);
            $pdf = $payStub::loadView('report.pdf',compact('report'),[],['title'=>"Report Data Survei ".date('d M',strtotime($request->from_date))." s/d ".date('d M',strtotime($request->to_date))." ".date('Y',strtotime($request->from_date))]);
            return $pdf->stream('report.pdf');
        }else if($request->submit ==='excel'){
            return Excel::download(new ReportExport(date('Y-m-d',strtotime($request->from_date)),date('Y-m-d',strtotime($request->to_date))), 'report-survei- '.date('d F Y',strtotime($request->from_date)).' s/d '.date('d F Y',strtotime($request->to_date)).'.xlsx');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $temp = Report::join('cabang','report.cabang_id','=','cabang.id')
        ->join('users','report.user_id','=','users.id')
        ->join('roles','report.role_id','=','roles.id')
        ->select("report.id","cabang.nama_cabang","roles.name as jenis_layanan","users.name as nama_petugas","report.nama as nama_nasabah","report.reason","report.created_at")
        ->where('report.id',$id)->first();
        $detailreport = DetailReport::where('report_id',$id)->get();

        return view('report.show',compact('detailreport','temp'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
