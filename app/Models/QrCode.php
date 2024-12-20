<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class QrCode extends Model
{
   protected $fillable =[

    'identifier',
    'url',
    'title',
    'scans'
   
    ];

    protected static function boot()
    {
        parent::boot();

        //generam identificator unic la creare

        static::creating(function ($qrcode) {
            $qrcode->identifier = Str::random(10);
        });
    }

    public function incrementScans() 
    {
        $this ->increment('scans');
    }

    public function scans()
    {
        return $this->hasMany(QrScan::class);
    }

    //helper pentru url-ul de tracking
    public function getTrackingUrlAttribute()
    {
        return route('qr.redirect'. $this->identifier);
    }
}
