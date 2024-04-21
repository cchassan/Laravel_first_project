<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SecondaryPackagingFormat extends Model
{
    use HasFactory;

    protected $primaryKey = 'secondaryPackagingFormat_id';

    protected $fillable = [
        'secondaryPackagingFormatName'
    ];
}
