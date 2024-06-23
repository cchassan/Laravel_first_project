<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BatchType extends Model
{
    use HasFactory;

    protected $primaryKey = 'batchType_id';

    protected $fillable = [
        'batchType'
    ];
}
