<?php

namespace App\Imports;

use App\Models\Katalog;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KatalogImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if (Auth::user()->hasRole('super-admin')) {
            return new Katalog([
                'judul' => $row['judul'],
                'pencipta_lagu' => $row['pencipta_lagu'],
                'pembawa_lagu' => $row['pembawa_lagu'],
                'link_vidio_lagu' => $row['link_vidio_lagu'],
                'publisher_id' => $row['publisher_id'],
            ]);
        }
        if (Auth::user()->hasRole('publisher')) {
            return new Katalog([
                'judul' => $row['judul'],
                'pencipta_lagu' => $row['pencipta_lagu'],
                'pembawa_lagu' => $row['pembawa_lagu'],
                'link_vidio_lagu' => $row['link_vidio_lagu'],
                'publisher_id' => Auth::user()->id,
            ]);
        }
    }
}
