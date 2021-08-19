<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PelajaranController extends Controller
{
    public function index() {
        return view('pelajaran.index');
    }
    public function create(){
        return view('pelajaran.create');
    }
    public function store(Request $request) {
        $validator= Validator:: make($request->all(), [
            'mata_pelajaran'=> 'required'
            'nama_guru'=> 'required'
            'jam_pelajaran'=> 'required'
            'hari'=> 'required'
            


    }
}