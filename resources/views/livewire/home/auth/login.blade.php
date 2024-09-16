<div>
    @if($submit_information)
        <div class="form-container">
            <div class=" wrapper-register" style="direction: rtl" >
                <div class="text-center mb-5">
                    <div style="margin: 5px auto 40px auto;" class="logo"> <!-- افزایش margin-bottom -->
                        <img src="https://www.freepnglogos.com/uploads/twitter-logo-png/twitter-bird-symbols-png-logo-0.png" alt="">
                    </div>
                    <span style="margin: 20px auto;" class="custom-primary-label">شرکت طیور متحد زرین قم (بهاران)</span> <!-- افزایش margin-top -->
                </div>

                <div class="row">
                    <div class="col-lg-6 col-sm-12 mb-2" >
                        <div class="form-field d-flex align-items-center @error('name') invalid-form @enderror">
                            <input type="text" wire:model.lazy="name"  class="" placeholder="نام و نام خانوادگی*" @if(($user->status ?? 0) == 2) disabled @endif>
                            @error('name')
                            <span style="font-size: 27px;color: red" class="fa fa-times-circle error-message show" aria-hidden="true"></span>
                            @enderror
                        </div>
                        @error('name')
                        <p style="font-size: 12px" class="me-2 text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="col-lg-6 col-sm-12 mb-2" >
                        <div class="form-field d-flex align-items-center @error('phone') invalid-form @enderror mb-sm-10 form-controller-custom">
                            <input type="text" wire:model.lazy="phone"   placeholder="شماره همراه*" @if($user) disabled @endif>
                            @error('phone')
                            <span style="font-size: 27px;color: red" class="fa fa-times-circle error-message show" aria-hidden="true"></span>
                            @enderror
                        </div>
                        @error('phone')
                        <p style="font-size: 12px" class="me-2 text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="col-lg-6 col-sm-12 mb-2" >
                        <div class="form-field d-flex align-items-center @error('email') invalid-form @enderror">
                            <input type="text" wire:model.lazy="email"  class="" placeholder="ایمیل*" @if(($user->status ?? 0) == 2) disabled @endif>
                            @error('email')
                            <span style="font-size: 27px;color: red" class="fa fa-times-circle error-message show" aria-hidden="true"></span>
                            @enderror
                        </div>
                        @error('email')
                        <p style="font-size: 12px" class="me-2 text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="col-lg-6 col-sm-12 mb-2" >
                        <div class="form-field d-flex align-items-center @error('code_meli') invalid-form @enderror">
                            <input type="text" wire:model.lazy="code_meli"  class="" placeholder="کد ملی*" @if(($user->status ?? 0) == 2) disabled @endif>
                            @error('code_meli')
                            <span style="font-size: 27px;color: red" class="fa fa-times-circle error-message show" aria-hidden="true"></span>
                            @enderror
                        </div>
                        @error('code_meli')
                        <p style="font-size: 12px" class="me-2 text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="col-lg-6 col-sm-12 mb-2" >
                        <div class="form-field d-lg-flex align-items-center ">
                            <input  id="image-file" type="file" wire:model.lazy="avatar"  class="d-none" placeholder="">
                            <label wire:model.lazy="avatar" id="image-label" for="image-file">
                                <span class="btn custom-primary mt-3 mb-3">تصویر خود را اپلود کنید</span>
                            </label>
                            @if($avatar)
                                <div class="w-sm-100">
                                    <img class="avatar mb-3 mt-3 mx-2" src="{{asset($avatar)}}" width="120px" height="120px">

                                </div>
                            @endif
                        </div>

                    </div>
                    <div class="col-lg-6 col-sm-12">
                            <div class="custom-card d-flex justify-content-center align-items-center ">

                            @if($user->status == 2 )
                            @else
                                <p class="mb-0 fs-sm-20">«کاربر گرامی، اطلاعات شما در حال بررسی و تأیید است.»</p>

                            @endif
                        </div>

                    </div>
                    <div class="col-lg-2 col-sm-12">
                        @if($user)
                            <button style="width: 100%" wire:click="user_update()" type="submit" class="btn custom-primary mt-3 mb-3" @if(($user->status ?? 0) == 2) disabled @endif >ثبت اطلاعات</button>
                        @else
                            <button style="width: 100%" wire:click="register_user()" type="submit" class="btn custom-primary mt-3 mb-3" @if(($user->status ?? 0) == 2) disabled @endif >ثبت اطلاعات</button>

                        @endif

                    </div>
                </div>
            </div>

        </div>
    @else
        <div class="wrapper">
            <div class="logo">
                <img src="https://www.freepnglogos.com/uploads/twitter-logo-png/twitter-bird-symbols-png-logo-0.png" alt="">
            </div>
            <div class="text-center mt-3 name mb-4">
                <p>فرم ثبت نام</p>
            </div>
            @if($status)
                <div >
                    <p class="mb-1"  style="direction: rtl; font-size: 12px;color: #acacac">کد ارسال شده به شماره همراه : {{$phone}}</p>
                    <div class="form-field d-flex align-items-center">
                        <span class="fa fa-barcode"></span>
                        <input type="text" wire:model.lazy="code"  placeholder="کد 5 رقمی*">

                    </div>
                    @error('code')
                    <p style="direction: rtl; font-size: 13px" class=" text-danger mb-0">{{$message}}</p>
                    @enderror
                    @if (session('code'))
                        <p style="direction: rtl; font-size: 13px" class=" text-danger mb-0">{{ session('code') }}</p>
                    @endif
                    <button wire:click="check_code()" type="submit" class="btn mt-3 mb-3">ارسال اطلاعات</button>
                </div>
            @else
                <div>
                    <div class="form-field d-flex align-items-center">
                        <span class="fa fa-phone"></span>
                        <input type="text" wire:model.lazy="phone" id="phone" placeholder="شماره همراه*">

                    </div>
                    @error('phone')
                    <p style="direction: rtl; font-size: 13px" class=" text-danger mb-0">{{$message}}</p>
                    @enderror

                    <button wire:click="get_code()" type="submit" class="btn mt-3 mb-3">ارسال اطلاعات</button>
                </div>
            @endif

            <div class="text-center fs-6">
                <span style="color: #7f7f7f;font-size: 13px">شرکت طیور متحد زرین قم (بهاران)</span>
            </div>
        </div>
    @endif
</div>
