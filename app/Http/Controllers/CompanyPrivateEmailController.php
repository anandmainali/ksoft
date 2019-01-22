<?php

namespace App\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use App\CompanyPrivateEmail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompanyPrivateEmailController extends Controller
{
    private $path = 'dashboard.pages.emails.';

    public function __construct() {
        $this->middleware(['auth','isAdmin']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emails = CompanyPrivateEmail::all();
        return view($this->path."index",compact('emails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'company_private_email'=>'required|email|unique:company_private_emails',
        ]);

        $company_private_email = $request['company_private_email'];
        $email = new CompanyPrivateEmail();
        $email->company_private_email = $company_private_email;

        $email->save();
        Toastr::success('Email '. $email->company_private_email.' added!','Success');  

        return back();
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
        $emails = CompanyPrivateEmail::all(); //Get all emails
        $email = CompanyPrivateEmail::findOrFail($id);

        return view($this->path.'index', compact('emails','email'));
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
        $email = CompanyPrivateEmail::findOrFail($id);
        $this->validate($request, [
            'company_private_email'=>'required|email|unique:company_private_emails',
        ]);

        $email->company_private_email = $request['company_private_email'];

        $email->save();
        Toastr::success('Email '. $email->company_private_email.' updated!','Success');  

        return redirect()->route('admin.companyEmail.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $email = CompanyPrivateEmail::findOrFail($id);

        $email->delete();

        Toastr::success('Email deleted! :)','Success');
        return redirect()->route('admin.companyEmail.index');
    }
}
