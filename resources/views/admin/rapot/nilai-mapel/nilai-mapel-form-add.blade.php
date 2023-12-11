@extends('layouts/templatedashboard')
@section('cssfile')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  <!-- Ekko Lightbox -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/ekko-lightbox/ekko-lightbox.css') }}">
@endsection
@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Rapot <b>Tahun Ajaran {{ $dataTitle->tahun_ajaran->tahun_ajaran }}</b></h1>
          <h1>Kelas <b>{{ $dataTitle->kelas->nama_kelas }}</b></h1>
          <h1>Rapot <b>{{ $semester }}</b></h1>
          <h1>Input Nilai <b>{{ $dataMapel->nama_mapel }}</b></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('rapot.TahunAjaran') }}">Rapot</a></li>
            <li class="breadcrumb-item"><a
                href="{{ route('rapot.Kelas', ['tahun_ajaran_id' => $dataTitle->tahun_ajaran_id]) }}">Tahun
                Ajaran
                {{ $dataTitle->tahun_ajaran->tahun_ajaran }}</a>
            </li>
            <li class="breadcrumb-item"><a
                href="{{ route('rapot.Siswa', ['tahun_ajaran_id' => $dataTitle->tahun_ajaran_id, 'kelas_id' => $dataTitle->kelas_id]) }}">{{ $dataTitle->kelas->nama_kelas }}</a>
            </li>
            <li class="breadcrumb-item"><a
                href="{{ route('rapot.Semester', ['tahun_ajaran_id' => $dataTitle->tahun_ajaran_id, 'kelas_id' => $dataTitle->kelas_id, 'semester' => $semester]) }}">Rapot
                {{ $semester }}</a>
            </li>
            <li class="breadcrumb-item active">Input Nilai {{ $dataMapel->nama_mapel }}</li>
          </ol>
        </div>
      </div>
    </div>
    <!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          @if ($errors->any())
            <div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h5><i class="icon fas fa-ban"></i> Alert!</h5>
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Input Nilai <b>{{ $dataMapel->nama_mapel }}</b></h3>
            </div>
            <!-- form start -->
            <form
              action="{{ route('rapot.NilaiMapelStore', ['tahun_ajaran_id' => $dataTitle->tahun_ajaran_id, 'kelas_id' => $dataTitle->kelas_id, 'semester' => $semester, 'mapel_id' => $mapel_id]) }}"
              method="POST" enctype="multipart/form-data">
              @csrf
              <div class="card-body">
                <div class="form-group">
                </div>
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th width="2%" rowspan="2" style="text-align: center; vertical-align: middle;">No</th>
                      <th width="25%" rowspan="2" style="text-align: center; vertical-align: middle;">Nama Siswa
                      </th>
                      <th width="20%"
                        {{ ($semester == 'Semester Ganjil' or $semester == 'Semester Genap') ? 'colspan=4' : 'colspan=3' }}
                        style="text-align: center; vertical-align: middle;">Pengetahuan
                      </th>
                      <th width="20%"
                        {{ ($semester == 'Semester Ganjil' or $semester == 'Semester Genap') ? 'colspan=4' : 'colspan=3' }}
                        style="text-align: center; vertical-align: middle;">Keterampilan
                      </th>
                    </tr>
                    <tr>
                      <th width="6%" style="text-align: center; vertical-align: middle;">KKM</th>
                      <th width="6%" style="text-align: center; vertical-align: middle;">Angka</th>
                      <th width="6%" style="text-align: center; vertical-align: middle;">Predikat</th>
                      @if ($semester == 'Semester Ganjil' or $semester == 'Semester Genap')
                        <th width="15%" style="text-align: center; vertical-align: middle;">Deskripsi</th>
                      @endif
                      <th width="6%" style="text-align: center; vertical-align: middle;">KKM</th>
                      <th width="6%" style="text-align: center; vertical-align: middle;">Angka</th>
                      <th width="6%" style="text-align: center; vertical-align: middle;">Predikat</th>
                      @if ($semester == 'Semester Ganjil' or $semester == 'Semester Genap')
                        <th width="15%" style="text-align: center; vertical-align: middle;">Deskripsi</th>
                      @endif
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($data as $key => $value)
                      <tr>
                        <td style="text-align: center; vertical-align: middle;">{{ $loop->iteration }}</td>
                        <td style="vertical-align: middle;"><a
                            href="{{ route('siswa.show', $value->kelas_siswa->siswa->id) }}"
                            target="_blank">{{ $value->kelas_siswa->siswa->nama_siswa }}</a>
                        </td>
                        <td style="text-align: center; vertical-align: middle;"><b>{{ $dataMapel->nilai_kkm }}</b></td>
                        <td style="text-align: center; vertical-align: middle;"><input type="number"
                            name="nilai_pengetahuan[{{ $key }}]" id="nilai_pengetahuan{{ $key }}"
                            class="form-control text-center" placeholder="00"
                            value="{{ old("nilai_pengetahuan.{$key}", '') }}" required></td>
                        <td style="text-align: center; vertical-align: middle;"><input type="text"
                            name="predikat_pengetahuan[{{ $key }}]"
                            id="predikat_pengetahuan{{ $key }}" class="form-control text-center" placeholder=""
                            value="{{ old("predikat_pengetahuan.{$key}", '') }}" readonly required>
                        </td>
                        @if ($semester == 'Semester Ganjil' or $semester == 'Semester Genap')
                          <td>
                            <textarea name="deskripsi_pengetahuan[{{ $key }}]" class="form-control" rows="3"
                              placeholder="Deskripsi Pengetahuan" required>{{ old("deskripsi_pengetahuan.{$key}", '') }}</textarea>
                          </td>
                        @endif
                        <td style="text-align: center; vertical-align: middle;"><b>{{ $dataMapel->nilai_kkm }}</b></td>
                        <td style="text-align: center; vertical-align: middle;"><input type="number"
                            name="nilai_keterampilan[{{ $key }}]" id="nilai_keterampilan{{ $key }}"
                            class="form-control text-center" placeholder="00"
                            value="{{ old("nilai_keterampilan.{$key}", '') }}" required></td>
                        <td style="text-align: center; vertical-align: middle;"><input type="text"
                            name="predikat_keterampilan[{{ $key }}]"
                            id="predikat_keterampilan{{ $key }}" class="form-control text-center"
                            placeholder="" value="{{ old("predikat_keterampilan.{$key}", '') }}" readonly required>
                        </td>
                        @if ($semester == 'Semester Ganjil' or $semester == 'Semester Genap')
                          <td>
                            <textarea name="deskripsi_keterampilan[{{ $key }}]" class="form-control" rows="3"
                              placeholder="Deskripsi Keterampilan" required>{{ old("deskripsi_keterampilan.{$key}", '') }}</textarea>
                          </td>
                        @endif
                        <input type="hidden" name="id_mapel[]" value="{{ $dataMapel->id }}" required>
                        <input type="hidden" name="rapot_id[]" value="{{ $value->id_rapot }}" required>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a class="btn btn-success"
                  href="{{ route('rapot.Semester', ['tahun_ajaran_id' => $dataTitle->tahun_ajaran_id, 'kelas_id' => $dataTitle->kelas_id, 'semester' => $semester]) }}">
                  Kembali</a>
              </div>
            </form>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
