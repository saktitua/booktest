<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cabang;
use App\Models\JenisLayanan;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.index');
    }

    public function getAjax(request $request){
        $column     = array('name','username','nik','nama_cabang','jenis_layanan','created_at','actions');
        $limit      = $request->input('length');
        $start      = $request->input('start');
        $order      = $column[$request->input('order.0.column')];
        $dir        = $request->input('order.0.dir');
        $temps      = User::join('cabang','users.cabang_id','=','cabang.id')
                          ->select("users.id","users.name","users.username","users.nik","users.cabang_id","cabang.nama_cabang","users.role","users.created_at","users.id as actions");
        $total      = $temps->count();
        $totalFiltered = $total;

        if(empty($request->input('search.value'))){
            $temp = $temps->offset($start)
                    ->limit($limit)
                    ->orderBy($order, $dir)
                    ->get();
        }else{
            $search = $request->input('search.value');
            $temp   = $temps->whereRaw("users.name LIKE '%$search%' OR users.username LIKE '%$search%' OR users.nik LIKE '%$search%' OR cabang.nama_cabang LIKE '%$search%' OR users.role LIKE '%$search%'")
                      ->orderBy($order,$dir)
                      ->get();
            $total  = $temps->whereRaw("users.name LIKE '%$search%' OR users.username LIKE '%$search%'OR users.nik LIKE '%$search%'OR cabang.nama_cabang LIKE '%$search%' OR users.role LIKE '%$search%'")->count();
            $totalFiltered = $total;
        }

        $data = array();
        if(!empty($temp)){

            foreach($temp as $key => $die){
                $obj['name']            = $die->name;
                $obj['username']        = $die->username;
                $obj['nik']             = $die->nik;
                $obj['nama_cabang']     = $die->cabang->nama_cabang;
                $obj['jenis_layanan']   = $die->role;
                $obj['created_at']      = date('d F Y',strtotime($die->created_at));
                $obj['actions']         = '<a href="javascript:;" data-href="'.route('pengguna.edit',$die->id).'" class="btn-edit btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="modal" data-target="kt_modal_1"><i class="la la-edit"></i></a>';
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
        $role = Role::all();
        $cabang = Cabang::all();
        $layanan = JenisLayanan::all();
        return view("user.create",compact('role','cabang','layanan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pengguna = new User;
        $pengguna->name = $request->name;
        $pengguna->username = $request->username;
        $pengguna->email = $request->email;
        $pengguna->password = Hash::make($request->password);
        $pengguna->phone_number = $request->phone_number;
        $pengguna->nik = $request->nik;
        $pengguna->cabang_id = $request->cabang_id;
        $pengguna->role = $request->role;
        $pengguna->generate = Str::uuid()->toString();
        $pengguna->save();
        return redirect()->route('pengguna.index')->with(['success'=>'Pengguna Berhasil Ditambahkan']);
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
        $role = Role::all();
        $cabang = Cabang::all();
        $layanan = JenisLayanan::all();
        return view('user.edit',compact('pengguna','role','cabang','layanan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pengguna =User::find($id);
        if($request->password != null){
            $updatepassword = Hash::make($request->password);
        }else{
            $updatepassword = $pengguna->password;
        }
        $pengguna->name = $request->name;
        $pengguna->username = $request->username;
        $pengguna->email = $request->email;
        $pengguna->password = $updatepassword;
        $pengguna->phone_number = $request->phone_number;
        $pengguna->nik = $request->nik;
        $pengguna->cabang_id = $request->cabang_id;
        $pengguna->jenis_layanan_id = $request->jenis_layanan_id;
        $pengguna->role = $request->role;
        $pengguna->save();
        return redirect()->route('pengguna.index')->with(['success'=>'Pengguna Berhasil Diupdated']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function viewQr(){
        return view('qrcode.index');
    }

    public function getQrAjax(request $request){
        $column     = array('name','username','nik','nama_cabang','jenis_layanan','QR');
        $limit      = $request->input('length');
        $start      = $request->input('start');
        $order      = $column[$request->input('order.0.column')];
        $dir        = $request->input('order.0.dir');
        $temps      = User::join('cabang','users.cabang_id','=','cabang.id')
                          ->select("users.id","users.name","users.username","users.nik","users.cabang_id","cabang.nama_cabang","users.role","users.created_at","users.id as QR");
        $total      = $temps->count();
        $totalFiltered = $total;

        if(empty($request->input('search.value'))){
            $temp = $temps->offset($start)
                    ->limit($limit)
                    ->orderBy($order, $dir)
                    ->get();
        }else{
            $search = $request->input('search.value');
            $temp   = $temps->whereRaw("users.name LIKE '%$search%' OR users.username LIKE '%$search%' OR users.nik LIKE '%$search%' OR cabang.nama_cabang LIKE '%$search%' OR users.role LIKE '%$search%'")
                      ->orderBy($order,$dir)
                      ->get();
            $total  = $temps->whereRaw("users.name LIKE '%$search%' OR users.username LIKE '%$search%'OR users.nik LIKE '%$search%'OR cabang.nama_cabang LIKE '%$search%' OR users.role LIKE '%$search%'")->count();
            $totalFiltered = $total;
        }

        $data = array();
        if(!empty($temp)){

            foreach($temp as $key => $die){
                $obj['name']            = $die->name;
                $obj['username']        = $die->username;
                $obj['nik']             = $die->nik;
                $obj['nama_cabang']     = $die->cabang->nama_cabang;
                $obj['jenis_layanan']   = $die->role;
                $obj['created_at']      = date('d F Y',strtotime($die->created_at));
                $obj['QR']              = '<a href="javascript:;" data-href="'.route('admin.users.qrcode.printqrcode',$die->id).'" class="btn-edit btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="modal" data-target="kt_modal_1"><i class="flaticon2-printer"></i></a>';
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

    public function printqrcode(string $id)
    {
        $pengguna =  User::find($id);
        return view('qrcode.printqr',compact('pengguna'));
    }

}
