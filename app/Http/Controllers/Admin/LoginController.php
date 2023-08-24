<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\Admin;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.auth.login');
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create(LoginRequest $request)
    {
        if (auth()->guard('admin')->attempt(['username' => $request->input('username'),'password' => $request->input('password')])){

            return redirect()->route('admin.dashboard');
        }else{
            return  redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        auth()->logout();
        return redirect()->route('admin.showLogin');
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
/*
    function make_admin(){
        // the save in the database is the command line is => php artisan tinker <= after the code in the command line is copay the function past in the command line OK
        /*
        $admin = new App\Models\Admin();
        $admin->name='admin';
        $admin->username='admin';
        $admin->email='admin@gmail.com';
        $admin->password=bcrypt('admin');
        $admin->com_code= 1;
        $admin->added_by= 1;
        $admin->save();


    }
    */
}
