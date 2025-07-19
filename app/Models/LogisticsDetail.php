<?php

namespace App\Models;

use App\Models\ExportFormApparel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LogisticsDetail extends Model
{
    use HasFactory;

    public function exportFormApparel()
    {
        return $this->belongsTo(ExportFormApparel::class);
    }
}
