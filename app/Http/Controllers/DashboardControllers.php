<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
class DashboardControllers extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('dashboard');
    }


    public function getAjax(request $request){
        $column     = array('no','name','slug','author','created_at','actions');
        $limit      = $request->input('length');
        $start      = $request->input('start');
        $order      = $column[$request->input('order.0.column')];
        $dir        = $request->input('order.0.dir');
        $temps      = Book::select('id','id as no','name','years','slug','author','created_at','id as actions');
        $total      = $temps->count();
        $totalFiltered = $total;

        if(empty($request->input('search.value'))){
            $temp = $temps->offset($start)
                    ->limit($limit)
                    ->orderBy($order, $dir)
                    ->get();
        }else{
            $search = $request->input('search.value');
            $temp   = $temps->whereRaw("name LIKE '%$search%' OR years LIKE '%$search%' OR slug LIKE '%$search%' OR author LIKE '%$search%'")
                      ->orderBy($order,$dir)
                      ->get();
            $total  = $temps->whereRaw("name LIKE '%$search%' OR years LIKE '%$search%' OR slug LIKE '%$search%' OR author LIKE '%$search%'")->count();
            $totalFiltered = $total;
        }

        $data = array();
        if(!empty($temp)){

            foreach($temp as $key => $die){
                $edit                   = '<a href="javascript:;" data-href="'.route('dashboard.edit',$die->id).'" class="btn-edit btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="modal" data-target="kt_modal_1"><i class="la la-edit"></i></a>';
                $delete                 = '<a href="javascript:;" data-href="'.route('dashboard.show',$die->id).'" class="btn-show btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="modal" data-target="kt_modal_1"><i class="la la-trash"></i></a>';
                $obj['no']              = $key + 1;
                $obj['name']            = $die->name;
                $obj['years']           = $die->years;
                $obj['slug']            = $die->slug;
                $obj['author']          = $die->author;
                $obj['created_at']      = date('d F Y',strtotime($die->created_at));
                $obj['actions']         = $edit."".$delete;
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
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $book           = new Book;
        $book->name     = $request->name;
        $book->years    = $request->years;
        $book->slug     = $request->slug;
        $book->author   = $request->author;
        $book->save();
        return redirect()->route('dashboard.index')->with(['success'=>'Book Success Add']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $show  = Book::find($id);
        return view('show',compact('show'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $edit  = Book::find($id);
        return view('edit',compact('edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $book           = Book::find($id);
        $book->name     = $request->name;
        $book->years    = $request->years;
        $book->slug     = $request->slug;
        $book->author   = $request->author;
        $book->save();
        return redirect()->route('dashboard.index')->with(['success'=>'Book Success Update']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete  = Book::find($id);
        $delete->delete();
        return redirect()->route('dashboard.index')->with(['success'=>'Book Success Delete']);
    }
}
