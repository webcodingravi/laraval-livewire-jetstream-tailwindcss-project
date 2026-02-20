<?php

namespace App\Livewire\Admin;

use App\Exports\ProductsExport;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\ImageProduct;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\SubCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class ProductCreateOrUpdate extends Component
{
    use WithFileUploads,WithPagination;

    public $title;
    public $slug;
    public $sku;
    public $category_id;
    public $sub_category_id;
    public $old_price;
     public $discount;
     public $price;
    public $brand_id;
    public $short_description;
    public $description;
    public $specifications;
    public $quantity;
    public $is_hot = false;
    public $is_featured = false;
    public $status = 'active';
    public $meta_title;
    public $meta_description;
    public $categories;
    public $subCategories;
    public $brands;
    public $productId;
    public $isOpen = false;
    public $isEdit = false;
    public $search = '';
    public $filtterStatus = '';
    public $filterCategory = '';
    public $filterBrand = '';
    public $showTrashed = false;
    public $oldImage = [];
     // product sizes table price
    public $productSizes = [];
    public $product_price ='';
    public $product_size = '';

    public $getColors;
    public $color_id= [];

    //product Images
    public $images = [];



    public function openModal() {
        $this->isOpen = true;
    }

    public function closeModal() {
         $this->isOpen= false;
           $this->resetForm();
         $this->resetValidation();


    }


 protected function rules() {
    return [
        'title' => 'required|string',
        'slug' => 'required|string|unique:products,slug,' . $this->productId,
        'sku' => 'required|string|unique:products,sku,' . $this->productId,
        'category_id' => 'required',
        'sub_category_id' => 'required',
        'brand_id' => 'required',
        'price' => 'required|numeric',
        'old_price' => 'required|numeric',
        'discount' => 'nullable|numeric',
        'short_description' => 'required|string',
        'description' => 'required|string',
        'quantity' => 'required|integer',
        'images'   => 'nullable|array',
       'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',

    ];
 }

 public function updatedSearch() {
    $this->resetPage();
 }

 public function updatedCategoryId() {
    $this->resetPage();
 }

 public function updatedStatus() {
    $this->resetPage();
 }

  public function updatedBrandId() {
    $this->resetPage();
 }

 public function updatedTitle($value) {
    $this->slug = Str::slug($value);
 }


     public function updated() {
        $this->calculatePrice();
    }


    // get discount price
    public function calculatePrice() {
        $discountAmount = ((float)$this->old_price * (float)$this->discount) / 100;
        $this->price = (float)$this->old_price - $discountAmount;
    }


 public function mount() {
try{
    // get category
    $categories = Category::orderBy('name','asc')->get();
    $this->categories = $categories;

    // get sub category
     $subCategories = SubCategory::orderBy('name','asc')->get();
    $this->subCategories= $subCategories;

    // get brand
     $brands = Brand::orderBy('brand_name','asc')->get();
    $this->brands = $brands;


    // get colors

     $colors = Color::orderBy('name','asc')->get();
     $this->getColors = $colors;
        }

catch(\Exception $e) {
 $this->dispatch('alert',type:'error',title:'Error!',text:$e->getMessage());
        }
}

// product size
  public function addProductSize() {
    $this->validate([
        'product_size' => 'required',
        'product_price' => 'required|numeric'
    ]);


    $this->productSizes[] = [
        'id' => null,
        'product_size' => $this->product_size,
        'product_price' => $this->product_price,
    ];

    $this->reset(['product_size','product_price']);
  }


  //remove product size
  public function removeSize($index) {
    if(isset($this->productSizes[$index]['id'])){
        ProductSize::find($this->productSizes[$index]['id'])?->delete();
    }
   unset($this->productSizes[$index]);
   $this->productSizes = array_values($this->productSizes);
  }

    public function save() {
            $this->validate();
            DB::beginTransaction();
        try{

            $data = $this->only(['title','slug','sku','category_id','sub_category_id','brand_id','price','old_price','discount',
            'short_description','description','specifications','quantity','status','meta_title','meta_description']);

              $data['is_hot'] = $this->is_hot ? 1 : 0;
            $data['is_featured'] = $this->is_featured ? 1 : 0;

           $product =  Product::create($data);


           // Attach colors (belongsToMany)
            if(!empty($this->color_id)) {
                $product->colors()->sync($this->color_id);
            }

            foreach($this->productSizes as $size) {
               $product->sizes()->create([
                    'product_id' => $product->id,
                    'product_size' => $size['product_size'],
                    'product_price' => $size['product_price'],
                ]);
            }

            if(!empty($this->images)) {
                foreach($this->images as $img) {
                $ext = $img->getClientOriginalExtension();
                $imageName = time().'_'.$this->slug.'_'.uniqid() .'.'.$ext;
                $img->storeAs('uploads/product',$imageName ,'public');
                  $product->productImages()->create([
                     'product_id' => $product->id,
                     'image_name' => $imageName
                  ]);
                }
            }
           DB::commit();
            $this->dispatch('alert',type:'success',title:'Success!',text:'Product Successfully Created');
            $this->resetForm();

        }
        catch(\Exception $e) {
             DB::rollBack();
            $this->dispatch('alert',type:'error',title:'Error!',text:$e->getMessage());
        }

        }

        public function edit($id) {

            try{
                $product = Product::findOrFail($id);
                $this->productId = $product->id;
                $this->title = $product->title;
                $this->slug = $product->slug;
                $this->sku = $product->sku;
                $this->category_id = $product->category_id;
                $this->sub_category_id = $product->sub_category_id;
                $this->brand_id = $product->brand_id;
                $this->old_price = $product->old_price;
                $this->discount = $product->discount;
                $this->price = $product->price;
                $this->color_id = $product->colors->pluck('id')->toArray();
                $this->productSizes = $product->sizes->map(function($size){
                    return [
                        'id' => $size->id,
                        'product_size' => $size->product_size,
                        'product_price' => $size->product_price
                    ];
                })->toArray();
                $this->oldImage = $product->productImages->pluck('image_name','id')->toArray();
                $this->short_description = $product->short_description ?? '';
                $this->description = $product->description ?? '';
                $this->specifications = $product->specifications ?? '';
                $this->quantity = $product->quantity;
                $this->is_hot = (bool) $product->is_hot;
                $this->is_featured = (bool) $product->is_featured;
                $this->status = $product->status;
                $this->meta_title = $product->meta_title;
                $this->meta_description = $product->meta_description;
                $this->isOpen = true;
                $this->isEdit = true;


            }
            catch(\Exception $e) {
                $this->dispatch('alert',type:'error',title:'Error!',text:$e->getMessage());
            }
        }

        // product image Delete
        public function productImageDelete($id) {
          try{
          $image = ImageProduct::findOrFail($id);
                if(!empty($image->image_name)) {
                //   old image delete
                  Storage::disk('public')->delete('uploads/product/'.$image->image_name);


                }
                $image->delete();

                  $product = Product::with('productImages')->find($this->productId);

                $this->oldImage = $product->productImages
                 ->pluck('image_name', 'id')
                   ->toArray();

                $this->dispatch('alert',type:'success',title:'Success!',text:'Image Deleted Successfully');

          }catch(\Exception $e){
            $this->dispatch('alert',type:'error',title:'Error!',text:$e->getMessage());
          }
        }

        public function update() {
            $this->validate();
              DB::beginTransaction();
            try{
                $product = Product::findOrFail($this->productId);
                 $data = $this->only(['title','slug','sku','category_id','sub_category_id','brand_id','price','old_price','discount',
                'short_description','description','specifications','quantity','is_hot','status','meta_title','meta_description']);

                  $data['is_hot'] = $this->is_hot ? 1 : 0;
                $data['is_featured'] = $this->is_featured ? 1 : 0;

                  $product->update($data);

                //   exising colors

                // colors update via pivot
             $product->colors()->sync($this->color_id ?? []);



        // new sizes add
            foreach($this->productSizes as $size) {
                if(isset($size['id']) && $size['id']) {
                    $product->sizes()->where('id',$size['id'])->update([
                        'product_size' => $size['product_size'],
                        'product_price' => $size['product_price']
                    ]);
                }else{
                     $product->sizes()->create([
                    'product_size' => $size['product_size'],
                    'product_price' => $size['product_price'],
                ]);
                }

            }


       if(!empty($this->images)) {
                foreach($this->images as $img) {
                $ext = $img->getClientOriginalExtension();
                $imageName = time().'_'.$this->slug.'_'.uniqid() .'.'.$ext;
                $img->storeAs('uploads/product',$imageName ,'public');
                  $product->productImages()->create([
                     'product_id' => $product->id,
                     'image_name' => $imageName
                  ]);
                }
            }

                DB::commit();

                $this->dispatch('alert',type:'success',title:'Success!',text:'Product Successfully Updated');
                $this->resetForm();

            }
            catch(\Exception $e) {
                DB::rollBack();
                $this->dispatch('alert',type:'error',title:'Error!',text:$e->getMessage());
            }

        }

        public function delete($id) {
            try{
                $product = Product::findOrFail($id);
                $product->delete();
                $this->dispatch('alert',type:'success',title:'Success!',text:'Product Successfully Deleted');
            }
            catch(\Exception $e) {
                $this->dispatch('alert',type:'error',title:'Error!',text:$e->getMessage());
            }
        }

        public function restore($id) {
            try{
               Product::onlyTrashed()->findOrFail($id)->restore();

                $this->dispatch('alert',type:'success',title:'Success!',text:'Product Successfully Restored');
            }
            catch(\Exception $e) {
                $this->dispatch('alert',type:'error',title:'Error!',text:$e->getMessage());
            }
        }

        public function forceDelete($id) {
            try{
               $product = Product::onlyTrashed()->findOrFail($id);

               foreach($product->productImages as $img) {
                Storage::disk('public')->delete('uploads/product/'.$img->image_name);
               }
                $product->productImages()->forceDelete();
                  $product->sizes()->forceDelete();

                  $product->colors()->detach();

                $product->forceDelete();
                $this->dispatch('alert',type:'success',title:'Success!',text:'Product Permanently Deleted');
            }
            catch(\Exception $e) {
                $this->dispatch('alert',type:'error',title:'Error!',text:$e->getMessage());
            }
        }


        public function resetForm() {
            $this->reset(['title','slug','sku','category_id','sub_category_id','brand_id','price','old_price','discount','productSizes','product_price','product_size','color_id','short_description','description','specifications','images','oldImage',
             'quantity','is_hot','is_featured','status','meta_title','meta_description','productId','isEdit','isOpen','productId']);


        }

        public function export() {

            return Excel::download(new ProductsExport,'Products.xlsx');
        }


    public function render()
    {
        $products = Product::with(['category:id,name','subCategory:id,name','brand:id,brand_name','productImages:id,product_id,image_name','colors','sizes'])
        ->when($this->showTrashed,function($query) {
            $query->onlyTrashed();
        })
         ->when(!$this->showTrashed,function($query) {
            $query->withoutTrashed();
        })
        ->when(!empty($this->search),function($query) {
            $query->where('title','like','%'.$this->search.'%');

        })
        ->when(!empty($this->filtterStatus),function($query) {
            $query->where('status',$this->filtterStatus);
        })

        ->when(!empty($this->filterCategory),function($query) {
             $query->where('category_id',$this->filterCategory);
        })

        ->when(!empty($this->filterBrand),function($query) {
        $query->where('brand_id',$this->filterBrand);
        })

        ->orderBy('id','desc')
        ->paginate(10);

        return view('admin.product-create-or-update',compact('products'))->layout('layouts.admin')->layoutData(['metaTitle'=>'Products - Admin','metaDescription'=>'Manage Products']);;
    }
}