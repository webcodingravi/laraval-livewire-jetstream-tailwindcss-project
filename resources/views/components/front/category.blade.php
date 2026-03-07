<div>

    @if (count($categories) > 0)

        <div class="bg-slate-50">
            <div class="w-11/12 mx-auto py-10">

                <h2 class="text-2xl font-bold mb-6 text-center py-8">Shop By Category</h2>

                <div wire:ignore>
                    <div class="owl-carousel category-slider">

                        @foreach ($categories as $category)
                            <a href="" class="text-center group">

                                <div
                                    class="w-24 h-24 mx-auto rounded-full bg-gray-100
                        flex items-center justify-center overflow-hidden
                        group-hover:scale-110 transition duration-300 shadow">

                                    <img src="{{ asset('storage/uploads/category/' . $category->image) }}"
                                        class="w-24 h-24 object-contain rounded-full">

                                </div>

                                <p class="mt-3 text-sm font-medium group-hover:text-indigo-600">
                                    {{ $category->name }}
                                </p>

                            </a>
                        @endforeach

                    </div>

                </div>

            </div>
        </div>
    @endif
</div>

@push('script')
    <script>
        document.addEventListener("livewire:navigated", function() {

            $('.category-slider').owlCarousel({

                loop: false,
                margin: 20,
                nav: true,
                dots: false,
                autoplay: true,
                autoplayTimeout: 2500,
                autoplayHoverPause: true,


                navText: [
                    '<span class="text-xl">‹</span>',
                    '<span class="text-xl">›</span>'
                ],

                responsive: {
                    0: {
                        items: 3
                    },
                    600: {
                        items: 4
                    },
                    900: {
                        items: 6
                    },
                    1200: {
                        items: 8
                    }
                }

            });

        });
    </script>
@endpush
