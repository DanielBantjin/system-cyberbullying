<?php

namespace App\Exports;

use App\Models\YoutubeComment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class YoutubeCommentsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return YoutubeComment::select(
            'comment',
            'category',
            'confidence',
            'created_at'
        )->get();
    }

    public function headings(): array
    {
        return [
            'Komentar',
            'Kategori',
            'Confidence',
            'Tanggal'
        ];
    }
}