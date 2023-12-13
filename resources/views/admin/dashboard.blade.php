@extends('layouts/templatedashboard')
@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      @if (auth()->user()->level == 1 or auth()->user()->level == 2)
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $hitung_tahunAjaran }}</h3>
                <p>Data Tahun Ajaran</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="{{ route('tahun-ajaran.index') }}" class="small-box-footer">Lihat Data <i
                  class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ $hitung_kelas }}</h3>
                <p>Data Kelas</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="{{ route('kelas.index') }}" class="small-box-footer">Lihat Data <i
                  class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{ $hitung_mataPelajaran }}</h3>
                <p>Data Mata Pelajaran</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="{{ route('mata-pelajaran.index') }}" class="small-box-footer">Lihat Data <i
                  class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger" style="background-color:#34495e!important">
              <div class="inner">
                <h3>{{ $hitung_guru }}</h3>
                <p>Data Guru</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="{{ route('guru.index') }}" class="small-box-footer">Lihat Data <i
                  class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger" style="background-color:#d35400!important">
              <div class="inner">
                <h3>{{ $hitung_waliKelas }}</h3>
                <p>Data Wali Kelas</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="{{ route('wali-kelas.index') }}" class="small-box-footer">Lihat Data <i
                  class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-danger" style="background-color: #7f8c8d!important">
              <div class="inner">
                <h3>{{ $hitung_siswa }}</h3>
                <p>Data Siswa</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="{{ route('siswa.index') }}" class="small-box-footer">Lihat Data <i
                  class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{ $hitung_dataakun }}</h3>
                <p>Data Akun</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="{{ route('data-akun.index') }}" class="small-box-footer">Lihat Data <i
                  class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
      @endif
    </div>
  </section>
  <!-- /.content -->
@endsection
