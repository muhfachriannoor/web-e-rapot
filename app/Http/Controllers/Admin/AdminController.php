<?php

namespace App\Http\Controllers\Admin;


use App\Models\TahunAjaran;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Guru;
use App\Models\WaliKelas;
use App\Models\Siswa;
use App\User;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
  public function index()
  {
    $title = 'Dashboard E-Rapot';
    $hitung_tahunAjaran = TahunAjaran::where('status', NULL)->count();
    $hitung_kelas = Kelas::where('status', NULL)->count();
    $hitung_mataPelajaran = MataPelajaran::where('status', NULL)->count();
    $hitung_guru = Guru::where('status', NULL)->count();
    $hitung_waliKelas = WaliKelas::where('status', NULL)->count();
    $hitung_siswa = Siswa::where('status', NULL)->count();
    $hitung_dataakun = User::count();
    return view('admin/dashboard', compact('title', 'hitung_dataakun', 'hitung_tahunAjaran', 'hitung_kelas', 'hitung_kelas', 'hitung_mataPelajaran', 'hitung_guru', 'hitung_waliKelas', 'hitung_siswa'));
  }

  public function halamanlogin()
  {
    return view('auth/login');
  }
}
