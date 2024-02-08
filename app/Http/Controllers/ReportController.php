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
class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
    
     
        $questions = array();
        $question = DB::table('report_detail')->select('report_id','question_id','question','point')->whereBetween('date',[date('Y-m-d',strtotime($request->from_date)),date('Y-m-d',strtotime($request->to_date))])->groupBy('question')->get();
        foreach($question as $q => $die){
            $questions[] = $die->question;
        }
        $temp = DB::table('report')->select('id','nama')->whereBetween('date',[date('Y-m-d',strtotime($request->from_date)),date('Y-m-d',strtotime($request->to_date))])->get();
        foreach($temp as $key => $die){ 
            $point = DB::table('report_detail')->select('point')->where('report_id',$die->id)->get();
            foreach($point as $k =>$d){
                $arrPoint[$k] = $d->point;
            }
            $nama [] = [
                'nasabah'=>$die->nama,
                'point'=>$arrPoint
            ];
        }
        $report =[
            'question'=>$questions,
            'nama'=>$nama
        ];

      
        dd($report);

        


        $from = $request->from_date;
        $to   = $request->to_date;

        if($request->submit ==='pdf'){
            $payStub= new PDF();
            $customPaper = array(0,0,720,1440);
            $pdf = $payStub::loadView('report.pdf',compact('temp','question','from','to','point'),[],['title'=>"Report Data Survei"]);
            return $pdf->stream('report.pdf');
        }else if($request->submit ==='excel'){
            return Excel::download(new ReportExport(date('Y-m-d',strtotime($request->from_date)),date('Y-m-d',strtotime($request->to_date))), 'report-survei- '.date('d F Y',strtotime($request->from_date)).' Sd '.date('d F Y',strtotime($request->to_date)).'.xlsx');
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
