<div class="sidebar-basket" >
    <div id="time" class="header-basket d-flex justify-content-center align-items-center" >
        <p id="remaining-time" class="mb-0">{{ $remainingTime }}</p>
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
