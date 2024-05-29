<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class AgendasController extends Controller
{
    public function index()
    {
        return view('site.agendas.index');
    }
}
