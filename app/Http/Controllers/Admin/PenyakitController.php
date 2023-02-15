<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penyakit;
use Validator;
use Ramsey\Uuid\Uuid;

class PenyakitController extends Controller
{
    public function index()
    {
        $data = Penyakit::orderBy('kd_penyakit', 'ASC')->get();

        return view('admin.penyakit.index', compact('data'));
    }

    public function create()
    {
        $kode = Penyakit::select('kd_penyakit')->orderBy('kd_penyakit', 'desc')->first();

        if ($kode != null) {
            $pecah  = explode("P", $kode->kd_penyakit);
            $number = intval($pecah[1])+1;
            if ($number <10) {
                $kode   = "P0".$number;
            }else{
                $kode   = "P".$number;
            }
        }else{
            $kode = "P01";
        }

        return view('admin.penyakit.create', compact('kode'));
    }

    public function store(request $request)
    {

        $input = $request->except('_token');

        $validation = Validator::make($input,[
            'kd_penyakit'   => 'required',
            'nama_penyakit' => 'required',
            'deskripsi'     => 'required',
            'pencegahan'        => 'required',
            'penyebab'        => 'required',
            'pengobatan'        => 'required',
 		]);

		if ($validation->fails()) {

            $errors = $validation->errors();

            return redirect()->back()->with('warning',implode("\n", $errors->all()));
        }

        $data                = new Penyakit;
        $data->id            = Uuid::uuid4() -> getHex();
        $data->kd_penyakit   = $request->kd_penyakit;
        $data->nama_penyakit = $request->nama_penyakit;
        $data->deskripsi     = $request->deskripsi;
        $data->pencegahan        = $request->pencegahan;
        $data->penyebab        = $request->pencegahan;
        $data->pengobatan        = $request->pencegahan;
        $data->save();

        return redirect()->route('admin.penyakit')->with('success','Berhasil menambahkan data');

    }

    public function edit($id)
    {
        if(!$data  = Penyakit::find($id)){
            return redirect()->route('admin.penyakit')->with('warning', 'Data tidak ditemukan');
		}

        return view ('admin.penyakit.edit' ,compact('data'));

    }

    public function update(request $request, $id)
    {

        if(!$data  = Penyakit::find($id)){
            return redirect()->route('admin.penyakit')->with('warning', 'Data tidak ditemukan');
        }

        $input = $request->except('_token');

        $validation = Validator::make($input,[
            'kd_penyakit'   => 'required',
            'nama_penyakit' => 'required',
            'deskripsi'     => 'required',
            'pencegahan'        => 'required',
            'penyebab'        => 'required',
            'pengobatan'        => 'required',
 		]);

		if ($validation->fails()) {

            $errors = $validation->errors();

            return redirect()->back()->with('warning',implode("\n", $errors->all()));
        }


        $data                = Penyakit::findOrFail($id);
        $data->kd_penyakit   = $request->kd_penyakit;
        $data->nama_penyakit = $request->nama_penyakit;
        $data->deskripsi     = $request->deskripsi;
        $data->pencegahan        = $request->pencegahan;
        $data->penyebab        = $request->pencegahan;
        $data->pengobatan        = $request->pencegahan;
        $data->save();

        return redirect()->route('admin.penyakit')->with('success','Berhasil memperbaharui data');
    }

    public function destroy($id)
    {
        if(!$data  = Penyakit::find($id)){
            return redirect()->route('admin.penyakit')->with('warning', 'Data tidak ditemukan');
        }

        $data->delete();

        return redirect()->route('admin.penyakit')->with('success','Berhasil menghapus data');

    }
}
