<div>
    @push('style')
        <style>
            .fr-wrapper {
                min-height: 250px !important;
            }
        </style>
    @endpush
    <main class="flex-1 overflow-y-auto p-4 md:p-6">
        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 gap-4">
            <div>
                <h2 class="text-3xl font-bold text-gray-900">All Pages</h2>
                <p class="text-gray-600 mt-1">Manage your Website Pages</p>
            </div>

            <button wire:click="openModal"
                class="w-full sm:w-auto px-6 py-2 bg-gradient-to-br from-[#24bad8] to-[#0b7a93] rounded active:scale-95 duration-300 text-white transition-all flex items-center justify-center gap-2 ">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add Page
            </button>
        </div>


        <!-- Pages Table -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">S.NO.</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Name</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Slug</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Title</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Created Date</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($pages->isNotEmpty())
                            @foreach ($pages as $page)
                                <tr class=" border-b border-gray-200 hover:bg-gray-50 transition">
                                    <td class="py-4 px-4">
                                        <p class="font-semibold text-gray-900">
                                            {{ ($pages->currentPage() - 1) * $pages->perPage() + $loop->iteration }}
                                        </p>


                                    </td>

                                    <td class="py-4 px-4">
                                        <div>
                                            <p class="font-semibold text-gray-900">
                                                {{ $page->name }}</p>

                                        </div>
                                    </td>

                                    <td class="py-4 px-4">
                                        <p class="font-semibold text-gray-900">
                                            {{ $page->slug }}</p>


                                    </td>

                                    <td class="py-4 px-4">
                                        <p class="font-semibold text-gray-900">
                                            {{ $page->title }}</p>


                                    </td>

                                    <td class="py-4 px-4 text-gray-600">
                                        {{ \Carbon\Carbon::parse($page->created_at)->format('d M Y') }}

                                    </td>
                                    <td class="py-4 px-4">
                                        <div class="flex items-center gap-2">
                                            <button wire:click="edit({{ $page->id }})"
                                                class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </button>


                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="text-center pt-4">Empty Pages</td>
                            </tr>
                        @endif


                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="p-4">
                {{ $pages->links() }}
            </div>
        </div>



        {{-- open modal --}}
        @if ($isOpen)
            <div class="bg-black/50 flex fixed justify-center inset-0 items-center animate__animated animate__fadeIn">
                <div
                    class="bg-white rounded md:w-6/12 w-full p-4 shadow-md animate__animated animate__zoomIn overflow-y-auto max-h-screen">
                    <div class="flex justify-between items-center">
                        <h1 class="text-2xl font-semibold">{{ $isEdit ? 'Edit Page' : 'Add Page' }}</h1>
                        <button class="text-xl cursor-pointer" wire:click="closeModal">X</button>

                    </div>
                    <hr class="text-slate-200 my-4">

                    <form wire:submit.prevent="save" class="flex flex-col gap-8">
                        <div class="flex gap-1 flex-col">
                            <label class="font-medium text-md text-slate-800">Page Name<span
                                    class="text-rose-500">*</span></label>
                            <input type="text" wire:model.live.debounce.500ms="name"
                                class="border rounded-md border-slate-200 p-4 focus:outline-none"
                                placeholder="Enter Page Name...">
                            @error('name')
                                <span class="text-rose-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex gap-1 flex-col">
                            <label class="font-medium text-md text-slate-800">Slug<span
                                    class="text-rose-500">*</span></label>
                            <input type="text" wire:model.live.debounce.500ms="slug" readonly
                                class="border rounded-md border-slate-200 p-4 focus:outline-none" placeholder="Slug...">
                            @error('slug')
                                <span class="text-rose-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex gap-1 flex-col">
                            <label class="font-medium text-md text-slate-800">Page Title</label>
                            <input type="text" wire:model="title"
                                class="border rounded-md border-slate-200 p-4 focus:outline-none"
                                placeholder="Enter Page Title...">

                        </div>

                        <div class="flex gap-1 flex-col md:border-r">
                            <label class="font-medium text-md text-slate-800">Page Image</label>
                            <div class="relative w-fit h-25">
                                <i class="ri-upload-cloud-2-line text-6xl text-[#0b7a93]"></i>
                                <input type="file" wire:model="image" accept="image/*"
                                    class="absolute left-0 w-full h-full opacity-0 cursor-pointer">
                            </div>
                            @error('image')
                                <span class="text-rose-500">{{ $message }}</span>
                            @enderror

                            {{-- OLD IMAGE --}}
                            <div class="mt-3">
                                @if ($image)
                                    <img src="{{ $image->temporaryUrl() }}" class=" rounded border w-40">
                                @elseif($oldImage)
                                    <img
                                        src="{{ asset('storage/uploads/pages/' . $oldImage) }}"class="rounded border w-40">
                                @endif
                            </div>


                        </div>

                        <div class="flex gap-1 flex-col" x-data x-init="const editor2 = new FroalaEditor('#description', {
                            events: {
                                contentChanged: function() {
                                    @this.set('description', this.html.get())
                                }
                            }
                        });
                        setTimeout(() => {
                            editor2.html.set(@js($description));
                        }, 50);" wire:ignore>
                            <label class="font-medium text-md text-slate-800">Description</label>
                            <div id="description"></div>

                            @error('description')
                                <span class="text-rose-500">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="flex gap-1 flex-col">
                            <label class="font-medium text-md text-slate-800">Meta Title<span
                                    class="text-rose-500">*</span></label>
                            <input wire:model="meta_title" type="text"
                                class="border rounded-md border-slate-200 p-4 focus:outline-none"
                                placeholder="Enter Meta Title...">
                        </div>

                        <div class="flex gap-1 flex-col">
                            <label class="font-medium text-md text-slate-800">Meta Description<span
                                    class="text-rose-500">*</span></label>
                            <textarea wire:model="meta_description" class="border rounded-md border-slate-200 p-4 focus:outline-none"
                                cols="2" rows="2" placeholder="Enter Meta Description..."></textarea>

                        </div>

                        <div class="flex gap-1 flex-col">

                            <button wire:loading.attr="disabled" wire:loading.class="opacity-50 cursor-not-allowed"
                                wire:target={{ $isEdit ? 'update' : 'save' }}
                                class="px-4 py-2 bg-gradient-to-br from-[#24bad8] to-[#0b7a93] rounded active:scale-95 duration-300 text-white transition-all w-fit flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                {{ $isEdit ? 'Update page' : 'Add page' }}</button>


                        </div>
                    </form>

                </div>
            </div>
        @endif

    </main>
</div>
