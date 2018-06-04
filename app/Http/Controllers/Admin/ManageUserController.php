<?php

namespace App\Http\Controllers\Admin;


use File;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ManageUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //


        $user = User::all();
        return view('user.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    public function ban(Request $request, $id)
    {
        //
        $user = User::findOrFail($id);
        $user->status = 'banned';
        $user->save();

        $request->session()->flash('msg', 'User berhasil diban');
        return redirect('admin/user');
    }

    public function unban(Request $request, $id)
    {
        //

        $user = User::findOrFail($id);
        $user->status = 'active';
        $user->save();

        $request->session()->flash('msg', 'User berhasil diaktifkan');
        return redirect('admin/user');
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
