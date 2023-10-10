<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cabang;
use App\Models\AuditTrail;
use Auth;

class CabangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    { 
        if(Auth()->user()->can('Cabang')){
            return view('cabang.index');
        }else{
            abort(404, 'Page not found');
        }
    }

    
    public function getAjax(request $request){
        $column     = array('kode_cabang','nama_cabang','alamat','actions');
        $limit      = $request->input('length');
        $start      = $request->input('start');
        $order      = $column[$request->input('order.0.column')];
        $dir        = $request->input('order.0.dir');
        $temps      = Cabang::select("id","kode_cabang","nama_cabang",'alamat',"id as actions");
        $total      = $temps->count();
        $totalFiltered = $total;

        if(empty($request->input('search.value'))){
            $temp = $temps->offset($start)
                    ->limit($limit)
                    ->orderBy($order, $dir)
                    ->get();
        }else{
            $search = $request->input('search.value');
            $temp   = $temps->whereRaw("nama_cabang LIKE '%$search%' OR kode_cabang LIKE '%$search%' OR alamat LIKE '%$search%'")
                      ->orderBy($order,$dir)
                      ->get();
            $total  = $temps->whereRaw("nama_cabang LIKE '%$search%' OR kode_cabang LIKE '%$search%' OR alamat LIKE '%$search%'")->count();
            $totalFiltered = $total;
        }

        $data = array();
        if(!empty($temp)){
            foreach($temp as $key => $die){
                $obj['kode_cabang']  = $die->kode_cabang;
                $obj['nama_cabang']  = $die->nama_cabang;
                $obj['alamat']       = $die->alamat;
                $obj['actions']   = '<a href="javascript:;" data-href="'.route('cabang.edit',$die->id).'" class="btn-edit btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="modal" data-target="kt_modal_1"><i class="la la-edit"></i></a>';
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
        return view('cabang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cabang  = new Cabang;
        $cabang->kode_cabang = $request->kode_cabang;
        $cabang->nama_cabang = $request->nama_cabang;
        $cabang->alamat      = $request->alamat;
        $cabang->save();
        AuditTrail::doLogAudit('Cabang','Create Cabang',Auth::user()->name,Auth::user()->role);
        return redirect()->route('cabang.index')->with(['success'=>'Cabang Berhasil Ditambahkan']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $cabang  = Cabang::find($id);
        return view('cabang.edit',compact('cabang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    { 
        $cabang  = Cabang::find($id);
        $cabang->kode_cabang = $request->kode_cabang;
        $cabang->nama_cabang = $request->nama_cabang;
        $cabang->alamat      = $request->alamat;
        $cabang->save();
        AuditTrail::doLogAudit('Cabang','Create Cabang',Auth::user()->name,Auth::user()->role);
        return redirect()->route('cabang.index')->with(['success'=>'Cabang Berhasil Diupdate']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
