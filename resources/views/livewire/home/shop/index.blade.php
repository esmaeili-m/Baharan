<div>
    <div class="shop-container" style="direction: rtl" >
        <div class="row w-100">
            <div class="col-lg-3 col-sm-12">
                <div class="sidebar-profile d-flex" >
                    <img class="avatar" width="80px" height="80px" src="{{asset('/home/images/user.png')}}">
                    <div class="mx-4">
                        <p class="mb-1 text-muted">مهدی اسماعیلی</p>
                        <p class="mb-1 text-muted">09193544391</p>
                        <p class="mb-1 text-muted">0372009522</p>
                    </div>
                </div>

                    <livewire:home.shop.category />


            </div>
            <div class="col-lg-6 col-sm-12">
                <livewire:home.shop.product />
{{--                <div class="content-Product" >--}}

{{--                </div>--}}
            </div>
            <div class="col-lg-3">
                <livewire:home.shop.basket />
            </div>
        </div>

    </div>
</div>
