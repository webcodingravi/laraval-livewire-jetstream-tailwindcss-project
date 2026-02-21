<?php

namespace App\Livewire\Front;

use App\Models\Brand;
use App\Models\Color;
use App\Models\SubCategory;
use App\Models\Product;
use App\Models\ProductWishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Products extends Component
{
    use WithPagination;


    public $category;
    public $subCategory;
    public $selectedCategories = [];
    public $selectedBrands = [];
    public $selectedColors = [];
    public $minPrice = null;
    public $maxPrice = null;
    public $isWishlisted = false;
    public $meta_title;
    public $meta_description;




    public function add_wishlists($productId) {

  try{

    if (!Auth::check()) return;

      $user_id = Auth::user()->id;
     $wishlist = ProductWishlist::where('user_id',$user_id)->where('product_id',$productId)->first();
     if($wishlist) {
        $wishlist->delete();
        $this->isWishlisted = false;
     }else{
        ProductWishlist::create([
            'user_id' => $user_id,
            'product_id' => $productId
        ]);

         $this->isWishlisted = true;
     }

     $this->dispatch('wishlistUpdated');

  }
  catch(\Exception $e) {
    $this->dispatch('alert',type:'error',title:'Error!',text:$e->getMessage());
  }
}



    public function mount($category = null,$subCategory = null) {
     $this->category = $category;
     $this->subCategory = $subCategory;

     $product = Product::first();
     if(Auth::check()) {
        $this->isWishlisted = ProductWishlist::where('user_id',Auth::id())->where('product_id',$product->id)->exists();
    }

    }




    public function updatedSelectedCategories() {
        $this->resetPage();
    }

    public function updatedMinPrice() {
        $this->resetPage();
    }

    public function updatedMaxPrice() {
        $this->resetPage();
    }

    public function clearAllFilters() {
        $this->reset(['selectedCategories','selectedBrands','selectedColors','minPrice','maxPrice']);
        $this->resetPage();
    }

    public function toggleColor($colorId)
{
    if (in_array($colorId, $this->selectedColors)) {

        $this->selectedColors = array_diff($this->selectedColors, [$colorId]);

    } else {

        $this->selectedColors[] = $colorId;

    }

    $this->resetPage();
}


    public function render()
    {
        $products = Product::with(['category:id,name,slug','subCategory:id,name,slug','productImages:id,product_id,image_name','colors:id,name'])

        ->when(!empty($this->category),function($query) {
            $query->whereHas('category',function($q) {
               $q->where('slug',$this->category);
            });

        })
        ->when(!empty($this->subCategory),function ($query) {
            $query->whereHas('subCategory',function($q) {
              $q->where('slug',$this->subCategory);
            });
 })
        ->when(!empty($this->selectedCategories),function($query) {
           $query->whereHas('category',function($q){
            $q->where('id',$this->selectedCategories);
           });
        })

          ->when(!empty($this->selectedBrands),function($query) {
           $query->whereHas('brand',function($q){
            $q->where('id',$this->selectedBrands);
           });
        })
        ->when(!empty($this->selectedColors), function ($query) {
            $query->whereHas('colors', function ($q) {
                $q->whereIn('colors.id', $this->selectedColors);
            });

})
        ->when(!empty($this->minPrice),function($query) {
            $query->where('price','>=',$this->minPrice);
        })

        ->when(!empty($this->maxPrice),function($query) {
            $query->where('price','<=',$this->maxPrice);
        })

        ->orderBy('id','desc')
        ->paginate(10);


        $subCategories = SubCategory::withCount('product')->with('category:id,name,slug')
        ->when(!empty($this->category),function($query) {
            $query->whereHas('category',function($q) {
                $q->where('slug',$this->category);
            });
        })
      ->orderBy('name','asc')->get();

      $brands = Brand::with(['category:id,name,slug','SubCategory:id,name,slug'])
          ->when($this->category,function($query) {
            $query->whereHas('category',function ($q) {
                $q->where('slug',$this->category);
            });
          })
       ->when($this->subCategory,function($query) {
            $query->whereHas('SubCategory',function ($q) {
                $q->where('slug',$this->subCategory);
            });
          })

        ->orderBy('brand_name','asc')->get();

      $colors = Color::with(['category:id,name,slug','subCategory:id,name,slug'])
      ->when(!empty($this->category),function($query) {
        $query->whereHas('category',function($q) {
            $q->where('slug',$this->category);
        });
         })
        ->when(!empty($this->subCategory),function($query) {
            $query->whereHas('SubCategory',function($q) {
                $q->where('slug',$this->subCategory);
            });
        })


        ->orderBy('name','asc')->get();




        return view('front.products',compact('products','subCategories','brands','colors'));
    }
}
