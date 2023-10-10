<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Auth;


class GantiPasswordUser extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth()->user()->can('Ganti Password Admin')){
            $admin = User::find(Auth::user()->id);
            return view('ganti-password-user.index',compact('admin'));
        }else{
            abort(404, 'Page not found');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      
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
     
        $user = User::find(Auth::user()->id);
        if($request->password != null){
            $check = Hash::check($request->password, $user->password);
            if($check == true){
                if($request->new_password == $request->confirm_password){
                    $user->password = Hash::make($request->new_password);
                    $user->save();
                    return redirect()->back()->with(['success'=>'password berhasil di perbaruhi']);
                }else{
                    return redirect()->back()->with(['danger'=>'password baru dan confirm password tidak sama']);
                }
                
            }else{
                return redirect()->back()->with(['danger'=>'password lama tidak match']);
            }
        }else{
            return redirect()->back()->with(['danger'=>'silahkan masukkan password baru']);
        }
      
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
