<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class staff extends Model
{
    use HasFactory;

       protected $fillable = [
        'fullanem',
        'role_id',
    ];

    public function services()
{
    return $this->belongsToMany(Service::class, 'service_staff');
}

}
