<?php

namespace App\Models;

use App\Models\ExportFormApparel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shipping extends Model
{
    use HasFactory;

    public function exportFormApparel()
    {
        return $this->belongsTo(ExportFormApparel::class , 'invoice_no', 'invoice_no');
    }
}
