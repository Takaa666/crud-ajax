<?php

namespace App\Http\Controllers;

use App\Mahasiswa;
use App\Pelajaran;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class PelajaranController extends Controller
{
    public function index() {
        return view('pelajaran.index');
    }
    public function get(){
        return DataTables::of(Pelajaran::get())->make(true);
    }
    public function create(){
        return view('pelajaran.create');
    }
    public function store(Request $request) {
        $validator = Validator:: make($request->all(), [
            'mata_pelajaran'=> 'required',
            'nama_guru'=> 'required',
            'jam_pelajaran'=> 'required',
            'hari'=> 'required',
        ],[
            'mata_pelajaran.required'=> 'Mata Pelajaran Harus Di Isi',
            'nama_guru.required'=> 'Nama Guru Harus Di Isi',
            'jam_pelajaran.required'=> 'Jam Pelajaran Harus Di Isi',
            'hari.required'=> 'Hari Harus Di Isi',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors'=> $validator -> messages(),
                'message'=> 'Error Validation'
            ], 400);
        }
        $data = [
            'mata_pelajaran' => $request->mata_pelajaran,
            'nama_guru' => $request->nama_guru,
            'jam_pelajaran' => $request->jam_pelajaran,
            'hari' => $request->hari,
        ];
        if(Pelajaran::create($data)){
           return [
                'success'=> true,
                'Massage'=> 'Data Berhasil di Update'                 
            ]; 
        }  else {
            return [
                    'success'=> false,
                    'Massage'=> 'Data Gagal di Update'
                ];
            }
        }

        public function delete($id) {
            $model = Pelajaran::findOrFail($id);
            if ($model){
                if($model->delete()){
                    return [
                        'success'=>true,
                        'Massage'=>'Data Berhasil di Hapus'
                    ];
                } else {
                    return [
                        'success'=>false,
                        'Massage'=>'Data Gagal di Hapus'
                    ];
                }
            } else {
                return [
                    'success'=> false,
                    'Massage'=>'Data tidak di temukan'
                ];        
            }
        }

        public function view($id) {
            $model = Pelajaran::findOrFail($id);
            return view('pelajaran.view', ['model' => $model]);
        }
}

