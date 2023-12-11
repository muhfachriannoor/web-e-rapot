<?php

namespace App\Http\Controllers\Admin;

use App\Models\InformasiSekolah;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InformasiSekolahController extends Controller
{
  //function __construct()
  //{
  //  $this->middleware('admin');
  //}

  public function index()
  {
    $data = InformasiSekolah::all();
    $title = 'Informasi Sekolah';
    return view('admin/informasi-sekolah/index', compact('data', 'title'));
  }

  public function edit($id)
  {
    $data = InformasiSekolah::find($id);
    $title = 'Informasi Sekolah';
    return view('admin/informasi-sekolah/form-edit', compact('data', 'title'));
  }

  public function update(Request $request, $id)
  {
    $request->validate([
      'nama_sekolah'   => 'required',
      'npsn'     => 'required',
      'nis'     => 'required',
      'nss'     => 'required',
      'nds'     => 'required',
      'alamat_sekolah' => 'required',
      'kelurahan' => 'required',
      'kecamatan' => 'required',
      'kota_kabupaten' => 'required',
      'provinsi' => 'required',
      'link_website' => 'required',
      'email_sekolah' => 'required',
      'kode_pos' => 'required',
      'no_telp_sekolah' => 'required',
    ]); //Memvalidasi inputan yang kita kirim apakah sudah benar

    $dataUpdate = array(
      'nama_sekolah'   => $request->input('nama_sekolah'),
      'npsn'     => $request->input('npsn'),
      'nis'     => $request->input('nis'),
      'nss'     => $request->input('nss'),
      'nds'     => $request->input('nds'),
      'alamat_sekolah' => $request->input('alamat_sekolah'),
      'kelurahan' => $request->input('kelurahan'),
      'kecamatan' => $request->input('kecamatan'),
      'kota_kabupaten' => $request->input('kota_kabupaten'),
      'provinsi' => $request->input('provinsi'),
      'link_website' => $request->input('link_website'),
      'email_sekolah' => $request->input('email_sekolah'),
      'kode_pos' => $request->input('kode_pos'),
      'no_telp_sekolah' => $request->input('no_telp_sekolah'),
    );

    $update = InformasiSekolah::where('id', $id)->update($dataUpdate);

    if ($update == TRUE) {
      toastr()->success('Berhasil mengubah data');
      return redirect()->route('informasi-sekolah.index');
    } else {
      toastr()->error('Gagal mengubah data');
      return redirect()->route('informasi-sekolah.index');
    }
  }
}
