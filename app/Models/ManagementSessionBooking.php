<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ManagementSessionBooking extends Model
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
        'event_type',
        'event_date',
        'stripe_session_id',
        'stripe_payment_intent_id',
        'amount_paid',
        'payment_status',
    ];

    protected $casts = [
        'slot_id' => 'integer',
        'event_date' => 'date',
    ];

    public function slot()
    {
        return $this->belongsTo(ManagementSessionSlot::class, 'slot_id');
    }

    public function rescheduleRequests()
    {
        return $this->hasMany(RescheduleRequest::class, 'booking_id')
            ->where('booking_type', 'management');
    }

    public static function generateConfirmationCode()
    {
        do {
            $code = 'MGT-' . strtoupper(Str::random(8));
        } while (self::where('confirmation_code', $code)->exists());
        
        return $code;
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }

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

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($booking) {
            if (empty($booking->confirmation_code)) {
                $booking->confirmation_code = self::generateConfirmationCode();
            }
        });

        static::created(function ($booking) {
            $booking->slot->update(['is_booked' => true]);
        });

        static::updated(function ($booking) {
            if ($booking->status === 'cancelled' && $booking->getOriginal('status') !== 'cancelled') {
                $booking->slot->update(['is_booked' => false]);
            }
        });
    }
}
