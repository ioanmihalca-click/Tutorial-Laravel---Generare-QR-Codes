<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QrScan extends Model
{
   protected $fillable =[

    'qr_code_id',
    'scanned_at'
   
    ];

    public function qrCode()
    {
        return $this->belongsTo(QrCode::class);
    }
}
