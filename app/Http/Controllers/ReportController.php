<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("report.index");
    }

    public function getAjax(request $request){
        $column     = array('nama_cabang','jenis_layanan','nama_petugas','nama_nasabah','ques1','ques2','ques3','ques4','ques5','ques6','ques7','tanggal','reason');
        $limit      = $request->input('length');
        $start      = $request->input('start');
        $order      = $column[$request->input('order.0.column')];
        $dir        = $request->input('order.0.dir');
        $temps      = Report::join('cabang','report.cabang_id','=','cabang.id')
                            ->join('users','report.user_id','=','users.id')
                            ->join('roles','report.role_id','=','roles.id')
                            ->select("roles.name as jenis_layanan","users.name as nama_petugas","report.nama as nama_nasabah","report.ques1","report.ques2","report.ques3","report.ques4","report.ques5","report.ques6","report.ques7","report.reason","report.created_at","report.id as actions");
        $total      = $temps->count();
        $totalFiltered = $total;
        if(empty($request->input('search.value'))){
            $temp = $temps->offset($start)
                    ->limit($limit)
                    ->orderBy($order, $dir)
                    ->get();
        }else{
            $search = $request->input('search.value');
            $temp   = $temps->whereRaw("users.name LIKE '%$search%' OR report.nama LIKE '%$search%' OR cabang.nama_cabang LIKE '%$search%' OR roles.name LIKE '%$search%'")
                      ->orderBy($order,$dir)
                      ->get();
            $total  = $temps->whereRaw("users.name LIKE '%$search%' OR report.nama LIKE '%$search%' OR cabang.nama_cabang LIKE '%$search%' OR roles.name LIKE '%$search%'")->count();
            $totalFiltered = $total;
        }

        $data = array();
        if(!empty($temp)){
            foreach($temp as $key => $die){
             
                $obj['nama_cabang']     = $die->nama_cabang;
                $obj['jenis_layanan']   = $die->jenis_layanan;
                $obj['nama_petugas']    = $die->nama_petugas;
                $obj['nama_nasabah']    = $die->nama_nasabah;
                $obj['ques1']           = $die->ques1;
                $obj['ques2']           = $die->ques2;
                $obj['ques3']           = $die->ques3;
                $obj['ques4']           = $die->ques4;
                $obj['ques5']           = $die->ques5;
                $obj['ques6']           = $die->ques6;
                $obj['ques7']           = $die->ques7;
                $obj['reason']          = $die->reason;
                $obj['created_at']      = date('d F Y',strtotime($die->created_at));
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
        //
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
