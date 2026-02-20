<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CounselingBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'slot_id',
        'name',
        'email',
        'phone',
        'message',
        'status',
        'confirmation_code',
        'stripe_session_id',
        'stripe_payment_intent_id',
        'amount_paid',
        'payment_status',
    ];

    protected $casts = [
        'slot_id' => 'integer',
    ];

    /**
     * Get the slot for this booking
     */
    public function slot()
    {
        return $this->belongsTo(CounselingSlot::class, 'slot_id');
    }

    /**
     * Generate a unique confirmation code
     */
    public static function generateConfirmationCode()
    {
        do {
            $code = 'SNS-' . strtoupper(Str::random(8));
        } while (self::where('confirmation_code', $code)->exists());
        
        return $code;
    }

    /**
     * Scope for pending bookings
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope for confirmed bookings
     */
    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }

    /**
     * Get status badge color
     */
    public function getStatusColorAttribute()
    {
        return match($this->status) {
            'pending' => 'yellow',
            'confirmed' => 'green',
            'completed' => 'blue',
            'cancelled' => 'red',
            default => 'gray',
        };
    }

    /**
     * Boot the model
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($booking) {
            if (empty($booking->confirmation_code)) {
                $booking->confirmation_code = self::generateConfirmationCode();
            }
        });

        // When a booking is created, mark the slot as booked
        static::created(function ($booking) {
            $booking->slot->update(['is_booked' => true]);
        });

        // When a booking is cancelled, free up the slot
        static::updated(function ($booking) {
            if ($booking->status === 'cancelled' && $booking->getOriginal('status') !== 'cancelled') {
                $booking->slot->update(['is_booked' => false]);
            }
        });
    }
}
