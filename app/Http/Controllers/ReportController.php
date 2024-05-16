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
use App\Models\Cabang;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth()->user()->can('Print Report',)){
            $cabang =  Cabang::all();
            return view("report.index",compact('cabang'));
        }else{
            abort(404, 'Page not found');
        }
    }

    public function getAjax(request $request){
        $boot       = null;
        $total      = null;
        $from       = date('Y-m-d',strtotime($request->from));
        $to         =   date('Y-m-d',strtotime($request->to));
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

        if($request->cabang_id != null){
            $temp = Report::join('cabang','report.cabang_id','=','cabang.id')
            ->join('users','report.user_id','=','users.id')
            ->join('roles','report.role_id','=','roles.id')
            ->select("report.id","cabang.nama_cabang","roles.name as jenis_layanan","report.nama_petugas","report.nama as nama_nasabah",'report.date',"report.reason","report.created_at","report.id as actions","report.id as total_point")
            ->where('report.cabang_id',$request->cabang_id)
            ->whereBetween('report.date',[$from,$to]);
        }


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
    
        /*
        $repot = DB::table('report')
            ->join('cabang','report.cabang_id','=','cabang.id')
            ->join('roles','report.role_id','=','roles.id')
            ->join('users','report.user_id','=','users.id')
            ->select('report.id','report.nama','roles.name as jenis_layanan','cabang.nama_cabang','report.date','report.reason','users.name as petugas')
            ->whereBetween('date',[date('Y-m-d',strtotime($request->from_date)),date('Y-m-d',strtotime($request->to_date))])
            ->get();

        $question = DB::table('report_detail')
            ->join('report','report_detail.report_id','=','report.id')
            ->groupBy('report_detail.question')->select('report_detail.question','report_detail.point','report_detail.report_id')
            ->whereBetween('report_detail.date',[date('Y-m-d',strtotime($request->from_date)),date('Y-m-d',strtotime($request->to_date))])
            ->get();     
        $points = DB::table('report_detail')->select('point')->get();
                    
        $arrReport = array();
       
        foreach($repot as $p => $r){     
            $arrpoint  = array();
            foreach($question as $k => $d){ 
                $arrpoint[$p][$k] =[
                    'question' =>$d->question,
                    'point' =>isset($d->point) ? $d->point : "",
                ];
                $arrquestion[$k] =[
                    'question' =>$d->question,
                ];   
            }

            $arrReport[$p] = [
                'id'=>$r->id,
                'tanggal'=>$r->date,
                'cabang'=>$r->nama_cabang,
                'kritik_saran'=>$r->reason,
                'jenis_layanan'=>$r->jenis_layanan,
                'nama'=>$r->nama,
                'petugas'=>$r->petugas,
                'points'=>$arrpoint ,
            ];
        }

      

        $report =[
            'question'=>$arrquestion,
            'nasabah'=>$arrReport, 
        ];

        dd($report);
        */
        
        $count = Report::whereBetween('date',[date('Y-m-d',strtotime($request->from_date)),date('Y-m-d',strtotime($request->to_date))])->count();
        if($request->cabang_id != ""){
            $count = Report::whereBetween('date',[date('Y-m-d',strtotime($request->from_date)),date('Y-m-d',strtotime($request->to_date))])->where('cabang_id',$request->cabang_id)->count();
        }
        $page = ceil($count/10);
        for($i=1; $i<=$page ;$i++){

            $question = DB::table('report_detail')
            ->join('report','report_detail.report_id','=','report.id')
            ->groupBy('report_detail.question')->select('report_detail.question','report_detail.point','report_detail.report_id')
            ->whereBetween('report_detail.date',[date('Y-m-d',strtotime($request->from_date)),date('Y-m-d',strtotime($request->to_date))])
            ->get();

            $reports_parsing = DB::table('report')
            ->join('cabang','report.cabang_id','=','cabang.id')
            ->join('roles','report.role_id','=','roles.id')
            ->join('users','report.user_id','=','users.id')
            ->select('report.id','report.nama','roles.name as jenis_layanan','cabang.nama_cabang','report.date','report.reason','users.name as petugas')
            ->whereBetween('date',[date('Y-m-d',strtotime($request->from_date)),date('Y-m-d',strtotime($request->to_date))])
            ->skip(($i  - 1) * 10)
            ->take(10)
            ->orderBy('nama_cabang','DESC')
            ->get();

         

            if($request->cabang_id != ""){

                $reports_parsing = DB::table('report')
                ->join('cabang','report.cabang_id','=','cabang.id')
                ->join('roles','report.role_id','=','roles.id')
                ->join('users','report.user_id','=','users.id')
                ->select('report.id','report.nama','roles.name as jenis_layanan','cabang.nama_cabang','report.date','report.reason','users.name as petugas')
                ->whereBetween('date',[date('Y-m-d',strtotime($request->from_date)),date('Y-m-d',strtotime($request->to_date))])
                ->skip(($i  - 1) * 10)
                ->take(10)
                ->where('report.cabang_id',$request->cabang_id)
                ->orderBy('nama_cabang','DESC')
                ->get();

                $question = DB::table('report_detail')
                ->join('report','report_detail.report_id','=','report.id')
                ->groupBy('report_detail.question')->select('report_detail.question','report_detail.point')
                ->whereBetween('report_detail.date',[date('Y-m-d',strtotime($request->from_date)),date('Y-m-d',strtotime($request->to_date))])
                ->where('report.cabang_id',$request->cabang_id)
                ->get();
            }
        
            $reportArr = array();
            foreach($reports_parsing as $key => $die){ 
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
                $reportArr[$key] = [
                    'id'=>$die->id,
                    'tanggal'=>$die->date,
                    'cabang'=>$die->nama_cabang,
                    'kritik_saran'=>$die->reason,
                    'jenis_layanan'=>$die->jenis_layanan,
                    'nama'=>$die->nama,
                    'petugas'=>$die->petugas,
                    'points'=>$arrpoint,
                ];
            }

            $nasabah[$i] = $reportArr;
            $rep[$i] = $reports_parsing;
        }

        $report =[
            'question'=>$arrquestion,
            'nasabah'=>$nasabah, 
        ];
    
        $from = $request->from_date;
        $to   = $request->to_date;

        $cabang_id = $request->cabang_id;
        $cabang = Cabang::find($cabang_id);

        if($request->submit ==='pdf'){
            ini_set("pcre.backtrack_limit", "100000000");
            $payStub= new PDF();
            $customPaper = array(0,0,720,1440);
            $pdf = $payStub::loadView('report.pdf',compact('report','from','to','cabang'),[],['title'=>"Report Data Survei ".date('d M',strtotime($request->from_date))." s/d ".date('d M',strtotime($request->to_date))." ".date('Y',strtotime($request->from_date))]);
            return $pdf->stream('report.pdf');
        }else if($request->submit ==='excel'){
            return Excel::download(new ReportExport(date('Y-m-d',strtotime($request->from_date)),date('Y-m-d',strtotime($request->to_date)),$cabang_id), 'report-survei- '.date('d F Y',strtotime($request->from_date)).' '.date('d F Y',strtotime($request->to_date)).'.xlsx');
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
