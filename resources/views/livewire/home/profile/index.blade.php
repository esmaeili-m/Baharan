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
                @elseif($status==5)
                    <livewire:home.profile.invoices />
                @elseif($status==4)
                    <livewire:home.profile.chat />
                @endif
            </div>

        </div>
    </div>
        @push('styles-end')
            <link rel="stylesheet" href="{{asset('home/login/datepicker/jalalidatepicker.min.css')}}">
        @endpush
        @push('scripts-end')
        <script type="text/javascript" src="{{asset('home/login/datepicker/jalalidatepicker.min.js')}}"></script>
        <script>
                window.addEventListener('contentChanged', event => {
                jalaliDatepicker.startWatch({
                    minDate: "attr",
                    maxDate: "attr",
                    separatorChars:{
                        date:"-"
                    }
                });


                    });

           </script>
        @endpush


</div>
