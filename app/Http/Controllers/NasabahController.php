<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Report;
use App\Models\Role;
use App\Models\AuditTrail;

class NasabahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($generate)
    {
        $pengguna =  User::where('generate',$generate)->first();
        return view('nasabah.index',compact('pengguna'));
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
        $pengguna = User::where('generate',$request->code)->first();
        $role = Role::where('name',$pengguna->role)->first();
        $report = new Report;
        $report->user_id    = $pengguna->id;
        $report->role_id    = $role->id;
        $report->cabang_id  = $pengguna->cabang_id;
        $report->nama       = $request->nama ?? 'Anonim';
        $report->ques1      = $request->ques1 ?? 0 ;
        $report->ques2      = $request->ques2 ?? 0 ;
        $report->ques3      = $request->ques3 ?? 0 ;
        $report->ques4      = $request->ques4 ?? 0 ;
        $report->ques5      = $request->ques5 ?? 0 ;
        $report->ques5      = $request->ques5 ?? 0 ;
        $report->ques6      = $request->ques6 ?? 0 ;
        $report->ques7      = $request->ques7 ?? 0 ;
        $report->reason     = $request->reason ?? '-';
        $report->date       = date("Y-m-d");
        $report->save();
        AuditTrail::doLogAudit('Nasabah','Submit Survei',$request->nama,'-');
        return redirect()->back()->with(['success'=>'']);

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
