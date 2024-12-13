<div>
    @push('styles-end')
        <link rel="stylesheet" href="{{asset('home/login/clock/clock.css')}}"/>
    @endpush
        <div class="sidebar-profile main-card p-3">
            <button style="border-radius: 8px;background-color: #93ba59;color: #FFFFFF"
                    class="mb-3 w-100 c-shadow btn btn-light-primary" id="countdown2"> زمانی باقی مانده تا شروع سفارش گیری</button>

            <div style="direction: ltr" class="countdown">
                <div style="color: #FFFFFF"  class="time clock-time-card" id="countdown">
                    <div class="">
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
                </div>
            </div>
        </div>

    <div class="sidebar-profile main-card p-3">
            <button style="border-radius: 8px;background-color: #8bb7f6;color: #FFFFFF"
                    class="mb-3 w-100 c-shadow btn btn-light-primary"> {{auth()->user()->name}}</button>
        <div class="mt-2 ">
            <div class="w-100 p-2 justify-content-center align-content-center" style="border-radius: 8px">
                <button @click="$dispatch('change-content', { status: '1' })" style="border-radius: 8px"  class="mb-3 w-100 c-shadow btn btn-light-primary">پروفایل کاربری</button>
                @if(auth()->user()->status == 3)
                    <button @click="$dispatch('change-content', { status: '2' })" style="border-radius: 8px"  class="mb-3 w-100 c-shadow btn btn-light-primary">فروشگاه</button>
                    <button @click="$dispatch('change-content', { status: '3' })" style="border-radius: 8px"  class="mb-3 w-100 c-shadow btn btn-light-primary">سفارشات</button>
                @endif
                <button @click="$dispatch('change-content', { status: '4' })" style="border-radius: 8px"  class="mb-3 w-100 c-shadow btn btn-light-primary">ارتباط با پشتیبانی</button>
                <button wire:click="logout()" style="border-radius: 8px;background-color: #f68b8b;color: #FFFFFF" class="mb-3 w-100 c-shadow btn btn-light-primary">خروج</button>
            </div>
        </div>
    </div>
    @push('scripts-end')
        <script>
            const openingTime = new Date(@json($openingTime).date).getTime(); // تبدیل به زمان در میلی‌ثانیه
            const closingTime = new Date(@json($closingTime).date).getTime();
            console.log(@json($openingTime))// تبدیل به زمان در میلی‌ثانیه
            console.log(@json($closingTime))// تبدیل به زمان در میلی‌ثانیه
            function updateTimer() {
                const now = new Date(@json($now).date).getTime();
                let targetTime, status;

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
                    document.getElementById("hours").innerHTML = String(hours).padStart(2, '0')
                    document.getElementById("minutes").innerHTML = String(minutes).padStart(2, '0')
                    document.getElementById("seconds").innerHTML = String(seconds).padStart(2, '0')
                    document.getElementById("countdown2").textContent = status;

                } else {
                    document.getElementById("countdown2").textContent = status;
                }
            }

            setInterval(updateTimer, 1000);
            updateTimer();
        </script>
    @endpush
</div>
