<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class business extends Model
{
    use HasFactory;

    protected $fillable = [
    'user_id',
    'email',
    'contact_number',
    'address',
    'business_name',
    'business_address',
    'business_permit',
    'expiration_date',
];

}
