@extends('layouts/templatedashboard')
@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Rapot <b>Tahun Ajaran {{ $dataTitle->tahun_ajaran->tahun_ajaran }}</b></h1>
          <h1>Kelas <b>{{ $dataTitle->kelas->nama_kelas }}</b></h1>
          <h1>Rapot <b>{{ $semester }}</b></h1>
          <h1>Input Keputusan Naik/Tidak Naik</h1>
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
            <li class="breadcrumb-item active">Input Keputusan Naik/Tidak Naik</li>
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
              <h3 class="card-title">Input Keputusan Naik/Tidak Naik</h3>
            </div>
            <!-- form start -->
            <form
              action="{{ route('rapot.KeputusanNaikTidakNaikStore', ['tahun_ajaran_id' => $dataTitle->tahun_ajaran_id, 'kelas_id' => $dataTitle->kelas_id, 'semester' => $semester]) }}"
              method="POST" enctype="multipart/form-data">
              @csrf
              <div class="card-body">
                <div class="form-group">
                </div>
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th width="2%" style="text-align: center; vertical-align: middle;">No</th>
                      <th width="50%" style="text-align: center; vertical-align: middle;">Nama Siswa
                      </th>
                      <th style="text-align: center; vertical-align: middle;">Keputusan
                      </th>
                      <th style="text-align: center; vertical-align: middle;">Tingkat Kelas</th>
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
                        <td style="text-align: center; vertical-align: middle;">
                          <select name="keputusan_kelas[{{ $key }}]" id="keputusan_kelas{{ $key }}"
                            class="form-control select2" required style="width: 100%;">
                            <option value="" selected disabled>-- PILIH KEPUTUSAN --</option>
                            <option value="Naik Kelas">Naik Kelas</option>
                            <option value="Tidak Naik Kelas">Tidak Naik Kelas</option>
                          </select>
                        </td>
                        <td>
                          <input type="text" name="tingkat_kelas[{{ $key }}]"
                            id="tingkat_kelas{{ $key }}" class="form-control text-center" rows="3"
                            placeholder="" value="{{ old("tingkat_kelas.{$key}", '') }}" readonly required>
                        </td>
                        <input type="hidden" name="tingkat_kelas_id[{{ $key }}]"
                          value="{{ $value->kelas_siswa->wali_kelas->kelas->tingkat_kelas_id }}"
                          id="tingkat_kelas_id{{ $key }}" required>
                        <input type="hidden" name="rapot_id[{{ $key }}]" value="{{ $value->id_rapot }}"
                          required>
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
  <!-- Select2 -->
  <script src="{{ asset('admin/plugins/select2/js/select2.full.min.js') }}"></script>
  <script>
    $(function() {
      $('.select2').select2();

      @foreach ($data as $key2 => $value2)
        //AJAX Keputusan Kelas
        $('#keputusan_kelas{{ $key2 }}').on('change', function() {
          let keputusan_kelas = $('select[name="keputusan_kelas[{{ $key2 }}]"]').val()
          let tingkat_kelas_id = $('#tingkat_kelas_id{{ $key2 }}').val()
          var url = "{{ url('/dashboard/rapot/ajax/keputusan-kelas/') }}/" + keputusan_kelas + "/" +
            tingkat_kelas_id
          $.ajax({
              url: url,
              method: "GET",
            })
            .done(function(result) {
              $('#tingkat_kelas{{ $key2 }}').val(result);
            });
        });
      @endforeach
    });
  </script>
@endsection
