<?php

namespace App\Imports;

use App\Models\Siswa;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SiswaImport implements ToModel, WithValidation, WithHeadingRow
{
  use Importable;

  public function model(array $row)
  {
    return new Siswa([
      'nisn' => $row['nisn'],
      'nama_siswa' => $row['nama_siswa'],
      'jenis_kelamin' => $row['jenis_kelamin'],
      'tempat_lahir' => $row['tempat_lahir'],
      'tanggal_lahir' => $row['tanggal_lahir'],
      'agama' => $row['agama'],
      'status_dalam_keluarga' => $row['status_dalam_keluarga'],
      'anak_ke' => $row['anak_ke'],
      'alamat_rumah' => $row['alamat_rumah'],
      'no_telp_rumah' => $row['no_telp_rumah'],
      'asal_sekolah' => $row['asal_sekolah'],
      'diterima_dikelas' => $row['diterima_dikelas'],
      'diterima_tanggal' => $row['diterima_tanggal'],
      'nama_ayah' => $row['nama_ayah'],
      'nama_ibu' => $row['nama_ibu'],
      'alamat_orangtua' => $row['alamat_orangtua'],
      'no_telp_orangtua' => $row['no_telp_orangtua'],
      'pekerjaan_ayah' => $row['pekerjaan_ayah'],
      'pekerjaan_ibu' => $row['pekerjaan_ibu'],
      'nama_wali' => $row['nama_wali'],
      'alamat_wali' => $row['alamat_wali'],
      'no_telp_wali' => $row['no_telp_wali'],
      'pekerjaan_wali' => $row['pekerjaan_wali'],
      'foto_siswa' => 'default-foto.png',
      'status' => NULL,
    ]);
  }

  public function rules(): array
  {
    return [
      'nisn' => [
        Rule::unique('siswa', 'nisn')->ignore(NULL, 'status'),
      ],
      'nama_siswa' => [
        Rule::unique('siswa')->ignore(NULL, 'status'),
      ],
    ];
  }

  public function customValidationMessages()
  {
    return [
      "nisn.unique" => "Dalam File Excel, NISN sudah ada di sistem!",
      "nama_siswa.unique" => "Dalam File Excel, Nama Siswa sudah ada di sistem!",
    ];
  }
}
