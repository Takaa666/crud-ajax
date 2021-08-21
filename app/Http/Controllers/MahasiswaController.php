<?php

namespace App\Http\Controllers;

use App\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class MahasiswaController extends Controller
{
    public function index() {
        return view('mahasiswa.index');
    }

    public function get() {
        $model = Mahasiswa::select('mahasiswa.*', 'jurusan.jurusan', 'semester.semester')
            ->join('jurusan', 'jurusan.id', 'mahasiswa.id_jurusan')
            ->join('semester', 'semester.id', 'mahasiswa.id_semester')
            ->get();
        return DataTables::of($model)->make(true);
    }

    public function create() {
        $jurusan = DB::table('jurusan')->where('status', 1)->pluck('jurusan', 'id');
        $semester = DB::table('semester')->where('status', 1)->pluck('semester', 'id');
        return view('mahasiswa.create', ['jurusan' => $jurusan, 'semester' => $semester]);
    }

    public function edit($id) {
        $model = Mahasiswa::findOrFail($id);
        $jurusan = DB::table('jurusan')->where('status', 1)->pluck('jurusan', 'id');
        $semester = DB::table('semester')->where('status', 1)->pluck('semester', 'id');
        return view('mahasiswa.edit', ['jurusan' => $jurusan, 'semester' => $semester, 'model' => $model]);
    }

    public function view($id) {
        $model = Mahasiswa::select('mahasiswa.*', 'jurusan.jurusan', 'semester.semester')
        ->join('jurusan', 'jurusan.id', 'mahasiswa.id_jurusan')
        ->join('semester', 'semester.id', 'mahasiswa.id_semester')
        ->findOrFail($id);
        return view('mahasiswa.view', ['model' => $model]);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'nama_mahasiswa' => 'required',
            'jurusan' => 'required',
            'semester' => 'required',
            'alamat' => 'required',
            'umur' => 'required',
            'email' => 'required',
        ], [
            'nama_mahasiswa.required' => 'Nama Mahasiswa Harus Di Isi',
            'jurusan.required' => 'Ju rusan Harus Di Isi',
            'semester.required' => 'Semester Harus Di Isi',
            'alamat.required' => 'Alamat Harus Di Isi',
            'umur.required' => 'Umur Harus Di Isi',
            'email.required' => 'email Harus Di Isi',
        ]);
        if($validator->fails()) {
            return response()->json([
                'errors' => $validator->messages(),
                'message' => 'Error Validation'
            ], 400);
        }
        $data = [
            'nama_mahasiswa' => $request->nama_mahasiswa,
            'id_jurusan' => $request->jurusan,
            'id_semester' => $request->semester,
            'alamat' => $request->alamat,
            'umur' => $request->umur,
            'email' => $request->email,
            'created_by' => 1,
            'created_at' => date('Y-m-d H:i:s'),
        ];
        if(Mahasiswa::create($data)) {
            return [
                'success' => true,
                'message' => 'Data Berhasil Di Tambahkan'
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Data Gagal Di Tambahkan'
            ];
        }
    }

    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'nama_mahasiswa' => 'required',
            'jurusan' => 'required',
            'semester' => 'required',
            'alamat' => 'required',
            'umur' => 'required',
            'email' => 'required',
        ], [
            'nama_mahasiswa.required' => 'Nama Mahasiswa Harus Di Isi',
            'jurusan.required' => 'Jurusan Harus Di Isi',
            'semester.required' => 'Semester Harus Di Isi',
            'alamat.required' => 'Alamat Harus Di Isi',
            'umur.required' => 'Umur Harus Di Isi',
            'email.required' => 'email Harus Di Isi',
        ]);
        if($validator->fails()) {
            return response()->json([
                'errors' => $validator->messages(),
                'message' => 'Error Validation'
            ], 400);
        }
        $data = [
            'nama_mahasiswa' => $request->nama_mahasiswa,
            'id_jurusan' => $request->jurusan,
            'id_semester' => $request->semester,
            'alamat' => $request->alamat,
            'umur' => $request->umur,
            'email' => $request->email,
            'updated_by' => 1,
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        $model = Mahasiswa::findOrFail($id);
        if($model->update($data)) {
           return [
               'success' => true,
               'message' => 'Data Berhasil Di Update'
           ];
        } else {
            return [
                'success' => false,
                'message' => 'Data Gagal Di Update'
            ];
        }
    }

    public function delete($id) {
        $model = Mahasiswa::findOrFail($id);
        if($model) {
            if($model->delete()) {
                return [
                    'success' => true,
                    'message' => 'Data Berhasil Di Hapus'
                ];
            } else {
                return [
                    'success' => false,
                    'message' => 'Data Gagal Di Hapus'
                ];
            }
        } else {
            return [
                'success' => false,
                'message' => 'Data Tidak Di Temukan'
            ];
        }
    }
}
