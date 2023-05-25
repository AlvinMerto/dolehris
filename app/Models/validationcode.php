<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class validationcode extends Model
{
    use HasFactory;

    protected $table        = "validationcodes";
    protected $primaryKey   = "validcode";
    protected $fillable     = [
        "typeofdocument","thecode","personnelid","detailsid","created_at","updated_at"
    ];
}
