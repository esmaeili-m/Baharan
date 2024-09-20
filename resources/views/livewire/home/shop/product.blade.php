<div class="shop-category" >
    @if($category)
        <div class="text-center">
            <span class="category-product card-product-title">{{$category->title}}</span>
        </div>
        <div class="row mt-3">
            @foreach($category->products as $product)
                <div  class="col-lg-6 col-sm-12">
                    <div class="card-category mb-2">
                        <img class="w-100 category-image" src="{{asset($product->image ?? '/home/images/category.jpg')}}" title="{{$product->title}}" alt="{{$product->title}}">
                        <div class="card-category-content">
                            <div class="d-flex mb-2">
                                <p class="category-product card-category-title mb-0 ">{{$product->name}}</p>
                                <span wire:loading.class.add="d-none" wire:click="add_to_basket({{$product->id}})" class="category-product checkout-button" style="">سفارش <i class="fa fa-arrow-left"></i></span>
                                <div wire:loading style="margin-right: auto;color: #72baf6" class="spinner-grow " role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                            <div class="details-product d-flex">
                                <div class="text-center">
                                    <p class="category-product card-product-details w-80 mb-0 "> قیمت محصول: {{number_format($product->price)}} </p>
                                    <p class="category-product card-product-details mb-0 w-80 "> موجودی انبار: {{number_format($product->stock)}} </p>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
