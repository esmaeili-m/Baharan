<div>
    @if(($has_invoice ?? 0 ) && $edit == 0)
            <div class="" style="direction: rtl" >
                <div class="row w-100 text-center d-flex justify-content-center align-content-center">
                    <div  class="error-invoice-main  justify-content-center align-content-center">
                        <p class="category-product card-category-title mb-0 p-5">شما در درحال حاظر سفارش فعال دارید امکان ثبت فاکتور جدید نمی باشد</p><br>
                       <div >
                           @if($has_invoice->status == 1)
                             <a wire:click="edit_invoice()" style="text-decoration: none;cursor: pointer" class="mt-3 category-product card-category-title mb-0 p-2">درخواست ویرایش فاکتور</a>
                           @endif
                           <a href="{{route('profile.index',['status'=>3,'code'=>$has_invoice->barcode])}}" style="text-decoration: none" class="mt-3 category-product card-category-title mb-0 p-2">نمایش فاکتور فعلی</a>
                       </div>

                    </div>
                </div>
            </div>

    @else
        <livewire:home.profile.header />

        <div class="shop-container" style="direction: rtl" >

            <div class="row w-100 mobile-margin">
                <div class="col-lg-3  col-sm-12">
                    <div class="sidebar-profile d-flex" >
                        <img class="avatar" width="80px" height="80px" src="{{asset('/home/images/user.png')}}">
                        <div class="mx-2 w-100">
                            <p class="mb-1 text-muted btn-shadow mb-1 p-1" style="font-size: 13px">{{auth()->user()->name}}</p>
                            <p class="mb-1 text-muted btn-shadow mb-1 p-1" style="font-size: 13px">{{auth()->user()->phone}}</p>
                            <p class="mb-1 text-muted btn-shadow mb-1 p-1" style="font-size: 13px">{{auth()->user()->code_meli}}</p>
                        </div>
                    </div>

                    <livewire:home.shop.category />


                </div>
                <div class="col-lg-7 col-sm-12">
                    <livewire:home.shop.product />
                </div>
                <div class="col-lg-2">
                    <livewire:home.shop.basket />
                </div>
            </div>
        </div>
    @endif
</div>
