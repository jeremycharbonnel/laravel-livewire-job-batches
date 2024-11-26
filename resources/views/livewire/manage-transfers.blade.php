<div class="flex items-start justify-between gap-6 p-6">
    <table class="flex-1">
        <thead>
            <tr>
                <th class="text-grey-500 py-3 text-left text-xs font-medium uppercase">Status</th>
                <th class="text-grey-500 text-left text-xs font-medium uppercase">Batch ID</th>
                <th class="text-grey-500 text-left text-xs font-medium uppercase">Storage</th>
            </tr>
        </thead>

        <tbody>
            @forelse($transfers as $transfer)
                <tr>
                    @if(is_null($transfer->jobBatch))
                        <td>
                            <div class="mr-6 flex h-2 overflow-hidden rounded bg-gray-50">
                                <div
                                    style="transform: scale(0, 1)"
                                    class="flex w-full origin-left flex-col bg-blue-500 shadow-none transition-transform duration-200 ease-in-out"
                                ></div>
                            </div>
                        </td>
                    @elseif($transfer->jobBatch->hasPendingJobs())
                        <td>
                            <div class="mr-6 flex h-2 overflow-hidden rounded bg-gray-50">
                                <div
                                    style="transform: scale({{ $transfer->jobBatch->progress() / 100 }}, 1)"
                                    class="flex w-full origin-left flex-col bg-blue-500 shadow-none transition-transform duration-200 ease-in-out"
                                ></div>
                            </div>
                        </td>
                    @elseif($transfer->jobBatch->finished() and $transfer->jobBatch->failed())
                        <td>
                            <div class="w-max rounded-lg bg-red-200 px-3 py-1 text-sm font-bold text-red-500">Failed</div>
                        </td>
                    @elseif($transfer->jobBatch->finished() and $transfer->jobBatch->hasFailures())
                        <td>
                            <div class="w-max rounded-lg bg-orange-200 px-3 py-1 text-sm font-bold text-orange-500">Finished with errors</div>
                        </td>
                    @elseif($transfer->jobBatch->finished())
                        <td>
                            <div class="w-max rounded-lg bg-green-200 px-3 py-1 text-sm font-bold text-green-500">Uploaded</div>
                        </td>
                    @endif
                    <td class="text-gray-500">{{ $transfer->batch_id }}</td>
                    <td class="py-3 text-gray-500">{{ $transfer->files_sum_size }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-sm text-gray-500">
                        You have no transfers. Create a batch on the right 👉🏻
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="space-y-6 rounded-2xl bg-white p-6 shadow">
        <div>
            <h3 class="text-md font-medium uppercase text-gray-900">Create Batch</h3>
            <p class="text-gray-700">Select the files you want to upload.</p>
        </div>

        <div>
            <input wire:model="pendingFiles" id="files" name="files" type="file" multiple>
        </div>

        <div class="flex justify-center font-medium">
            Files
        </div>

        <div class="ml-4 flex items-center">
            @forelse($pendingFiles as $pendingFile)
                <img src="{{ $pendingFile->temporaryUrl() }}" class="-ml-4 h-16 w-16" />
            @empty
                <p>No files selected</p>
            @endforelse
        </div>

        <div class="space-y-3">
            <button
                type="button"
                wire:click="initiateTransfer"
                class="flex w-full items-center justify-center gap-2 rounded-lg bg-blue-400 py-2 text-white"
            >
                Do some magic
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6">
                    <path stroke="currentColor" fill="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                </svg>
            </button>

            @error('pendingFiles.*')
                <div class="w-full rounded-xl bg-red-100 p-3">
                    <div class="text-sm text-red-400">{{ $message }}</div>
                </div>
            @enderror
        </div>
    </div>
</div>
