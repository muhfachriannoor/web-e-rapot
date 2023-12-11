<?php

namespace App\Http\Controllers\Admin;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Imports\SiswaImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use File;

class SiswaController extends Controller
{
  //function __construct()
  //{
  //  $this->middleware('admin');
  //}

  public function index()
  {
    $data = Siswa::where('status', NULL)->orderBy('nama_siswa', 'ASC')->get();
    $title = 'Data Siswa';
    return view('admin/siswa/index', compact('data', 'title'));
  }

  public function create()
  {
    $title = 'Data Siswa';
    return view('admin/siswa/form-add', compact('title'));
  }

  public function store(Request $request)
  {
    $request->validate([
      'nisn'   => 'required',
      'nama_siswa'   => 'required',
      'jenis_kelamin'   => 'required',
      'tempat_lahir'   => 'required',
      'tanggal_lahir'   => 'required',
      'agama'   => 'required',
      'status_dalam_keluarga'   => 'required',
      'anak_ke'   => 'required',
      'alamat_rumah'   => 'required',
      'no_telp_rumah'   => 'required',
      'asal_sekolah'   => 'required',
      'diterima_dikelas'   => 'required',
      'diterima_tanggal'   => 'required',
      //'nama_ayah'   => 'required',
      //'nama_ibu'   => 'required',
      //'alamat_orangtua'   => 'required',
      //'no_telp_orangtua'   => 'required',
      //'pekerjaan_ayah'   => 'required',
      //'pekerjaan_ibu' => 'required',
      'foto_siswa' => 'required|file|image|mimes:jpeg,png,jpg'
    ]); //Memvalidasi inputan yang kita kirim apakah sudah benar

    $cekDataNisnSiswa = Siswa::query()
      ->where('nisn', $request->input('nisn'))
      ->where('status', NULL)
      ->exists();

    if ($cekDataNisnSiswa) {
      return back()->withErrors([
        "error" => "NISN Siswa " . $request->input('nisn') . " sudah ada!",
      ])->withInput();
    }

    $cekDataNamaSiswa = Siswa::query()
      ->where('nama_siswa', $request->input('nama_siswa'))
      ->where('status', NULL)
      ->exists();

    if ($cekDataNamaSiswa) {
      return back()->withErrors([
        "error" => "Nama Siswa " . $request->input('nama_siswa') . " sudah ada!",
      ])->withInput();
    }

    $file = $request->file('foto_siswa');

    $nama_file = $file->getClientOriginalName();
    $simpanfolder = 'datafoto_siswa';
    $file->move($simpanfolder, $nama_file);

    $dataInsert = array(
      'id' => (string)Str::uuid(),
      'nisn'   => $request->input('nisn'),
      'nama_siswa'   => $request->input('nama_siswa'),
      'jenis_kelamin'   => $request->input('jenis_kelamin'),
      'tempat_lahir'   => $request->input('tempat_lahir'),
      'tanggal_lahir'   => date('Y-m-d', strtotime($request->input('tanggal_lahir'))),
      'agama'   => $request->input('agama'),
      'status_dalam_keluarga'   => $request->input('status_dalam_keluarga'),
      'anak_ke'   => $request->input('anak_ke'),
      'alamat_rumah'   => $request->input('alamat_rumah'),
      'no_telp_rumah'   => $request->input('no_telp_rumah'),
      'asal_sekolah'   => $request->input('asal_sekolah'),
      'diterima_dikelas'   => $request->input('diterima_dikelas'),
      'diterima_tanggal'   => date('Y-m-d', strtotime($request->input('diterima_tanggal'))),
      'nama_ayah'   => $request->input('nama_ayah'),
      'nama_ibu'   => $request->input('nama_ibu'),
      'alamat_orangtua'   => $request->input('alamat_orangtua'),
      'no_telp_orangtua'   => $request->input('no_telp_orangtua'),
      'pekerjaan_ayah'   => $request->input('pekerjaan_ayah'),
      'pekerjaan_ibu'   => $request->input('pekerjaan_ibu'),
      'nama_wali'   => $request->input('nama_wali'),
      'alamat_wali' => $request->input('alamat_wali'),
      'no_telp_wali'   => $request->input('no_telp_wali'),
      'pekerjaan_wali'   => $request->input('pekerjaan_wali'),
      'foto_siswa'   => $nama_file,
    );

    $insert = Siswa::create($dataInsert);

    if ($insert == TRUE) {
      toastr()->success('Berhasil menambahkan data');
      return redirect()->route('siswa.index');
    } else {
      toastr()->error('Gagal menambahkan data');
      return redirect()->route('siswa.index');
    }
  }

  public function importExcel()
  {
    $title = 'Data Siswa';
    return view('admin/siswa/form-import', compact('title'));
  }

  public function importStore(Request $request)
  {
    $request->validate([
      'file' => 'required|file|mimes:xlsx,xls,application/csv,application/excel'
    ], [
      'file.mimes' => 'Upload file dengan format Excel .xls .xlsx .csv'
    ]); //Memvalidasi inputan yang kita kirim apakah sudah benar

    $insert = Excel::import(new SiswaImport, request()->file('file'));
    if ($insert == TRUE) {
      toastr()->success('Berhasil menambahkan data');
      return redirect()->route('siswa.index');
    } else {
      toastr()->error('Gagal menambahkan data');
      return redirect()->route('siswa.index');
    }
  }