@endsection
@section('jsfile')
  <!-- DataTables  & Plugins -->
  <script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('admin/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
  <script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('admin/plugins/jszip/jszip.min.js') }}"></script>
  <script src="{{ asset('admin/plugins/pdfmake/pdfmake.min.js') }}"></script>
  <script src="{{ asset('admin/plugins/pdfmake/vfs_fonts.js') }}"></script>
  <script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
  <script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
  <script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
  <!-- Ekko Lightbox -->
  <script src="{{ asset('admin/plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>
  <!-- Select2 -->
  <script src="{{ asset('admin/plugins/select2/js/select2.full.min.js') }}"></script>
  <script>
    $(function() {
      //Initialize Select2 Elements
      $('.select2').select2();

      @foreach ($data as $key2 => $value2)
        //Jquery Jika Mengisi Angka pengetahuan, Tampilkan Predikat pengetahuannya
        $('#nilai_pengetahuan{{ $key2 }}').on('change', function() {
          let nilai_pengetahuan = $('#nilai_pengetahuan{{ $key2 }}').val()
          if (nilai_pengetahuan >= 92) {
            //Tampilkan predikat pengetahuan
            $('#predikat_pengetahuan{{ $key2 }}').val('A');
          } else if (nilai_pengetahuan >= 83) {
            $('#predikat_pengetahuan{{ $key2 }}').val('B');
          } else if (nilai_pengetahuan >= 75) {
            $('#predikat_pengetahuan{{ $key2 }}').val('C');
          } else if (nilai_pengetahuan >= 0) {
            $('#predikat_pengetahuan{{ $key2 }}').val('D');
          }
        });
        //Jquery Jika Mengisi Angka keterampilan, Tampilkan Predikat keterampilan
        $('#nilai_keterampilan{{ $key2 }}').on('change', function() {
          let nilai_keterampilan = $('#nilai_keterampilan{{ $key2 }}').val()
          if (nilai_keterampilan >= 92) {
            //Tampilkan predikat keterampilan
            $('#predikat_keterampilan{{ $key2 }}').val('A');
          } else if (nilai_keterampilan >= 83) {
            $('#predikat_keterampilan{{ $key2 }}').val('B');
          } else if (nilai_keterampilan >= 75) {
            $('#predikat_keterampilan{{ $key2 }}').val('C');
          } else if (nilai_keterampilan >= 0) {
            $('#predikat_keterampilan{{ $key2 }}').val('D');
          }
        });
      @endforeach
    });
  </script>
@endsection
