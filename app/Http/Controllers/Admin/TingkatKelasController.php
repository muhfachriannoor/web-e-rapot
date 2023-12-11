<?php

namespace App\Http\Controllers\Admin;

use App\Models\TingkatKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

class TingkatKelasController extends Controller
{
  //function __construct()
  //{
  //  $this->middleware('admin');
  //}

  public function index()
  {
    $data = TingkatKelas::orderBy('created_at', 'ASC')->get();
    $title = 'Tingkat Kelas';
    return view('admin/tingkat-kelas/index', compact('data', 'title'));
  }

  public function create()
  {
    $title = 'Tingkat Kelas';
    return view('admin/tingkat-kelas/form-add', compact('title'));
  }

  public function store(Request $request)
  {
    $request->validate([
      'tingkat_kelas'   => 'required',
    ]); //Memvalidasi inputan yang kita kirim apakah sudah benar

    $cekData = TingkatKelas::query()
      ->where('tingkat_kelas', $request->input('tingkat_kelas'))
      ->exists();

    if ($cekData) {
      return back()->withErrors([
        "error" => "Tingkat Kelas " . $request->input('tingkat_kelas') . " sudah ada!",
      ])->withInput();
    }

    $dataInsert = array(
      'id' => (string)Str::uuid(),
      'tingkat_kelas'   => $request->input('tingkat_kelas')
    );

    $insert = TingkatKelas::create($dataInsert);

    if ($insert == TRUE) {
      toastr()->success('Berhasil menambahkan data');
      return redirect()->route('tingkat-kelas.index');
    } else {
      toastr()->error('Gagal menambahkan data');
      return redirect()->route('tingkat-kelas.index');
    }
  }

  public function edit($id)
  {
    $datanya = TingkatKelas::find($id);
    $title = 'Tingkat Kelas';
    return view('admin/tingkat-kelas/form-edit', compact('datanya', 'title'));
  }

  public function update(Request $request, $id)
  {
    $request->validate([
      'tingkat_kelas'   => 'required',
    ]); //Memvalidasi inputan yang kita kirim apakah sudah benar

    $cekData = TingkatKelas::query()
      ->where('id', '!=', $id)
      ->where('tingkat_kelas', $request->input('tingkat_kelas'))
      ->exists();

    if ($cekData) {
      return back()->withErrors([
        "error" => "Tingkat Kelas " . $request->input('tingkat_kelas') . " sudah ada!",
      ])->withInput();
    }

    $dataUpdate = array(
      'tingkat_kelas'   => $request->input('tingkat_kelas')
    );

    $update = TingkatKelas::where('id', $id)->update($dataUpdate);

    if ($update == TRUE) {
      toastr()->success('Berhasil mengubah data');
      return redirect()->route('tingkat-kelas.index');
    } else {
      toastr()->error('Gagal mengubah data');
      return redirect()->route('tingkat-kelas.index');
    }
  }

  public function destroy($id)
  {
    $idnya = TingkatKelas::find($id);
    $delete = $idnya->delete();
    if ($delete == TRUE) {
      toastr()->success('Berhasil menghapus data');
      return redirect()->route('tingkat-kelas.index');
    } else {
      toastr()->error('Gagal menghapus data');
      return redirect()->route('tingkat-kelas.index');
    }
  }
}
