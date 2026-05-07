<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $fillable = [
        'ip_address',
        'user_agent',
        'page',
        'referrer',
    ];

    /**
     * Detect device type from user agent.
     */
    public function getDeviceAttribute(): string
    {
        $ua = $this->user_agent ?? '';
        if (preg_match('/Mobile|Android|iPhone|iPod/i', $ua)) return 'Mobile';
        if (preg_match('/Tablet|iPad/i', $ua)) return 'Tablet';
        return 'Desktop';
    }

    /**
     * Detect browser from user agent.
     */
    public function getBrowserAttribute(): string
    {
        $ua = $this->user_agent ?? '';
        if (str_contains($ua, 'Edg')) return 'Edge';
        if (str_contains($ua, 'OPR') || str_contains($ua, 'Opera')) return 'Opera';
        if (str_contains($ua, 'Chrome')) return 'Chrome';
        if (str_contains($ua, 'Firefox')) return 'Firefox';
        if (str_contains($ua, 'Safari')) return 'Safari';
        return 'Other';
    }
}
