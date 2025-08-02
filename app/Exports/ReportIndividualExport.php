<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReportIndividualExport implements FromCollection, WithHeadings
{
    protected $data;
    protected $headers;
    protected $module;

    public function __construct($data, $headers, $module)
    {
        $this->data = $data;
        $this->headers = $headers;
        $this->module = $module;
    }

    public function collection()
    {
        return $this->data->map(function ($item) {
            $row = [];
            foreach ($this->headers[$this->module] as $field) {
                $value = $item[$field['column']] ?? '-';
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
        return array_column($this->headers[$this->module], 'title');
    }
}
