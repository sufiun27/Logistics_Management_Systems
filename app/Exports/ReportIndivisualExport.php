<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReportIndivisualExport implements FromCollection, WithHeadings
{
    protected $data;
    protected $headers;

    public function __construct($data, $headers)
    {
        $this->data = $data;
        $this->headers = $headers;
    }

    public function collection()
    {
        $module = key($this->headers);
        return $this->data->map(function ($item) use ($module) {
            $row = [];
            foreach ($this->headers[$module] as $field) {
                $value = $module === 'export' ? ($item[$field['column']] ?? '-') : ($item[$module][$field['column']] ?? '-');
                if (str_contains($field['column'], 'date')) {
                    try {
                        $value = $value ? \Carbon\Carbon::parse($value)->format('Y-m-d') : '-';
                    } catch (\Exception $e) {
                        $value = '-';
                    }
                }
                $row[$field['title']] = $value;
            }
            return $row;
        });
    }

    public function headings(): array
    {
        $module = key($this->headers);
        return array_column($this->headers[$module], 'title');
    }
}