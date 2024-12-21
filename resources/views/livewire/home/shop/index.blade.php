<div>
    @push('styles-end')
        <link rel="stylesheet" href="{{asset('home/login/clock/clock.css')}}"/>
    @endpush
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
                    <div class="sidebar-profile main-card p-3">
                        <button style="border-radius: 8px;background-color: #93ba59;color: #FFFFFF"
                                class="mb-3 w-100 c-shadow btn btn-light-primary" id="countdown2"> زمانی باقی مانده تا شروع سفارش گیری</button>

                        <div style="direction: ltr" class="countdown">
                            <div style="color: #FFFFFF"  class="time clock-time-card" id="countdown">

                                <div class="d-none">
                                    <span style="color: #FFFFFF" id="days">00</span>
                                    <span  style="color: #FFFFFF" >روز</span>
                                </div>
                                <div class="">
                                    <span style="color: #FFFFFF" id="hours">00</span>
                                    <span  style="color: #FFFFFF" >ساعت</span>
                                </div>
                                <div class="">
                                    <span style="color: #FFFFFF" id="minutes">00</span>
                                    <span  style="color: #FFFFFF" >دقیقه</span>
                                </div>
                                <div class="">
                                    <span style="color: #FFFFFF" id="seconds">00</span>
                                    <span  style="color: #FFFFFF" >ثانیه</span>
                                </div>
                                <div class="">
                                    <img width="80" height="80" src="{{asset('home/images/alarm-clock.png')}}">

                                </div>
                            </div>
                        </div>
                    </div>

{{--                    <div class="sidebar-profile d-flex" >--}}

{{--                        <img class="avatar" width="80px" height="80px" src="{{asset('/home/images/user.png')}}">--}}
{{--                        <div class="mx-2 w-100">--}}
{{--                            <p class="mb-1 text-muted btn-shadow mb-1 p-1" style="font-size: 13px">{{auth()->user()->name}}</p>--}}
{{--                            <p class="mb-1 text-muted btn-shadow mb-1 p-1" style="font-size: 13px">{{auth()->user()->phone}}</p>--}}
{{--                            <p class="mb-1 text-muted btn-shadow mb-1 p-1" style="font-size: 13px">{{auth()->user()->code_meli}}</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}

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
        @push('scripts-end')
            <script>
                const openingTime = new Date(@json($openingTime)).getTime();
                const closingTime = new Date(@json($closingTime)).getTime();
                function updateTimer() {
                    const now = new Date().getTime(); // زمان فعلی از مرورگر                    let targetTime, status;

                    if (now < openingTime) {
                        targetTime = openingTime;
                        status = "زمان باقی مانده تا شروع سفارش گیری";
                    } else if (now >= openingTime && now < closingTime) {
                        targetTime = closingTime;
                        status = "زمان باقی مانده تا پایان سفارش گیری";
                    } else {
                        targetTime = null;
                        status = "زمان سفارش گیری به پایان رسیده است";
                        window.location.href = '/home/shop';

                    }

                    if (targetTime) {
                        const timeLeft = targetTime - now;
                        const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
                        const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
                        const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

                        document.getElementById("days").innerHTML = String(days).padStart(2, '0');
                        document.getElementById("hours").innerHTML = String(hours).padStart(2, '0');
                        document.getElementById("minutes").innerHTML = String(minutes).padStart(2, '0');
                        document.getElementById("seconds").innerHTML = String(seconds).padStart(2, '0');
                    } else {
                        document.getElementById("days").innerHTML = "00";
                        document.getElementById("hours").innerHTML = "00";
                        document.getElementById("minutes").innerHTML = "00";
                        document.getElementById("seconds").innerHTML = "00";
                    }

                    document.getElementById("countdown2").textContent = status;
                }

                setInterval(updateTimer, 1000);
                updateTimer();
            </script>

        @endpush
</div>
