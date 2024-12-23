<?php

namespace App\Livewire;

use App\Events\LocalTransferCreated;
use App\Models\TransferFile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class ManageTransfers extends Component
{
    use WithFileUploads;

    public array $pendingFiles = [];

    public function getListeners()
    {
        $userId = auth()->id();

        return [
            "echo-private:notifications.{$userId},FileTransferredToCloud" => '$refresh',
        ];
    }

    public function initiateTransfer()
    {
        $this->validate([
            'pendingFiles.*' => ['image', 'max:5120']
        ]);

        // This code will not execute if the validation fails
        $transfer = User::findOrFail(Auth::user()->id)->transfers()->create();

        $transfer->files()->saveMany(
            collect($this->pendingFiles)
                ->map(function (TemporaryUploadedFile $pendingFile) {
                    return new TransferFile([
                        'disk' => 'local',
                        'path' => $pendingFile->getRealPath(),
                        'size' => $pendingFile->getSize(),
                    ]);
                })
        );

        $this->pendingFiles = [];

        LocalTransferCreated::dispatch($transfer);
    }

    public function render()
    {
        return view('livewire.manage-transfers', [
            'transfers' => Auth::user()->transfers()->with('jobBatch')->withSum('files', 'size')->get()
        ]);
    }
}
