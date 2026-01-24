<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class CounselingSlot extends Model
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

    /**
     * Get the booking for this slot
     */
    public function booking()
    {
        return $this->hasOne(CounselingBooking::class, 'slot_id');
    }

    /**
     * Scope for available slots (not booked and marked as available)
     */
    public function scopeAvailable($query)
    {
        return $query->where('is_available', true)->where('is_booked', false);
    }

    /**
     * Scope for upcoming slots (today or future)
     */
    public function scopeUpcoming($query)
    {
        return $query->where('date', '>=', Carbon::today());
    }

    /**
     * Scope for a specific date
     */
    public function scopeForDate($query, $date)
    {
        return $query->whereDate('date', $date);
    }

    /**
     * Get formatted time range
     */
    public function getFormattedTimeAttribute()
    {
        return Carbon::parse($this->start_time)->format('g:i A') . ' - ' . Carbon::parse($this->end_time)->format('g:i A');
    }

    /**
     * Get formatted date
     */
    public function getFormattedDateAttribute()
    {
        return $this->date->format('l, F j, Y');
    }

    /**
     * Check if slot can be booked
     */
    public function canBeBooked()
    {
        return $this->is_available && !$this->is_booked && $this->date >= Carbon::today();
    }
}
