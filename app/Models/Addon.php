<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addon extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'type',
        'price',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
    ];

    /**
     * Get the relations for addon.
     */
    public function addonRelations()
    {
        return $this->hasMany(AddonRelation::class);
    }

    public function bookings()
    {
        return $this->belongsToMany(Booking::class,'bookings_addons','addon_id','booking_id','id','id');
        //return $this->morphedByMany(Booking::class);
    }
}
