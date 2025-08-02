<?php

namespace App\Models;

use App\Models\ExportFormApparel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BillingDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_no',
        'sb_no',
        'sb_date',
        'doc_submit_date',
        'hk_courier_no',
        'hk_courier_date',
        'buyer_courier_no',
        'buyer_courier_date',
        'lead_time',
        'bank_submit_date',
        'mode',
        'bd_thc',
        'created_by',
        'updated_by',
    ];

    public function exportFormApparel()
    {
        return $this->belongsTo(ExportFormApparel::class, 'invoice_no', 'invoice_no');
    }
}
