<div>
    <!-- Formular -->
    <div class="mx-auto my-8 max-w-7xl">
        <form wire:submit.prevent="generate">
            <div class="mb-4">
                <label for="url" class="block text-sm font-medium text-gray-700">URL</label>
                <input type="url" wire:model="url" id="url"
                       class="block w-full mt-1 border-gray-300 rounded-md shadow-sm"
                       placeholder="https://laravel.com/docs">
                @error('url') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>
            
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Titlu (opțional)</label>
                <input type="text" wire:model="title" id="title"
                       class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                @error('title') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>

            <button type="submit" 
                    class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                Generează QR Code
            </button>
        </form>
    </div>

    <!-- Lista QR Codes -->
    <div class="mx-auto mt-8 max-w-7xl">
        <h2 class="mb-4 text-lg font-semibold">QR Codes Generate</h2>
        
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
            @foreach($qrCodes as $qr)
                <div class="p-4 border rounded-lg">
                    <div class="mb-2">
                        <h3 class="font-bold">{{ $qr->title ?? 'QR Code #' . $qr->id }}</h3>
                        <p class="text-sm text-gray-600">{{ $qr->url }}</p>
                    </div>
                    
                    <img src="{{ Storage::url("qrcodes/{$qr->identifier}.svg") }}" 
                         alt="QR Code"
                         class="w-full h-auto">
                         
                    <div class="mt-2 text-sm text-gray-600">
                        Scanări: {{ $qr->scans }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>