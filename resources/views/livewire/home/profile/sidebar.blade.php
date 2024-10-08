<div>
    <div class="sidebar-profile main-card p-3">
            <button style="border-radius: 8px;background-color: #8bb7f6;color: #FFFFFF"
                    class="mb-3 w-100 c-shadow btn btn-light-primary"> {{auth()->user()->name}}</button>
        <div class="mt-2 ">
            <div class="w-100 p-2 justify-content-center align-content-center" style="border-radius: 8px">
                <button @click="$dispatch('change-content', { status: '1' })" style="border-radius: 8px"  class="mb-3 w-100 c-shadow btn btn-light-primary">پروفایل کاربری</button>
                @if(auth()->user()->status == 3)
                    <button @click="$dispatch('change-content', { status: '2' })" style="border-radius: 8px"  class="mb-3 w-100 c-shadow btn btn-light-primary">فروشگاه</button>
                    <button @click="$dispatch('change-content', { status: '3' })" style="border-radius: 8px"  class="mb-3 w-100 c-shadow btn btn-light-primary">فاکتورها</button>
                @endif
                <button @click="$dispatch('change-content', { status: '4' })" style="border-radius: 8px"  class="mb-3 w-100 c-shadow btn btn-light-primary">ارتباط با پشتیبانی</button>
                <button wire:click="logout()" style="border-radius: 8px;background-color: #f68b8b;color: #FFFFFF" class="mb-3 w-100 c-shadow btn btn-light-primary">خروج</button>
            </div>
        </div>
    </div>
</div>
