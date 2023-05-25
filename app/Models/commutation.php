<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class commutation extends Model
{
    use HasFactory;
    protected $table        = "commutations";
    protected $primaryKey   = "commutationpk";
    protected $fillable     = [
            "isrequested","notrequested","created_at","updated_at"
        ];
}
