<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tardyundertimetbls extends Model
{
    use HasFactory;
    protected $table         = "tardyundertimetbls";
    protected $primaryKey    = "tardyundertimepk";
    protected $fillable      = [
        "typeofitem","thevalue","personnelid","thedateinquestion","created_at","updated_at"
    ];
}
