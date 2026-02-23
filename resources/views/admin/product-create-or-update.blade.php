@push('style')
    <style>
        .fr-wrapper {
            min-height: 250px !important;
        }
    </style>
@endpush
<div>
    <main class="flex-1 overflow-y-auto p-4 md:p-6">
        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 gap-4">
            <div>
                <h2 class="text-3xl font-bold text-gray-900">Products</h2>
                <p class="text-gray-600 mt-1">Manage your product</p>
            </div>

            <button wire:click="openModal"
                class="w-full sm:w-auto px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition flex items-center justify-center gap-2 ">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add Product
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
                        class="bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition px-6 py-2">
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

                <select wire:model.live.debounce.500ms="filterCategory"
                    class="border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="">All Categories</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>

                <select wire:model.live.debounce.500ms="filterBrand"
                    class="border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="">All Brands</option>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                    @endforeach
                </select>

                <div>
                    <input type="text" wire:model.live.debounce.500ms="search" placeholder="Search product..."
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
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Title</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Slug</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">SKU</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Category</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Sub Category</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Brand</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Price</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Qty</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Status</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Created Date</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($products->isNotEmpty())
                            @foreach ($products as $product)
                                <tr class=" border-b border-gray-200 hover:bg-gray-50 transition">
                                    <td class="py-4 px-4">
                                        <p class="font-semibold text-gray-900">
                                            {{ ($products->currentPage() - 1) * $products->perPage() + $loop->iteration }}
                                        </p>


                                    </td>

                                    <td class="py-4 px-4">

                                        <div class="flex items-center gap-3">
                                            @if (!empty($product->productImages[0]))
                                                <div
                                                    class="w-20 h-20 bg-indigo-100 rounded-lg flex items-center justify-center">
                                                    <img src="{{ asset('storage/uploads/product/' . $product->productImages[0]['image_name']) }}"
                                                        class="object-cover" alt="">
                                                </div>
                                            @endif
                                            <p class="font-semibold text-gray-900">
                                                {{ $product->title }}</p>

                                        </div>

                                    <td class="py-4 px-4">
                                        <p class="font-semibold text-gray-900">
                                            {{ $product->slug }}</p>


                                    </td>

                                    <td class="py-4 px-4">
                                        <p class="font-semibold text-gray-900">
                                            {{ $product->sku }}</p>


                                    </td>



                                    </td>

                                    <td>
                                        <p class="font-semibold text-gray-900">
                                            {{ $product->category->name }}</p>
                                    </td>

                                    <td class="py-4 px-4">
                                        <p class="font-semibold text-gray-900">
                                            {{ $product->subCategory->name }}</p>


                                    </td>

                                    <td class="py-4 px-4">
                                        <p class="font-semibold text-gray-900">
                                            {{ $product->brand->brand_name }}</p>


                                    </td>

                                    <td class="py-4 px-4">
                                        <p class="font-semibold text-gray-900">
                                            {{ config('app.currency.symbol') . number_format($product->price, 2) }}</p>


                                    </td>

                                    <td class="py-4 px-4">
                                        <p class="font-semibold text-gray-900">
                                            {{ $product->quantity }}</p>


                                    </td>

                                    <td class="py-4 px-4">
                                        @if ($product->status === 'active')
                                            <span
                                                class='px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold'>Active</span>
                                        @else
                                            <span
                                                class='px-3 py-1 bg-rose-100 text-rose-700 rounded-full text-xs font-semibold'>Deactive</span>
                                        @endif


                                    </td>
                                    <td class="py-4 px-4 text-gray-600">
                                        {{ \Carbon\Carbon::parse($product->created_at)->format('d M Y') }}

                                    </td>
                                    <td class="py-4 px-4">
                                        <div class="flex items-center gap-2">
                                            <button wire:click="edit({{ $product->id }})"
                                                class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </button>
                                            @if (!$showTrashed)
                                                <button wire:click="delete({{ $product->id }})"
                                                    class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            @else
                                                <button wire:click="restore({{ $product->id }})"
                                                    class="p-2 text-indigo-600 hover:bg-indigo-50 rounded-lg transition">
                                                    <i class="ri-reset-right-fill text-xl"></i>
                                                </button>

                                                <button wire:click="forceDelete({{ $product->id }})"
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
                                <td colspan="12" class="text-center p-4">No Products Found</td>
                            </tr>
                        @endif


                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="p-4">
                {{ $products->links() }}
            </div>
        </div>



        {{-- open modal --}}
        @if ($isOpen)
            <div class="bg-black/50 flex fixed justify-center inset-0 items-center animate__animated animate__fadeIn">
                <div
                    class="bg-white rounded md:w-6/12 w-full p-4 shadow-md animate__animated animate__zoomIn overflow-y-auto max-h-screen">
                    <div class="flex justify-between items-center">
                        <h1 class="text-2xl font-semibold">{{ $isEdit ? 'Edit Product' : 'Add New Product' }}</h1>
                        <button class="text-xl cursor-pointer" wire:click="closeModal">X</button>

                    </div>
                    <hr class="text-slate-200 my-4">

                    <form wire:submit.prevent="{{ $isEdit ? 'update' : 'save' }}" class="flex flex-col gap-8"
                        enctype="multipart/form-data">
                        <div class="flex gap-1 flex-col">
                            <label class="font-medium text-md text-slate-800">Title<span
                                    class="text-rose-500">*</span></label>
                            <input type="text" wire:model.live.debounce.500ms="title"
                                class="border rounded-md border-slate-200 p-4 focus:outline-none"
                                placeholder="Enter Product Title...">
                            @error('title')
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

                        <div class="md:grid grid-cols-2 gap-4">
                            <div class="flex gap-1 flex-col">
                                <label class="font-medium text-md text-slate-800">SKU<span
                                        class="text-rose-500">*</span></label>
                                <input type="text" wire:model="sku"
                                    class="border rounded-md border-slate-200 p-4 focus:outline-none"
                                    placeholder="SKU...">
                                @error('sku')
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
                        </div>


                        <div class="md:grid grid-cols-2 gap-4">
                            <div class="flex gap-1 flex-col">
                                <label class="font-medium text-md text-slate-800">Sub Category<span
                                        class="text-rose-500">*</span></label>
                                <select wire:model="sub_category_id"
                                    class="border rounded-md border-slate-200 p-4 focus:outline-none"
                                    placeholder="Enter Category Name...">
                                    <option value="">---Select Sub Category---</option>
                                    @foreach ($subCategories as $subCategory)
                                        <option value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                                    @endforeach

                                </select>

                                @error('sub_category_id')
                                    <span class="text-rose-500">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="flex gap-1 flex-col">
                                <label class="font-medium text-md text-slate-800">Brand<span
                                        class="text-rose-500">*</span></label>
                                <select wire:model="brand_id"
                                    class="border rounded-md border-slate-200 p-4 focus:outline-none"
                                    placeholder="Enter Brand Name...">
                                    <option value="">---Select Brand---</option>

                                    @foreach ($brands as $brand)
                                        {{ $brand }}
                                        <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                                    @endforeach

                                </select>

                                @error('brand_id')
                                    <span class="text-rose-500">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="flex gap-1 flex-col mt-4">
                                <label class="font-medium text-md text-slate-800">Old
                                    Price({{ config('app.currency.symbol') }})<span
                                        class="text-rose-500">*</span></label>
                                <input id="oldPrice" type="number" wire:model.live.debounce.500ms="old_price"
                                    class="border rounded-md border-slate-200 p-4 focus:outline-none"
                                    placeholder="0.0.">
                                @error('old_price')
                                    <span class="text-rose-500">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="flex gap-1 flex-col mt-4">
                                <label class="font-medium text-md text-slate-800">Discount(%)
                                    <span class="text-rose-500">*</span></label>
                                <input id="discount" type="number" step=0.01
                                    wire:model.live.debounce.500ms="discount"
                                    class="border rounded-md border-slate-200 p-4 focus:outline-none" placeholder="%">
                                @error('discount')
                                    <span class="text-rose-500">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>



                        <div class="flex gap-1 flex-col">
                            <div class="flex gap-1 flex-col">
                                <label
                                    class="font-medium text-md text-slate-800">Price({{ config('app.currency.symbol') }})<span
                                        class="text-rose-500">*</span></label>
                                <input id="price" type="number" step=0.01 wire:model="price"
                                    class="border rounded-md border-slate-200 p-4 focus:outline-none"
                                    placeholder="0.0">
                                @error('price')
                                    <span class="text-rose-500">{{ $message }}</span>
                                @enderror
                            </div>



                        </div>

                        @if (count($getColors))
                            <div class="flex gap-3 flex-col">
                                <label class="font-medium text-md text-slate-800">Product Colors</label>
                                @foreach ($getColors as $color)
                                    <div>
                                        <input type="checkbox" value="{{ $color['id'] }}" wire:model="color_id">
                                        <span class="text-md text-slate-800">{{ $color['name'] }}</span>
                                    </div>
                                @endforeach


                            </div>
                        @endif



                        <div class="flex gap-1 flex-col">
                            <label class="font-medium text-md text-slate-800">Product Size</label>
                            <div class="grid grid-cols-5 gap-2 bg-slate-100 p-4">
                                <div class="col-span-2">
                                    <label class="font-medium text-md text-slate-800">Size</label>
                                    <input type="text" wire:model="product_size"
                                        placeholder="Product Size like('Small','Large','5.2')"
                                        class="border rounded-md border-slate-200 p-4 focus:outline-none w-full">
                                    @error('product_size')
                                        <span class="text-rose-500">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-span-2">
                                    <label
                                        class="font-medium text-md text-slate-800">Price({{ config('app.currency.symbol') }})</label>
                                    <input type="number" wire:model="product_price" step="0.01"
                                        placeholder="0.0"
                                        class="border rounded-md border-slate-200 p-4 focus:outline-none w-full">
                                    @error('product_price')
                                        <span class="text-rose-500">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>

                                    <button type="button" wire:click="addProductSize"
                                        class="bg-indigo-500 active:scale-95 transition-all duration-300 px-6 py-4  text-white rounded mt-6">+Add</button>
                                </div>
                            </div>


                            @if (count($productSizes))
                                <div class="mt-4">
                                    <table class="w-full border">
                                        <thead class="bg-slate-200">
                                            <tr class="text-left">
                                                <th class="p-2">Size</th>
                                                <th class="p-2">Price({{ config('app.currency.symbol') }})</th>
                                                <th class="p-2">Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($productSizes as $index => $item)
                                                <tr class="border-t" wire:key="size-{{ $item['id'] ?? $index }}">
                                                    <td class="p-2">
                                                        {{ $item['product_size'] }}
                                                    </td>
                                                    <td class="p-2">
                                                        {{ config('app.currency.symbol') }}{{ $item['product_price'] }}
                                                    </td>
                                                    <td class="p-2">
                                                        <button type="button"
                                                            wire:click="removeSize({{ $index }})"
                                                            class="px-4 py-2 bg-rose-500 active:scale-95 duration-300 transition-all text-white rounded">Remove</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif

                        </div>

                        <div class="flex gap-1 flex-col my-8" x-data="{
                            isUploading: false,
                            uploadProgress: 0,
                            previewImages: [],
                            handleFileInput(event) {
                                const files = event.target.files;
                                this.previewImages = [];

                                for (let i = 0; i < files.length; i++) {
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        this.previewImages.push(e.target.result);
                                    };
                                    reader.readAsDataURL(files[i]);
                                }

                                this.isUploading = true;
                                this.uploadProgress = 0;
                                const interval = setInterval(() => {
                                    if (this.uploadProgress >= 100) {
                                        clearInterval(interval);
                                        setTimeout(() => {
                                            this.isUploading = false;
                                        }, 500);
                                    } else {
                                        this.uploadProgress += Math.random() * 40;
                                    }
                                }, 300);
                            },
                            removePreview(index) {
                                this.previewImages.splice(index, 1);
                            }
                        }">
                            <label class="font-medium text-md text-slate-800">Product Image<span
                                    class="text-rose-500">*</span></label>

                            <div class="border-2 border-dashed border-slate-300 hover:border-indigo-500 rounded-lg p-6 transition cursor-pointer bg-slate-50 hover:bg-indigo-50"
                                @dragover.prevent="$el.classList.add('border-indigo-500', 'bg-indigo-50')"
                                @dragleave.prevent="$el.classList.remove('border-indigo-500', 'bg-indigo-50')"
                                @drop.prevent="
                                    $el.classList.remove('border-indigo-500', 'bg-indigo-50');
                                    const files = $event.dataTransfer.files;
                                    if (files.length > 0) {
                                        document.querySelector('input[type=file][accept^=image]').files = files;
                                        handleFileInput({target: {files: files}});
                                    }
                                ">
                                <input type="file" wire:model="images" multiple accept="image/*"
                                    @change="handleFileInput($event)" class="hidden" id="fileInput">
                                <div class="text-center" @click="document.getElementById('fileInput').click()">
                                    <svg class="w-12 h-12 mx-auto text-slate-400 mb-2" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4" />
                                    </svg>
                                    <p class="text-slate-600 font-medium">Drag or click to upload images</p>
                                    <p class="text-slate-500 text-sm">PNG, JPG, GIF up to 10MB</p>
                                </div>
                            </div>

                            <div x-show="isUploading && uploadProgress < 100" class="mt-3">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-sm font-medium text-slate-600">Uploading...</span>
                                    <span class="text-sm font-semibold text-indigo-600"
                                        x-text="Math.min(uploadProgress, 100).toFixed(0) + '%'"></span>
                                </div>
                                <div class="w-full bg-slate-200 rounded-full h-2.5">
                                    <div class="bg-indigo-500 h-2.5 rounded-full transition-all duration-300"
                                        :style="`width: ${Math.min(uploadProgress, 100)}%`"></div>
                                </div>
                            </div>

                            <div x-show="previewImages.length > 0" class="mt-4">
                                <div class="flex items-center justify-between mb-3">
                                    <h3 class="text-sm font-semibold text-slate-800">Preview Images</h3>
                                    <span class="text-xs bg-indigo-100 text-indigo-700 px-2 py-1 rounded"
                                        x-text="previewImages.length + ' selected'"></span>
                                </div>
                                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                                    <template x-for="(image, index) in previewImages" :key="index">
                                        <div class="relative group">
                                            <img :src="image" :alt="'Preview ' + (index + 1)"
                                                class="w-full h-24 object-cover rounded-lg border border-slate-200 shadow-sm">
                                            <button type="button" @click="removePreview(index)"
                                                class="absolute top-1 right-1 bg-red-500 hover:bg-red-600 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </div>
                                    </template>
                                </div>
                            </div>

                            @if (!empty($oldImage))
                                <div class="flex gap-6 mt-6">
                                    @foreach ($oldImage as $index => $image)
                                        <div>
                                            <img src="{{ asset('storage/uploads/product/' . $image) }}"
                                                alt="" class="h-[100px]">
                                            <div class="mt-2">

                                                <button type="button"
                                                    wire:click="productImageDelete({{ $index }})"
                                                    class="px-4 py-2 rounded bg-rose-500 active:scale-90 transition-all duration-200 text-white">
                                                    <i class="ri-delete-bin-line"></i> Delete</button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                            @endif
                            @error('images')
                                <span class="text-rose-500 text-sm mt-2">{{ $message }}</span>
                            @enderror
                        </div>



                        <div class="flex gap-1 flex-col my-8" x-data x-init="const editor = new FroalaEditor('#short_description', {
                            events: {
                                contentChanged: function() {
                                    @this.set('short_description', this.html.get())
                                }
                            }
                        });
                        setTimeout(() => {
                            editor.html.set(@js($short_description));
                        }, 50);" wire:ignore>
                            <label class="font-medium text-md text-slate-800">Short Description</label>
                            <div id="short_description"></div>

                            @error('short_description')
                                <span class="text-rose-500">{{ $message }}</span>
                            @enderror
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

                        <div class="flex gap-1 flex-col" x-data x-init="const editor2 = new FroalaEditor('#specifications', {
                            events: {
                                contentChanged: function() {
                                    @this.set('specifications', this.html.get())
                                }
                            }
                        });
                        setTimeout(() => {
                            editor2.html.set(@js($specifications));
                        }, 50);" wire:ignore>
                            <label class="font-medium text-md text-slate-800">Specifications</label>
                            <div id="specifications"></div>

                            @error('specifications')
                                <span class="text-rose-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex gap-1 flex-col my-8">
                            <label class="font-medium text-md text-slate-800">Qty</label>
                            <input type="number" wire:model="quantity"
                                class="border rounded-md border-slate-200 p-4 focus:outline-none"
                                placeholder="Enter Qty...">
                            @error('quantity')
                                <span class="text-rose-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="md:grid grid-cols-3 gap-4">
                            <div class="flex gap-1 flex-col">
                                <label class="font-medium text-md text-slate-800">Hot Product</label>
                                <input type="checkbox" wire:model="is_hot"
                                    class="border border-slate-200  focus:outline-none">

                            </div>

                            <div class="flex gap-1 flex-col">
                                <label class="font-medium text-md text-slate-800">Featured Product</label>
                                <input type="checkbox" wire:model="is_featured"
                                    class=" border-slate-200 focus:outline-none">

                            </div>



                        </div>

                        <div class="flex gap-1 flex-col w-fit">
                            <label class="font-medium text-md text-slate-800">Status<span
                                    class="text-rose-500">*</span></label>
                            <select wire:model="status"
                                class="border  border-slate-200 p-3 focus:outline-none cursor-pointer">
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
                                cols="2" rows="2" placeholder="Enter Meta Description..."></textarea>

                        </div>


                        <div class="flex gap-1 flex-col">

                            <button wire:loading.attr="disabled" wire:loading.class="opacity-50 cursor-not-allowed"
                                wire:target={{ $isEdit ? 'update' : 'save' }}
                                class="bg-indigo-500 px-4 py-2 active:scale-90 duration-300 transition-all text-white rounded w-fit flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                {{ $isEdit ? 'Update Product' : 'Add Product' }}</button>


                        </div>
                    </form>

                </div>
            </div>
        @endif

    </main>
</div>
