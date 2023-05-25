<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Signatories extends Model
{
    use HasFactory;

    protected $primaryKey = "signids";
    protected $table      = "signatories";
    protected $fillable   = [
        "signatorypk","area_officesid","thesignatory","personnelid","created_at","updated_at"
    ];
}
