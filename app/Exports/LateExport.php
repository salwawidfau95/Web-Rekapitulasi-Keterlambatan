<?php

namespace App\Exports;

use App\Models\Late;
use Maatwebsite\Excel\Concerns\FromCollection;

class LateExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Late::all();
    }

    public function headings(): array
    {
        return [
            "Nis", "Nama", "Rombel", "Rayon", "Jumlah Keterlambatan"
        ];
    }

    public function map($item): array
    {
        return[
            $item->student->nis,
            $item->student->name,
            $item->rombel->rombel,
            $item->rayon->rayon,
            $item->total_late,
            \Carbon\Carbon::parse($item->created_at)->isoFormat($item->created_at),
        ];
    }
}

