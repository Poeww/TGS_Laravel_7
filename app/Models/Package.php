<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $table = 'package';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'package_name',
        'description',
        'location',
        'duration',
        'price',
        'image'
    ];
}
