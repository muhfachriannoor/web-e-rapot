<?php

namespace App\Http\Controllers\Admin;

use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

class TahunAjaranController extends Controller
{
  //function __construct()
  //{
  //  $this->middleware('admin');
  //}

  public function index()
  {
    $data = TahunAjaran::where('status', NULL)->orderBy('tahun_ajaran', 'ASC')->get();
    $title = 'Tahun Ajaran';
    return view('admin/tahun-ajaran/index', compact('data', 'title'));
  }

  public function create()
  {
    $title = 'Tahun Ajaran';
    return view('admin/tahun-ajaran/form-add', compact('title'));
  }

  public function store(Request $request)
  {
    $request->validate([
      'tahun_ajaran'   => 'required',
    ]); //Memvalidasi inputan yang kita kirim apakah sudah benar

    //Mengecek jika tahun ajaran sudah ada
    $cekDataTahunAjaran = TahunAjaran::query()
      ->where('tahun_ajaran', $request->input('tahun_ajaran'))
      ->where('status', NULL)
      ->exists();

    if ($cekDataTahunAjaran) {
      return back()->withErrors([
        "error" => "Tahun Ajaran " . $request->input('tahun_ajaran') . " sudah ada!",
      ])->withInput();
    }

    $dataInsert = array(
      'id' => (string)Str::uuid(),
      'tahun_ajaran'   => $request->input('tahun_ajaran')
    );

    $insert = TahunAjaran::create($dataInsert);

    if ($insert == TRUE) {
      toastr()->success('Berhasil menambahkan data');
      return redirect()->route('tahun-ajaran.index');
    } else {
      toastr()->error('Gagal menambahkan data');
      return redirect()->route('tahun-ajaran.index');
    }
  }

  public function edit($id)
  {
    $datanya = TahunAjaran::find($id);
    $title = 'Tahun Ajaran';
    return view('admin/tahun-ajaran/form-edit', compact('datanya', 'title'));
  }

  public function update(Request $request, $id)
  {
    $request->validate([
      'tahun_ajaran'   => 'required',
    ]); //Memvalidasi inputan yang kita kirim apakah sudah benar

    //Mengecek jika tahun ajaran sudah ada
    $cekDataTahunAjaran = TahunAjaran::query()
      ->where('id', '!=', $id)
      ->where('tahun_ajaran', $request->input('tahun_ajaran'))
      ->where('status', NULL)
      ->exists();

    if ($cekDataTahunAjaran) {
      return back()->withErrors([
        "error" => "Tahun Ajaran " . $request->input('tahun_ajaran') . " sudah ada!",
      ])->withInput();
    }

    $dataUpdate = array(
      'tahun_ajaran'   => $request->input('tahun_ajaran')
    );

    $update = TahunAjaran::where('id', $id)->update($dataUpdate);

    if ($update == TRUE) {
      toastr()->success('Berhasil mengubah data');
      return redirect()->route('tahun-ajaran.index');
    } else {
      toastr()->error('Gagal mengubah data');
      return redirect()->route('tahun-ajaran.index');
    }
  }

  public function destroy($id)
  {
    $dataUpdate = array(
      'status' => 'DELETED'
    );

    $updateStatus = TahunAjaran::where('id', $id)->update($dataUpdate);

    if ($updateStatus == TRUE) {
      toastr()->success('Berhasil menghapus data');
      return redirect()->route('tahun-ajaran.index');
    } else {
      toastr()->error('Gagal menghapus data');
      return redirect()->route('tahun-ajaran.index');
    }
  }
}
