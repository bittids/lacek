<?php
namespace App\Classes;

use Illuminate\Http\Request;


class URLHelper
{
    public function str_get_intended_url(Request $request)
    {
        return $request->session()->get('str_intended_url');
    }


    public function void_save_intended_url()
    {
        session(['str_intended_url' =>  url()->current()]);
    }
}