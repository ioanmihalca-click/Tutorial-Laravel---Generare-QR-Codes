<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\QrCode;
use SimpleSoftwareIO\QrCode\Facades\QrCode as QrCodeGenerator;
use Illuminate\Support\Facades\Storage;

class QrGenerator extends Component
{
    public $url = '';
    public $title = '';

    protected $rules = [
        'url' => 'required|url',
        'title' => 'nullable|string|max:255'
    ];


    public function generate()
    {
        $this->validate();

        // Creare QR code în baza de date
        $qrCode = QrCode::create([
            'url' => $this->url,
            'title' => $this->title
        ]);

        // Folosim app()->make pentru a genera URL-ul corect de tracking
        $trackingUrl = app()->make('url')->to("/r/{$qrCode->identifier}");

        // Generăm QR code-ul cu URL-ul de tracking
        $generatedQr = QrCodeGenerator::size(300)
            ->format('svg')
            ->style('round')
            ->eye('circle')
            ->errorCorrection('H')
            ->generate($trackingUrl);

        Storage::disk('public')->put(
            "qrcodes/{$qrCode->identifier}.svg",
            $generatedQr
        );

        $this->reset(['url', 'title']);
        session()->flash('success', 'QR Code generat cu succes!');
    }

    public function render()
    {
        return view('livewire.qr-generator', [
            'qrCodes' => QrCode::latest()->get()
        ]);
    }
}
