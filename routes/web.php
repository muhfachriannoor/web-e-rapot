<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//AUTH
Auth::routes();
Route::get('/', 'Admin\AdminController@halamanlogin')->name('halaman-login');


Route::get('/dashboard', 'Admin\AdminController@index')->name('dashboard');
//Master Data
Route::resource('/dashboard/informasi-sekolah', 'Admin\InformasiSekolahController'); //Informasi Sekolah
Route::resource('/dashboard/tingkat-kelas', 'Admin\TingkatKelasController'); //Tingkat Kelas
Route::resource('/dashboard/tahun-ajaran', 'Admin\TahunAjaranController'); //Tahun Ajaran
Route::resource('/dashboard/kelas', 'Admin\KelasController'); //Kelas
Route::resource('/dashboard/mata-pelajaran', 'Admin\MataPelajaranController'); // Mata Pelajaran
Route::resource('/dashboard/mapel-kelas', 'Admin\MapelKelasController'); //Mata Pelajaran Kelas

//Guru
Route::get('/dashboard/guru/importExcel', 'Admin\GuruController@importExcel')->name('importExcel-guru');
Route::post('/dashboard/guru/importStore', 'Admin\GuruController@importStore')->name('importStore-guru');
Route::resource('/dashboard/guru', 'Admin\GuruController'); //Data Guru
Route::resource('/dashboard/wali-kelas', 'Admin\WaliKelasController'); //Data Wali Kelas

//Siswa
Route::get('/dashboard/siswa/importExcel', 'Admin\SiswaController@importExcel')->name('importExcel-siswa');
Route::post('/dashboard/siswa/importStore', 'Admin\SiswaController@importStore')->name('importStore-siswa');
Route::resource('/dashboard/siswa', 'Admin\SiswaController'); //Data Siswa
Route::get('/dashboard/kelas-siswa/ajax/tahun-ajaran/{tahun_ajaran_id}', 'Admin\KelasSiswaController@ajaxTahunAjaran')->name('ajaxTahunAjaran-kelas-siswa'); //Ajax Tahun Ajaran
Route::get('/dashboard/kelas-siswa/ajax/kelas', 'Admin\KelasSiswaController@ajaxKelas')->name('ajaxKelas-kelas-siswa'); //Ajax Kelas
Route::resource('/dashboard/kelas-siswa', 'Admin\KelasSiswaController'); //Data Kelas Siswa

