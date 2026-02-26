<div>
    <main class="flex-1 overflow-y-auto p-4 md:p-6">
        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 gap-4">
            <div>
                <h2 class="text-3xl font-bold text-gray-900">Sub Categories</h2>
                <p class="text-gray-600 mt-1">Manage your Sub categories</p>
            </div>

            <button wire:click="openModal"
                class="w-full sm:w-auto px-6 py-2 bg-gradient-to-br from-[#24bad8] to-[#0b7a93] rounded active:scale-95 duration-300 text-white transition-all flex items-center justify-center gap-2 ">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add Sub Category
            </button>
        </div>

        <!-- Search and Filter -->
        <div class="bg-white rounded-lg shadow-sm p-4 md:p-6 mb-6">
            <div class="flex md:flex-row flex-col md:justify-end items-center gap-4">
                <div>
                    <button wire:click="export">
                        <i class="ri-file-excel-2-fill text-4xl text-green-600 hover:text-green-800"></i>

                    </button>

                </div>

                <div>
                    <button wire:click="$toggle('showTrashed')"
                        class="bg-gradient-to-br from-[#24bad8] to-[#0b7a93] rounded active:scale-95 duration-300 text-white transition-all px-6 py-2">
                        {{ $showTrashed ? 'Show Active' : 'Show Trash' }}
                    </button>
                </div>

                <div>
                    <select wire:model.live.debounce.500ms="filtterStatus"
                        class="border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <option value="">All</option>
                        <option value="active">Active</option>
                        <option value="deactive">Deactive</option>
                    </select>
                </div>

                <div>
                    <input type="text" wire:model.live.debounce.500ms="search" placeholder="Search categories..."
                        class="border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>

            </div>
        </div>

        <!-- Categories Table -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">S.No.</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Sub Category</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Slug</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Category</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Status</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Created Date</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($SubCategories->isNotEmpty())
                            @foreach ($SubCategories as $SubCategory)
                                <tr class=" border-b border-gray-200 hover:bg-gray-50 transition">
                                    <td class="py-4 px-4">
                                        <p class="font-semibold text-gray-900">
                                            {{ ($SubCategories->currentPage() - 1) * $SubCategories->perPage() + $loop->iteration }}
                                        </p>


                                    </td>

                                    <td class="py-4 px-4">
                                        <p class="font-semibold text-gray-900">
                                            {{ $SubCategory->name }}</p>


                                    </td>


                                    <td class="py-4 px-4">
                                        <p class="font-semibold text-gray-900">
                                            {{ $SubCategory->slug }}</p>


                                    </td>


                                    <td class="py-4 px-4">
                                        <p class="font-semibold text-gray-900">
                                            {{ $SubCategory->category->name }}</p>


                                    </td>

                                    <td class="py-4 px-4">
                                        @if ($SubCategory->status === 'active')
                                            <span
                                                class='px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold'>Active</span>
                                        @else
                                            <span
                                                class='px-3 py-1 bg-rose-100 text-rose-700 rounded-full text-xs font-semibold'>Deactive</span>
                                        @endif


                                    </td>
                                    <td class="py-4 px-4 text-gray-600">
                                        {{ \Carbon\Carbon::parse($SubCategory->created_at)->format('d M Y') }}

                                    </td>
                                    <td class="py-4 px-4">
                                        <div class="flex items-center gap-2">
                                            <button wire:click="edit({{ $SubCategory->id }})"
                                                class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </button>
                                            @if (!$showTrashed)
                                                <button wire:click="delete({{ $SubCategory->id }})"
                                                    class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            @else
                                                <button wire:click="restore({{ $SubCategory->id }})"
                                                    class="p-2 text-indigo-600 hover:bg-indigo-50 rounded-lg transition">
                                                    <i class="ri-reset-right-fill text-xl"></i>
                                                </button>

                                                <button wire:click="forceDelete({{ $SubCategory->id }})"
                                                    class="p-2 text-rose-600 hover:bg-indigo-50 rounded-lg transition">
                                                    <i class="ri-delete-bin-2-line text-xl"></i>
                                                    force delete
                                                </button>
                                            @endif


                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-center p-4">No Sub Category</td>
                            </tr>
                        @endif


                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="p-4">
                {{ $SubCategories->links() }}
            </div>
        </div>



        {{-- open modal --}}
        @if ($isOpen)
            <div class="bg-black/50 flex fixed justify-center inset-0 items-center animate__animated animate__fadeIn">
                <div class="bg-white rounded md:w-6/12 w-full p-4 shadow-md animate__animated animate__zoomIn">
                    <div class="flex justify-between items-center">
                        <h1 class="text-2xl font-semibold">{{ $isEdit ? 'Edit Sub Category' : 'Add Sub Category' }}
                        </h1>
                        <button class="text-xl cursor-pointer" wire:click="closeModal">X</button>

                    </div>
                    <hr class="text-slate-200 my-4">

                    <form wire:submit.prevent="{{ $isEdit ? 'update' : 'save' }}" class="flex flex-col gap-8">
                        <div class="flex gap-1 flex-col">
                            <label class="font-medium text-md text-slate-800">Sub Category Name<span
                                    class="text-rose-500">*</span></label>
                            <input type="text" wire:model.live.debounce.500ms="name"
                                class="border rounded-md border-slate-200 p-4 focus:outline-none"
                                placeholder="Enter Sub Category Name...">
                            @error('name')
                                <span class="text-rose-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex gap-1 flex-col">
                            <label class="font-medium text-md text-slate-800">Slug<span
                                    class="text-rose-500">*</span></label>
                            <input type="text" wire:model="slug" readonly
                                class="border rounded-md border-slate-200 p-4 focus:outline-none"
                                placeholder="Slug...">
                            @error('slug')
                                <span class="text-rose-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex gap-1 flex-col">
                            <label class="font-medium text-md text-slate-800">Category<span
                                    class="text-rose-500">*</span></label>
                            <select wire:model="category_id"
                                class="border rounded-md border-slate-200 p-4 focus:outline-none"
                                placeholder="Enter Category Name...">
                                <option value="">---Select Category---</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach

                            </select>

                            @error('category_id')
                                <span class="text-rose-500">{{ $message }}</span>
                            @enderror
                        </div>



                        <div class="flex gap-1 flex-col">
                            <label class="font-medium text-md text-slate-800">Status<span
                                    class="text-rose-500">*</span></label>
                            <select wire:model="status"
                                class="border rounded-md border-slate-200 p-4 focus:outline-none">
                                <option value="active">Active</option>
                                <option value="deactive">Deactive</option>
                            </select>
                            @error('status')
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
                                name="" id="" cols="2" rows="2" placeholder="Enter Meta Description..."></textarea>

                        </div>

                        <div class="flex gap-1 flex-col">


                            <button wire:loading.attr="disabled" wire:loading.class="opacity-50 cursor-not-allowed"
                                wire:target={{ $isEdit ? 'update' : 'save' }}
                                class="px-4 py-2 bg-gradient-to-br from-[#24bad8] to-[#0b7a93] active:scale-95 duration-300 text-white transition-all  rounded w-fit flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>

                                {{ $isEdit ? 'Update Sub Category' : 'Add Sub Category' }}
                            </button>


                        </div>
                    </form>

                </div>
            </div>
        @endif

    </main>
</div>
