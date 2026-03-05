<div>
    {{-- <section class="relative w-full overflow-hidden bg-cover bg-center h-[600px] md:mt-[100px] lg:mt-[100px] mt-[165px]"
        style="background-image: url('{{ asset('assets/img/banner.jpg') }}')">
        <!-- Animated Background Elements -->
        <div class="absolute
        inset-0 opacity-20">
            <div
                class="absolute top-20 left-10 w-72 h-72 bg-white rounded-full mix-blend-multiply filter blur-3xl animate-pulse">
            </div>
            <div
                class="absolute -top-40 right-10 w-72 h-72 bg-white rounded-full mix-blend-multiply filter blur-3xl animate-pulse delay-2000">
            </div>
            <div
                class="absolute -bottom-8 left-20 w-72 h-72 bg-white rounded-full mix-blend-multiply filter blur-3xl animate-pulse delay-4000">
            </div>
        </div>

        <div class="relative z-10 px-4 md:px-8 lg:px-16 xl:px-24 h-full flex items-center">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 w-full">
                <!-- Left Content -->
                <div class="flex flex-col justify-center">
                    <div class="space-y-6">
                        <div
                            class="inline-flex items-center gap-2 bg-white bg-opacity-20 backdrop-blur-lg px-4 py-2 rounded-full text-white w-fit">
                            <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                            <span class="text-sm font-semibold">🎉 Limited Time Offer</span>
                        </div>
                        <h1 class="text-5xl md:text-6xl lg:text-7xl font-black text-white leading-tight">
                            Discover Your
                            <span
                                class="block bg-gradient-to-r from-yellow-200 to-pink-200 bg-clip-text text-transparent">
                                Perfect Style
                            </span>
                        </h1>
                        <p class="text-lg md:text-xl text-white text-opacity-90 max-w-lg">
                            Shop exclusive collections with up to 60% off. Premium products, exceptional service, and
                            guaranteed satisfaction.
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4 pt-4">
                            <a href="{{ route('products') }}"
                                class="px-8 py-4 bg-white text-[#24bad8] font-bold rounded-lg hover:shadow-2xl transition-all duration-300 transform hover:scale-105 text-center">
                                Shop Now
                            </a>
                            <a href="#"
                                class="px-8 py-4 bg-white bg-opacity-20 backdrop-blur text-white font-bold rounded-lg border-2 border-white hover:bg-opacity-30 transition-all duration-300 text-center">
                                Learn More
                            </a>
                        </div>
                        <!-- Stats -->

                    </div>
                </div>

            </div>
        </div>
    </section> --}}


    <div x-data="{
        active: 0,
        slides: [{
                image: 'https://plus.unsplash.com/premium_photo-1672883551961-dd625e47990a?q=80&w=1074&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                title: 'Big Fashion Sale',
                desc: 'Up to 50% off on new arrivals'
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
    }" class="relative w-full h-[420px] md:h-[500px] overflow-hidden mt-[100px]">

        <!-- SLIDES -->
        <template x-for="(slide,index) in slides" :key="index">

            <div x-show="active === index" x-transition:enter="transition duration-700"
                x-transition:enter-start="opacity-0 scale-105" x-transition:enter-end="opacity-100 scale-100"
                class="absolute inset-0">

                <img :src="slide.image" class="w-full h-full object-cover">

                <div class="absolute inset-0 bg-black/40 flex items-center">
                    <div class="max-w-7xl mx-auto px-6 text-white">

                        <h1 class="text-3xl md:text-5xl font-bold" x-text="slide.title"></h1>

                        <p class="mt-4 text-lg max-w-xl" x-text="slide.desc"></p>

                        <a href="#"
                            class="inline-block mt-6 px-6 py-3 bg-indigo-600 hover:bg-indigo-700 rounded-lg">
                            Shop Now
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
