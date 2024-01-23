<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Report;
use App\Models\Role;
use App\Models\AuditTrail;
use App\Models\Question;
use App\Models\DetailReport;
class NasabahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($generate)
    {
        $pengguna =  User::where('generate',$generate)->first();
        $question =  Question::where('is_edit',0)->where('is_delete',0)->get();
        return view('nasabah.index',compact('pengguna','question'));
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
        $report->user_id         = $pengguna->id;
        $report->nama_petugas    = $pengguna->name;
        $report->role_id         = $role->id;
        $report->cabang_id       = $pengguna->cabang_id;
        $report->nama            = $request->nama_nasabah ?? 'Anonim';
        $report->reason          = $request->kritik_saran ?? '-';
        $report->date            = date("Y-m-d");
        $report->save();

        $question =  Question::all();
        foreach($question as $key => $die){
            if($die->is_edit  != 0 || $die->is_delete != 0){
                $reportdetail = new DetailReport;
                $reportdetail->report_id = $report->id;
                $reportdetail->date      = date('Y-m-d');
                $reportdetail->question  = $die->question;
                $reportdetail->point     = "";
                $reportdetail->save();
            }else{
                $reportdetail = new DetailReport;
                $reportdetail->report_id = $report->id;
                $reportdetail->date      = date('Y-m-d');
                $reportdetail->question  = $request->question[$die->id];
                $reportdetail->point     = isset($request->question[$die->id]) ? $request->ques[$die->id] : 0;
                $reportdetail->save();
            }
      
          
          
        }
        AuditTrail::doLogAudit('Nasabah','Submit Survei',$request->nama,'-');
        return redirect()->back()->with(['success'=>'']);

    }

    public function getQuesionId(){
        $question = Question::all();
        return response()->json(['question'=>$question]);
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
