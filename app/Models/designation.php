<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class designation extends Model
{
    use HasFactory;
    protected $table="designations";
    protected $fillable=[
        'designation_name',
    ];
}
