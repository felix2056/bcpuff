<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'sub_title', 'info', 'logo'
    ];

    protected $appends = [
        'logo_url'
    ];

    public function getLogoUrlAttribute()
    {
        if (empty($this->logo)) {
            return '/img/default/logo.png';
        }

        return '/storage/settings/' . $this->logo;
    }
}
