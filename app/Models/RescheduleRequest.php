<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RescheduleRequest extends Model
{
    protected $fillable = [
        'booking_type',
        'booking_id',
        'requested_slot_id',
        'reason',
        'status',
        'admin_note',
    ];

    /**
     * The new slot the user wants.
     * We can't use a single belongsTo for polymorphic slots, so we resolve dynamically.
     */
    public function requestedSlot()
    {
        if ($this->booking_type === 'counseling') {
            return $this->belongsTo(CounselingSlot::class, 'requested_slot_id');
        }
        return $this->belongsTo(ManagementSessionSlot::class, 'requested_slot_id');
    }

    /**
     * The booking this request belongs to.
     */
    public function booking()
    {
        if ($this->booking_type === 'counseling') {
            return $this->belongsTo(CounselingBooking::class, 'booking_id');
        }
        return $this->belongsTo(ManagementSessionBooking::class, 'booking_id');
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }
}
