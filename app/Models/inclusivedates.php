<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class inclusivedates extends Model
{
    use HasFactory;
    protected $table        = "inclusivedates";
    protected $primaryKey   = "inclusivedatespk";
    protected $fillable     = ["leaveapplicationid","thedate","created_at","updated_at"];
}
