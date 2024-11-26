<?php

namespace App\Listeners;

use App\Events\LocalTransferCreated;
use App\Events\TransferCompleted;
use App\Jobs\TransferLocalFileToCloud;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Bus;

class CreateTransferBatch
{
    public function __construct()
    {
        //
    }

    public function handle(LocalTransferCreated $event)
    {
        $transfer = $event->getTransfer();

        $jobs = $event->getTransfer()->files->mapInto(TransferLocalFileToCloud::class);

        $batch = Bus::batch($jobs)
            ->finally(function () use ($transfer) {
                TransferCompleted::dispatch($transfer);
            })
            ->dispatch();

        $event->getTransfer()->update([
            'batch_id' => $batch->id
        ]);
    }
}
