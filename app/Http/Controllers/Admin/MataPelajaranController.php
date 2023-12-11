<?php

namespace App\Http\Controllers\Admin;

use App\Models\MataPelajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

class MataPelajaranController extends Controller
{
  //function __construct()
  //{
  //  $this->middleware('admin');
  //}

  public function index()
  {
    $data = MataPelajaran::where('status', NULL)->orderBy('nama_mapel', 'ASC')->get();
    $title = 'Mata Pelajaran';
    return view('admin/mata-pelajaran/index', compact('data', 'title'));
  }

  public function create()
  {
    $title = 'Mata Pelajaran';
    return view('admin/mata-pelajaran/form-add', compact('title'));
  }

  public function store(Request $request)
  {
    $request->validate([
      'nama_mapel' => 'required',
      'nilai_kkm' => 'required',
      'kelompok_mapel' => 'required',
    ]); //Memvalidasi inputan yang kita kirim apakah sudah benar

    //Mengecek jika mata pelajaran sudah ada
    $cekDataNamaMapel = MataPelajaran::query()
      ->where('nama_mapel', $request->input('nama_mapel'))
      ->where('status', NULL)
      ->exists();

    if ($cekDataNamaMapel) {
      return back()->withErrors([
        "error" => "Mata Pelajaran " . $request->input('nama_mapel') . " sudah ada!",
      ])->withInput();
    }

    $dataInsert = array(
      'id' => (string)Str::uuid(),
      'nama_mapel' => $request->input('nama_mapel'),
      'nilai_kkm' => $request->input('nilai_kkm'),
      'kelompok_mapel' => $request->input('kelompok_mapel')
    );

    $insert = MataPelajaran::create($dataInsert);

    if ($insert == TRUE) {
      toastr()->success('Berhasil menambahkan data');
      return redirect()->route('mata-pelajaran.index');
    } else {
      toastr()->error('Gagal menambahkan data');
      return redirect()->route('mata-pelajaran.index');
    }
  }

  public function edit($id)
  {
    $datanya = MataPelajaran::find($id);
    $title = 'Mata Pelajaran';
    return view('admin/mata-pelajaran/form-edit', compact('datanya', 'title'));
  }

  public function update(Request $request, $id)
  {
    $request->validate([
      'nama_mapel' => 'required',
      'nilai_kkm' => 'required',
      'kelompok_mapel' => 'required',
    ]); //Memvalidasi inputan yang kita kirim apakah sudah benar

    //Mengecek jika mata pelajaran sudah ada
    $cekDataNamaMapel = MataPelajaran::query()
      ->where('id', '!=', $id)
      ->where('nama_mapel', $request->input('nama_mapel'))
      ->where('status', NULL)
      ->exists();

    if ($cekDataNamaMapel) {
      return back()->withErrors([
        "error" => "Mata Pelajaran " . $request->input('nama_mapel') . " sudah ada!",
      ])->withInput();
    }

    $dataUpdate = array(
      'nama_mapel' => $request->input('nama_mapel'),
      'nilai_kkm' => $request->input('nilai_kkm'),
      'kelompok_mapel' => $request->input('kelompok_mapel')
    );

    $update = MataPelajaran::where('id', $id)->update($dataUpdate);

    if ($update == TRUE) {
      toastr()->success('Berhasil mengubah data');
      return redirect()->route('mata-pelajaran.index');
    } else {
      toastr()->error('Gagal mengubah data');
      return redirect()->route('mata-pelajaran.index');
    }
  }

  public function destroy($id)
  {
    $dataUpdate = array(
      'status' => 'DELETED'
    );

    $updateStatus = MataPelajaran::where('id', $id)->update($dataUpdate);

    if ($updateStatus == TRUE) {
      toastr()->success('Berhasil menghapus data');
      return redirect()->route('mata-pelajaran.index');
    } else {
      toastr()->error('Gagal menghapus data');
      return redirect()->route('mata-pelajaran.index');
    }
  }
}
