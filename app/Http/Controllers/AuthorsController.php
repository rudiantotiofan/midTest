<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Author;
use Session;

class AuthorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $author = Author::where('name','like','%'.$request->keyword.'%')->paginate(5);
        if($request->ajax()){
            return view('authors.tables')->with(compact('author'));
        }else{
            return view('authors.index')->with(compact('author'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('authors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name'=>'required|unique:authors']);
        $author = Author::create($request->all());
        Session::flash("flash_notification",[
            "level"=>"success",
            "message"=>"Berhasil menyimpan $author->name"
        ]);
        return redirect()->route('authors.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $author = Author::find($id);
        return view('authors.show')->with(compact('author'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $author = Author::find($id);
        return view('authors.edit')->with(compact('author'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, ['name'=>'required|unique:authors,name,'.$id]);
        $author = Author::find($id);
        $author->update($request->only('name'));
        Session::flash("flash_notification",[
            "level" => "success",
            "message" => "Berhasil menyimpan $author->name"
        ]);
        return redirect()->route('authors.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Author::destroy($id)) return redirect()->back();
        Session::flash("flash_notification",[
            "level" => "success",
            "message" => "Penulis berhasil dihapus"
        ]);
        return redirect()->route('authors.index');
    }
}
