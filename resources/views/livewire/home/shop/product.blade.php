<div class="shop-category" >
    @if($category)
        <div class="text-center">
            <span class="category-product card-product-title">{{$category->title}}</span>
        </div>
        <div class="row mt-3 products-wrapper">
                @foreach($category->products->where('stock','>',0) as $product)
                    <div class="col-lg-4 col-sm-12 ">
                        <div class="card-category mb-2 ">
                            <img class="w-100 category-image" src="{{asset($product->image ?? '/home/images/category.jpg')}}" title="{{$product->title}}" alt="{{$product->title}}">
                            <div class="card-category-content">
                                <div class="d-flex mb-2">
                                    <p class="category-product card-category-title mb-0">{{$product->name}}</p>
                                    <span wire:loading.class.add="d-none" wire:click="add_to_basket({{$product->id}})" class="category-product checkout-button">سفارش <i class="fa fa-arrow-left"></i></span>
                                    <div wire:loading style="margin-right: auto;color: #72baf6" class="spinner-grow" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </div>
                                <div class="details-product d-flex">
                                    <div class="text-center">
                                        <p class="category-product card-product-details w-80 mb-0"> قیمت : {{number_format($product->price)}} (تومان)</p>
                                        <p class="category-product card-product-details mb-0 w-80"> موجودی : {{number_format($product->stock)}} ({{$type[$product->type] ?? 'None'}})</p>
                                        <p class="category-product card-product-details mb-0 w-80"> حداقل سفارش : {{number_format($product->min)}} ({{$type[$product->type] ?? 'None'}})</p>
                                        <p class="category-product card-product-details mb-0 w-80"> حداکثر سفارش : {{number_format($product->max)}} ({{$type[$product->type] ?? 'None'}})</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
        </div>
    @endif
</div>
