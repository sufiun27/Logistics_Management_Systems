<?php

namespace App\Models;

use App\Models\ExportFormApparel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SaleDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'invoice_no',
        'buyer_contract',
        'order_no',
        'style_no',
        'product_type',
        'shipped_qty',
        'carton_qty',
        'shipped_fob_value',
        'shipped_cm_value',
        'cbm_value',
        'gross_wet',
        'net_wet',
        'eta_date',
        'vessel_name',
        'shipbording_date',
        'bl_no',
        'bl_date',
        'final_qty',
        'final_fob',
        'final_cm',
        'remarks',
        'created_by',
        'updated_by',
    ];

    public function exportFormApparel()
    {
        return $this->belongsTo(ExportFormApparel::class , 'invoice_no', 'invoice_no');
    }
}
