<div>
    <!-- Hero Section - Premium Banner -->

    <x-front.hero-section />

    <!-- Category Section -->
    <x-front.category :categories="$categories" />

    <!-- Featured Products Section -->

    <x-front.featured-products :featuredProducts="$featuredProducts" :isWishlisted="$isWishlisted" />

    <!-- Flash Sale Section -->
    {{-- <livewire:components.front.flash-sale-banner /> --}}

    <!-- Benefits Section -->

    <x-front.benefits-section />

    <!-- Testimonials Section -->
    <x-front.testimonials />

    <!-- CTA Section - Newsletter -->
    <x-front.newsletter />
</div>
