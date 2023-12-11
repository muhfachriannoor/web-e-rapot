@extends('layouts/templatedashboard')
@section('cssfile')
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet"
    href="{{ asset('admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
@endsection
@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Informasi Sekolah</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Informasi Sekolah</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card card-primary">
            <div class="card-header">
              <h4 class="card-title">Data Informasi Sekolah</h4>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-sm-12">
                  <table class="table table-responsive">
                    <tbody>
                      @foreach ($data as $key => $value)
                        <tr>
                          <td width="20%">Nama Sekolah</td>
                          <td width="1%" align="center">:</td>
                          <td><b>{{ $value->nama_sekolah }}</b>
                          </td>
                        </tr>
                        <tr>
                          <td width="20%">NPSN</td>
                          <td width="1%" align="center">:</td>
                          <td><b>{{ $value->npsn }}</b>
                          </td>
                        </tr>
                        <tr>
                          <td width="20%">NIS</td>
                          <td width="1%" align="center">:</td>
                          <td><b>{{ $value->nis }}</b>
                          </td>
                        </tr>
                        <tr>
                          <td width="20%">NSS</td>
                          <td width="1%" align="center">:</td>
                          <td><b>{{ $value->nss }}</b>
                          </td>
                        </tr>
                        <tr>
                          <td width="20%">NDS</td>
                          <td width="1%" align="center">:</td>
                          <td><b>{{ $value->nds }}</b>
                          </td>
                        </tr>
                        <tr>
                          <td width="20%">Alamat Sekolah</td>
                          <td width="1%" align="center">:</td>
                          <td><b>{{ $value->alamat_sekolah }}</b>
                          </td>
                        </tr>
                        <tr>
                          <td width="20%">Kelurahan</td>
                          <td width="1%" align="center">:</td>
                          <td><b>{{ $value->kelurahan }}</b>
                          </td>
                        </tr>
                        <tr>
                          <td width="20%">Kecamatan</td>
                          <td width="1%" align="center">:</td>
                          <td><b>{{ $value->kecamatan }}</b>
                          </td>
                        </tr>
                        <tr>
                          <td width="20%">Kota/Kabupaten</td>
                          <td width="1%" align="center">:</td>
                          <td><b>{{ $value->kota_kabupaten }}</b>
                          </td>
                        </tr>
                        <tr>
                          <td width="20%">Provinsi</td>
                          <td width="1%" align="center">:</td>
                          <td><b>{{ $value->provinsi }}</b>
                          </td>
                        </tr>
                        <tr>
                          <td width="20%">Link Website</td>
                          <td width="1%" align="center">:</td>
                          <td><b><a href="{{ $value->link_website }}" target="_blank">{{ $value->link_website }}</a></b>
                          </td>
                        </tr>
                        <tr>
                          <td width="20%">Email Sekolah</td>
                          <td width="1%" align="center">:</td>
                          <td><b>{{ $value->email_sekolah }}</b>
                          </td>
                        </tr>
                        <tr>
                          <td width="20%">Kode Pos</td>
                          <td width="1%" align="center">:</td>
                          <td><b>{{ $value->kode_pos }}</b>
                          </td>
                        </tr>
                        <tr>
                          <td width="20%">Nomor Telpon Sekolah</td>
                          <td width="1%" align="center">:</td>
                          <td><b>{{ $value->no_telp_sekolah }}</b>
                          </td>
                        </tr>
                        <tr>
                          <td colspan="3">
                            <a class="btn btn-primary" href="{{ route('informasi-sekolah.edit', $value->id) }}"> Ubah
                              Data</a>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
@endsection
