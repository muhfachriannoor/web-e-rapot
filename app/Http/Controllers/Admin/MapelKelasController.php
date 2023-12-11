<?php

namespace App\Http\Controllers\Admin;

use App\Models\TahunAjaran;
use App\Models\TingkatKelas;
use App\Models\MataPelajaran;
use App\Models\MapelKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

class MapelKelasController extends Controller
{
  //function __construct()
  //{
  //  $this->middleware('admin');
  //}

  public function index()
  {
    $data = MapelKelas::where('status', NULL)->orderBy('tahun_ajaran_id', 'ASC')->orderBy('tingkat_kelas_id', 'ASC')->get();
    $title = 'Mata Pelajaran Kelas';
    return view('admin/mapel-kelas/index', compact('data', 'title'));
  }

  public function create()
  {
    $title = 'Mata Pelajaran Kelas';
    $dataTahunAjaran = TahunAjaran::where('status', NULL)->orderBy('tahun_ajaran', 'ASC')->get();
    $dataTingkatKelas = TingkatKelas::orderBy('created_at', 'ASC')->get();
    $dataMapel = MataPelajaran::where('status', NULL)->orderBy('nama_mapel', 'ASC')->get();
    return view('admin/mapel-kelas/form-add', compact('title', 'dataTahunAjaran', 'dataTingkatKelas', 'dataMapel'));
  }

  public function store(Request $request)
  {
    $request->validate([
      'tahun_ajaran_id' => 'required',
      'tingkat_kelas_id' => 'required',
      'mapel_id' => 'required',
    ]); //Memvalidasi inputan yang kita kirim apakah sudah benar

    $mapel_id = $request->input('mapel_id');
    foreach ($mapel_id as $key => $value) {
      $cekData = MapelKelas::query()
        ->where('tahun_ajaran_id', $request->input('tahun_ajaran_id'))
        ->where('tingkat_kelas_id', $request->input('tingkat_kelas_id'))
        ->where('mapel_id', $value)
        ->where('status', NULL)
        ->exists();

      $dataMapelKelas = MapelKelas::where('mapel_id', $value)->where('status', NULL)->first();
      if ($cekData) {
        return back()->withErrors([
          "error" => "Mata Pelajaran " . $dataMapelKelas->mata_pelajaran->nama_mapel . " sudah ada di tingkat " . $dataMapelKelas->tingkat_kelas->tingkat_kelas . " di tahun ajaran " . $dataMapelKelas->tahun_ajaran->tahun_ajaran,
        ])->withInput();
      }

      $dataInsertMapelKelas[] = [
        'id' => (string)Str::uuid(),
        'tahun_ajaran_id' => $request->input('tahun_ajaran_id'),
        'tingkat_kelas_id' => $request->input('tingkat_kelas_id'),
        'mapel_id' => $value
      ];
    }

    $insert = MapelKelas::insert($dataInsertMapelKelas);

    if ($insert == TRUE) {
      toastr()->success('Berhasil menambahkan data');
      return redirect()->route('mapel-kelas.index');
    } else {
      toastr()->error('Gagal menambahkan data');
      return redirect()->route('mapel-kelas.index');
    }
  }

  public function edit($id)
  {
    $datanya = MapelKelas::find($id);
    $title = 'Mata Pelajaran Kelas';
    $dataTahunAjaran = TahunAjaran::where('status', NULL)->orderBy('tahun_ajaran', 'ASC')->get();
    $dataTingkatKelas = TingkatKelas::orderBy('created_at', 'ASC')->get();
    $dataMapel = MataPelajaran::where('status', NULL)->orderBy('nama_mapel', 'ASC')->get();
    return view('admin/mapel-kelas/form-edit', compact('datanya', 'title', 'dataTahunAjaran', 'dataTingkatKelas', 'dataMapel'));
  }

  public function update(Request $request, $id)
  {
    $request->validate([
      'tahun_ajaran_id' => 'required',
      'tingkat_kelas_id' => 'required',
      'mapel_id' => 'required',
    ]); //Memvalidasi inputan yang kita kirim apakah sudah benar

    $cekData = MapelKelas::query()
      ->where('id', '!=', $id)
      ->where('tahun_ajaran_id', $request->input('tahun_ajaran_id'))
      ->where('tingkat_kelas_id', $request->input('tingkat_kelas_id'))
      ->where('mapel_id', $request->input('mapel_id'))
      ->where('status', NULL)
      ->exists();

    $dataMapelKelas = MapelKelas::where('mapel_id', $request->input('mapel_id'))->where('status', NULL)->first();
    if ($cekData) {
      return back()->withErrors([
        "error" => "Mata Pelajaran " . $dataMapelKelas->mata_pelajaran->nama_mapel . " sudah ada di tingkat " . $dataMapelKelas->tingkat_kelas->tingkat_kelas . " di tahun ajaran " . $dataMapelKelas->tahun_ajaran->tahun_ajaran,
      ])->withInput();
    }

    $dataUpdate = array(
      'tahun_ajaran_id' => $request->input('tahun_ajaran_id'),
      'tingkat_kelas_id' => $request->input('tingkat_kelas_id'),
      'mapel_id' => $request->input('mapel_id')
    );

    $update = MapelKelas::where('id', $id)->update($dataUpdate);

    if ($update == TRUE) {
      toastr()->success('Berhasil mengubah data');
      return redirect()->route('mapel-kelas.index');
    } else {
      toastr()->error('Gagal mengubah data');
      return redirect()->route('mapel-kelas.index');
    }
  }

  public function destroy($id)
  {
    $dataUpdate = array(
      'status' => 'DELETED'
    );

    $updateStatus = MapelKelas::where('id', $id)->update($dataUpdate);

    if ($updateStatus == TRUE) {
      toastr()->success('Berhasil menghapus data');
      return redirect()->route('mapel-kelas.index');
    } else {
      toastr()->error('Gagal menghapus data');
      return redirect()->route('mapel-kelas.index');
    }
  }
}
