<?php

namespace App\Models;

use App\Models\ExportFormApparel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shipping extends Model
{
    use HasFactory;

    public $fillable = [
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
        'created_by',   // ✅ Added
        'updated_by'    // ✅ Added
    ];

    public function exportFormApparel()
    {
        return $this->belongsTo(ExportFormApparel::class , 'invoice_no', 'invoice_no');
    }
}
