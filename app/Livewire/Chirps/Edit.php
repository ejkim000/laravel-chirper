<?php

namespace App\Livewire\Chirps;

use App\Models\Chirp;
use Livewire\Component;


class Edit extends Component
{
    public Chirp $chirp;

    protected $rules = [
        'message' => 'required|string|max:255'
    ];

    public string $message = '';

    public function mount(): void
    {
        $this->message = $this->chirp->message;
    }
    
    public function update(): void
    {
        $this->authorize('update', $this->chirp);

        $validated = $this->validate();

        $this->chirp->update($validated);

        $this->dispatch('chirp-updated');
    }

    public function cancel(): void
    {
        $this->dispatch('chrip-edit-canceled');
    }

    public function render()
    {
        return view('livewire.chirps.edit');
    }
}
