<?php

namespace App\Http\Controllers\Admin;

use App\Models\WaliKelas;
use App\Models\Siswa;
use App\Models\KelasSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

class KelasSiswaController extends Controller
{
  //function __construct()
  //{
  //  $this->middleware('admin');
  //}

  public function index()
  {
    $data = KelasSiswa::with(['wali_kelas', 'siswa'])->where('status', NULL)->orderBy('wali_kelas_id', 'ASC')->get();
    $title = 'Data Kelas Siswa';
    return view('admin/kelas-siswa/index', compact('data', 'title'));
  }

  public function create()
  {
    $title = 'Data Kelas Siswa';
    $dataTahunAjaranWaliKelas = WaliKelas::where('status', NULL)->orderBy('tahun_ajaran_id', 'ASC')->groupBy('tahun_ajaran_id')->get();
    $dataKelas = WaliKelas::where('status', NULL)->orderBy('tahun_ajaran_id', 'ASC')->get();
    $dataSiswa = Siswa::where('status_lulus', NULL)->where('status', NULL)->orderBy('nama_siswa', 'ASC')->get();
    return view('admin/kelas-siswa/form-add', compact('title', 'dataTahunAjaranWaliKelas', 'dataKelas', 'dataSiswa'));
  }

  public function ajaxTahunAjaran($tahun_ajaran_id)
  {
    $dataKelas = WaliKelas::where('tahun_ajaran_id', $tahun_ajaran_id)->where('status', NULL)->orderBy('tahun_ajaran_id', 'ASC')->get();
    $html[] = '<option value="" selected disabled>-- PILIH KELAS --</option>';
    foreach ($dataKelas as $key => $value) {
      $html[] = '<option value="' . $value->kelas->id . '">' . $value->kelas->nama_kelas . '</option>';
    }
    return $html;
  }

  public function ajaxKelas(Request $request)
  {
    $dataGuru = WaliKelas::where('tahun_ajaran_id', $request->tahun_ajaran)->where('kelas_id', $request->kelas)->where('status', NULL)->orderBy('tahun_ajaran_id', 'ASC')->first();
    return ['nama_guru' => $dataGuru->guru->nama_guru, 'wali_kelas_id' => $dataGuru->id];
  }

  public function store(Request $request)
  {
    $request->validate([
      'tahun_ajaran_id' => 'required',
      'kelas_id' => 'required',
      'siswa_id' => 'required',
    ]); //Memvalidasi inputan yang kita kirim apakah sudah benar

    $siswa_id = $request->input('siswa_id');
    foreach ($siswa_id as $key => $value) {
      //Mengecek jika siswa sudah terdata di tahun ajaran yang sama
      $cekData = KelasSiswa::join('wali_kelas', 'kelas_siswa.wali_kelas_id', '=', 'wali_kelas.id')
        ->where('wali_kelas.tahun_ajaran_id', $request->input('tahun_ajaran_id'))
        ->where('wali_kelas.status', NULL)
        ->where('kelas_siswa.siswa_id', $value)
        ->where('kelas_siswa.status', NULL)
        ->first();
      if ($cekData != NULL) {
        return back()->withErrors([
          "error" => "NISN " . $cekData->siswa->nisn . " Nama Siswa " . $cekData->siswa->nama_siswa . " sudah ada di kelas " . $cekData->wali_kelas->kelas->nama_kelas . " di tahun ajaran " . $cekData->wali_kelas->tahun_ajaran->tahun_ajaran,
        ])->withInput();
      }

      $dataInsertKelasSiswa[] = [
        'id_kelas_siswa' => (string)Str::uuid(),
        'wali_kelas_id' => $request->input('wali_kelas_id'),
        'siswa_id' => $value
      ];
    }

    $insert = KelasSiswa::insert($dataInsertKelasSiswa);

    if ($insert == TRUE) {
      toastr()->success('Berhasil menambahkan data');
      return redirect()->route('kelas-siswa.index');
    } else {
      toastr()->error('Gagal menambahkan data');
      return redirect()->route('kelas-siswa.index');
    }
  }

  public function edit($id)
  {
    $datanya = KelasSiswa::find($id);
    $title = 'Data Kelas Siswa';
    $dataTahunAjaranWaliKelas = WaliKelas::where('status', NULL)->orderBy('tahun_ajaran_id', 'ASC')->groupBy('tahun_ajaran_id')->get();
    $dataKelas = WaliKelas::where('tahun_ajaran_id', $datanya->wali_kelas->tahun_ajaran_id)->where('status', NULL)->orderBy('tahun_ajaran_id', 'ASC')->get();
    $dataSiswa = Siswa::where('status_lulus', NULL)->where('status', NULL)->orderBy('nama_siswa', 'ASC')->get();
    return view('admin/kelas-siswa/form-edit', compact('datanya', 'title', 'dataTahunAjaranWaliKelas', 'dataKelas', 'dataSiswa'));
  }

  public function update(Request $request, $id)
  {
    $request->validate([
      'tahun_ajaran_id' => 'required',
      'kelas_id' => 'required',
      'siswa_id' => 'required',
    ]); //Memvalidasi inputan yang kita kirim apakah sudah benar

    $siswa_id = $request->input('siswa_id');
    //Mengecek jika siswa sudah terdata di tahun ajaran yang sama
    $cekData = KelasSiswa::join('wali_kelas', 'kelas_siswa.wali_kelas_id', '=', 'wali_kelas.id')
      ->where('wali_kelas.tahun_ajaran_id', $request->input('tahun_ajaran_id'))
      ->where('wali_kelas.status', NULL)
      ->where('kelas_siswa.id_kelas_siswa', '!=', $id)
      ->where('kelas_siswa.siswa_id', $siswa_id)
      ->where('kelas_siswa.status', NULL)
      ->first();
    if ($cekData != NULL) {
      return back()->withErrors([
        "error" => "NISN " . $cekData->siswa->nisn . " Nama Siswa " . $cekData->siswa->nama_siswa . " sudah ada di kelas " . $cekData->wali_kelas->kelas->nama_kelas . " di tahun ajaran " . $cekData->wali_kelas->tahun_ajaran->tahun_ajaran,
      ])->withInput();
    }

    $dataUpdate = array(
      'wali_kelas_id' => $request->input('wali_kelas_id'),
      'siswa_id' => $request->input('siswa_id'),
    );

    $update = KelasSiswa::where('id_kelas_siswa', $id)->update($dataUpdate);

    if ($update == TRUE) {
      toastr()->success('Berhasil mengubah data');
      return redirect()->route('kelas-siswa.index');
    } else {
      toastr()->error('Gagal mengubah data');
      return redirect()->route('kelas-siswa.index');
    }
  }

  public function destroy($id)
  {
    $dataUpdate = array(
      'status' => 'DELETED'
    );

    $updateStatus = KelasSiswa::where('id_kelas_siswa', $id)->update($dataUpdate);

    if ($updateStatus == TRUE) {
      toastr()->success('Berhasil menghapus data');
      return redirect()->route('kelas-siswa.index');
    } else {
      toastr()->error('Gagal menghapus data');
      return redirect()->route('kelas-siswa.index');
    }
  }
}
