<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicPagesController extends Controller
{   
    public function get_index()
    {
        return view('public.index');
    }

}
