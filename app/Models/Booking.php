<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'start_timestamp' => 'datetime',
        'end_timestamp' => 'datetime',
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
     * Get the contact for the booking.
     */
    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
    
    /**
     * Get the vehicle for the booking.
     */
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
