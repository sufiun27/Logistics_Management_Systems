<?php

namespace App\Models;

use App\Models\ExportFormApparel;
use App\Models\SaleDetail;
use Illuminate\Database\Eloquent\Model;


class Shipping extends Model
{


    protected $table = 'shippings';

    protected $fillable = [
        'invoice_no',
        'factory',
        'ep_no',
        'ep_date',
        'exp_no',
        'exp_date',
        'ex_factory_date',
        'sb_no',
        'sb_date',
        'transport_port',
        'cnf_agent',
        'vessel_no',
        'cargorpt_date',
        'bring_back',
        'shipped_out',
        'shipped_cancel',
        'shipped_back',
        'unshipped',
        'created_by',
        'updated_by'
    ];

    // protected $appends = [
    //     'shipping_ex_factory_date',
    //     'efa_invoice_site',
    // ];

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
     * Accessor for shipping_ex_factory_date
     * Returns this shipping's own ex_factory_date attribute
     */
    // public function getShippingExFactoryDateAttribute(): ?string
    // {
    //     return $this->ex_factory_date;
    // }

    /**
     * Accessor for efa_invoice_site
     * Returns related exportFormApparel invoice_site attribute
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
