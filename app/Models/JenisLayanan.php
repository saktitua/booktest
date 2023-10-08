<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisLayanan extends Model
{
    protected $table ="jenis_layanan";

    public function users(){
        return $this->hasOne('User');
    }
}
