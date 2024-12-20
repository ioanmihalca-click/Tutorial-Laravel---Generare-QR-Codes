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

    public function mount($identifier = null)
    {
        if ($identifier) {
           $qrCode = QrCode::where('identifier', $identifier)->firstofFail();
           $qrCode->scans()->create();
           $qrCode->incrementScans();
        
        }
    }



    public function generate()
    {
        $this->validate();

        // Creare QR code în baza de date
        $qrCode = QrCode::create([
            'url' => $this->url,
            'title' => $this->title
        ]);

        // Generare imagine QR
        $generatedQr = QrCodeGenerator::size(300)
            ->format('svg')
            ->style('round')
            ->eye('circle')
            ->errorCorrection('H')
            ->generate($qrCode->tracking_url);

        // Salvare imagine
        Storage::disk('public')->put(
            "qrcodes/{$qrCode->identifier}.svg",
            $generatedQr
        );

        // Reset form
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