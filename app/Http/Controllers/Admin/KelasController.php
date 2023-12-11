<?php

namespace App\Http\Controllers\Admin;

use App\Models\TingkatKelas;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

class KelasController extends Controller
{
  //function __construct()
  //{
  //  $this->middleware('admin');
  //}

  public function index()
  {
    $data = Kelas::where('status', NULL)->orderBy('tingkat_kelas_id', 'ASC')->get();
    $title = 'Kelas';
    return view('admin/kelas/index', compact('data', 'title'));
  }

  public function create()
  {
    $title = 'Kelas';
    $datatingkatkelas = TingkatKelas::orderBy('created_at', 'ASC')->get();
    return view('admin/kelas/form-add', compact('title', 'datatingkatkelas'));
  }

  public function store(Request $request)
  {
    $request->validate([
      'tingkat_kelas_id'   => 'required',
      'nama_kelas'   => 'required',

    ]); //Memvalidasi inputan yang kita kirim apakah sudah benar

    //Mengecek jika nama kelas sudah ada
    $cekDataNamaKelas = Kelas::query()
      ->where('nama_kelas', $request->input('nama_kelas'))
      ->where('status', NULL)
      ->exists();

    if ($cekDataNamaKelas) {
      return back()->withErrors([
        "error" => "Nama Kelas " . $request->input('nama_kelas') . " sudah ada!",
      ])->withInput();
    }

    $dataInsert = array(
      'id' => (string)Str::uuid(),
      'tingkat_kelas_id' => $request->input('tingkat_kelas_id'),
      'nama_kelas' => $request->input('nama_kelas')
    );

    $insert = Kelas::create($dataInsert);

    if ($insert == TRUE) {
      toastr()->success('Berhasil menambahkan data');
      return redirect()->route('kelas.index');
    } else {
      toastr()->error('Gagal menambahkan data');
      return redirect()->route('kelas.index');
    }
  }

  public function edit($id)
  {
    $datanya = Kelas::find($id);
    $datatingkatkelas = TingkatKelas::orderBy('created_at', 'ASC')->get();
    $title = 'Kelas';
    return view('admin/kelas/form-edit', compact('datanya', 'title', 'datatingkatkelas'));
  }

  public function update(Request $request, $id)
  {
    $request->validate([
      'tingkat_kelas_id'   => 'required',
      'nama_kelas'   => 'required',

    ]); //Memvalidasi inputan yang kita kirim apakah sudah benar

    //Mengecek jika nama kelas sudah ada
    $cekDataNamaKelas = Kelas::query()
      ->where('id', '!=', $id)
      ->where('nama_kelas', $request->input('nama_kelas'))
      ->where('status', NULL)
      ->exists();

    if ($cekDataNamaKelas) {
      return back()->withErrors([
        "error" => "Nama Kelas " . $request->input('nama_kelas') . " sudah ada!",
      ])->withInput();
    }

    $dataUpdate = array(
      'tingkat_kelas_id' => $request->input('tingkat_kelas_id'),
      'nama_kelas' => $request->input('nama_kelas')
    );

    $update = Kelas::where('id', $id)->update($dataUpdate);

    if ($update == TRUE) {
      toastr()->success('Berhasil mengubah data');
      return redirect()->route('kelas.index');
    } else {
      toastr()->error('Gagal mengubah data');
      return redirect()->route('kelas.index');
    }
  }

  public function destroy($id)
  {
    $dataUpdate = array(
      'status' => 'DELETED'
    );

    $updateStatus = Kelas::where('id', $id)->update($dataUpdate);

    if ($updateStatus == TRUE) {
      toastr()->success('Berhasil menghapus data');
      return redirect()->route('kelas.index');
    } else {
      toastr()->error('Gagal menghapus data');
      return redirect()->route('kelas.index');
    }
  }
}
