<div class="sidebar-basket" >
    <div class="basket-invoice">
        <button style="border-radius: 8px;background:linear-gradient(to right, #0099cc, #0057b7);color: #FFFFFF" class="mb-3 w-100 c-shadow btn btn-light-primary" > سبد خرید </button>

        <div class="mt-3">
            @foreach($products ?? [] as $product)
                <div  class="col-lg-12 col-sm-12 mb-1">
                    <div class="card-category mb-2">
                        <div class="card-category-content">
                            <div class="d-flex mb-2">
                                <p class="category-product card-category-title mb-0 ">{{$product->name}}</p>
                                <span wire:loading.class.add="d-none" wire:click="remove_from_basket({{$product->id}})" class="category-product checkout-button-remove" style=""><i class="fa fa-times"></i></span>
                                <div wire:loading style="margin-right: auto;color: #72baf6" class="spinner-grow " role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center form-invoice  ">
                                <input wire:key="product-{{$product->id}}" type="number"  wire:model.live.debounce.1000ms="invoice.{{ $product->id }}"  class="mb-1 @if(session()->has('invoice-'.$product->id)) invalid-form @endif" placeholder="برحسب {{$type[$product->type] ?? 'None'}}">
                                @if(session()->has('invoice-'.$product->id))
                                <span style="font-size: 27px;color: red" class="fa fa-times-circle error-message show" aria-hidden="true"></span>
                                @endif
                            </div>
                            <div class="">
                                @if(session()->has('invoice-'.$product->id))
                                    <div class="error-invoice mt-1 mb-1 text-center">
                                        {{session()->get('invoice-'.$product->id)}}
                                    </div>
                                @endif
                                <p style="font-size: 11px !important;" class="category-product card-category-title mb-1 w-100"> قیمت : {{number_format($product->price)}} تومان </p>
                                @if($this->price[$product->id] ?? 0)
                                    <p class="category-product card-product-details w-100 mb-1">قیمت نهایی: {{ number_format($this->price[$product->id] ?? 0) }} تومان</p>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
    <div class="checkout-card ">
        <div class="total-factor p-3">
            <p class="mb-0">جمع کل : {{number_format(array_sum($price ?? []) ?? 0)}} تومان</p>
        </div>
        @if($this->invoice && $this->price)
            @if(count($price) == count($invoice)  && count($price) == count($products ?? []))
                @if($has_invoice)
                    <span wire:click="update()"  class="checkout-button-basket p-3 blink-button">ویرایش</span>

                @else
                    <span wire:click="save()"  class="checkout-button-basket p-3 blink-button">ثبت نهایی</span>

                @endif
            @else
                <span style="background-color: #fae5e5 !important;" class="checkout-button-basket p-3 ">ثبت نهایی</span>
            @endif
        @else
            <span style="background-color: #fae5e5 !important;" class="checkout-button-basket p-3">ثبت نهایی</span>
        @endif
    </div>
</div>
