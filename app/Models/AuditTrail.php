<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditTrail extends Model
{
    use HasFactory;

    protected $table = "audittrail"; 

    public static function doLogAudit($menu,$description,$username,$jenis_layanan){
        $audit = new $this->class;
        $audit->menu = $menu;
        $audit->description = $description;
        $audit->username = $username;
        $audit->jenis_layanan = $jenis_layanan;
        $audit->save();
    }
}
