<div>
    @push('styles-end')
        <link rel="stylesheet" href="{{asset('home/login/clock/clock.css')}}"/>
    @endpush
        <div class="sidebar-profile main-card p-3">

            <div style="direction: ltr" class="countdown clock-time-card">
                <p style="color: #FFFFFF" id="countdown2" > زمانی باقی مانده تا شروع سفارش گیری</p>
                <div style="color: #FFFFFF"  class="time " id="countdown">

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
                    {{--                                <div class="">--}}
                    {{--                                    <img width="80" height="80" src="{{asset('home/images/alarm-clock.png')}}">--}}

                    {{--                                </div>--}}
                </div>
            </div>
        </div>

    <div class="sidebar-profile main-card p-3">
            <button style="border-radius: 8px;background:linear-gradient(to right, #0099cc, #0057b7);color: #FFFFFF"
                    class="mb-3 w-100 c-shadow btn btn-light-primary"> {{auth()->user()->name}}</button>
        <div class="mt-2 ">
            <div class="w-100 p-2 justify-content-center align-content-center" style="border-radius: 8px">
                <button @click="$dispatch('change-content', { status: '1' })"
                        class="align-center-btn mb-3 w-100 c-shadow btn btn-light-primary">
                    <img width="40px" height="40px" src="{{asset('home/images/attach_4774602.png')}}">
                    پروفایل کاربری
                </button>

                @if(auth()->user()->status == 3)
                    <button @click="$dispatch('change-content', { status: '2' })"
                            class="align-center-btn mb-3 w-100 c-shadow btn btn-light-primary">
                        <img width="40px" height="40px" src="{{asset('home/images/delete-cart_5451616.png')}}">
                        فروشگاه
                    </button>
                    <button @click="$dispatch('change-content', { status: '3' })"
                            class="align-center-btn mb-3 w-100 c-shadow btn btn-light-primary">
                        <img width="40px" height="40px" src="{{asset('home/images/bill_5451602.png')}}">
                        سفارشات
                    </button>
                @endif

                <button @click="$dispatch('change-content', { status: '4' })"
                        class="align-center-btn mb-3 w-100 c-shadow btn btn-light-primary">
                    <img width="40px" height="40px" src="{{asset('home/images/customer-support_5340006.png')}}">
                    ارتباط با پشتیبانی
                </button>

                <button wire:click="logout()"
                        class="align-center-btn mb-3 w-100 c-shadow btn btn-light-primary"
                        style="background-color: #f68b8b; color: #FFFFFF;">
                    <img width="40px" height="40px" src="{{asset('home/images/login_4790908.png')}}">
                    خروج
                </button>

            </div>
        </div>
    </div>
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
