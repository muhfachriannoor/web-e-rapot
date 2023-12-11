<?php

namespace App\Http\Controllers\Admin;

use App\Models\TahunAjaran;
use App\Models\Kelas;
use App\Models\Guru;
use App\Models\WaliKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

class WaliKelasController extends Controller
{
  //function __construct()
  //{
  //  $this->middleware('admin');
  //}

  public function index()
  {
    $data = WaliKelas::where('status', NULL)->orderBy('tahun_ajaran_id', 'ASC')->get();
    $title = 'Data Wali Kelas';
    return view('admin/wali-kelas/index', compact('data', 'title'));
  }

  public function create()
  {
    $title = 'Data Wali Kelas';
    $dataTahunAjaran = TahunAjaran::where('status', NULL)->orderBy('tahun_ajaran', 'ASC')->get();
    $dataKelas = Kelas::where('status', NULL)->orderBy('tingkat_kelas_id', 'ASC')->get();
    $dataGuru = Guru::where('status', NULL)->orderBy('nama_guru', 'ASC')->get();
    return view('admin/wali-kelas/form-add', compact('title', 'dataTahunAjaran', 'dataKelas', 'dataGuru'));
  }

  public function store(Request $request)
  {
    $request->validate([
      'tahun_ajaran_id' => 'required',
      'kelas_id' => 'required',
      'guru_id' => 'required',
    ]); //Memvalidasi inputan yang kita kirim apakah sudah benar

    //Mengecek jika guru sudah menjadi wali kelas di tahun ajaran yang sama
    $cekDataTahunAjaranGuru = WaliKelas::query()
      ->where('tahun_ajaran_id', $request->input('tahun_ajaran_id'))
      ->where('guru_id', $request->input('guru_id'))
      ->where('status', NULL)
      ->exists();

    $dataWaliKelas = WaliKelas::where('guru_id', $request->input('guru_id'))->where('status', NULL)->first();
    if ($cekDataTahunAjaranGuru) {
      return back()->withErrors([
        "error" => "Guru " . $dataWaliKelas->guru->nama_guru . " sudah menjadi Wali Kelas di Kelas " . $dataWaliKelas->kelas->nama_kelas . " di tahun ajaran " . $dataWaliKelas->tahun_ajaran->tahun_ajaran,
      ])->withInput();
    }

    //Mengecek jika sudah ada wali kelas di kelas tersebut dengan tahun ajaran yang sama
    $cekDataKelas = WaliKelas::query()
      ->where('tahun_ajaran_id', $request->input('tahun_ajaran_id'))
      ->where('kelas_id', $request->input('kelas_id'))
      ->where('status', NULL)
      ->exists();

    $dataWaliKelas2 = WaliKelas::where('kelas_id', $request->input('kelas_id'))->where('status', NULL)->first();
    if ($cekDataKelas) {
      return back()->withErrors([
        "error" => "Kelas " . $dataWaliKelas2->kelas->nama_kelas . " sudah ada Wali Kelas di tahun ajaran " . $dataWaliKelas2->tahun_ajaran->tahun_ajaran,
      ])->withInput();
    }

    $dataInsert = array(
      'id' => (string)Str::uuid(),
      'tahun_ajaran_id' => $request->input('tahun_ajaran_id'),
      'kelas_id' => $request->input('kelas_id'),
      'guru_id' => $request->input('guru_id')
    );

    $insert = WaliKelas::create($dataInsert);

    if ($insert == TRUE) {
      toastr()->success('Berhasil menambahkan data');
      return redirect()->route('wali-kelas.index');
    } else {
      toastr()->error('Gagal menambahkan data');
      return redirect()->route('wali-kelas.index');
    }
  }

  public function edit($id)
  {
    $datanya = WaliKelas::find($id);
    $title = 'Data Wali Kelas';
    $dataTahunAjaran = TahunAjaran::where('status', NULL)->orderBy('tahun_ajaran', 'ASC')->get();
    $dataKelas = Kelas::where('status', NULL)->orderBy('tingkat_kelas_id', 'ASC')->get();
    $dataGuru = Guru::where('status', NULL)->orderBy('nama_guru', 'ASC')->get();
    return view('admin/wali-kelas/form-edit', compact('datanya', 'title', 'dataTahunAjaran', 'dataKelas', 'dataGuru'));
  }

  public function update(Request $request, $id)
  {
    $request->validate([
      'tahun_ajaran_id' => 'required',
      'kelas_id' => 'required',
      'guru_id' => 'required',
    ]); //Memvalidasi inputan yang kita kirim apakah sudah benar

    //Mengecek jika guru sudah menjadi wali kelas di tahun ajaran yang sama
    $cekDataTahunAjaranGuru = WaliKelas::query()
      ->where('id', '!=', $id)
      ->where('tahun_ajaran_id', $request->input('tahun_ajaran_id'))
      ->where('guru_id', $request->input('guru_id'))
      ->where('status', NULL)
      ->exists();

    $dataWaliKelas = WaliKelas::where('guru_id', $request->input('guru_id'))->where('status', NULL)->first();
    if ($cekDataTahunAjaranGuru) {
      return back()->withErrors([
        "error" => "Guru " . $dataWaliKelas->guru->nama_guru . " sudah menjadi Wali Kelas di Kelas " . $dataWaliKelas->kelas->nama_kelas . " di tahun ajaran " . $dataWaliKelas->tahun_ajaran->tahun_ajaran,
      ])->withInput();
    }

    //Mengecek jika sudah ada wali kelas di kelas tersebut dengan tahun ajaran yang sama
    $cekDataKelas = WaliKelas::query()
      ->where('id', '!=', $id)
      ->where('tahun_ajaran_id', $request->input('tahun_ajaran_id'))
      ->where('kelas_id', $request->input('kelas_id'))
      ->where('status', NULL)
      ->exists();

    $dataWaliKelas2 = WaliKelas::where('kelas_id', $request->input('kelas_id'))->where('status', NULL)->first();
    if ($cekDataKelas) {
      return back()->withErrors([
        "error" => "Kelas " . $dataWaliKelas2->kelas->nama_kelas . " sudah ada Wali Kelas di tahun ajaran " . $dataWaliKelas2->tahun_ajaran->tahun_ajaran,
      ])->withInput();
    }

    $dataUpdate = array(
      'tahun_ajaran_id' => $request->input('tahun_ajaran_id'),
      'kelas_id' => $request->input('kelas_id'),
      'guru_id' => $request->input('guru_id')
    );

    $update = WaliKelas::where('id', $id)->update($dataUpdate);

    if ($update == TRUE) {
      toastr()->success('Berhasil mengubah data');
      return redirect()->route('wali-kelas.index');
    } else {
      toastr()->error('Gagal mengubah data');
      return redirect()->route('wali-kelas.index');
    }
  }

  public function destroy($id)
  {
    $dataUpdate = array(
      'status' => 'DELETED'
    );

    $updateStatus = WaliKelas::where('id', $id)->update($dataUpdate);

    if ($updateStatus == TRUE) {
      toastr()->success('Berhasil menghapus data');
      return redirect()->route('wali-kelas.index');
    } else {
      toastr()->error('Gagal menghapus data');
      return redirect()->route('wali-kelas.index');
    }
  }
}
