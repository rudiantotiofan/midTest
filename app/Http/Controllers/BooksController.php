<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Book;
use Session;
use File;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $book = Book::where('title','like','%'.$request->keyword.'%')->with('author')->paginate(5);
        //$author = $request->keyword;
        if($request->ajax()){
            return view('books.tables')->with(compact('book'));
        }else{
            return view('books.index')->with(compact('book'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookRequest $request)
    {
        $book = Book::create($request->except('cover'));
        //isi field cover jika ada cover yang diupload
        if($request->hasFile('cover')){
            //Mengambil file yang diupload
            $uploaded_cover = $request->file('cover');
            //Mengambil extension file
            $extension = $uploaded_cover->getClientOriginalExtension();
            //Membuat nama file random berikut extensoin
            $filename = md5(time()).'.'.$extension;
            //Menyimpan over ke folder public/images/upload
            $destinationPath = public_path().DIRECTORY_SEPARATOR.'images/upload';
            $uploaded_cover->move($destinationPath,$filename);
            //mengisi field cover di book dengan filename yang baru dibuat
            $book->cover = $filename;
        }
        $book->save();

        Session::flash("flash_notification",[
            "level"=>"success",
            "message"=>"Berhasil menyimpan $book->title"
        ]);

        return redirect()->route('books.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::find($id);
        return view('books.show')->with(compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::with('authors')->find($id)->first();
        return view('books.edit')->with(compact('book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookRequest $request, $id)
    {
        $book = Book::find($id);
        $book->update($request->all());
        //isi field cover jika ada cover yang diupload
        if($request->hasFile('cover')){
            //Mengambil file yang diupload berikut ekstensinya
            $filename = null;
            $uploaded_cover = $request->file('cover');
            $extension = $uploaded_cover->getClientOriginalExtension();

            //Membuat nama file random berikut extensoin
            $filename = md5(time()).'.'.$extension;
            $destinationPath = public_path().DIRECTORY_SEPARATOR.'images/upload';

            //memindahkan file ke folder public/img
            $uploaded_cover->move($destinationPath,$filename);

            //hapus cover lama, jika ada
            if($book->cover){
                $filepath = public_path().DIRECTORY_SEPARATOR.'images/upload'.DIRECTORY_SEPARATOR.$book->cover;
                try{
                    File::delete($filepath);
                }catch (FileNotFoundException $e){
                    echo '<script>alert("Kesalahan : '.$e.'")</script>';
                }
            }
            //mengisi field cover di book dengan filename yang baru dibuat
            $book->cover = $filename;
        }
        $book->save();

        Session::flash("flash_notification",[
            "level"=>"success",
            "message"=>"Berhasil menyimpan $book->title"
        ]);

        return redirect()->route('books.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::find($id);
        //hapus cover lama, jika ada
        if($book->cover){
            $filepath = public_path().DIRECTORY_SEPARATOR.'images/upload'.DIRECTORY_SEPARATOR.$book->cover;
            try{
                File::delete($filepath);
            }catch(FileNotFoundException $e){
                echo '<script>alert("Kesalahan : '.$e.'")</script>';
            }
        }
        $book->delete();

        Session::flash('flash_notification',[
            'level'=>'success',
            'message'=>'Buku berhasil dihapus'
        ]);
        return redirect()->route('books.index');
    }
}
