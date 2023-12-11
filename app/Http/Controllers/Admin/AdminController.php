<?php

namespace App\Http\Controllers\Admin;


use App\User;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
  public function index()
  {
    $title = 'Dashboard E-Rapot';
    //$hitung_datapns = DataPns::count();
    //$hitung_datanonpns = DataNonPns::count();
    //$hitung_databidang = Bidang::count();
    //$hitung_datasubbidang = SubBidang::count();
    $hitung_dataakun = User::count();
    //return view('admin/dashboard', compact('title', 'hitung_datapns', 'hitung_datanonpns', 'hitung_databidang', 'hitung_datasubbidang', 'hitung_dataakun'));
    return view('admin/dashboard', compact('title', 'hitung_dataakun'));
  }

  public function halamanlogin()
  {
    return view('auth/login');
  }
}
