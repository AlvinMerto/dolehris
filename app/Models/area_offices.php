<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class area_offices extends Model
{
    use HasFactory;

    protected $table      = "area_offices";
    protected $primaryKey = "areaofficepk";
    protected $fillable   = [
        "theareaoffice","status","created_at","updated_at"
    ];
}
