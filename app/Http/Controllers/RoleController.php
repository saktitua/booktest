<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\AuditTrail;
use Auth;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth()->user()->can('Role Maintenance')){
            return view('role.index');
        }else{
            abort(404, 'Page not found');
        }
    }
    public function getAjax(request $request){
        $bool       = null;
        $column     = array('name','kode_role','actions');
        $limit      = $request->input('length');
        $start      = $request->input('start');
        $order      = $column[$request->input('order.0.column')];
        $dir        = $request->input('order.0.dir');
        $temps      = Role::select("id","name","kode_role","id as actions");
        $total      = $temps->count();
        $totalFiltered = $total;

        if(empty($request->input('search.value'))){
            $bool = $temps->offset($start)
                    ->limit($limit)
                    ->orderBy($order, $dir)
                    ->get();
        }else{
            $search = $request->input('search.value');
            $bool   = $temps->whereRaw("name LIKE '%$search%'")
                      ->orderBy($order,$dir)
                      ->get();
            $total  = $temps->whereRaw("name LIKE '%$search%'")->count();
            $totalFiltered = $total;
        }

        $data = array();
        if(!empty($bool)){
            foreach($bool as $key => $die){
                $obj['name']            = $die->name;
                $obj['kode_role']       = $die->kode_role != null ? $die->kode_role : "-";
                $obj['actions']         = '<a href="javascript:;" data-href="'.route('roles.edit',$die->id).'" class="btn-edit btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="modal" data-target="kt_modal_1"><i class="la la-edit"></i></a>';
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
        return view('role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $role  = new Role;
        $role->name = $request->nama;
        $role->guard_name = "web";
        $role->kode_role = $request->kode_role;
        $role->save();
        AuditTrail::doLogAudit('Role Maintenance',Auth::user()->name." membuat role ".$role->name,Auth::user()->name,Auth::user()->role);
        return redirect()->route('roles.index')->with(['success'=>'Role Berhasil Ditambahkan']);
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
        $roles  = Role::find($id);
        return view('role.edit',compact('roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $roles  = Role::find($id);
        $roles->name = $request->nama;
        $roles->guard_name = 'web';
        $roles->kode_role = $request->kode_role;
        $roles->save();
        AuditTrail::doLogAudit('Role Maintenance',Auth::user()->name." mengubah role ".$roles->name,Auth::user()->name,Auth::user()->role);
        return redirect()->route('roles.index')->with(['success'=>'Role Berhasil Diupdate']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
