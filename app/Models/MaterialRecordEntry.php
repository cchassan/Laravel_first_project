<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class MaterialRecordEntry extends Model
{
    use HasFactory, HasRoles;

    protected $table = 'material_record_entries';
    protected $fillable = [
        'serialNumber',
        'itemCode',
        'itemDescription',
        'manufacturerName',
        'manufacturerAddress',
        'preparedBy',
        'date',
        'remarks'
    ];
}
