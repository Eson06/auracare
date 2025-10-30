<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order_details extends Model
{
    use HasFactory;

     protected $fillable = [
        'name_service',
        'type_service',
        'price',
        'date_schdedule',
        'selected_time',
        'picture',
        'amount_paid',
        'user_id',
    ];

     public function customer() {
        return $this->belongsTo(user::class,'user_id', 'id');
    }
}
