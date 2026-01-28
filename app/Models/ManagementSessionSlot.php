<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ManagementSessionSlot extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'start_time',
        'end_time',
        'duration',
        'price',
        'is_available',
        'is_booked',
        'notes',
    ];

    protected $casts = [
        'date' => 'date',
        'is_available' => 'boolean',
        'is_booked' => 'boolean',
        'duration' => 'integer',
        'price' => 'decimal:2',
    ];

    public function bookings()
    {
        return $this->hasOne(ManagementSessionBooking::class, 'slot_id');
    }

    public function scopeAvailable($query)
    {
        return $query->where('is_available', true)->where('is_booked', false);
    }

    public function scopeUpcoming($query)
    {
        return $query->where('date', '>=', Carbon::today())
                     ->where(function($q) {
                         $q->where('date', '>', Carbon::today())
                           ->orWhere(function($subq) {
                               $subq->where('date', '=', Carbon::today())
                                    ->where('start_time', '>', Carbon::now()->format('H:i:s'));
                           });
                     });
    }

    public function scopeForDate($query, $date)
    {
        return $query->whereDate('date', $date);
    }

    public function getFormattedTimeAttribute()
    {
        return Carbon::parse($this->start_time)->format('g:i A') . ' - ' . Carbon::parse($this->end_time)->format('g:i A');
    }

    public function canBeBooked()
    {
        return $this->is_available && !$this->is_booked;
    }
}
