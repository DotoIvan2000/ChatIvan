<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportUsers implements FromCollection, WithHeadings, ShouldAutoSize
{
    protected $users;
    public function __construct($users)
    {
        $this->users = $users;
    }
    public function collection()
    {
        return $this->users;
    }
    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Nombre(s)',
            'Apellido(s)',
            'Nombre de usuario',
            'Correo electrónico',
            'created_at',
            'updated_at',
        ];
    }
}
