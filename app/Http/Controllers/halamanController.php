<?php

namespace App\Http\Controllers;

use App\Models\halaman;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class halamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = halaman::orderBy('judul','asc')->get();
        return view('dasboard.halaman.halaman')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dasboard.halaman.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r)
    {
        $judul=$r->judul;
        $deskripsi=$r->deskripsi;
        $r->validate([
            'judul'=>'required',
            'deskripsi'=>'required',
            'gambar'=>'required|mimes:jpg,png,jpeg|image|max:2040'
        ],[
            'judul.required'=>'Judul Wajib di isi',
            'deskripsi.required'=>'Deskripsi Wajib di isi',
            'gambar.required'=>'Gambar wajib di isi'
        ]
    );
    if($r->hasFile('gambar')){
        $path=$r->file('gambar')->store('uploads');
    }else{
        $path='';
    }
    $halaman=new halaman();
    $halaman->judul=$judul;
    $halaman->deskripsi=$deskripsi;
    $halaman->gambar=$path;
    $halaman->save();
    return redirect()->route('halaman.index')->with('success', 'Berhasil
menambahkan data');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=halaman::where('id',$id)->first();
        return view('dasboard.halaman.edit')->with('data',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $r, $id)
    {
        $judul=$r->judul;
        $deskripsi=$r->deskripsi;
        $r->validate([
            'judul'=>'required',
            'deskripsi'=>'required',
            'gambar'=>'required|mimes:jpg,png,jpeg|image|max:2040'
        ],[
            'judul.required'=>'Judul Wajib di isi',
            'deskripsi.required'=>'Deskripsi Wajib di isi',
            'gambar.required'=>'Gambar wajib di isi'
        ]
    );
    if($r->hasFile('gambar')){
        $path=$r->file('gambar')->store('uploads');
    }else{
        $path='';
    }
    $halaman=halaman::find($id);
    $pathFoto=$halaman->gambar;
    if($pathFoto!=null||$pathFoto!=''){
        Storage::delete($pathFoto);
    }
    $halaman->judul=$judul;
    $halaman->deskripsi=$deskripsi;
    $halaman->gambar=$path;
    $halaman->save();
    return redirect()->route('halaman.index')->with('success','Berhasil menambahkan data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hlm = halaman::find($id);
        $pathFoto =$hlm->gambar;
        if ($pathFoto != null || $pathFoto){
        Storage::delete($pathFoto);
        }
        halaman::where('id',$id)->delete();
        return view('dasboard.halaman.halaman')->with('success','data berhasil di hapus');
    }
}
