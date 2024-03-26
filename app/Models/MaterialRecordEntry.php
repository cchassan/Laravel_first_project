<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class MaterialRecordEntry extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'material_record_entries';
    protected $primaryKey = 'material_record_id';
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
