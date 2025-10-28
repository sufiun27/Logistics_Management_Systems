<?php

namespace App\Models;

use App\Models\ExportFormApparel;
use Illuminate\Database\Eloquent\Model;


class SaleDetail extends Model
{
    protected $table = 'sale_details';
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

     protected $casts = [
        'shipped_fob_value' => 'float',
        'shipped_cm_value'  => 'float',
        'cbm_value'         => 'float',
    ];

    /* ------------------------------
     |  Accessors for 2 decimal places
     -------------------------------*/
    public function getShippedFobValueAttribute($value)
    {
        return round((float)$value, 2);
    }

    public function getShippedCmValueAttribute($value)
    {
        return round((float)$value, 2);
    }

    public function getCbmValueAttribute($value)
    {
        return round((float)$value, 2);
    }

    // protected $appends = [
    //     'shipping_ex_factory_date',
    //     'efa_invoice_site',
    // ];

    /**
     * Relationship with Shipping
     */
    public function shipping()
    {
        return $this->belongsTo(Shipping::class, 'invoice_no', 'invoice_no');
    }

    /**
     * Accessor for shipping_ex_factory_date
     */
    // public function getShippingExFactoryDateAttribute(): ?string
    // {
    //     return $this->shipping->ex_factory_date ?? null;
    // }
    /**
     * Relationship with SaleDetail
     */
    public function saleDetail()
    {
        return $this->belongsTo(SaleDetail::class, 'invoice_no', 'invoice_no');
    }

    public function exportFormApparel()
    {
        return $this->belongsTo(ExportFormApparel::class , 'invoice_no', 'invoice_no');
    }

    // public function getEfaInvoiceSiteAttribute(): ?string
    // {
    //     return $this->exportFormApparel?->invoice_site ?? null;
    // }

    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'created_by', 'emp_id');
    }

    public function updatedByUser()
    {
        return $this->belongsTo(User::class, 'updated_by', 'emp_id');
    }

}
