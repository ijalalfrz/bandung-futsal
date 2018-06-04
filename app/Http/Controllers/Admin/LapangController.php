<?php

namespace App\Http\Controllers\Admin;
use File;
use App\Lapang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LapangController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $lapang = Lapang::all();
        return view('lapang.index', compact('lapang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('lapang.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'jenis' => 'required',
            'deskripsi' => 'required',
            'harga_sewa' => 'required|numeric',
            'foto' => 'required|file|max:5000',
        ]);


        $foto = "";
        if($request->hasfile('foto'))
        {
            $file = $request->file('foto');
            $foto = time().'.'.$file->extension();
            $file->move(public_path().'/uploads/', $foto);
        }

        $data = new Lapang();

        $data->nama = $request->get('nama');
        $data->deskripsi = $request->get('deskripsi');
        $data->jenis = $request->get('jenis');
        $data->harga_sewa = $request->get('harga_sewa');
        $data->foto = $foto;

        $data->save();

        $request->session()->flash('msg', 'Data lapang berhasil ditambah');
        return redirect('admin/lapang');

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
        //
        $lapang = Lapang::findOrFail($id);
        if($lapang!=null){
            return view('lapang.edit', compact('lapang', 'id'));
        }

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
        //
         $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'jenis' => 'required',
            'deskripsi' => 'required',
            'harga_sewa' => 'required|numeric',
        ]);
        $lapang = Lapang::findOrFail($id);

        $foto = $lapang->foto;
        if($request->hasfile('foto'))
        {
            if (File::exists(public_path().'/uploads/'.$foto)) {
                File::delete(public_path().'/uploads/'.$foto);
            }

            $file = $request->file('foto');
            $foto = time().'.'.$file->extension();
            $file->move(public_path().'/uploads/', $foto);
        }

        $lapang->nama = $request->get('nama');
        $lapang->deskripsi = $request->get('deskripsi');
        $lapang->jenis = $request->get('jenis');
        $lapang->harga_sewa = $request->get('harga_sewa');
        $lapang->foto = $foto;

        $lapang->save();

        $request->session()->flash('msg', 'Data lapang berhasil diubah');
        return redirect('admin/lapang');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        //
        $lapang = Lapang::findOrFail($id);
        $foto = $lapang->foto;

        if (File::exists(public_path().'/uploads/'.$foto)) {
            File::delete(public_path().'/uploads/'.$foto);
        }
        $lapang->delete();
        $request->session()->flash('msg', 'Data lapang berhasil dihapus');
        return redirect('admin/lapang');
    }
}
