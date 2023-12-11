<?php

namespace App\Http\Controllers\Admin;

use App\Models\TahunAjaran;
use App\Models\TingkatKelas;
use App\Models\MataPelajaran;
use App\Models\Guru;
use App\Models\WaliKelas;
use App\Models\Siswa;
use App\Models\KelasSiswa;
use App\Models\Rapot;
use App\Models\NilaiMapel;
use App\Models\Sikap;
use App\Models\Prestasi;
use App\Models\Ekstrakurikuler;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class RapotController extends Controller
{
  //function __construct()
  //{
  //  $this->middleware('admin');
  //}

  public function TahunAjaran()
  {
    $data = KelasSiswa::join('wali_kelas', 'kelas_siswa.wali_kelas_id', '=', 'wali_kelas.id')
      ->where('wali_kelas.status', NULL)
      ->where('kelas_siswa.status', NULL)
      ->orderBy('wali_kelas.tahun_ajaran_id', 'ASC')
      ->groupBy('wali_kelas.tahun_ajaran_id')
      ->get();
    $title = 'Rapot';
    return view('admin/rapot/tahun-ajaran', compact('data', 'title'));
  }

  public function Kelas($tahun_ajaran_idnya)
  {
    $data = KelasSiswa::join('wali_kelas', 'kelas_siswa.wali_kelas_id', '=', 'wali_kelas.id')
      ->join('kelas', 'wali_kelas.kelas_id', '=', 'kelas.id')
      ->join('tingkat_kelas', 'kelas.tingkat_kelas_id', '=', 'tingkat_kelas.id')
      ->where('wali_kelas.tahun_ajaran_id', $tahun_ajaran_idnya)
      ->where('kelas_siswa.status', NULL)
      ->where('wali_kelas.status', NULL)
      ->where('kelas.status', NULL)
      ->orderBy('tingkat_kelas.created_at', 'ASC')
      ->groupBy('wali_kelas.kelas_id')
      ->get();
    $titleTahunAjaran = TahunAjaran::where('id', $tahun_ajaran_idnya)->where('status', NULL)->first();
    $title = 'Rapot';
    return view('admin/rapot/kelas', compact('data', 'title', 'titleTahunAjaran'));
  }

  public function Siswa(Request $request)
  {
    $tahun_ajaran_id = $request->tahun_ajaran_id;
    $kelas_id = $request->kelas_id;
    $dataTitle = WaliKelas::where('tahun_ajaran_id', $tahun_ajaran_id)->where('kelas_id', $kelas_id)->where('status', NULL)->first();
    $data = KelasSiswa::join('wali_kelas', 'kelas_siswa.wali_kelas_id', '=', 'wali_kelas.id')
      ->join('siswa', 'kelas_siswa.siswa_id', '=', 'siswa.id')
      ->join('kelas', 'wali_kelas.kelas_id', '=', 'kelas.id')
      ->where('wali_kelas.tahun_ajaran_id', $tahun_ajaran_id)
      ->where('wali_kelas.kelas_id', $kelas_id)
      ->where('kelas_siswa.status', NULL)
      ->where('wali_kelas.status', NULL)
      ->where('kelas.status', NULL)
      ->orderBy('siswa.nama_siswa', 'ASC')
      ->get();
    $cekRapotMidSemesterGanjil = Rapot::cekRapotSemester($tahun_ajaran_id, $kelas_id, 'MID Semester Ganjil');
    $cekRapotSemesterGanjil = Rapot::cekRapotSemester($tahun_ajaran_id, $kelas_id, 'Semester Ganjil');
    $cekRapotMidSemesterGenap = Rapot::cekRapotSemester($tahun_ajaran_id, $kelas_id, 'MID Semester Genap');
    $cekRapotSemesterGenap = Rapot::cekRapotSemester($tahun_ajaran_id, $kelas_id, 'Semester Genap');
    $title = 'Rapot';
    return view('admin/rapot/siswa', compact('data', 'title', 'dataTitle', 'cekRapotMidSemesterGanjil', 'cekRapotSemesterGanjil', 'cekRapotMidSemesterGenap', 'cekRapotSemesterGenap'));
  }

  public function WaliKelas()
  {
    //dd(auth()->user()->guru_id);
    $data = WaliKelas::join('tahun_ajaran', 'wali_kelas.tahun_ajaran_id', '=', 'tahun_ajaran.id')
      ->join('kelas', 'wali_kelas.kelas_id', '=', 'kelas.id')
      ->join('tingkat_kelas', 'kelas.tingkat_kelas_id', '=', 'tingkat_kelas.id')
      ->where('wali_kelas.guru_id', auth()->user()->guru_id)
      ->where('wali_kelas.status', NULL)
      ->where('kelas.status', NULL)
      ->orderBy('tahun_ajaran.tahun_ajaran', 'ASC')
      ->get();
    $title = 'Rapot';
    return view('admin/rapot/wali-kelas', compact('data', 'title'));
  }

  public function SemesterCreate(Request $request)
  {
    $tahun_ajaran_id = $request->tahun_ajaran_id;
    $kelas_id = $request->kelas_id;
    $semester = $request->semester;
    $dataTitle = WaliKelas::where('tahun_ajaran_id', $tahun_ajaran_id)->where('kelas_id', $kelas_id)->where('status', NULL)->first();
    $data = KelasSiswa::join('wali_kelas', 'kelas_siswa.wali_kelas_id', '=', 'wali_kelas.id')
      ->join('siswa', 'kelas_siswa.siswa_id', '=', 'siswa.id')
      ->whereNotExists(function ($query) use ($semester) {
        $query->select('*')
          ->from('rapot')
          ->where('semester', $semester)
          ->where('status', NULL)
          ->whereRaw('kelas_siswa.id_kelas_siswa = rapot.kelas_siswa_id');
      })
      ->where('wali_kelas.tahun_ajaran_id', $tahun_ajaran_id)
      ->where('wali_kelas.kelas_id', $kelas_id)
      ->where('kelas_siswa.status', NULL)
      ->where('wali_kelas.status', NULL)
      ->where('siswa.status', NULL)
      ->orderBy('siswa.nama_siswa', 'ASC')
      ->get();
    $title = 'Rapot';
    return view('admin/rapot/semester/semester-form-add', compact('data', 'title', 'dataTitle', 'semester'));
  }

  public function SemesterStore(Request $request)
  {
    $request->validate([
      'semester' => 'required',
      'sakit' => 'required',
      'izin' => 'required',
      'tanpa_keterangan' => 'required',
      'catatan_walikelas' => 'required',
    ]); //Memvalidasi inputan yang kita kirim apakah sudah benar

    $tahun_ajaran_id = $request->tahun_ajaran_id;
    $kelas_id = $request->kelas_id;
    $kelas_siswa_id = $request->input('kelas_siswa_id');
    $sakit = $request->input('sakit');
    $izin = $request->input('izin');
    $tanpa_keterangan = $request->input('tanpa_keterangan');
    $catatan_walikelas = $request->input('catatan_walikelas');
    $tanggapan_orangtua_wali = $request->input('tanggapan_orangtua_wali');
    foreach ($kelas_siswa_id as $key => $value) {
      $dataInsertRapotSiswa[] = [
        'id_rapot' => (string)Str::uuid(),
        'kelas_siswa_id' => $value,
        'semester' => $request->input('semester'),
        'keputusan_kelas' => $request->input('keputusan_kelas'),
        'sakit' => $sakit[$key],
        'izin' => $izin[$key],
        'tanpa_keterangan' => $tanpa_keterangan[$key],
        'catatan_walikelas' => $catatan_walikelas[$key],
        'tanggapan_orangtua_wali' => $tanggapan_orangtua_wali[$key],
        'created_at_rapot' => Carbon::now(),
      ];
    }

    $insert = Rapot::insert($dataInsertRapotSiswa);

    if ($insert == TRUE) {
      toastr()->success('Berhasil menambahkan data');
      return redirect()->route('rapot.Siswa', ['tahun_ajaran_id' => $tahun_ajaran_id, 'kelas_id' => $kelas_id]);
    } else {
      toastr()->error('Gagal menambahkan data');
      return redirect()->route('rapot.Siswa', ['tahun_ajaran_id' => $tahun_ajaran_id, 'kelas_id' => $kelas_id]);
    }
  }

  public function Semester(Request $request)
  {
    $tahun_ajaran_id = $request->tahun_ajaran_id;
    $kelas_id = $request->kelas_id;
    $semester = $request->semester;
    $dataTitle = WaliKelas::where('tahun_ajaran_id', $tahun_ajaran_id)->where('kelas_id', $kelas_id)->where('status', NULL)->first();
    $dataMapel = Rapot::dataMapel($tahun_ajaran_id, $dataTitle->kelas->tingkat_kelas_id);
    $cekSikapdanSpiritual = Rapot::cekSikapdanSpiritual($tahun_ajaran_id, $kelas_id, $semester);
    $cekEkstrakurikuler = Rapot::cekEkstrakurikuler($tahun_ajaran_id, $kelas_id, $semester);
    $cekKeputusanKelas = Rapot::cekKeputusanKelas($tahun_ajaran_id, $kelas_id);
    $data = Rapot::join('kelas_siswa', 'rapot.kelas_siswa_id', '=', 'kelas_siswa.id_kelas_siswa')
      ->join('wali_kelas', 'kelas_siswa.wali_kelas_id', '=', 'wali_kelas.id')
      ->join('siswa', 'kelas_siswa.siswa_id', '=', 'siswa.id')
      ->join('kelas', 'wali_kelas.kelas_id', '=', 'kelas.id')
      ->where('wali_kelas.tahun_ajaran_id', $tahun_ajaran_id)
      ->where('wali_kelas.kelas_id', $kelas_id)
      ->where('rapot.semester', $semester)
      ->where('rapot.status', NULL)
      ->where('kelas_siswa.status', NULL)
      ->where('wali_kelas.status', NULL)
      ->where('siswa.status', NULL)
      ->where('kelas.status', NULL)
      ->orderBy('siswa.nama_siswa', 'ASC')
      ->get();
    $title = 'Rapot';
    return view('admin/rapot/semester/semester', compact('data', 'title', 'dataTitle', 'dataMapel', 'semester', 'cekSikapdanSpiritual', 'cekEkstrakurikuler', 'cekKeputusanKelas'));
  }

  public function CetakRapot(Request $request)
  {
    $tahun_ajaran_id = $request->tahun_ajaran_id;
    $kelas_id = $request->kelas_id;
    $semester = $request->semester;
    $id_rapot = $request->id_rapot;

    $dataRapot = Rapot::find($id_rapot);
    $dataNilaiMapelKelompokA = NilaiMapel::join('mata_pelajaran', 'nilai_mapel.id_mapel', '=', 'mata_pelajaran.id')
      ->where('mata_pelajaran.kelompok_mapel', 'Kelompok A')
      ->where('mata_pelajaran.status', NULL)
      ->where('nilai_mapel.rapot_id', $id_rapot)
      ->where('nilai_mapel.status', NULL)
      ->get();
    $dataNilaiMapelKelompokB = NilaiMapel::join('mata_pelajaran', 'nilai_mapel.id_mapel', '=', 'mata_pelajaran.id')
      ->where('mata_pelajaran.kelompok_mapel', 'Kelompok B')
      ->where('mata_pelajaran.status', NULL)
      ->where('nilai_mapel.rapot_id', $id_rapot)
      ->where('nilai_mapel.status', NULL)
      ->get();
    $dataPrestasi = Prestasi::where('rapot_id', $id_rapot)->get();
    $dataSikap = Sikap::where('rapot_id', $id_rapot)->first();
    $dataEkstrakurikuler = Ekstrakurikuler::where('rapot_id', $id_rapot)->get();
    $dataKepalaSekolah = Guru::where('jabatan', 'Kepala Sekolah')->first();

    if ($semester == 'MID Semester Ganjil' or $semester == 'MID Semester Genap') {
      return view('admin/rapot/semester/cetak-mid-semester', compact('semester', 'dataRapot', 'dataNilaiMapelKelompokA', 'dataNilaiMapelKelompokB', 'dataKepalaSekolah'));
    } elseif ($semester == 'Semester Ganjil') {
      return view('admin/rapot/semester/cetak-semester-ganjil', compact('semester', 'dataRapot', 'dataNilaiMapelKelompokA', 'dataNilaiMapelKelompokB', 'dataPrestasi', 'dataSikap', 'dataEkstrakurikuler', 'dataKepalaSekolah'));
    } else {
      return view('admin/rapot/semester/cetak-semester-genap', compact('semester', 'dataRapot', 'dataNilaiMapelKelompokA', 'dataNilaiMapelKelompokB', 'dataPrestasi', 'dataSikap', 'dataEkstrakurikuler', 'dataKepalaSekolah'));
    }
  }

  public function SemesterEdit(Request $request)
  {
    $datanya = Rapot::find($request->id_rapot);
    $title = 'Rapot';
    return view('admin/rapot/semester/semester-form-edit', compact('datanya', 'title'));
  }

  public function SemesterUpdate(Request $request)
  {
    $request->validate([
      'nisn' => 'required',
      'nama_siswa' => 'required',
      'sakit' => 'required',
      'izin' => 'required',
      'tanpa_keterangan' => 'required',
      'catatan_walikelas' => 'required',
    ]); //Memvalidasi inputan yang kita kirim apakah sudah benar

    $dataUpdate = array(
      'sakit' => $request->input('sakit'),
      'izin' => $request->input('izin'),
      'tanpa_keterangan' => $request->input('tanpa_keterangan'),
      'catatan_walikelas' => $request->input('catatan_walikelas'),
      'tanggapan_orangtua_wali' => $request->input('tanggapan_orangtua_wali'),
      'updated_at_rapot' => Carbon::now(),
    );

    $update = Rapot::where('id_rapot', $request->id_rapot)->update($dataUpdate);

    if ($update == TRUE) {
      toastr()->success('Berhasil mengubah data');
      return redirect()->route('rapot.Semester', ['tahun_ajaran_id' => $request->tahun_ajaran_id, 'kelas_id' => $request->kelas_id, 'semester' => $request->semester]);
    } else {
      toastr()->error('Gagal mengubah data');
      return redirect()->route('rapot.Semester', ['tahun_ajaran_id' => $request->tahun_ajaran_id, 'kelas_id' => $request->kelas_id, 'semester' => $request->semester]);
    }
  }

  public function NilaiMapelCreate(Request $request)
  {
    $tahun_ajaran_id = $request->tahun_ajaran_id;
    $kelas_id = $request->kelas_id;
    $semester = $request->semester;
    $mapel_id = $request->mapel_id;
    $dataTitle = WaliKelas::where('tahun_ajaran_id', $tahun_ajaran_id)->where('kelas_id', $kelas_id)->where('status', NULL)->first();
    $dataMapel = MataPelajaran::where('id', $mapel_id)->first();
    $data = Rapot::join('kelas_siswa', 'rapot.kelas_siswa_id', '=', 'kelas_siswa.id_kelas_siswa')
      ->join('wali_kelas', 'kelas_siswa.wali_kelas_id', '=', 'wali_kelas.id')
      ->join('siswa', 'kelas_siswa.siswa_id', '=', 'siswa.id')
      ->whereNotExists(function ($query) use ($mapel_id) {
        $query->select('*')
          ->from('nilai_mapel')
          ->where('status', NULL)
          ->where('id_mapel', $mapel_id)
          ->whereRaw('rapot.id_rapot = nilai_mapel.rapot_id');
      })
      ->where('wali_kelas.tahun_ajaran_id', $tahun_ajaran_id)
      ->where('wali_kelas.kelas_id', $kelas_id)
      ->where('rapot.semester', $semester)
      ->where('rapot.status', NULL)
      ->where('kelas_siswa.status', NULL)
      ->where('wali_kelas.status', NULL)
      ->where('siswa.status', NULL)
      ->orderBy('siswa.nama_siswa', 'ASC')
      ->get();
    $title = 'Rapot';
    return view('admin/rapot/nilai-mapel/nilai-mapel-form-add', compact('data', 'title', 'dataTitle', 'dataMapel', 'semester', 'mapel_id'));
  }

  public function NilaiMapelStore(Request $request)
  {
    $validation = array(
      'rapot_id.*' => 'required',
      'id_mapel.*' => 'required',
      'nilai_pengetahuan.*' => 'required',
      'predikat_pengetahuan.*' => 'required',
      'nilai_keterampilan.*' => 'required',
      'predikat_keterampilan.*' => 'required',
    );

    if ($request->semester == 'Semester Ganjil' or $request->semester == 'Semester Genap') {
      $validation['deskripsi_pengetahuan.*'] = 'required';
      $validation['deskripsi_keterampilan.*'] = 'required';
    }

    $request->validate($validation); //Memvalidasi inputan yang kita kirim apakah sudah benar

    $tahun_ajaran_id = $request->tahun_ajaran_id;
    $kelas_id = $request->kelas_id;
    $semester = $request->semester;
    $rapot_id = $request->input('rapot_id');
    $id_mapel = $request->input('id_mapel');
    $nilai_pengetahuan = $request->input('nilai_pengetahuan');
    $predikat_pengetahuan = $request->input('predikat_pengetahuan');
    $deskripsi_pengetahuan = $request->input('deskripsi_pengetahuan');
    $nilai_keterampilan = $request->input('nilai_keterampilan');
    $predikat_keterampilan = $request->input('predikat_keterampilan');
    $deskripsi_keterampilan = $request->input('deskripsi_keterampilan');
    $cekNilaiKkmMapel = MataPelajaran::find($request->mapel_id);

    foreach ($rapot_id as $key => $value) {
      if ($nilai_pengetahuan[$key] >= $cekNilaiKkmMapel->nilai_kkm and $nilai_keterampilan[$key] >= $cekNilaiKkmMapel->nilai_kkm) {
        $status_kkm = 'Lulus Nilai KKM';
      } else {
        $status_kkm = 'Tidak Lulus Nilai KKM';
      }

      $dataInsertNilai[] = array(
        'id_nilai_mapel' => (string)Str::uuid(),
        'rapot_id' => $value,
        'id_mapel' => $id_mapel[$key],
        'nilai_pengetahuan' => $nilai_pengetahuan[$key],
        'predikat_pengetahuan' => $predikat_pengetahuan[$key],
        'nilai_keterampilan' => $nilai_keterampilan[$key],
        'predikat_keterampilan' => $predikat_keterampilan[$key],
        'status_kkm' => $status_kkm,
        'created_at_nilai' => Carbon::now(),
      );

      if ($request->semester == 'Semester Ganjil' or $request->semester == 'Semester Genap') {
        $dataDekripsi[] = array(
          'deskripsi_pengetahuan' => $deskripsi_pengetahuan[$key],
          'deskripsi_keterampilan' => $deskripsi_keterampilan[$key]
        );
        $dataInsertSemesterGanjilGenap[] = array_merge($dataInsertNilai[$key], $dataDekripsi[$key]);
      }
    }

    if ($request->semester == 'Semester Ganjil' or $request->semester == 'Semester Genap') {
      $insert = NilaiMapel::insert($dataInsertSemesterGanjilGenap);
    } else {
      $insert = NilaiMapel::insert($dataInsertNilai);
    }

    if ($insert == TRUE) {
      toastr()->success('Berhasil menambahkan data');
      return redirect()->route('rapot.Semester', ['tahun_ajaran_id' => $tahun_ajaran_id, 'kelas_id' => $kelas_id, 'semester' => $semester]);
    } else {
      toastr()->error('Gagal menambahkan data');
      return redirect()->route('rapot.Semester', ['tahun_ajaran_id' => $tahun_ajaran_id, 'kelas_id' => $kelas_id, 'semester' => $semester]);
    }
  }

  public function NilaiMapel(Request $request)
  {
    $tahun_ajaran_id = $request->tahun_ajaran_id;
    $kelas_id = $request->kelas_id;
    $semester = $request->semester;
    $mapel_id = $request->mapel_id;
    $dataTitle = WaliKelas::where('tahun_ajaran_id', $tahun_ajaran_id)->where('kelas_id', $kelas_id)->where('status', NULL)->first();
    $dataMapel = MataPelajaran::where('id', $mapel_id)->first();
    $data = NilaiMapel::join('rapot', 'nilai_mapel.rapot_id', '=', 'rapot.id_rapot')
      ->join('kelas_siswa', 'rapot.kelas_siswa_id', '=', 'kelas_siswa.id_kelas_siswa')
      ->join('wali_kelas', 'kelas_siswa.wali_kelas_id', '=', 'wali_kelas.id')
      ->join('siswa', 'kelas_siswa.siswa_id', '=', 'siswa.id')
      ->join('kelas', 'wali_kelas.kelas_id', '=', 'kelas.id')
      ->where('wali_kelas.tahun_ajaran_id', $tahun_ajaran_id)
      ->where('wali_kelas.kelas_id', $kelas_id)
      ->where('rapot.semester', $semester)
      ->where('nilai_mapel.id_mapel', $dataMapel->id)
      ->where('nilai_mapel.status', NULL)
      ->where('rapot.status', NULL)
      ->where('kelas_siswa.status', NULL)
      ->where('wali_kelas.status', NULL)
      ->where('siswa.status', NULL)
      ->where('kelas.status', NULL)
      ->orderBy('siswa.nama_siswa', 'ASC')
      ->get();
    $title = 'Rapot';
    return view('admin/rapot/nilai-mapel/nilai-mapel', compact('data', 'title', 'dataTitle', 'dataMapel', 'semester'));
  }

  public function NilaiMapelEdit(Request $request)
  {
    $datanya = NilaiMapel::find($request->id_nilai_mapel);
    $title = 'Rapot';
    return view('admin/rapot/nilai-mapel/nilai-mapel-form-edit', compact('datanya', 'title'));
  }

  public function NilaiMapelUpdate(Request $request)
  {
    $validation = array(
      'nilai_pengetahuan' => 'required',
      'predikat_pengetahuan' => 'required',
      'nilai_keterampilan' => 'required',
      'predikat_keterampilan' => 'required',
    );

    if ($request->semester == 'Semester Ganjil' or $request->semester == 'Semester Genap') {
      $validation['deskripsi_pengetahuan'] = 'required';
      $validation['deskripsi_keterampilan'] = 'required';
    }

    $request->validate($validation); //Memvalidasi inputan yang kita kirim apakah sudah benar

    $cekNilaiKkmMapel = MataPelajaran::find($request->mapel_id);
    $nilai_pengetahuan = $request->input('nilai_pengetahuan');
    $nilai_keterampilan = $request->input('nilai_keterampilan');
    if ($nilai_pengetahuan >= $cekNilaiKkmMapel->nilai_kkm and $nilai_keterampilan >= $cekNilaiKkmMapel->nilai_kkm) {
      $status_kkm = 'Lulus Nilai KKM';
    } else {
      $status_kkm = 'Tidak Lulus Nilai KKM';
    }

    $dataUpdate = array(
      'nilai_pengetahuan' => $nilai_pengetahuan,
      'predikat_pengetahuan' => $request->input('predikat_pengetahuan'),
      'deskripsi_pengetahuan' => $request->input('deskripsi_pengetahuan'),
      'nilai_keterampilan' => $nilai_keterampilan,
      'predikat_keterampilan' => $request->input('predikat_keterampilan'),
      'deskripsi_keterampilan' => $request->input('deskripsi_keterampilan'),
      'status_kkm' => $status_kkm,
      'updated_at_nilai' => Carbon::now(),
    );

    $update = NilaiMapel::where('id_nilai_mapel', $request->id_nilai_mapel)->update($dataUpdate);

    if ($update == TRUE) {
      toastr()->success('Berhasil mengubah data');
      return redirect()->route('rapot.NilaiMapel', ['tahun_ajaran_id' => $request->tahun_ajaran_id, 'kelas_id' => $request->kelas_id, 'semester' => $request->semester, 'mapel_id' => $request->mapel_id]);
    } else {
      toastr()->error('Gagal mengubah data');
      return redirect()->route('rapot.NilaiMapel', ['tahun_ajaran_id' => $request->tahun_ajaran_id, 'kelas_id' => $request->kelas_id, 'semester' => $request->semester, 'mapel_id' => $request->mapel_id]);
    }
  }

  public function SikapCreate(Request $request)
  {
    $tahun_ajaran_id = $request->tahun_ajaran_id;
    $kelas_id = $request->kelas_id;
    $semester = $request->semester;
    $dataTitle = WaliKelas::where('tahun_ajaran_id', $tahun_ajaran_id)->where('kelas_id', $kelas_id)->where('status', NULL)->first();
    $data = Rapot::join('kelas_siswa', 'rapot.kelas_siswa_id', '=', 'kelas_siswa.id_kelas_siswa')
      ->join('wali_kelas', 'kelas_siswa.wali_kelas_id', '=', 'wali_kelas.id')
      ->join('siswa', 'kelas_siswa.siswa_id', '=', 'siswa.id')
      ->whereNotExists(function ($query) {
        $query->select('*')
          ->from('sikap')
          ->where('status', NULL)
          ->whereRaw('rapot.id_rapot = sikap.rapot_id');
      })
      ->where('wali_kelas.tahun_ajaran_id', $tahun_ajaran_id)
      ->where('wali_kelas.kelas_id', $kelas_id)
      ->where('rapot.semester', $semester)
      ->where('rapot.status', NULL)
      ->where('kelas_siswa.status', NULL)
      ->where('wali_kelas.status', NULL)
      ->where('siswa.status', NULL)
      ->orderBy('siswa.nama_siswa', 'ASC')
      ->get();
    $title = 'Rapot';
    return view('admin/rapot/sikap/sikap-form-add', compact('data', 'title', 'dataTitle', 'semester'));
  }

  public function SikapStore(Request $request)
  {
    $validation = array(
      'rapot_id.*' => 'required',
      'predikat_spiritual.*' => 'required',
      'deskripsi_spiritual.*' => 'required',
      'predikat_sosial.*' => 'required',
      'deskripsi_sosial.*' => 'required',
    );

    $request->validate($validation); //Memvalidasi inputan yang kita kirim apakah sudah benar

    $tahun_ajaran_id = $request->tahun_ajaran_id;
    $kelas_id = $request->kelas_id;
    $semester = $request->semester;
    $rapot_id = $request->input('rapot_id');
    $predikat_spiritual = $request->input('predikat_spiritual');
    $deskripsi_spiritual = $request->input('deskripsi_spiritual');
    $predikat_sosial = $request->input('predikat_sosial');
    $deskripsi_sosial = $request->input('deskripsi_sosial');

    foreach ($rapot_id as $key => $value) {
      $dataInsertSikap[] = array(
        'id_sikap' => (string)Str::uuid(),
        'rapot_id' => $value,
        'predikat_spiritual' => $predikat_spiritual[$key],
        'deskripsi_spiritual' => $deskripsi_spiritual[$key],
        'predikat_sosial' => $predikat_sosial[$key],
        'deskripsi_sosial' => $deskripsi_sosial[$key],
        'created_at_sikap' => Carbon::now(),
      );
    }

    $insert = Sikap::insert($dataInsertSikap);

    if ($insert == TRUE) {
      toastr()->success('Berhasil menambahkan data');
      return redirect()->route('rapot.Semester', ['tahun_ajaran_id' => $tahun_ajaran_id, 'kelas_id' => $kelas_id, 'semester' => $semester]);
    } else {
      toastr()->error('Gagal menambahkan data');
      return redirect()->route('rapot.Semester', ['tahun_ajaran_id' => $tahun_ajaran_id, 'kelas_id' => $kelas_id, 'semester' => $semester]);
    }
  }

  public function Sikap(Request $request)
  {
    $tahun_ajaran_id = $request->tahun_ajaran_id;
    $kelas_id = $request->kelas_id;
    $semester = $request->semester;
    $dataTitle = WaliKelas::where('tahun_ajaran_id', $tahun_ajaran_id)->where('kelas_id', $kelas_id)->where('status', NULL)->first();
    $data = Sikap::join('rapot', 'sikap.rapot_id', '=', 'rapot.id_rapot')
      ->join('kelas_siswa', 'rapot.kelas_siswa_id', '=', 'kelas_siswa.id_kelas_siswa')
      ->join('wali_kelas', 'kelas_siswa.wali_kelas_id', '=', 'wali_kelas.id')
      ->join('siswa', 'kelas_siswa.siswa_id', '=', 'siswa.id')
      ->join('kelas', 'wali_kelas.kelas_id', '=', 'kelas.id')
      ->where('wali_kelas.tahun_ajaran_id', $tahun_ajaran_id)
      ->where('wali_kelas.kelas_id', $kelas_id)
      ->where('rapot.semester', $semester)
      ->where('sikap.status', NULL)
      ->where('rapot.status', NULL)
      ->where('kelas_siswa.status', NULL)
      ->where('wali_kelas.status', NULL)
      ->where('siswa.status', NULL)
      ->where('kelas.status', NULL)
      ->orderBy('siswa.nama_siswa', 'ASC')
      ->get();
    $title = 'Rapot';
    return view('admin/rapot/sikap/sikap', compact('data', 'title', 'dataTitle', 'semester'));
  }

  public function SikapEdit(Request $request)
  {
    $datanya = Sikap::find($request->id_sikap);
    $title = 'Rapot';
    return view('admin/rapot/sikap/sikap-form-edit', compact('datanya', 'title'));
  }

  public function SikapUpdate(Request $request)
  {
    $validation = array(
      'predikat_spiritual' => 'required',
      'deskripsi_spiritual' => 'required',
      'predikat_sosial' => 'required',
      'deskripsi_sosial' => 'required',
    );

    $request->validate($validation); //Memvalidasi inputan yang kita kirim apakah sudah benar

    $dataUpdate = array(
      'predikat_spiritual' => $request->input('predikat_spiritual'),
      'deskripsi_spiritual' => $request->input('deskripsi_spiritual'),
      'predikat_sosial' => $request->input('predikat_sosial'),
      'deskripsi_sosial' => $request->input('deskripsi_sosial'),
      'updated_at_sikap' => Carbon::now(),
    );

    $update = Sikap::where('id_sikap', $request->id_sikap)->update($dataUpdate);

    if ($update == TRUE) {
      toastr()->success('Berhasil mengubah data');
      return redirect()->route('rapot.Sikap', ['tahun_ajaran_id' => $request->tahun_ajaran_id, 'kelas_id' => $request->kelas_id, 'semester' => $request->semester]);
    } else {
      toastr()->error('Gagal mengubah data');
      return redirect()->route('rapot.Sikap', ['tahun_ajaran_id' => $request->tahun_ajaran_id, 'kelas_id' => $request->kelas_id, 'semester' => $request->semester]);
    }
  }

  public function Prestasi(Request $request)
  {
    $tahun_ajaran_id = $request->tahun_ajaran_id;
    $kelas_id = $request->kelas_id;
    $semester = $request->semester;
    $dataTitle = WaliKelas::where('tahun_ajaran_id', $tahun_ajaran_id)->where('kelas_id', $kelas_id)->where('status', NULL)->first();
    $data = Prestasi::join('rapot', 'prestasi.rapot_id', '=', 'rapot.id_rapot')
      ->join('kelas_siswa', 'rapot.kelas_siswa_id', '=', 'kelas_siswa.id_kelas_siswa')
      ->join('wali_kelas', 'kelas_siswa.wali_kelas_id', '=', 'wali_kelas.id')
      ->join('siswa', 'kelas_siswa.siswa_id', '=', 'siswa.id')
      ->join('kelas', 'wali_kelas.kelas_id', '=', 'kelas.id')
      ->where('wali_kelas.tahun_ajaran_id', $tahun_ajaran_id)
      ->where('wali_kelas.kelas_id', $kelas_id)
      ->where('rapot.semester', $semester)
      ->where('prestasi.status', NULL)
      ->where('rapot.status', NULL)
      ->where('kelas_siswa.status', NULL)
      ->where('wali_kelas.status', NULL)
      ->where('siswa.status', NULL)
      ->where('kelas.status', NULL)
      ->orderBy('siswa.nama_siswa', 'ASC')
      ->get();
    $title = 'Rapot';
    return view('admin/rapot/prestasi/prestasi', compact('data', 'title', 'dataTitle', 'semester'));
  }

  public function PrestasiCreate(Request $request)
  {
    $tahun_ajaran_id = $request->tahun_ajaran_id;
    $kelas_id = $request->kelas_id;
    $semester = $request->semester;
    $dataTitle = WaliKelas::where('tahun_ajaran_id', $tahun_ajaran_id)->where('kelas_id', $kelas_id)->where('status', NULL)->first();
    $dataSiswa = Rapot::join('kelas_siswa', 'rapot.kelas_siswa_id', '=', 'kelas_siswa.id_kelas_siswa')
      ->join('wali_kelas', 'kelas_siswa.wali_kelas_id', '=', 'wali_kelas.id')
      ->join('siswa', 'kelas_siswa.siswa_id', '=', 'siswa.id')
      ->join('kelas', 'wali_kelas.kelas_id', '=', 'kelas.id')
      ->where('wali_kelas.tahun_ajaran_id', $tahun_ajaran_id)
      ->where('wali_kelas.kelas_id', $kelas_id)
      ->where('rapot.semester', $semester)
      ->where('rapot.status', NULL)
      ->where('kelas_siswa.status', NULL)
      ->where('wali_kelas.status', NULL)
      ->where('siswa.status', NULL)
      ->where('kelas.status', NULL)
      ->orderBy('siswa.nama_siswa', 'ASC')
      ->get();
    $title = 'Rapot';
    return view('admin/rapot/prestasi/prestasi-form-add', compact('dataSiswa', 'title', 'dataTitle', 'semester'));
  }

  public function PrestasiStore(Request $request)
  {
    $validation = array(
      'rapot_id' => 'required',
      'jenis_prestasi' => 'required',
      'keterangan_prestasi' => 'required',
    );

    $request->validate($validation); //Memvalidasi inputan yang kita kirim apakah sudah benar

    $dataInsert = array(
      'id_prestasi' => (string)Str::uuid(),
      'rapot_id'   => $request->input('rapot_id'),
      'jenis_prestasi'   => $request->input('jenis_prestasi'),
      'keterangan_prestasi'   => $request->input('keterangan_prestasi'),
      'created_at_prestasi'   => Carbon::now(),
    );

    $insert = Prestasi::create($dataInsert);

    if ($insert == TRUE) {
      toastr()->success('Berhasil mengubah data');
      return redirect()->route('rapot.Prestasi', ['tahun_ajaran_id' => $request->tahun_ajaran_id, 'kelas_id' => $request->kelas_id, 'semester' => $request->semester]);
    } else {
      toastr()->error('Gagal mengubah data');
      return redirect()->route('rapot.Prestasi', ['tahun_ajaran_id' => $request->tahun_ajaran_id, 'kelas_id' => $request->kelas_id, 'semester' => $request->semester]);
    }
  }

  public function PrestasiEdit(Request $request)
  {
    $datanya = Prestasi::find($request->id_prestasi);
    $dataSiswa = Rapot::join('kelas_siswa', 'rapot.kelas_siswa_id', '=', 'kelas_siswa.id_kelas_siswa')
      ->join('wali_kelas', 'kelas_siswa.wali_kelas_id', '=', 'wali_kelas.id')
      ->join('siswa', 'kelas_siswa.siswa_id', '=', 'siswa.id')
      ->join('kelas', 'wali_kelas.kelas_id', '=', 'kelas.id')
      ->where('wali_kelas.tahun_ajaran_id', $request->tahun_ajaran_id)
      ->where('wali_kelas.kelas_id', $request->kelas_id)
      ->where('rapot.semester', $request->semester)
      ->where('rapot.status', NULL)
      ->where('kelas_siswa.status', NULL)
      ->where('wali_kelas.status', NULL)
      ->where('siswa.status', NULL)
      ->where('kelas.status', NULL)
      ->orderBy('siswa.nama_siswa', 'ASC')
      ->get();
    $title = 'Rapot';
    return view('admin/rapot/prestasi/prestasi-form-edit', compact('dataSiswa', 'title', 'datanya'));
  }

  public function PrestasiUpdate(Request $request)
  {
    $validation = array(
      'rapot_id' => 'required',
      'jenis_prestasi' => 'required',
      'keterangan_prestasi' => 'required',
    );

    $request->validate($validation); //Memvalidasi inputan yang kita kirim apakah sudah benar

    $dataUpdate = array(
      'rapot_id' => $request->input('rapot_id'),
      'jenis_prestasi' => $request->input('jenis_prestasi'),
      'keterangan_prestasi' => $request->input('keterangan_prestasi'),
      'updated_at_prestasi' => Carbon::now(),
    );

    $update = Prestasi::where('id_prestasi', $request->id_prestasi)->update($dataUpdate);

    if ($update == TRUE) {
      toastr()->success('Berhasil mengubah data');
      return redirect()->route('rapot.Prestasi', ['tahun_ajaran_id' => $request->tahun_ajaran_id, 'kelas_id' => $request->kelas_id, 'semester' => $request->semester]);
    } else {
      toastr()->error('Gagal mengubah data');
      return redirect()->route('rapot.Prestasi', ['tahun_ajaran_id' => $request->tahun_ajaran_id, 'kelas_id' => $request->kelas_id, 'semester' => $request->semester]);
    }
  }

  public function PrestasiDestroy(Request $request)
  {
    $dataUpdate = array(
      'status' => 'DELETED'
    );

    $updateStatus = Prestasi::where('id_prestasi', $request->id_prestasi)->update($dataUpdate);

    if ($updateStatus == TRUE) {
      toastr()->success('Berhasil mengubah data');
      return redirect()->route('rapot.Prestasi', ['tahun_ajaran_id' => $request->tahun_ajaran_id, 'kelas_id' => $request->kelas_id, 'semester' => $request->semester]);
    } else {
      toastr()->error('Gagal mengubah data');
      return redirect()->route('rapot.Prestasi', ['tahun_ajaran_id' => $request->tahun_ajaran_id, 'kelas_id' => $request->kelas_id, 'semester' => $request->semester]);
    }
  }

  public function EkstrakurikulerCreate(Request $request)
  {
    $tahun_ajaran_id = $request->tahun_ajaran_id;
    $kelas_id = $request->kelas_id;
    $semester = $request->semester;
    $dataTitle = WaliKelas::where('tahun_ajaran_id', $tahun_ajaran_id)->where('kelas_id', $kelas_id)->where('status', NULL)->first();
    $data = Rapot::join('kelas_siswa', 'rapot.kelas_siswa_id', '=', 'kelas_siswa.id_kelas_siswa')
      ->join('wali_kelas', 'kelas_siswa.wali_kelas_id', '=', 'wali_kelas.id')
      ->join('siswa', 'kelas_siswa.siswa_id', '=', 'siswa.id')
      ->whereNotExists(function ($query) {
        $query->select('*')
          ->from('ekstrakurikuler')
          ->where('status', NULL)
          ->whereRaw('rapot.id_rapot = ekstrakurikuler.rapot_id');
      })
      ->where('wali_kelas.tahun_ajaran_id', $tahun_ajaran_id)
      ->where('wali_kelas.kelas_id', $kelas_id)
      ->where('rapot.semester', $semester)
      ->where('rapot.status', NULL)
      ->where('kelas_siswa.status', NULL)
      ->where('wali_kelas.status', NULL)
      ->where('siswa.status', NULL)
      ->orderBy('siswa.nama_siswa', 'ASC')
      ->get();
    $title = 'Rapot';
    return view('admin/rapot/ekstrakurikuler/ekstrakurikuler-form-add', compact('data', 'title', 'dataTitle', 'semester'));
  }

  public function EkstrakurikulerStore(Request $request)
  {
    $validation = array(
      'rapot_id.*' => 'required',
      'kegiatan_ekstrakurikuler1.*' => 'required',
      'keterangan_ekstrakurikuler1.*' => 'required',
      'kegiatan_ekstrakurikuler2.*' => 'required',
      'keterangan_ekstrakurikuler2.*' => 'required',
    );

    $request->validate($validation); //Memvalidasi inputan yang kita kirim apakah sudah benar

    $tahun_ajaran_id = $request->tahun_ajaran_id;
    $kelas_id = $request->kelas_id;
    $semester = $request->semester;
    $rapot_id = $request->input('rapot_id');
    $kegiatan_ekstrakurikuler1 = $request->input('kegiatan_ekstrakurikuler1');
    $keterangan_ekstrakurikuler1 = $request->input('keterangan_ekstrakurikuler1');
    $kegiatan_ekstrakurikuler2 = $request->input('kegiatan_ekstrakurikuler2');
    $keterangan_ekstrakurikuler2 = $request->input('keterangan_ekstrakurikuler2');

    foreach ($rapot_id as $key => $value) {
      $dataInsertEskul1[] = array(
        'id_ekstrakurikuler' => (string)Str::uuid(),
        'rapot_id' => $value,
        'kegiatan_ekstrakurikuler' => $kegiatan_ekstrakurikuler1[$key],
        'keterangan_ekstrakurikuler' => $keterangan_ekstrakurikuler1[$key],
        'created_at_ekstrakurikuler' => Carbon::now(),
      );
      $dataInsertEskul2[] = array(
        'id_ekstrakurikuler' => (string)Str::uuid(),
        'rapot_id' => $value,
        'kegiatan_ekstrakurikuler' => $kegiatan_ekstrakurikuler2[$key],
        'keterangan_ekstrakurikuler' => $keterangan_ekstrakurikuler2[$key],
        'created_at_ekstrakurikuler' => Carbon::now(),
      );
    }

    $insertEskul1 = Ekstrakurikuler::insert($dataInsertEskul1);
    $insertEskul2 = Ekstrakurikuler::insert($dataInsertEskul2);

    if ($insertEskul1 == TRUE and $insertEskul2 == TRUE) {
      toastr()->success('Berhasil menambahkan data');
      return redirect()->route('rapot.Semester', ['tahun_ajaran_id' => $tahun_ajaran_id, 'kelas_id' => $kelas_id, 'semester' => $semester]);
    } else {
      toastr()->error('Gagal menambahkan data');
      return redirect()->route('rapot.Semester', ['tahun_ajaran_id' => $tahun_ajaran_id, 'kelas_id' => $kelas_id, 'semester' => $semester]);
    }
  }

  public function Ekstrakurikuler(Request $request)
  {
    $tahun_ajaran_id = $request->tahun_ajaran_id;
    $kelas_id = $request->kelas_id;
    $semester = $request->semester;
    $dataTitle = WaliKelas::where('tahun_ajaran_id', $tahun_ajaran_id)->where('kelas_id', $kelas_id)->where('status', NULL)->first();
    //$data = Rapot::with('EkstrakurikulerData')
    //  ->join('kelas_siswa', 'rapot.kelas_siswa_id', '=', 'kelas_siswa.id_kelas_siswa')
    //  ->join('wali_kelas', 'kelas_siswa.wali_kelas_id', '=', 'wali_kelas.id')
    //  ->join('siswa', 'kelas_siswa.siswa_id', '=', 'siswa.id')
    //  ->where('wali_kelas.tahun_ajaran_id', $tahun_ajaran_id)
    //  ->where('wali_kelas.kelas_id', $kelas_id)
    //  ->where('rapot.semester', $semester)
    //  ->where('rapot.status', null)
    //  ->where('kelas_siswa.status', null)
    //  ->where('wali_kelas.status', null)
    //  ->get();
    //dd($data);
    $data = Ekstrakurikuler::join('rapot', 'ekstrakurikuler.rapot_id', '=', 'rapot.id_rapot')
      ->join('kelas_siswa', 'rapot.kelas_siswa_id', '=', 'kelas_siswa.id_kelas_siswa')
      ->join('wali_kelas', 'kelas_siswa.wali_kelas_id', '=', 'wali_kelas.id')
      ->join('siswa', 'kelas_siswa.siswa_id', '=', 'siswa.id')
      ->join('kelas', 'wali_kelas.kelas_id', '=', 'kelas.id')
      ->where('wali_kelas.tahun_ajaran_id', $tahun_ajaran_id)
      ->where('wali_kelas.kelas_id', $kelas_id)
      ->where('rapot.semester', $semester)
      ->where('ekstrakurikuler.status', NULL)
      ->where('rapot.status', NULL)
      ->where('kelas_siswa.status', NULL)
      ->where('wali_kelas.status', NULL)
      ->where('siswa.status', NULL)
      ->where('kelas.status', NULL)
      ->orderBy('siswa.nama_siswa', 'ASC')
      ->get();
    $title = 'Rapot';
    return view('admin/rapot/ekstrakurikuler/ekstrakurikuler', compact('data', 'title', 'dataTitle', 'semester'));
  }

  public function EkstrakurikulerEdit(Request $request)
  {
    $datanya = Ekstrakurikuler::find($request->id_ekstrakurikuler);
    $title = 'Rapot';
    return view('admin/rapot/ekstrakurikuler/ekstrakurikuler-form-edit', compact('datanya', 'title'));
  }

  public function EkstrakurikulerUpdate(Request $request)
  {
    $validation = array(
      'kegiatan_ekstrakurikuler' => 'required',
      'keterangan_ekstrakurikuler' => 'required',
    );

    $request->validate($validation); //Memvalidasi inputan yang kita kirim apakah sudah benar

    $dataUpdate = array(
      'kegiatan_ekstrakurikuler' => $request->input('kegiatan_ekstrakurikuler'),
      'keterangan_ekstrakurikuler' => $request->input('keterangan_ekstrakurikuler'),
      'updated_at_ekstrakurikuler' => Carbon::now(),
    );

    $update = Ekstrakurikuler::where('id_ekstrakurikuler', $request->id_ekstrakurikuler)->update($dataUpdate);

    if ($update == TRUE) {
      toastr()->success('Berhasil mengubah data');
      return redirect()->route('rapot.Ekstrakurikuler', ['tahun_ajaran_id' => $request->tahun_ajaran_id, 'kelas_id' => $request->kelas_id, 'semester' => $request->semester]);
    } else {
      toastr()->error('Gagal mengubah data');
      return redirect()->route('rapot.Ekstrakurikuler', ['tahun_ajaran_id' => $request->tahun_ajaran_id, 'kelas_id' => $request->kelas_id, 'semester' => $request->semester]);
    }
  }

  public function KeputusanNaikTidakNaikCreate(Request $request)
  {
    $tahun_ajaran_id = $request->tahun_ajaran_id;
    $kelas_id = $request->kelas_id;
    $semester = $request->semester;
    $dataTitle = WaliKelas::where('tahun_ajaran_id', $tahun_ajaran_id)->where('kelas_id', $kelas_id)->where('status', NULL)->first();
    $data = Rapot::join('kelas_siswa', 'rapot.kelas_siswa_id', '=', 'kelas_siswa.id_kelas_siswa')
      ->join('wali_kelas', 'kelas_siswa.wali_kelas_id', '=', 'wali_kelas.id')
      ->join('siswa', 'kelas_siswa.siswa_id', '=', 'siswa.id')
      ->whereNotExists(function ($query) {
        $query->select('*')
          ->from('rapot')
          ->where('keputusan_kelas', '!=', NULL)
          ->where('status', NULL)
          ->whereRaw('kelas_siswa.id_kelas_siswa = rapot.kelas_siswa_id');
      })
      ->where('wali_kelas.tahun_ajaran_id', $tahun_ajaran_id)
      ->where('wali_kelas.kelas_id', $kelas_id)
      ->where('rapot.semester', $semester)
      ->where('rapot.status', NULL)
      ->where('kelas_siswa.status', NULL)
      ->where('wali_kelas.status', NULL)
      ->where('siswa.status', NULL)
      ->orderBy('siswa.nama_siswa', 'ASC')
      ->get();
    $title = 'Rapot';
    return view('admin/rapot/keputusan-naiktidaknaik/keputusan-naiktidaknaik-form-add', compact('data', 'title', 'dataTitle', 'semester'));
  }

  public function AjaxKeputusanKelas(Request $request)
  {
    $keputusan_kelas = $request->keputusan_kelas;
    $tingkat_kelas_id = $request->tingkat_kelas_id;
    $dataTingkatKelas = TingkatKelas::where('id', $tingkat_kelas_id)->first();

    if ($keputusan_kelas == 'Naik Kelas') { //if Naik Kelas
      if ($dataTingkatKelas->tingkat_kelas == 'Kelas VII (7)') {
        return 'Kelas VIII (8)';
      } elseif ($dataTingkatKelas->tingkat_kelas == 'Kelas VIII (8)') {
        return 'Kelas IX (9)';
      }
    } else { //else Tidak Naik Kelas
      if ($dataTingkatKelas->tingkat_kelas == 'Kelas VII (7)') {
        return 'Tetap di Kelas VII (7)';
      } elseif ($dataTingkatKelas->tingkat_kelas == 'Kelas VIII (8)') {
        return 'Tetap di Kelas VIII (8)';
      }
    }
  }

  public function KeputusanNaikTidakNaikStore(Request $request)
  {
    $validation = array(
      'rapot_id.*' => 'required',
      'keputusan_kelas.*' => 'required',
      'tingkat_kelas.*' => 'required',
    );

    $request->validate($validation); //Memvalidasi inputan yang kita kirim apakah sudah benar

    $tahun_ajaran_id = $request->tahun_ajaran_id;
    $kelas_id = $request->kelas_id;
    $semester = $request->semester;
    $rapot_id = $request->input('rapot_id');
    $keputusan_kelas = $request->input('keputusan_kelas');
    $tingkat_kelas = $request->input('tingkat_kelas');

    foreach ($rapot_id as $key => $value) {
      $dataUpdateKeputusan = array(
        'keputusan_kelas' => $keputusan_kelas[$key],
        'keputusan_tingkat_kelas' => $tingkat_kelas[$key],
      );
      $UpdateKeputusan = Rapot::where('id_rapot', $value)->update($dataUpdateKeputusan);
    }

    if ($UpdateKeputusan == TRUE) {
      toastr()->success('Berhasil menambahkan data');
      return redirect()->route('rapot.Semester', ['tahun_ajaran_id' => $tahun_ajaran_id, 'kelas_id' => $kelas_id, 'semester' => $semester]);
    } else {
      toastr()->error('Gagal menambahkan data');
      return redirect()->route('rapot.Semester', ['tahun_ajaran_id' => $tahun_ajaran_id, 'kelas_id' => $kelas_id, 'semester' => $semester]);
    }
  }

  public function KeputusanNaikTidakNaik(Request $request)
  {
    $tahun_ajaran_id = $request->tahun_ajaran_id;
    $kelas_id = $request->kelas_id;
    $semester = $request->semester;
    $dataTitle = WaliKelas::where('tahun_ajaran_id', $tahun_ajaran_id)->where('kelas_id', $kelas_id)->where('status', NULL)->first();
    $data = Rapot::join('kelas_siswa', 'rapot.kelas_siswa_id', '=', 'kelas_siswa.id_kelas_siswa')
      ->join('wali_kelas', 'kelas_siswa.wali_kelas_id', '=', 'wali_kelas.id')
      ->join('siswa', 'kelas_siswa.siswa_id', '=', 'siswa.id')
      ->join('kelas', 'wali_kelas.kelas_id', '=', 'kelas.id')
      ->where('wali_kelas.tahun_ajaran_id', $tahun_ajaran_id)
      ->where('wali_kelas.kelas_id', $kelas_id)
      ->where('rapot.semester', $semester)
      ->where('rapot.status', NULL)
      ->where('kelas_siswa.status', NULL)
      ->where('wali_kelas.status', NULL)
      ->where('siswa.status', NULL)
      ->where('kelas.status', NULL)
      ->orderBy('siswa.nama_siswa', 'ASC')
      ->get();
    $title = 'Rapot';
    return view('admin/rapot/keputusan-naiktidaknaik/keputusan-naiktidaknaik', compact('data', 'title', 'dataTitle', 'semester'));
  }

  public function KeputusanNaikTidakNaikEdit(Request $request)
  {
    $datanya = Rapot::find($request->id_rapot);
    $title = 'Rapot';
    return view('admin/rapot/keputusan-naiktidaknaik/keputusan-naiktidaknaik-form-edit', compact('datanya', 'title'));
  }

  public function KeputusanNaikTidakNaikUpdate(Request $request)
  {
    $validation = array(
      'keputusan_kelas' => 'required',
      'tingkat_kelas' => 'required',
    );

    $request->validate($validation); //Memvalidasi inputan yang kita kirim apakah sudah benar

    $dataUpdate = array(
      'keputusan_kelas' => $request->input('keputusan_kelas'),
      'keputusan_tingkat_kelas' => $request->input('tingkat_kelas'),
    );

    $update = Rapot::where('id_rapot', $request->id_rapot)->update($dataUpdate);

    if ($update == TRUE) {
      toastr()->success('Berhasil mengubah data');
      return redirect()->route('rapot.KeputusanNaikTidakNaik', ['tahun_ajaran_id' => $request->tahun_ajaran_id, 'kelas_id' => $request->kelas_id, 'semester' => $request->semester]);
    } else {
      toastr()->error('Gagal mengubah data');
      return redirect()->route('rapot.KeputusanNaikTidakNaik', ['tahun_ajaran_id' => $request->tahun_ajaran_id, 'kelas_id' => $request->kelas_id, 'semester' => $request->semester]);
    }
  }

  public function KeputusanLulusTidakLulusCreate(Request $request)
  {
    $tahun_ajaran_id = $request->tahun_ajaran_id;
    $kelas_id = $request->kelas_id;
    $semester = $request->semester;
    $dataTitle = WaliKelas::where('tahun_ajaran_id', $tahun_ajaran_id)->where('kelas_id', $kelas_id)->where('status', NULL)->first();
    $data = Rapot::join('kelas_siswa', 'rapot.kelas_siswa_id', '=', 'kelas_siswa.id_kelas_siswa')
      ->join('wali_kelas', 'kelas_siswa.wali_kelas_id', '=', 'wali_kelas.id')
      ->join('siswa', 'kelas_siswa.siswa_id', '=', 'siswa.id')
      ->whereNotExists(function ($query) {
        $query->select('*')
          ->from('rapot')
          ->where('keputusan_kelas', '!=', NULL)
          ->where('status', NULL)
          ->whereRaw('kelas_siswa.id_kelas_siswa = rapot.kelas_siswa_id');
      })
      ->where('wali_kelas.tahun_ajaran_id', $tahun_ajaran_id)
      ->where('wali_kelas.kelas_id', $kelas_id)
      ->where('rapot.semester', $semester)
      ->where('rapot.status', NULL)
      ->where('kelas_siswa.status', NULL)
      ->where('wali_kelas.status', NULL)
      ->where('siswa.status', NULL)
      ->orderBy('siswa.nama_siswa', 'ASC')
      ->get();
    $title = 'Rapot';
    return view('admin/rapot/keputusan-lulustidaklulus/keputusan-lulustidaklulus-form-add', compact('data', 'title', 'dataTitle', 'semester'));
  }

  public function KeputusanLulusTidakLulusStore(Request $request)
  {
    $validation = array(
      'rapot_id.*' => 'required',
      'keputusan_kelas.*' => 'required',
      'siswa_id.*' => 'required',
    );

    $request->validate($validation); //Memvalidasi inputan yang kita kirim apakah sudah benar

    $tahun_ajaran_id = $request->tahun_ajaran_id;
    $kelas_id = $request->kelas_id;
    $semester = $request->semester;
    $rapot_id = $request->input('rapot_id');
    $keputusan_kelas = $request->input('keputusan_kelas');
    $siswa_id = $request->input('siswa_id');

    foreach ($rapot_id as $key => $value) {
      if ($keputusan_kelas[$key] == 'Lulus') {
        $dataUpdateSiswa = array(
          'status_lulus' => $keputusan_kelas[$key],
        );
        $UpdateKeputusan = Siswa::where('id', $siswa_id[$key])->update($dataUpdateSiswa);
      }

      $dataUpdateKeputusan = array(
        'keputusan_kelas' => $keputusan_kelas[$key],
      );
      $UpdateKeputusan = Rapot::where('id_rapot', $value)->update($dataUpdateKeputusan);
    }

    if ($UpdateKeputusan == TRUE) {
      toastr()->success('Berhasil menambahkan data');
      return redirect()->route('rapot.Semester', ['tahun_ajaran_id' => $tahun_ajaran_id, 'kelas_id' => $kelas_id, 'semester' => $semester]);
    } else {
      toastr()->error('Gagal menambahkan data');
      return redirect()->route('rapot.Semester', ['tahun_ajaran_id' => $tahun_ajaran_id, 'kelas_id' => $kelas_id, 'semester' => $semester]);
    }
  }

  public function KeputusanLulusTidakLulus(Request $request)
  {
    $tahun_ajaran_id = $request->tahun_ajaran_id;
    $kelas_id = $request->kelas_id;
    $semester = $request->semester;
    $dataTitle = WaliKelas::where('tahun_ajaran_id', $tahun_ajaran_id)->where('kelas_id', $kelas_id)->where('status', NULL)->first();
    $data = Rapot::join('kelas_siswa', 'rapot.kelas_siswa_id', '=', 'kelas_siswa.id_kelas_siswa')
      ->join('wali_kelas', 'kelas_siswa.wali_kelas_id', '=', 'wali_kelas.id')
      ->join('siswa', 'kelas_siswa.siswa_id', '=', 'siswa.id')
      ->join('kelas', 'wali_kelas.kelas_id', '=', 'kelas.id')
      ->where('wali_kelas.tahun_ajaran_id', $tahun_ajaran_id)
      ->where('wali_kelas.kelas_id', $kelas_id)
      ->where('rapot.semester', $semester)
      ->where('rapot.status', NULL)
      ->where('kelas_siswa.status', NULL)
      ->where('wali_kelas.status', NULL)
      ->where('siswa.status', NULL)
      ->where('kelas.status', NULL)
      ->orderBy('siswa.nama_siswa', 'ASC')
      ->get();
    $title = 'Rapot';
    return view('admin/rapot/keputusan-lulustidaklulus/keputusan-lulustidaklulus', compact('data', 'title', 'dataTitle', 'semester'));
  }

  public function KeputusanLulusTidakLulusEdit(Request $request)
  {
    $datanya = Rapot::find($request->id_rapot);
    $title = 'Rapot';
    return view('admin/rapot/keputusan-lulustidaklulus/keputusan-lulustidaklulus-form-edit', compact('datanya', 'title'));
  }

  public function KeputusanLulusTidakLulusUpdate(Request $request)
  {
    $validation = array(
      'keputusan_kelas' => 'required',
      'siswa_id' => 'required',
    );

    $request->validate($validation); //Memvalidasi inputan yang kita kirim apakah sudah benar

    $keputusan_kelas = $request->input('keputusan_kelas');
    $siswa_id = $request->input('siswa_id');

    if ($keputusan_kelas == 'Lulus') {
      $dataUpdateSiswa = array(
        'status_lulus' => 'Lulus',
      );
    } else {
      $dataUpdateSiswa = array(
        'status_lulus' => NULL,
      );
    }
    $UpdateSiswa = Siswa::where('id', $siswa_id)->update($dataUpdateSiswa);

    $dataUpdate = array(
      'keputusan_kelas' => $keputusan_kelas,
    );

    $update = Rapot::where('id_rapot', $request->id_rapot)->update($dataUpdate);

    if ($update == TRUE) {
      toastr()->success('Berhasil mengubah data');
      return redirect()->route('rapot.KeputusanLulusTidakLulus', ['tahun_ajaran_id' => $request->tahun_ajaran_id, 'kelas_id' => $request->kelas_id, 'semester' => $request->semester]);
    } else {
      toastr()->error('Gagal mengubah data');
      return redirect()->route('rapot.KeputusanLulusTidakLulus', ['tahun_ajaran_id' => $request->tahun_ajaran_id, 'kelas_id' => $request->kelas_id, 'semester' => $request->semester]);
    }
  }
}
