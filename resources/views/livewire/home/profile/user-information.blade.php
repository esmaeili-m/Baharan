<div>
    <div class="c-shadow p-5 content-profile">
        <div class="row">
            <div class="col-lg-6 col-sm-12 mb-4">
                <div class="form-field d-flex align-items-center ">
                    <input type="text" wire:model.lazy="name" class="" placeholder="نام و نام خانوادگی*"
                            disabled >
                    <label class=" p-2 mb-2 mt-2 text-center" style="">نام و نام خانوادگی</label>

                </div>
            </div>
            <div class="col-lg-6 col-sm-12 mb-4">
                <div class="form-field d-flex align-items-center" >
                    <input type="text" wire:model.lazy="father" class="" placeholder="نام پدر*" disabled>
                    <label class=" p-2 mb-2 mt-2 text-center" style="">نام پدر</label>

                </div>

            </div>

            <div class="col-lg-6 col-sm-12 mb-4">
                <div
                    class="form-field d-flex align-items-center  mb-sm-10 form-controller-custom">
                    <input type="text" wire:model.lazy="phone" placeholder="شماره همراه*" disabled >
                    <label class=" p-2 mb-2 mt-2 text-center" style="">شماره همراه</label>

                </div>

            </div>
            <div class="col-lg-6 col-sm-12 mb-4">
                <div class="form-field d-flex align-items-center">
                    <input type="text" wire:model.lazy="address" class="" placeholder="آدرس*"
                           disabled >
                    <label class=" p-2 mb-2 mt-2 text-center" style="">آدرس</label>

                </div>
            </div>
            <div class="col-lg-6 col-sm-12 mb-4">
                <div class="form-field d-flex align-items-center ">
                    <input type="text" wire:model.lazy="license_number" class=""
                           placeholder="شماره پروانه / مجوز*"
                           disabled>
                    <label class=" p-2 mb-2 mt-2 text-center" style="">شماره پروانه</label>

                </div>

            </div>
            <div class="col-lg-6 col-sm-12 mb-4">
                <div class="form-field d-flex align-items-center ">
                    <input type="text" wire:model.lazy="code_meli" class="" placeholder="کد ملی*" disabled>
                    <label class=" p-2 mb-2 mt-2 text-center" style="">کد ملی</label>
                </div>
            </div>
            <div class="col-lg-6 col-sm-12 mb-4">
                <div class="form-field d-flex align-items-center ">
                    <input type="text" value="{{$years.'-'.$month.'-'.$day}}" class="" placeholder="تاریخ تولد*" disabled>
                    <label class=" p-2 mb-2 mt-2 text-center" style="">تاریخ تولد</label>
                </div>
            </div>
            <div class="col-lg-6 col-sm-12 mb-4">
                <div class="form-field d-flex align-items-center ">
                    <input type="text" value="{{$license_years.'-'.$license_month.'-'.$license_day}}" class="" placeholder="تاریخ صدور پروانه*" disabled>
                    <label class=" p-2 mb-2 mt-2 text-center" style="">تاریخ صدور پروانه</label>
                </div>
            </div>
            <div class="col-lg-6 col-sm-12 mb-4">
                <div class="form-field d-flex align-items-center ">
                    <input  type="text" value="{{$type}}" class=""  disabled>
                    <label class=" p-2 mb-2 mt-2 text-center" style="">نوع مالکیت</label>
                </div>
            </div>

        </div>
    </div>
</div>
