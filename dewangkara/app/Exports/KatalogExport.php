<?php

namespace App\Exports;

use App\Models\Katalog;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class KatalogExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Katalog::select('judul', 'pencipta_lagu', 'pembawa_lagu', 'link_vidio_lagu', 'publisher_id',)->get();
        // return Katalog::all();
    }

    public function headings(): array{
        return [
            'judul',
            'pencipta_lagu',
            'pembawa_lagu',
            'link_vidio_lagu',
            'publisher_id',
        ];
    }
}
