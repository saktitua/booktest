<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AuditTrail;

class AuditTrailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth()->user()->can('Audit Trails')){
            return view('audittrail.index');
        }else{
            abort(404, 'Page not found');
        }
    }

    public function getAjax(request $request){
        $column     = array('menu','description','username','jenis_layanan','created_at');
        $limit      = $request->input('length');
        $start      = $request->input('start');
        $order      = $column[$request->input('order.0.column')];
        $dir        = $request->input('order.0.dir');
        $temps      = AuditTrail::select("id","menu","description","username","jenis_layanan","created_at","id as actions");
        $total      = $temps->count();
        $totalFiltered = $total;

        if(empty($request->input('search.value'))){
            $temp = $temps->offset($start)
                    ->limit($limit)
                    ->orderBy($order, $dir)
                    ->get();
        }else{
            $search = $request->input('search.value');
            $temp   = $temps->whereRaw("menu LIKE '%$search%' OR description LIKE '%$search%' OR username LIKE '%$search%' OR jenis_layanan LIKE '%$search%'")
                      ->orderBy($order,$dir)
                      ->get();
            $total  = $temps->whereRaw("menu LIKE '%$search%' OR description LIKE '%$search%' OR username LIKE '%$search%' OR jenis_layanan LIKE '%$search%'")->count();
            $totalFiltered = $total;
        }

        $data = array();
        if(!empty($temp)){
            foreach($temp as $key => $die){
                $obj['menu']             = $die->menu;
                $obj['description']      = $die->description;
                $obj['username']         = $die->username;
                $obj['jenis_layanan']    = $die->jenis_layanan;
                $obj['created_at']       = date("d F Y",strtotime($die->created_at));
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
