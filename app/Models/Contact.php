<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'subject',
        'message',
        'status',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the full name of the contact.
     */
    public function getFullNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Scope a query to only include new contacts.
     */
    public function scopeNew($query)
    {
        return $query->where('status', 'new');
    }

    /**
     * Scope a query to only include read contacts.
     */
    public function scopeRead($query)
    {
        return $query->where('status', 'read');
    }

    /**
     * Scope a query to only include replied contacts.
     */
    public function scopeReplied($query)
    {
        return $query->where('status', 'replied');
    }

    /**
     * Get subject options.
     */
    public static function getSubjectOptions(): array
    {
        return [
            'order_inquiry' => 'Order Inquiry',
            'product_question' => 'Product Question',
            'shipping_issue' => 'Shipping Issue',
            'return_refund' => 'Return/Refund',
            'general_question' => 'General Question',
            'complaint' => 'Complaint',
            'partnership_business' => 'Partnership/Business',
        ];
    }

    /**
     * Get formatted subject label.
     */
    public function getSubjectLabelAttribute(): string
    {
        return self::getSubjectOptions()[$this->subject] ?? $this->subject;
    }
}
