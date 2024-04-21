<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'product_id';
    protected $fillable = [
        'serialNumber',
        'product_code',
        'product_name',
        'generic_name',
        'strength',
        'fill_volume',
        'batch_size_liter',
        'batch_size_vial',
        'routeAdministration_id',
        'secondaryPackagingFormat_id',
        'preparedBy',
        'addedBy'
    ];


    function getRouteAdministration(){
        return $this->belongsTo('App\Models\RouteAdministration', 'routeAdministration_id');
    }

    function getSecondaryPackagingFormat(){
        return $this->belongsTo('App\Models\SecondaryPackagingFormat', 'secondaryPackagingFormat_id');
    }
}
