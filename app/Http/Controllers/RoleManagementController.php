<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\permission;

class RoleManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('role-management.index');
    }

    public function getAjax(request $request){
        $column     = array('name','guard_name','actions');
        $limit      = $request->input('length');
        $start      = $request->input('start');
        $order      = $column[$request->input('order.0.column')];
        $dir        = $request->input('order.0.dir');
        $temps      = Role::select("id","name","guard_name","id as actions");
        $total      = $temps->count();
        $totalFiltered = $total;

        if(empty($request->input('search.value'))){
            $temp = $temps->offset($start)
                    ->limit($limit)
                    ->orderBy($order, $dir)
                    ->get();
        }else{
            $search = $request->input('search.value');
            $temp   = $temps->whereRaw("name LIKE '%$search'")
                      ->orderBy($order,$dir)
                      ->get();
            $total  = $temps->whereRaw("name LIKE '%$search'")->count();
            $totalFiltered = $total;
        }

        $data = array();
        if(!empty($temp)){
            foreach($temp as $key => $die){
                $obj['name']            = $die->name;
                $obj['guard_name']      = $die->guard_name;
                $obj['actions']         = '<a href="javascript:;" data-href="'.route('roles-management.edit',$die->id).'" class="btn-edit btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="modal" data-target="kt_modal_1"><i class="la la-edit"></i></a>';
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
        $roles  = Role::find($id);
        $permission = Permission::all();
        $user = Permission::all();
        return view('role-management.edit',compact('roles','permission','user'));
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
