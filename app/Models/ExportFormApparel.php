<?php

namespace App\Models;

use App\Models\Shipping;
use App\Models\SaleDetail;
use App\Models\BillingDetail;
use App\Models\LogisticsDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExportFormApparel extends Model
{
    use HasFactory;

    public function saleDetail()
    {
        return $this->belongsTo(SaleDetail::class);
    }
    public function shipping()
    {
        return $this->belongsTo(Shipping::class);
    }
    public function billingDetail()
    {
        return $this->belongsTo(BillingDetail::class);
    }
    public function logisticsDetail()
    {
        return $this->belongsTo(LogisticsDetail::class);
    }

}
