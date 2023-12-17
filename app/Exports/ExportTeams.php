<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportTeams implements FromCollection, WithHeadings, ShouldAutoSize
{
    protected $teams;

    public function __construct($teams)
    {
        $this->teams = $teams;
    }
    public function collection()
    {
        return $this->teams;
    }
    /**
     * @return array
     */

    public function headings(): array
    {
        return [
            'ID',
            'Nombre',
            'Descripción',
            'String',
            'created_at',
            'updated_at',
        ];
    }
}
