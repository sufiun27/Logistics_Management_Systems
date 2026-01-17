<?php

namespace App\Exports;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use Maatwebsite\Excel\Concerns\{
    FromCollection,
    WithHeadings,
    WithMapping,
    WithEvents
};
use Maatwebsite\Excel\Events\AfterSheet;

class FinanceReportExport implements FromCollection, WithHeadings, WithMapping, WithEvents
{
    protected Collection $data;
    protected array $dateColumns;

    public function __construct(Collection $data)
    {
        $this->data = $data;

        $this->dateColumns = [
            'invoice_date', 'contract_date', 'ex_factory_date', 'cargo_report_date',
            'shipboarding_date', 'bl_date', 'eta_date', 'exp_date', 'tt_date',
            'export_date', 'ep_date', 'sb_date', 'document_submit_date',
            'hk_courier_date', 'buyer_courier_date', 'bank_submit_date',
            'cargo_handover_date', 'bill_submission_deadline', 'bill_received_date',
        ];
    }

    public function collection(): Collection
    {
        return $this->data;
    }

    public function headings(): array
    {
        return $this->data->isNotEmpty()
            ? array_keys((array) $this->data->first())
            : [];
    }

    /**
     * ✅ Convert date strings into Excel numeric dates
     */
    public function map($row): array
    {
        $rowArray = is_array($row) ? $row : (array) $row;
        $mapped = [];

        foreach ($rowArray as $key => $value) {
            if (in_array($key, $this->dateColumns, true) && !empty($value)) {
                $mapped[] = ExcelDate::dateTimeToExcel(Carbon::parse($value));
            } else {
                $mapped[] = $value;
            }
        }

        return $mapped;
    }

    /**
     * ✅ FORCE Excel date formatting (THIS MAKES FILTER WORK)
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                if ($this->data->isEmpty()) {
                    return;
                }

                $headers = array_keys((array) $this->data->first());

                foreach ($headers as $index => $columnName) {
                    if (in_array($columnName, $this->dateColumns, true)) {
                        $columnLetter = Coordinate::stringFromColumnIndex($index + 1);

                        // Apply format to ENTIRE column
                        $event->sheet
                            ->getDelegate()
                            ->getStyle("{$columnLetter}:{$columnLetter}")
                            ->getNumberFormat()
                            ->setFormatCode(NumberFormat::FORMAT_DATE_YYYYMMDD);
                    }
                }
            },
        ];
    }
}