  public function show($id)
  {
    $datanya = Siswa::findOrFail($id);
    $title = 'Data Siswa';
    return view('admin/siswa/detail', compact('datanya', 'title'));
  }

  public function edit($id)
  {
    $datanya = Siswa::find($id);
    $title = 'Data Siswa';
    return view('admin/siswa/form-edit', compact('datanya', 'title'));
  }

  public function update(Request $request, $id)
  {
    $request->validate([
      'nisn'   => 'required',
      'nama_siswa'   => 'required',
      'jenis_kelamin'   => 'required',
      'tempat_lahir'   => 'required',
      'tanggal_lahir'   => 'required',
      'agama'   => 'required',
      'status_dalam_keluarga'   => 'required',
      'anak_ke'   => 'required',
      'alamat_rumah'   => 'required',
      'no_telp_rumah'   => 'required',
      'asal_sekolah'   => 'required',
      'diterima_dikelas'   => 'required',
      'diterima_tanggal'   => 'required',
      //'nama_ayah'   => 'required',
      //'nama_ibu'   => 'required',
      //'alamat_orangtua'   => 'required',
      //'no_telp_orangtua'   => 'required',
      //'pekerjaan_ayah'   => 'required',
      //'pekerjaan_ibu' => 'required',
      'foto_siswa' => 'file|image|mimes:jpeg,png,jpg'
    ]); //Memvalidasi inputan yang kita kirim apakah sudah benar

    $cekDataNisnSiswa = Siswa::query()
      ->where('id', '!=', $id)
      ->where('nisn', $request->input('nisn'))
      ->where('status', NULL)
      ->exists();

    if ($cekDataNisnSiswa) {
      return back()->withErrors([
        "error" => "NISN Siswa " . $request->input('nisn') . " sudah ada!",
      ])->withInput();
    }

    $cekDataNamaSiswa = Siswa::query()
      ->where('id', '!=', $id)
      ->where('nama_siswa', $request->input('nama_siswa'))
      ->where('status', NULL)
      ->exists();

    if ($cekDataNamaSiswa) {
      return back()->withErrors([
        "error" => "Nama Siswa " . $request->input('nama_siswa') . " sudah ada!",
      ])->withInput();
    }

    $dataSiswa = Siswa::find($id);
    $file = $request->file('foto_siswa');
    if ($file != NULL) {
      $hapus = File::delete(public_path('datafoto_siswa/' . $dataSiswa->foto_siswa));
      $nama_file = $file->getClientOriginalName();
      $simpanfolder = 'datafoto_siswa';
      $file->move($simpanfolder, $nama_file);
    } else {
      $nama_file = $dataSiswa->foto_siswa;
    }

    $dataUpdate = array(
      'nisn'   => $request->input('nisn'),
      'nama_siswa'   => $request->input('nama_siswa'),
      'jenis_kelamin'   => $request->input('jenis_kelamin'),
      'tempat_lahir'   => $request->input('tempat_lahir'),
      'tanggal_lahir'   => date('Y-m-d', strtotime($request->input('tanggal_lahir'))),
      'agama'   => $request->input('agama'),
      'status_dalam_keluarga'   => $request->input('status_dalam_keluarga'),
      'anak_ke'   => $request->input('anak_ke'),
      'alamat_rumah'   => $request->input('alamat_rumah'),
      'no_telp_rumah'   => $request->input('no_telp_rumah'),
      'asal_sekolah'   => $request->input('asal_sekolah'),
      'diterima_dikelas'   => $request->input('diterima_dikelas'),
      'diterima_tanggal'   => date('Y-m-d', strtotime($request->input('diterima_tanggal'))),
      'nama_ayah'   => $request->input('nama_ayah'),
      'nama_ibu'   => $request->input('nama_ibu'),
      'alamat_orangtua'   => $request->input('alamat_orangtua'),
      'no_telp_orangtua'   => $request->input('no_telp_orangtua'),
      'pekerjaan_ayah'   => $request->input('pekerjaan_ayah'),
      'pekerjaan_ibu'   => $request->input('pekerjaan_ibu'),
      'nama_wali'   => $request->input('nama_wali'),
      'alamat_wali' => $request->input('alamat_wali'),
      'no_telp_wali'   => $request->input('no_telp_wali'),
      'pekerjaan_wali'   => $request->input('pekerjaan_wali'),
      'foto_siswa'   => $nama_file,
    );

    $update = Siswa::where('id', $id)->update($dataUpdate);

    if ($update == TRUE) {
      toastr()->success('Berhasil mengubah data');
      return redirect()->route('siswa.index');
    } else {
      toastr()->error('Gagal mengubah data');
      return redirect()->route('siswa.index');
    }
  }

  public function destroy($id)
  {
    $dataUpdate = array(
      'status' => 'DELETED'
    );

    $updateStatus = Siswa::where('id', $id)->update($dataUpdate);

    if ($updateStatus == TRUE) {
      toastr()->success('Berhasil menghapus data');
      return redirect()->route('siswa.index');
    } else {
      toastr()->error('Gagal menghapus data');
      return redirect()->route('siswa.index');
    }
  }
}
