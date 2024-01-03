<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailReport extends Model
{
    use HasFactory;
    protected $table = 'report_detail';

    protected $fillable  = [
        'id',
        'report_id',
        'question',
        'point'
    ];
}
