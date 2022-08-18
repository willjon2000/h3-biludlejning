<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddonRelation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'addone',
        'addone_price',
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
     * Get the addon for relation.
     */
    public function addon()
    {
        return $this->belongsTo(Addon::class);
    }
    
    /**
     * Get the booking for relation.
     */
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
