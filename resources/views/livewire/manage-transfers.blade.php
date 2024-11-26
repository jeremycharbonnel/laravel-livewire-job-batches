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
            <tr>
                <td class="py-3">
                    <div class="w-max rounded-lg bg-green-200 px-3 py-1 text-sm font-bold text-green-500">Uploaded</div>
                </td>
                <td class="text-gray-500">d9cbb5a7-ea12-42b4-9fb3-3e5a7f10631f</td>
                <td class="text-gray-500">2MB</td>
            </tr>
            <tr>
                <td class="py-3">
                    <div class="w-max rounded-lg bg-orange-200 px-3 py-1 text-sm font-bold text-orange-500">Finished with errors</div>
                </td>
                <td class="text-gray-500">0d669854-fb2c-480f-ae04-8572ec695242</td>
                <td class="text-gray-500">0MB</td>
            </tr>
            <tr>
                <td class="py-3">
                    <div class="w-max rounded-lg bg-red-200 px-3 py-1 text-sm font-bold text-red-500">Failed</div>
                </td>
                <td class="text-gray-500">e176a925-8534-446f-a1f6-3fc2e06fcb0f</td>
                <td class="text-gray-500">0MB</td>
            </tr>
            <tr>
                <td class="py-3">
                    <div class="mr-6 flex h-2 overflow-hidden rounded bg-gray-50">
                        <div
                            style="transform: scale({{ 50 / 100 }}, 1)"
                            class="flex w-full origin-left flex-col bg-blue-500 shadow-none transition-transform duration-200 ease-in-out"
                        ></div>
                    </div>
                </td>
                <td class="text-gray-500">296fc64e-af31-401d-9895-3d18ce02931c</td>
                <td class="text-gray-500">0MB</td>
            </tr>
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

        <div>
            <button type="button" class="flex w-full items-center justify-center gap-2 rounded-lg bg-blue-400 py-2 text-white">
                Do some magic
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6">
                    <path stroke="currentColor" fill="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                </svg>
            </button>
        </div>
    </div>
</div>
