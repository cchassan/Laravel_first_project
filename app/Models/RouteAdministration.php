<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RouteAdministration extends Model
{
    use HasFactory;

    protected $primaryKey = 'routeAdministration_id';

    protected $fillable = [
        'routeAdministrationName'
    ];
}
