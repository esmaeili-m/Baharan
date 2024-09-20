<div class="sidebar-basket" >
    <div id="time" class="header-basket d-flex justify-content-center align-items-center" >
        <p id="remaining-time" class="mb-0">{{ $remainingTime }}</p>
    </div>
    <div class="mt-3">
        @foreach($products ?? [] as $product)
            <div  class="col-lg-12 col-sm-12 mb-1">
                <div class="card-category mb-2">
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // گرفتن زمان باقی‌مانده از DOM
            let remainingTime = document.getElementById('remaining-time').innerText;

            // تابع برای به‌روزرسانی تایمر هر دقیقه
            function updateTimer() {
                let timeParts = remainingTime.split(':');
                let hours = parseInt(timeParts[0]);
                let minutes = parseInt(timeParts[1]);

                // کم کردن یک دقیقه
                if (minutes === 0) {
                    if (hours > 0) {
                        hours--;
                        minutes = 59;
                    } else {
                        // اگر ساعت و دقیقه هر دو به 0 برسند
                        clearInterval(timerInterval);
                        document.getElementById('remaining-time').innerText = "CLOSED";
                        return;
                    }
                } else {
                    minutes--;
                }
                if (hours === 0 && minutes < 30){
                    document.getElementById('time').style.backgroundColor = '#fbe5e5'; // تغییر رنگ پس‌زمینه
                }
                // تنظیم مقدار جدید
                remainingTime = `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}`;
                document.getElementById('remaining-time').innerText = remainingTime;
            }

            // به‌روزرسانی هر دقیقه
            let timerInterval = setInterval(updateTimer, 60000); // 60000 میلی‌ثانیه = 1 دقیقه
        });
    </script>
</div>
