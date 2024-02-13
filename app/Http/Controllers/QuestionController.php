<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use DB;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('question.index');
    }

    /**
     * Show Ajax.
     */
    public function getAjax(request $request){

        $column     = array('id','question');
        $limit      = $request->input('length');
        $start      = $request->input('start');
        $order      = $column[$request->input('order.0.column')];
        $dir        = $request->input('order.0.dir');
        $temp       = Question::select("id","question","type","id as actions");
        $total      = $temp->where('is_edit',0)->where('is_delete',0)->count();
        $totalFiltered = $total;

        if(empty($request->input('search.value'))){
            $boot = $temp->offset($start)
                    ->limit($limit)
                    ->orderBy($order, $dir)
                    ->get();
        }else{
            $search = $request->input('search.value');
            $boot   = $temp->whereRaw("question.question LIKE '%$search%'")
                      ->orderBy($order,$dir)
                      ->get();
            $total  = $temp->whereRaw("question.question LIKE '%$search%'")->count();
            $totalFiltered = $total;
        }

        $data = array();
        if(!empty($boot)){
            foreach($boot as $key => $die){
                // if(Auth()->user()->can('Edit Action')){
                    $edit  = '<a href="javascript:;" data-href="'.route('question.edit',$die->id).'" class="btn-edit btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="modal" data-target="kt_modal_1"><i class="la la-edit"></i></a>';
                    $hapus = '<a href="javascript:;" data-href="'.route('question.show',$die->id).'" class="btn-show btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="modal" data-target="kt_modal_1"><i class="la la-trash"></i></a>';
                // }else{
                    // $edit ="-";
                // }
                $obj['question']         = $die->question;
                $obj['type']             = $die->type;
                $obj['actions']          = $edit."".$hapus;
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
        return view('question.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $question = new Question;
        $question->question = $request->question;
        $question->type = 'radio';
        $question->save();
        return redirect()->route('question.index')->with(['success'=>'Pertanyaan berhasil di tambahkan']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $questions = Question::find($id);
        return view('question.show',compact('questions'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $questions = Question::find($id);
        return view('question.edit',compact('questions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $question = Question::find($id);
        if($question->question != $request->question){
                   
            // cek question lama
            $check = DB::table("question")->where('question',$request->question)->exists();
            if($check == false){
                $insert = new Question;
                $insert->question = $request->question;
                $insert->type = 'radio';
                $insert->is_new_edit = 1;
                $insert->save();

                $is_edit = Question::find($id);
                $is_edit->is_edit = 1;
                $is_edit->save();
            }

            if($check == true){
                $old = Question::where('question',$request->question)->first();
                $old->is_edit =0;
           
                $old->save();

                $is_edit = Question::find($id);
                $is_edit->is_edit = 1;
                $is_edit->save();
                
            }

            
            return redirect()->route('question.index')->with(['success'=>'Pertanyaan berhasil di update']);
        }else{
            $question->question = $request->question;
            $question->type = 'radio';
            $question->save();
            return redirect()->route('question.index')->with(['success'=>'Pertanyaan berhasil di update']);
        
        }
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $question = Question::find($id);
        $question->is_delete =1;
        $question->save();
        return redirect()->route('question.index')->with(['success'=>'Pertanyaan berhasil di hapus']);

    }
}
