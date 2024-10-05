<div>
    <div class="sidebar-category " >
        @foreach($categories ?? [] as $category)
            <div class="card-category mb-2 me-2">
                <img class="w-100 category-image" src="{{asset($category->image ?? '/home/images/category.jpg')}}" title="{{$category->title}}" alt="{{$category->title}}">
                <div class="card-category-content">
                    <div class="d-md-flex mb-2">
                        <p class="category-product card-category-title w-sm-100  mb-sm-10  ">{{$category->title}}</p>
                        <span wire:loading.remove wire:click="set_category({{$category->id}})" class=" w-sm-100 category-product checkout-button" style="">محصولات <i class="fa fa-arrow-left"></i></span>
                        <div wire:loading style="margin-right: auto;color: #72baf6" class="spinner-grow " role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                    @foreach($category->products as $product)
                        <span class="category-product  w-sm-100">{{$product->name}}</span>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>

</div>
