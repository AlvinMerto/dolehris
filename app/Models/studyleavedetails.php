<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class studyleavedetails extends Model
{
    use HasFactory;
    protected $table       = "studyleavedetails";
    protected $primaryKey  = "studyleavedetailspk";
    protected $fillable    = [
        "leaveapplicationid","iscompletionofgradstud",
        "isbarboardexamrev","created_at","updated_at"
    ];
}
