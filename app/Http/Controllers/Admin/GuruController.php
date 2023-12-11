<?php

namespace App\Http\Controllers\Admin;

use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Imports\GuruImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class GuruController extends Controller
{
  //function __construct()
  //{
  //  $this->middleware('admin');
  //}

  public function index()
  {
    $data = Guru::where('status', NULL)->orderBy('nama_guru', 'ASC')->get();
    $title = 'Data Guru';
    return view('admin/guru/index', compact('data', 'title'));
  }

  public function create()
  {
    $title = 'Data Guru';
    return view('admin/guru/form-add', compact('title'));
  }

  public function store(Request $request)
  {
    $request->validate([
      'nip'   => 'required',
      'nama_guru'   => 'required',
      'jabatan'   => 'required',
    ]); //Memvalidasi inputan yang kita kirim apakah sudah benar

    $cekDataNamaGuru = Guru::query()
      ->where('nama_guru', $request->input('nama_guru'))
      ->where('status', NULL)
      ->exists();

    if ($cekDataNamaGuru) {
      return back()->withErrors([
        "error" => "Nama Guru " . $request->input('nama_guru') . " sudah ada!",
      ])->withInput();
    }

    $dataInsert = array(
      'id' => (string)Str::uuid(),
      'nip'   => $request->input('nip'),
      'nama_guru'   => $request->input('nama_guru'),
      'jabatan'   => $request->input('jabatan'),
    );

    $insert = Guru::create($dataInsert);

    if ($insert == TRUE) {
      toastr()->success('Berhasil menambahkan data');
      return redirect()->route('guru.index');
    } else {
      toastr()->error('Gagal menambahkan data');
      return redirect()->route('guru.index');
    }
  }

  public function importExcel()
  {
    $title = 'Data Guru';
    return view('admin/guru/form-import', compact('title'));
  }

  public function importStore(Request $request)
  {
    $request->validate([
      'file' => 'required|file|mimes:xlsx,xls,application/csv,application/excel'
    ], [
      'file.mimes' => 'Upload file dengan format Excel .xls .xlsx .csv'
    ]); //Memvalidasi inputan yang kita kirim apakah sudah benar

    $insert = Excel::import(new GuruImport, request()->file('file'));
    if ($insert == TRUE) {
      toastr()->success('Berhasil menambahkan data');
      return redirect()->route('guru.index');
    } else {
      toastr()->error('Gagal menambahkan data');
      return redirect()->route('guru.index');
    }
  }

  public function edit($id)
  {
    $datanya = Guru::find($id);
    $title = 'Data Guru';
    return view('admin/guru/form-edit', compact('datanya', 'title'));
  }

  public function update(Request $request, $id)
  {
    $request->validate([
      'nip'   => 'required',
      'nama_guru'   => 'required',
      'jabatan'   => 'required',
    ]); //Memvalidasi inputan yang kita kirim apakah sudah benar

    $cekDataNamaGuru = Guru::query()
      ->where('id', '!=', $id)
      ->where('nama_guru', $request->input('nama_guru'))
      ->where('status', NULL)
      ->exists();

    if ($cekDataNamaGuru) {
      return back()->withErrors([
        "error" => "Nama Guru " . $request->input('nama_guru') . " sudah ada!",
      ])->withInput();
    }

    $dataUpdate = array(
      'nip'   => $request->input('nip'),
      'nama_guru'   => $request->input('nama_guru'),
      'jabatan'   => $request->input('jabatan'),
    );

    $update = Guru::where('id', $id)->update($dataUpdate);

    if ($update == TRUE) {
      toastr()->success('Berhasil mengubah data');
      return redirect()->route('guru.index');
    } else {
      toastr()->error('Gagal mengubah data');
      return redirect()->route('guru.index');
    }
  }

  public function destroy($id)
  {
    $dataUpdate = array(
      'status' => 'DELETED'
    );

    $updateStatus = Guru::where('id', $id)->update($dataUpdate);

    if ($updateStatus == TRUE) {
      toastr()->success('Berhasil menghapus data');
      return redirect()->route('guru.index');
    } else {
      toastr()->error('Gagal menghapus data');
      return redirect()->route('guru.index');
    }
  }
}
