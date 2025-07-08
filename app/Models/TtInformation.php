<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TtInformation extends Model
{
    use HasFactory;

    protected $table = 'tt_information';
    protected $primaryKey = 'id';

    protected $fillable = [
        'tt_no',
        'tt_amount',
        'tt_currency',
        'bank_name',
        'tt_site',
        'tt_date',
        'tt_remarks',
        'tt_status',
        'Created_by',
        'Modified_by',
    ];

    protected $casts = [
        'tt_date' => 'datetime',
    ];


}
