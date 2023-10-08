<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Cabang extends Model
{
    use HasFactory;
    protected $table="cabang";

    public function users(){
        return $this->hasOne(User::class);
    }
}
