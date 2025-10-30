<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class service extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_id',
        'name_service',
        'type_service',
        'price',
        'description',
        'picture',
    ];

    public function business()
    {
        return $this->belongsTo(business::class,'business_id','user_id');
    }

    public function staff()
{
    return $this->belongsToMany(staff::class, 'service_staff');
}

  public function servicestaff()
{
    return $this->belongsToMany(
        staff::class,
        'service_staff',
        'service_id',
        'staff_id' 
    );
}


}
