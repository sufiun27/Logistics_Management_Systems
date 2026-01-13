<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomAuditDetail extends Model
{
    use HasFactory;

     protected $fillable = [
        'invoice_no',
        'import_reg_no',
        'import_bond',
        'total_fabric_used',
        'adjusted_reg',
        'adjusted_reg_page',
        'created_by',
        'updated_by'
    ];

    protected $causts = [
        'total_fabric_used' => 'double',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function exportFormApparel()
    {
        return $this->belongsTo(ExportFormApparel::class, 'invoice_no', 'invoice_no');
    }

    public function getTotalFabricUsedAttribute($value)
    {
        return round((float)$value, 2);
    }

    public function getCreatedAtAttribute($value)
    {
        return date('d-m-Y', strtotime($value));
    }
    public function getUpdatedAtAttribute($value)
    {
        return date('d-m-Y', strtotime($value));
    }
}
