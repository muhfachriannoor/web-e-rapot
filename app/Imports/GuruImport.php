<?php

namespace App\Imports;

use App\Models\Guru;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GuruImport implements ToModel, WithValidation, WithHeadingRow
{
  use Importable;

  public function model(array $row)
  {
    return new Guru([
      'nip' => $row['nip'],
      'nama_guru' => $row['nama_guru'],
      'jabatan' => $row['jabatan'],
      'status' => NULL,
    ]);
  }

  public function rules(): array
  {
    return [
      'nama_guru' => [
        Rule::unique('guru')->ignore(NULL, 'status'),
      ],
    ];
  }

  public function customValidationMessages()
  {
    return [
      "nama_guru.unique" => "Dalam File Excel, Nama Guru sudah ada di sistem!",
    ];
  }
}
