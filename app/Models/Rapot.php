<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\KelasSiswa;
use App\Models\MapelKelas;
use App\Models\Ekstrakurikuler;
use App\Models\Traits\UsesUuid;

class Rapot extends Model
{
  use UsesUuid;

  protected $table = 'rapot';
  protected $primaryKey = 'id_rapot';
  protected $guarded = [];

  const CREATED_AT = 'created_at_rapot';
  const UPDATED_AT = 'updated_at_rapot';

  public function kelas_siswa()
  {
    return $this->belongsTo(KelasSiswa::class, 'kelas_siswa_id', 'id_kelas_siswa');
  }

  public function EkstrakurikulerData()
  {
    return $this->hasMany(Ekstrakurikuler::class, 'rapot_id', 'id_rapot');
  }

  public static function cekRapotSemester($tahun_ajaran_id, $kelas_id, $semester)
  {
    return KelasSiswa::join('wali_kelas', 'kelas_siswa.wali_kelas_id', '=', 'wali_kelas.id')
      ->join('siswa', 'kelas_siswa.siswa_id', '=', 'siswa.id')
      ->whereNotExists(function ($query) use ($semester) {
        $query->select('*')
          ->from('rapot')
          ->where('status', NULL)
          ->where('semester', $semester)
          ->whereRaw('kelas_siswa.id_kelas_siswa = rapot.kelas_siswa_id');
      })
      ->where('wali_kelas.tahun_ajaran_id', $tahun_ajaran_id)
      ->where('wali_kelas.kelas_id', $kelas_id)
      ->where('kelas_siswa.status', NULL)
      ->where('wali_kelas.status', NULL)
      ->where('siswa.status', NULL)
      ->orderBy('siswa.nama_siswa', 'ASC')
      ->exists();
  }

  public static function dataMapel($tahun_ajaran_id, $tingkat_kelas_id)
  {
    return MapelKelas::join('mata_pelajaran', 'mapel_kelas.mapel_id', '=', 'mata_pelajaran.id')
      ->join('tingkat_kelas', 'mapel_kelas.tingkat_kelas_id', '=', 'tingkat_kelas.id')
      ->where('mapel_kelas.tahun_ajaran_id', $tahun_ajaran_id)
      ->where('mapel_kelas.tingkat_kelas_id', $tingkat_kelas_id)
      ->where('mapel_kelas.status', NULL)
      ->where('mata_pelajaran.status', NULL)
      ->orderBy('mata_pelajaran.nama_mapel', 'ASC')
      ->get();
  }

  public static function cekNilaiMapel($tahun_ajaran_id, $kelas_id, $semester, $mapel_id)
  {
    return Rapot::join('kelas_siswa', 'rapot.kelas_siswa_id', '=', 'kelas_siswa.id_kelas_siswa')
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
      ->where('rapot.status', null)
      ->where('kelas_siswa.status', null)
      ->where('wali_kelas.status', null)
      ->exists();
  }

  public static function cekSikapdanSpiritual($tahun_ajaran_id, $kelas_id, $semester)
  {
    return Rapot::join('kelas_siswa', 'rapot.kelas_siswa_id', '=', 'kelas_siswa.id_kelas_siswa')
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
      ->where('rapot.status', null)
      ->where('kelas_siswa.status', null)
      ->where('wali_kelas.status', null)
      ->exists();
  }

  public static function cekEkstrakurikuler($tahun_ajaran_id, $kelas_id, $semester)
  {
    return Rapot::join('kelas_siswa', 'rapot.kelas_siswa_id', '=', 'kelas_siswa.id_kelas_siswa')
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
      ->where('rapot.status', null)
      ->where('kelas_siswa.status', null)
      ->where('wali_kelas.status', null)
      ->exists();
  }

  public static function cekKeputusanKelas($tahun_ajaran_id, $kelas_id)
  {
    return KelasSiswa::join('wali_kelas', 'kelas_siswa.wali_kelas_id', '=', 'wali_kelas.id')
      ->join('siswa', 'kelas_siswa.siswa_id', '=', 'siswa.id')
      ->whereNotExists(function ($query) {
        $query->select('*')
          ->from('rapot')
          ->where('status', NULL)
          ->where('keputusan_kelas', '!=', NULL)
          ->whereRaw('kelas_siswa.id_kelas_siswa = rapot.kelas_siswa_id');
      })
      ->where('wali_kelas.tahun_ajaran_id', $tahun_ajaran_id)
      ->where('wali_kelas.kelas_id', $kelas_id)
      ->where('kelas_siswa.status', NULL)
      ->where('wali_kelas.status', NULL)
      ->where('siswa.status', NULL)
      ->orderBy('siswa.nama_siswa', 'ASC')
      ->exists();
  }
}
