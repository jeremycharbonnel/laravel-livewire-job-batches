<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class ManageTransfers extends Component
{
    use WithFileUploads;

    public array $pendingFiles = [];

    public function initiateTransfer()
    {
        $this->validate([
            'pendingFiles.*' => ['image', 'max:5120']
        ]);
    }

    public function render()
    {
        return view('livewire.manage-transfers');
    }
}
