<div>

    <div x-data="{
        active: 0,
        slides: [{
                image: 'https://plus.unsplash.com/premium_photo-1672883551961-dd625e47990a?q=80&w=1074&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                title: 'Big Fashion Sale',
                desc: 'Shop exclusive collections with up to 60% off Premium products exceptional service and guaranteed satisfaction'
            },
            {
                image: 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                title: 'New Electronics',
                desc: 'Latest gadgets available now'
            },
            {
                image: 'https://images.unsplash.com/photo-1615397349754-cfa2066a298e?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                title: 'Summer Collection',
                desc: 'Trendy styles for this season'
            }
        ],

        next() {
            this.active = (this.active + 1) % this.slides.length
        },

        prev() {
            this.active = (this.active - 1 + this.slides.length) % this.slides.length
        },

        init() {
            setInterval(() => { this.next() }, 4000)
        }
    }" class="relative w-full h-[420px] md:h-[674px] overflow-hidden mt-[99px]">

        <!-- SLIDES -->
        <template x-for="(slide,index) in slides" :key="index">

            <div x-show="active === index" x-transition:enter="transition duration-700"
                x-transition:enter-start="opacity-0 scale-105" x-transition:enter-end="opacity-100 scale-100"
                class="absolute inset-0">

                <img :src="slide.image" class="w-full h-full object-cover">

                <div class="absolute inset-0 bg-black/40 flex items-center">
                    <div class="max-w-8xl mx-auto px-6 text-white text-center">

                        <h1 class="text-3xl md:text-7xl font-bold" x-text="slide.title"></h1>

                        <p class="mt-4 text-lg max-w-xl mx-auto" x-text="slide.desc"></p>

                        <a href="{{ route('products') }}" wire:navigate
                            class="inline-block mt-6 px-6 py-3 md:px-10 bg-[#47b0c6]  md:py-3 rounded-lg  hover:bg-[#0b869e] transition-all duration-300 text-xl font-medium active:scale-95">
                            <i class="ri-shopping-cart-2-line"></i> Shop Now
                        </a>

                    </div>
                </div>

            </div>

        </template>

        <!-- LEFT ARROW -->
        <button @click="prev()"
            class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/70 hover:bg-white p-2 rounded-full shadow">

            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>

        </button>

        <!-- RIGHT ARROW -->
        <button @click="next()"
            class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/70 hover:bg-white p-2 rounded-full shadow">

            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>

        </button>

        <!-- DOTS -->
        <div class="absolute bottom-5 left-1/2 -translate-x-1/2 flex gap-3">

            <template x-for="(slide,index) in slides">

                <div @click="active = index" :class="active === index ? 'bg-white w-6' : 'bg-white/50 w-3'"
                    class="h-3 rounded-full cursor-pointer transition-all">
                </div>

            </template>

        </div>

    </div>
</div>
