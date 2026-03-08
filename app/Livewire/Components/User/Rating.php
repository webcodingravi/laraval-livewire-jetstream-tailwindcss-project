<?php

namespace App\Livewire\Components\User;

use App\Models\Product;
use App\Models\ProductRating as ModelsProductRating;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class Rating extends Component
{
    public $product;

    public $rating = 0;

    public $hoverRating = 0;

    public $review = '';

    public $average = 0;

    public $isOpen = false;

    public $reviewSubmitted = false;

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;

    }

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->average = $product->averageRating();

        if (Auth::check()) {
            $existing = ModelsProductRating::where('user_id', Auth::id())->where('product_id', $product->id)->first();

            if ($existing) {
                $this->rating = $existing->rating;
                $this->review = $existing->review;
            }
        }
    }

    public function hover($value)
    {
        $this->hoverRating = $value;
    }

    public function resetHover()
    {
        $this->hoverRating = 0;
    }

    public function submitReview()
    {

        $hasPurchased = $this->product->orderItems()
            ->whereHas('Orders', function ($query) {
                $query->where('user_id', Auth::id())
                    ->where('status', 'delivered');
            })
            ->exists();

        if (! Auth::check() || ! $hasPurchased) {
            abort(403, 'You cannot rate this product yet.');
        }

        Validator::make(
            [
                'rating' => $this->rating,
                'review' => $this->review,
            ],
            [
                'rating' => 'required|numeric|min:1|max:5',
                'review' => 'required|string|max:1000',
            ]
        )->validate();

        ModelsProductRating::updateOrCreate(
            ['user_id' => Auth::id(), 'product_id' => $this->product->id],
            ['rating' => $this->rating, 'review' => $this->review]
        );

        cache()->forget("product_{$this->product->id}_avg_rating");

        $this->product->refresh();
        $this->average = $this->product->averageRating();

        $this->reviewSubmitted = true;

    }

    public function render()
    {
        return view('components.user.rating', ['reviews' => $this->product->ratings]);
    }
}
