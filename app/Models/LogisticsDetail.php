<?php

namespace App\Models;

use App\Models\ExportFormApparel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LogisticsDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_no',
        'receivable_amount',
        'doc_process_fee',
        'seal_lock_charge',
        'agency_commission',
        'documentation_charge',
        'transportation_charge',
        'short_shipment_certificate_fee',
        'factory_loading_fee',
        'uploading_fee_forwarder_wh',
        'truck_demurrage_fee_delay_at_depot',
        'cfs_depot_mixed_cargo_loading_fee',
        'customs_misc_remark_reasons_charge',
        'customs_remark_charge_misc_reasons',
        'cargo_ho_date',
        'deadline_bill_submission',
        'bill_received_date',
        'status',
        'forwarder_name',
        'total_charges',
        'created_by',
        'updated_by',
    ];

    public function exportFormApparel()
    {
        return $this->belongsTo(ExportFormApparel::class , 'invoice_no', 'invoice_no');
    }
}
