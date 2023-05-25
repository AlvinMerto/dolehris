<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class updatedetails extends Model
{
    use HasFactory;

    protected $table        = "updatedetails";
    protected $primaryKey   = "updatedetailsid";
    protected $fillable     = [
        "leavecardid","theupdate","created_at","updated_at"
    ];

}
