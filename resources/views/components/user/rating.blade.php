<div>

    <button class="text-green-100 bg-green-500 active:scale-95 duration-300 transition-all px-4 py-2 rounded mt-4"
        wire:click="openModal">Make
        Review ★</button>


    @if ($isOpen)
        <div
            class="bg-black/50 flex fixed justify-center inset-0 items-center animate__animated animate__fadeIn z-[9999]">


            <div
                class="bg-white fixed  rounded md:w-6/12 w-full p-4 shadow-md animate__animated animate__zoomIn overflow-y-auto max-h-screen">
                <div class="flex justify-between items-center">
                    <h1 class="text-2xl font-semibold">Make Review ☆
                    </h1>
                    <button class="text-xl cursor-pointer" wire:click="closeModal">X</button>

                </div>
                <hr class="text-slate-200 my-4">

                <!-- Main Content -->
                @if (!$reviewSubmitted)
                    <div class="max-w-xl mx-auto p-4 border rounded shadow">
                        <!-- Rating Stars -->
                        <div class="flex items-center gap-1 select-none">

                            <div class="flex text-2xl">
                                @for ($i = 1; $i <= 5; $i++)
                                    <span wire:mouseenter="hover({{ $i }})" wire:mouseleave="resetHover"
                                        wire:click="$set('rating', {{ $i }})"
                                        class="cursor-pointer transition-colors duration-150
                                 {{ $hoverRating >= $i ? 'text-yellow-400' : ($rating >= $i ? 'text-yellow-400' : 'text-gray-300') }}">
                                        ★
                                    </span>
                                @endfor
                            </div>

                            <span class="ml-2 text-sm text-gray-600">
                                {{ number_format($average, 1) }} / 5
                            </span>

                        </div>
                        <!-- Review Textarea -->
                        <textarea wire:model.defer="review" rows="3" class="w-full border rounded p-2 mb-2 border-slate-200 mt-2"
                            placeholder="Write your review..."></textarea>

                        <button wire:click="submitReview"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded ">
                            Submit Review
                        </button>
                    @else
                        <div class="text-center py-6">
                            <h2 class="text-green-600 text-xl font-semibold">
                                ✅ Thank you for your review!
                            </h2>
                        </div>


                    </div>
                @endif
            </div>
        </div>
    @endif
</div>
