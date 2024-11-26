<?php

namespace App\Jobs;

use App\Events\FileTransferredToCloud;
use App\Models\TransferFile;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\File;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class TransferLocalFileToCloud implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(private TransferFile $file)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $localPath = $this->file->path;

        // $cloudPath = Storage::disk('s3')->put('images', new File($localPath));

        sleep(3);

        $this->file->update([
            'disk' => 's3',
            // 'path' => $cloudPath,
        ]);

        Storage::delete(explode('/app/', $localPath)[1]);

        // Dispatch event
        FileTransferredToCloud::dispatch($this->file);
    }
}
