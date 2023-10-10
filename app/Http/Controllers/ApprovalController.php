<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class ApprovalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth()->user()->can('Create User Approval')){
            return view('approval.index');
        }else{
            abort(404, 'Page not found');
        }
    }
    public function getAjax(request $request){
        $column     = array('name','username','nik','date','status','confirmation_status','actions');
        $limit      = $request->input('length');
        $start      = $request->input('start');
        $order      = $column[$request->input('order.0.column')];
        $dir        = $request->input('order.0.dir');
        $temps      = User::select("id","name","username","nik","created_at","status","confirmation_status","id as actions");
        $total      = $temps->count();
        $totalFiltered = $total;

        if(empty($request->input('search.value'))){
            $temp = $temps->offset($start)
                    ->limit($limit)
                    ->orderBy($order, $dir)
                    ->get();
        }else{
            $search = $request->input('search.value');
            $temp   = $temps->whereRaw("name LIKE '%$search%' OR username LIKE '%$search%' OR cabang LIKE '%$search%' OR nik LIKE '%$search%'")
                      ->orderBy($order,$dir)
                      ->get();
            $total  = $temps->whereRaw("name LIKE '%$search%' OR username LIKE '%$search%' OR cabang LIKE '%$search%' OR nik LIKE '%$search%'")->count();
            $totalFiltered = $total;
        }

        $data = array();
        if(!empty($temp)){
            foreach($temp as $key => $die){
                $obj['name']                = $die->name;
                $obj['username']            = $die->username;
                $obj['nik']                 = $die->nik;
                $obj['date']                = date('d F Y',strtotime($die->created_at));
                $obj['status']              = $die->status;
                $obj['confirmation_status'] = $die->confirmation_status;
                $obj['actions']             = '<a href="javascript:;" data-href="'.route('approval.edit',$die->id).'" class="btn-edit btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="modal" data-target="kt_modal_1"><i class="la la-edit"></i></a>';
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
        return view('approval.create');
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
        $pengguna =  User::find($id);
        return view('approval.confirm',compact('pengguna'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pengguna =  User::find($id);
        $pengguna->status = $request->status;
        $pengguna->confirmation_status = $request->submit;
        $pengguna->save();
        return redirect()->route('approval.index')->with(['success'=>'Pengguna Berhasil '.$request->submit]);
      
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
