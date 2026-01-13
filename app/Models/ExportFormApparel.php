<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Shipping;
use App\Models\SaleDetail;
use App\Models\BillingDetail;
use App\Models\LogisticsDetail;
use App\Models\User;


class ExportFormApparel extends Model
{


    protected $fillable = [
        'item_name', 'hs_code', 'hs_code_second', 'invoice_no', 'invoice_date',
        'contract_no', 'contract_date', 'consignee_name', 'consignee_site',
        'consignee_country', 'consignee_address', 'dst_country_code',
        'dst_country_name', 'dst_country_port', 'transport_name', 'transport_address',
        'transport_port', 'notify_name', 'notify_address', 'section', 'tt_no',
        'tt_date', 'invoice_site', 'unit', 'quantity', 'currency',
        'amount',
        'cm_percentage', 'incoterm', 'cm_amount',
        'freight_value',
        'exp_no',
        'exp_date', 'exp_permit_no', 'bl_no', 'bl_date', 'ex_factory_date',
        'net_wet', 'gross_wet', 'create_by', 'update_by'
    ];

    protected $appends = [
        // 'shipping_ex_factory_date',
        // 'efa_invoice_site'
        'fob_value',

    ];

        protected $casts = [
        'freight_value' => 'float',
    'cm_percentage'=> 'float',
    'cm_amount'=> 'float',
    'amount'=> 'float',
    ];


    public function getFOBvalueAttribute()
    {
        if (is_null($this->freight_value)) {


            return number_format($this->amount, 2, '.', '');
        }
        $amount = $this->amount ?? 0;
        $freight = $this->freight_value ?? 0;

        return number_format($amount - $freight, 2, '.', '');
    }



    public function getFreightValueAttribute()
{
    return number_format($this->attributes['freight_value'] ?? 0, 2, '.', '');
}

public function getCmPercentageAttribute()
{
    return number_format($this->attributes['cm_percentage'] ?? 0, 2, '.', '');
}

public function getCmAmountAttribute()
{
    return number_format($this->attributes['cm_amount'] ?? 0, 2, '.', '');
}

public function getAmountAttribute(){
    return number_format($this->attributes['amount'] ?? 0, 2, '.', '');
}



    /**
     * Relationship with Shipping
     */
    public function shipping()
    {
        return $this->belongsTo(Shipping::class, 'invoice_no', 'invoice_no');
    }

    /**
     * Accessor: Get Shipping Ex-Factory Date
     */
    // public function getShippingExFactoryDateAttribute(): ?string
    // {
    //     return $this->shipping?->ex_factory_date ?? null;
    // }

    // /**
    //  * Accessor: Get EFA Invoice Site
    //  */
    // public function getEfaInvoiceSiteAttribute(): ?string
    // {
    //     return $this->invoice_site ?? null;
    // }

    /**
     * Relationship with SaleDetail
     */
    public function saleDetail()
    {
        return $this->belongsTo(SaleDetail::class, 'invoice_no', 'invoice_no');
    }

    /**
     * Relationship with BillingDetail
     */
    public function billingDetail()
    {
        return $this->belongsTo(BillingDetail::class, 'invoice_no', 'invoice_no');
    }

    /**
     * Relationship with LogisticsDetail
     */
    public function logisticsDetail()
    {
        return $this->belongsTo(LogisticsDetail::class, 'invoice_no', 'invoice_no');
    }

    //audit
    public function auditDetail()
    {
        return $this->belongsTo(CustomAuditDetail::class, 'invoice_no', 'invoice_no');
    }


    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'create_by', 'emp_id');
    }

    public function updatedByUser()
    {
        return $this->belongsTo(User::class, 'update_by', 'emp_id');
    }
}
