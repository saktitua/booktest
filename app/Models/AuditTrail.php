<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditTrail extends Model
{
    use HasFactory;

    protected $table = "auditTrail"; 
    protected $fillable =[
        'id',
        'menu',
        'description0',
        'username',
        'jenis_layanan',

    ];

    public static function doLogAudit($menu,$description,$username,$jenis_layanan){
        $audit = new AuditTrail;
        $audit->menu = $menu;
        $audit->description = $description;
        $audit->username = $username;
        $audit->jenis_layanan = $jenis_layanan;
        $audit->save();
    }
}
