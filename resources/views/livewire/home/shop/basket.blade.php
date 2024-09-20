<div class="sidebar-basket" >
    <div class="basket-invoice">
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
                                <span wire:loading.class.add="d-none" wire:click="remove_from_basket({{$product->id}})" class="category-product checkout-button-remove" style=""><i class="fa fa-times"></i></span>
                                <div wire:loading style="margin-right: auto;color: #72baf6" class="spinner-grow " role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                            <div class="form-field d-flex align-items-center form-invoice">
                                <input type="number" wire:model.lazy="invoice.{{ $product->id }}"  class="mb-1" placeholder="برحسب {{$type[$product->type] ?? 'None'}}">
                                @error('invoice.' . $product->id)
                                <span style="font-size: 27px;color: red" class="fa fa-times-circle error-message show" aria-hidden="true"></span>
                                @enderror
                            </div>
                            <div class="">
                                <p style="font-size: 11px !important;" class="category-product card-category-title mb-1 w-100"> قیمت : {{number_format($product->price)}}</p>
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
            <p class="mb-0">جمع کل : {{$total}}</p>
        </div>
        <span class="checkout-button-basket p-3">ثبت نهایی</span>
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