//Rapot
Route::name('rapot.')->group(function () {
  Route::get('/dashboard/rapot/tahun-ajaran/', 'Admin\RapotController@TahunAjaran')->name('TahunAjaran');
  Route::get('/dashboard/rapot/tahun-ajaran/{tahun_ajaran_id}/kelas', 'Admin\RapotController@Kelas')->name('Kelas');
  Route::get('/dashboard/rapot/tahun-ajaran/{tahun_ajaran_id}/kelas/{kelas_id}/siswa', 'Admin\RapotController@Siswa')->name('Siswa');
  //RAPOT UNTUK WALI KELAS
  Route::get('/dashboard/rapot/wali-kelas', 'Admin\RapotController@WaliKelas')->name('WaliKelas');

  //Data Semester
  Route::get('/dashboard/rapot/tahun-ajaran/{tahun_ajaran_id}/kelas/{kelas_id}/semester/{semester}', 'Admin\RapotController@Semester')->name('Semester');
  Route::get('/dashboard/rapot/tahun-ajaran/{tahun_ajaran_id}/kelas/{kelas_id}/semester-create', 'Admin\RapotController@SemesterCreate')->name('SemesterCreate');
  Route::post('/dashboard/rapot/tahun-ajaran/{tahun_ajaran_id}/kelas/{kelas_id}/semester-store', 'Admin\RapotController@SemesterStore')->name('SemesterStore');
  Route::get('/dashboard/rapot/tahun-ajaran/{tahun_ajaran_id}/kelas/{kelas_id}/semester/{semester}/{id_rapot}/semester-edit', 'Admin\RapotController@SemesterEdit')->name('SemesterEdit');
  Route::put('/dashboard/rapot/tahun-ajaran/{tahun_ajaran_id}/kelas/{kelas_id}/semester/{semester}/{id_rapot}', 'Admin\RapotController@SemesterUpdate')->name('SemesterUpdate');
  Route::get('/dashboard/rapot/tahun-ajaran/{tahun_ajaran_id}/kelas/{kelas_id}/semester/{semester}/cetak-rapot/{id_rapot}', 'Admin\RapotController@CetakRapot')->name('CetakRapot');

  //Data Nilai Mapel
  Route::get('/dashboard/rapot/tahun-ajaran/{tahun_ajaran_id}/kelas/{kelas_id}/semester/{semester}/mapel_id/{mapel_id}/nilai', 'Admin\RapotController@NilaiMapel')->name('NilaiMapel');
  Route::get('/dashboard/rapot/tahun-ajaran/{tahun_ajaran_id}/kelas/{kelas_id}/semester/{semester}/mapel_id/{mapel_id}/input-nilai/create', 'Admin\RapotController@NilaiMapelCreate')->name('NilaiMapelCreate');
  Route::post('/dashboard/rapot/tahun-ajaran/{tahun_ajaran_id}/kelas/{kelas_id}/semester/{semester}/mapel_id/{mapel_id}/input-nilai-store', 'Admin\RapotController@NilaiMapelStore')->name('NilaiMapelStore');
  Route::get('/dashboard/rapot/tahun-ajaran/{tahun_ajaran_id}/kelas/{kelas_id}/semester/{semester}/mapel_id/{mapel_id}/nilai/{id_nilai_mapel}/nilai-mapel-edit', 'Admin\RapotController@NilaiMapelEdit')->name('NilaiMapelEdit');
  Route::put('/dashboard/rapot/tahun-ajaran/{tahun_ajaran_id}/kelas/{kelas_id}/semester/{semester}/mapel_id/{mapel_id}/nilai/{id_nilai_mapel}', 'Admin\RapotController@NilaiMapelUpdate')->name('NilaiMapelUpdate');

  //Data Sikap dan Spiritual
  Route::get('/dashboard/rapot/tahun-ajaran/{tahun_ajaran_id}/kelas/{kelas_id}/semester/{semester}/sikap-dan-spiritual', 'Admin\RapotController@Sikap')->name('Sikap');
  Route::get('/dashboard/rapot/tahun-ajaran/{tahun_ajaran_id}/kelas/{kelas_id}/semester/{semester}/input-sikap-dan-spiritual/create', 'Admin\RapotController@SikapCreate')->name('SikapCreate');
  Route::post('/dashboard/rapot/tahun-ajaran/{tahun_ajaran_id}/kelas/{kelas_id}/semester/{semester}/input-sikap-dan-spiritual-store', 'Admin\RapotController@SikapStore')->name('SikapStore');
  Route::get('/dashboard/rapot/tahun-ajaran/{tahun_ajaran_id}/kelas/{kelas_id}/semester/{semester}/sikap-dan-spiritual/{id_sikap}/sikap-dan-spiritual-edit', 'Admin\RapotController@SikapEdit')->name('SikapEdit');
  Route::put('/dashboard/rapot/tahun-ajaran/{tahun_ajaran_id}/kelas/{kelas_id}/semester/{semester}/sikap-dan-spiritual/{id_sikap}', 'Admin\RapotController@SikapUpdate')->name('SikapUpdate');

  //Data Prestasi
  Route::get('/dashboard/rapot/tahun-ajaran/{tahun_ajaran_id}/kelas/{kelas_id}/semester/{semester}/prestasi', 'Admin\RapotController@Prestasi')->name('Prestasi');
  Route::get('/dashboard/rapot/tahun-ajaran/{tahun_ajaran_id}/kelas/{kelas_id}/semester/{semester}/input-prestasi/create', 'Admin\RapotController@PrestasiCreate')->name('PrestasiCreate');
  Route::post('/dashboard/rapot/tahun-ajaran/{tahun_ajaran_id}/kelas/{kelas_id}/semester/{semester}/input-prestasi-store', 'Admin\RapotController@PrestasiStore')->name('PrestasiStore');
  Route::get('/dashboard/rapot/tahun-ajaran/{tahun_ajaran_id}/kelas/{kelas_id}/semester/{semester}/prestasi/{id_prestasi}/prestasi-edit', 'Admin\RapotController@PrestasiEdit')->name('PrestasiEdit');
  Route::put('/dashboard/rapot/tahun-ajaran/{tahun_ajaran_id}/kelas/{kelas_id}/semester/{semester}/prestasi/{id_prestasi}', 'Admin\RapotController@PrestasiUpdate')->name('PrestasiUpdate');
  Route::delete('/dashboard/rapot/tahun-ajaran/{tahun_ajaran_id}/kelas/{kelas_id}/semester/{semester}/prestasi/{id_prestasi}', 'Admin\RapotController@PrestasiDestroy')->name('PrestasiDestroy');

  //Data Ekstrakurikuler
  Route::get('/dashboard/rapot/tahun-ajaran/{tahun_ajaran_id}/kelas/{kelas_id}/semester/{semester}/ekstrakurikuler', 'Admin\RapotController@Ekstrakurikuler')->name('Ekstrakurikuler');
  Route::get('/dashboard/rapot/tahun-ajaran/{tahun_ajaran_id}/kelas/{kelas_id}/semester/{semester}/ekstrakurikuler/create', 'Admin\RapotController@EkstrakurikulerCreate')->name('EkstrakurikulerCreate');
  Route::post('/dashboard/rapot/tahun-ajaran/{tahun_ajaran_id}/kelas/{kelas_id}/semester/{semester}/ekstrakurikuler-store', 'Admin\RapotController@EkstrakurikulerStore')->name('EkstrakurikulerStore');
  Route::get('/dashboard/rapot/tahun-ajaran/{tahun_ajaran_id}/kelas/{kelas_id}/semester/{semester}/ekstrakurikuler/{id_ekstrakurikuler}/ekstrakurikuler-edit', 'Admin\RapotController@EkstrakurikulerEdit')->name('EkstrakurikulerEdit');
  Route::put('/dashboard/rapot/tahun-ajaran/{tahun_ajaran_id}/kelas/{kelas_id}/semester/{semester}/ekstrakurikuler/{id_ekstrakurikuler}', 'Admin\RapotController@EkstrakurikulerUpdate')->name('EkstrakurikulerUpdate');

  //Data Keputusan Naik/Tidak Naik
  Route::get('/dashboard/rapot/tahun-ajaran/{tahun_ajaran_id}/kelas/{kelas_id}/semester/{semester}/keputusan-naik-tidak-naik', 'Admin\RapotController@KeputusanNaikTidakNaik')->name('KeputusanNaikTidakNaik');
  Route::get('/dashboard/rapot/tahun-ajaran/{tahun_ajaran_id}/kelas/{kelas_id}/semester/{semester}/keputusan-naik-tidak-naik/create', 'Admin\RapotController@KeputusanNaikTidakNaikCreate')->name('KeputusanNaikTidakNaikCreate');
  Route::get('/dashboard/rapot/ajax/keputusan-kelas/{keputusan_kelas}/{tingkat_kelas_id}', 'Admin\RapotController@AjaxKeputusanKelas')->name('AjaxKeputusanKelas'); //Ajax Keputusan Kelas
  Route::post('/dashboard/rapot/tahun-ajaran/{tahun_ajaran_id}/kelas/{kelas_id}/semester/{semester}/keputusan-naik-tidak-naik-store', 'Admin\RapotController@KeputusanNaikTidakNaikStore')->name('KeputusanNaikTidakNaikStore');
  Route::get('/dashboard/rapot/tahun-ajaran/{tahun_ajaran_id}/kelas/{kelas_id}/semester/{semester}/keputusan-naik-tidak-naik/{id_rapot}/keputusan-naik-tidak-naik-edit', 'Admin\RapotController@KeputusanNaikTidakNaikEdit')->name('KeputusanNaikTidakNaikEdit');
  Route::put('/dashboard/rapot/tahun-ajaran/{tahun_ajaran_id}/kelas/{kelas_id}/semester/{semester}/keputusan-naik-tidak-naik/{id_rapot}', 'Admin\RapotController@KeputusanNaikTidakNaikUpdate')->name('KeputusanNaikTidakNaikUpdate');
  //Data Keputusan Lulus/Tidak Lulus
  Route::get('/dashboard/rapot/tahun-ajaran/{tahun_ajaran_id}/kelas/{kelas_id}/semester/{semester}/keputusan-lulus-tidak-lulus', 'Admin\RapotController@KeputusanLulusTidakLulus')->name('KeputusanLulusTidakLulus');
  Route::get('/dashboard/rapot/tahun-ajaran/{tahun_ajaran_id}/kelas/{kelas_id}/semester/{semester}/keputusan-lulus-tidak-lulus/create', 'Admin\RapotController@KeputusanLulusTidakLulusCreate')->name('KeputusanLulusTidakLulusCreate');
  Route::post('/dashboard/rapot/tahun-ajaran/{tahun_ajaran_id}/kelas/{kelas_id}/semester/{semester}/keputusan-lulus-tidak-lulus-store', 'Admin\RapotController@KeputusanLulusTidakLulusStore')->name('KeputusanLulusTidakLulusStore');
  Route::get('/dashboard/rapot/tahun-ajaran/{tahun_ajaran_id}/kelas/{kelas_id}/semester/{semester}/keputusan-lulus-tidak-lulus/{id_rapot}/keputusan-lulus-tidak-lulus-edit', 'Admin\RapotController@KeputusanLulusTidakLulusEdit')->name('KeputusanLulusTidakLulusEdit');
  Route::put('/dashboard/rapot/tahun-ajaran/{tahun_ajaran_id}/kelas/{kelas_id}/semester/{semester}/keputusan-lulus-tidak-lulus/{id_rapot}', 'Admin\RapotController@KeputusanLulusTidakLulusUpdate')->name('KeputusanLulusTidakLulusUpdate');
});

// Data Akun
Route::resource('/dashboard/data-akun', 'Admin\DataAkunController');
