<div>
    <div class="profile-container">
        <div class="row" style="direction: rtl">
            <div class="col-lg-3 col-sm-12">
                <livewire:home.profile.sidebar />
            </div>
            <div class="col-lg-9 col-sm-12">
                @if($status==1)
                    <livewire:home.profile.user-information />
                @elseif($status==3)
                    <livewire:home.profile.invoices />
                @endif
            </div>
            <input type="text" class="example1" />

        </div>
    </div>

</div>
