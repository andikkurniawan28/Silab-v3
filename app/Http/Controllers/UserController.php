<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Station;
use App\Models\Activity;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stations = Station::all();
        $users = User::all();
        $roles = Role::all();
        return view('user.index', compact('stations', 'users', 'roles'));
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
        $request->request->add(['password' => bcrypt($request->password)]);
        User::create($request->all());
        Activity::insert([
            'subject' => 'User',
            'action' => 'Create',
            'user_id' => Auth()->user()->id,
        ]);
        return redirect()->back()->with('success', 'User berhasil disimpan');
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
        $stations = Station::all();
        $roles = Role::all();
        $user = User::whereId($id)->get()->last();
        return view('user.edit', compact('stations', 'user', 'roles'));
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
        $request->request->add(['password' => bcrypt($request->password)]);
        User::whereId($id)->update([
            'is_active' => $request->is_active,
            'role_id' => $request->role_id,
            'name' => $request->name,
            'username' => $request->username,
            'password' => $request->password,
            'hmi_access' => $request->hmi_access,
        ]);
        Activity::insert([
            'subject' => 'User',
            'subject_id' => $id,
            'action' => 'Edit',
            'user_id' => Auth()->user()->id,
        ]);
        return redirect()->back()->with('success', 'User berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::whereId($id)->delete();
        Activity::insert([
            'subject' => 'User',
            'subject_id' => $id,
            'action' => 'Delete',
            'user_id' => Auth()->user()->id,
        ]);
        return redirect()->back()->with('success', 'User berhasil dihapus');
    }
}
