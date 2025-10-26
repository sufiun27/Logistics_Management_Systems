<?php

namespace App\Models;

use App\Models\ExportFormApparel;
use App\Models\Shipping;
use App\Models\SaleDetail;
use Illuminate\Database\Eloquent\Model;


class BillingDetail extends Model
{

    protected $table = 'billing_details';

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
    //     return $this->shipping?->ex_factory_date ?? null;
    // }

    /**
     * Relationship with SaleDetail
     */
    public function saleDetail()
    {
        return $this->belongsTo(SaleDetail::class, 'invoice_no', 'invoice_no');
    }

    /**
     * Relationship with ExportFormApparel
     */
    public function exportFormApparel()
    {
        return $this->belongsTo(ExportFormApparel::class, 'invoice_no', 'invoice_no');
    }

    /**
     * Accessor for efa_invoice_site (from ExportFormApparel)
     */
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
