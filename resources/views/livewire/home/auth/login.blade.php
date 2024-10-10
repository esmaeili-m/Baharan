<div>
    @if($submit_information)
        <div class="form-container">
            <div class=" wrapper-register" style="direction: rtl">
                <div class="text-center mb-5">
                    <span class=" btn custom-primary mt-3 mb-3 w-lg-40 w-sm-100 h-sm-50" >شرکت طیور متحد زرین قم (بهاران)</span>
                </div>
                @if(($user->status  ?? 0) == 2  || ($user->status  ?? 0) == 3)
                    <div class=" col-lg-12 col-sm-12">
                        <div class="custom-card d-flex justify-content-center align-items-center p-sm-4" style="background-color: #45c159">
                            <p class="mb-0 fs-sm-20">«کاربر گرامی، اطلاعات شما بررسی و تأیید شد لطفا    وجه ضمانت خود را از طریق لینک زیر پرداخت کنید.»</p>

                        </div>
                        <div class="d-flex  justify-content-center align-content-center mt-5">
                            <a href="{{route('profile.index')}}" class="btn mx-2 btn-custom-primary" style="font-size: 15px">پروفایل کاربری</a>
                            <a href="{{route('profile.index')}}" class="btn mx-2 btn-custom-primary" style="font-size: 15px">پرداخت وجه ضمانت</a>

                        </div>
                    </div>
                @else
                    <div class="row">
                        <div class="col-lg-6 col-sm-12 mb-4">
                            <div class="label-input">
                                <p class="mb-0 mx-2">
                                    نام و نام خانوادگی
                                </p>
                            </div>
                            <div class="form-field d-flex align-items-center @error('name') invalid-form @enderror">
                                <input type="text" wire:model.lazy="name" class="" placeholder="نام و نام خانوادگی*"
                                       @if(($user->status ?? 0) == 2) disabled @endif>
                                @error('name')
                                <span style="font-size: 27px;color: red" class="fa fa-times-circle error-message show"
                                      aria-hidden="true"></span>
                                @enderror
                            </div>
                            @error('name')
                            <p style="font-size: 12px" class="me-2 text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="col-lg-6 col-sm-12 mb-4">
                            <div class="label-input">
                                <p class="mb-0 mx-2">
                                    نام پدر
                                </p>
                            </div>
                            <div class="form-field d-flex align-items-center @error('father') invalid-form @enderror">
                                <input type="text" wire:model.lazy="father" class="" placeholder="نام پدر*"
                                       @if(($user->status ?? 0) == 2) disabled @endif>
                                @error('father')
                                <span style="font-size: 27px;color: red" class="fa fa-times-circle error-message show"
                                      aria-hidden="true"></span>
                                @enderror
                            </div>
                            @error('father')
                            <p style="font-size: 12px" class="me-2 text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="col-lg-6 col-sm-12 mb-4">
                            <div class="label-input">
                                <p class="mb-0 mx-2">
                                    شماره همراه
                                </p>
                            </div>
                            <div
                                class="form-field d-flex align-items-center @error('phone') invalid-form @enderror mb-sm-10 form-controller-custom">
                                <input type="text" wire:model.lazy="phone" placeholder="شماره همراه*"
                                       @if($user) disabled @endif>
                                @error('phone')
                                <span style="font-size: 27px;color: red" class="fa fa-times-circle error-message show"
                                      aria-hidden="true"></span>
                                @enderror
                            </div>
                            @error('phone')
                            <p style="font-size: 12px" class="me-2 text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="col-lg-6 col-sm-12 mb-4">
                            <div class="label-input">
                                <p class="mb-0 mx-2">
                                    آدرس
                                </p>
                            </div>
                            <div class="form-field d-flex align-items-center @error('address') invalid-form @enderror">
                                <input type="text" wire:model.lazy="address" class="" placeholder="آدرس*"
                                       @if(($user->status ?? 0) == 2) disabled @endif>
                                @error('address')
                                <span style="font-size: 27px;color: red" class="fa fa-times-circle error-message show"
                                      aria-hidden="true"></span>
                                @enderror
                            </div>
                            @error('address')
                            <p style="font-size: 12px" class="me-2 text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="col-lg-6 col-sm-12 mb-4">
                            <div class="label-input">
                                <p class="mb-0 mx-2">
                                    شماره پروانه / مجوز
                                </p>
                            </div>
                            <div class="form-field d-flex align-items-center @error('license_number') invalid-form @enderror">
                                <input type="text" wire:model.lazy="license_number" class=""
                                       placeholder="شماره پروانه / مجوز*"
                                       @if(($user->status ?? 0) == 2) disabled @endif>
                                @error('license_number')
                                <span style="font-size: 27px;color: red" class="fa fa-times-circle error-message show"
                                      aria-hidden="true"></span>
                                @enderror
                            </div>
                            @error('address')
                            <p style="font-size: 12px" class="me-2 text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="col-lg-6 col-sm-12 mb-4">
                            <div class="label-input">
                                <p class="mb-0 mx-2">
                                    کد ملی
                                </p>
                            </div>
                            <div class="form-field d-flex align-items-center @error('code_meli') invalid-form @enderror">
                                <input type="text" wire:model.lazy="code_meli" class="" placeholder="کد ملی*"
                                       @if(($user->status ?? 0) == 2) disabled @endif>
                                @error('code_meli')
                                <span style="font-size: 27px;color: red" class="fa fa-times-circle error-message show"
                                      aria-hidden="true"></span>
                                @enderror
                            </div>
                            @error('code_meli')
                            <p style="font-size: 12px" class="me-2 text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="col-lg-6 col-sm-12 mb-4 ">
                            <div class="label-input">
                                <p class="mb-0 mx-2">
                                    تاریخ تولد
                                </p>
                            </div>
                            <div class="p-3 form-field align-items-center padding-mobile-4 @if($errors->has('day')) invalid-form @elseif($errors->has('month')) invalid-form @elseif($errors->has('years')) invalid-form @endif">
                                <div class=" d-lg-flex">
                                    <div class="col-lg-3 col-sm-12 mb-3 mt-3 me-3">
                                        <select class="form-select no-arrow" wire:model.lazy="day" id="customSelect">
                                            <option value="0" selected>روز تولد</option>
                                            @for($i=1;$i<31;$i++)
                                                @if($i<10)
                                                    <option value="0{{$i}}">{{$i}}</option>

                                                @else
                                                    <option value="{{$i}}">{{$i}}</option>
                                                @endif
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-lg-3 col-sm-12 mb-3 mt-3 me-3">
                                        <select class="form-select no-arrow" wire:model.lazy="month" id="customSelect">
                                            <option value="0" selected>ماه تولد</option>
                                            <option value="01">فروردین</option>
                                            <option value="02">اردیبهشت</option>
                                            <option value="03">خرداد</option>
                                            <option value="04">تیر</option>
                                            <option value="05">مرداد</option>
                                            <option value="06">شهریور</option>
                                            <option value="07">مهر</option>
                                            <option value="08">آبان</option>
                                            <option value="09">آذر</option>
                                            <option value="10">دی</option>
                                            <option value="11">بهمن</option>
                                            <option value="12">اسفند</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-3 col-sm-12 mb-3 mt-3 me-3">
                                        <select class="form-select no-arrow" wire:model.lazy="years" id="customSelect">
                                            <option value="0" selected>سال تولد</option>
                                            @for($i=1300;$i<1390;$i++)
                                                <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    @if($errors->has('day'))
                                        <span style="font-size: 27px;color: red;margin-right: auto"
                                              class="me-2 fa mt-4 fa-times-circle error-message show" aria-hidden="true"></span>
                                    @elseif($errors->has('month'))
                                        <span style="font-size: 27px;color: red"
                                              class="me-2 fa mt-4 fa-times-circle error-message show" aria-hidden="true"></span>
                                    @elseif($errors->has('years'))
                                        <span style="font-size: 27px;color: red"
                                              class="me-2 fa mt-4 fa-times-circle error-message show" aria-hidden="true"></span>
                                    @endif

                                </div>

                                @if($errors->has('day'))
                                    <p style="font-size: 12px" class="me-2 text-danger">{{ $errors->first('day') }}</p>

                                @elseif($errors->has('month'))
                                    <p style="font-size: 12px" class="me-2 text-danger">{{ $errors->first('month') }}</p>

                                @elseif($errors->has('years'))
                                    <p style="font-size: 12px" class="me-2 text-danger">{{ $errors->first('years') }}</p>

                                @endif

                            </div>


                        </div>
                        <div class="col-lg-6 col-sm-12 mb-4 ">
                            <div class="label-input">
                                <p class="mb-0 mx-2">
                                    تاریخ صدور مجوز
                                </p>
                            </div>
                            <div class="p-3 form-field align-items-center padding-mobile-4 @if($errors->has('license_day')) invalid-form @elseif($errors->has('license_month')) invalid-form @elseif($errors->has('license_years')) invalid-form @endif">

                                <div class=" d-lg-flex">
                                    <div class="col-lg-3 col-sm-12 mb-3 mt-3 me-3">
                                        <select class="form-select no-arrow" wire:model.lazy="license_day" id="customSelect">
                                            <option value="0" selected>روز صدور</option>
                                            @for($i=1;$i<31;$i++)
                                                @if($i<10)
                                                    <option value="0{{$i}}">{{$i}}</option>

                                                @else
                                                    <option value="{{$i}}">{{$i}}</option>
                                                @endif
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-lg-3 col-sm-12 mb-3 mt-3 me-3">
                                        <select class="form-select no-arrow" wire:model.lazy="license_month" id="customSelect">
                                            <option value="0" selected>ماه صدور</option>
                                            <option value="01">فروردین</option>
                                            <option value="02">اردیبهشت</option>
                                            <option value="03">خرداد</option>
                                            <option value="04">تیر</option>
                                            <option value="05">مرداد</option>
                                            <option value="06">شهریور</option>
                                            <option value="07">مهر</option>
                                            <option value="08">آبان</option>
                                            <option value="09">آذر</option>
                                            <option value="10">دی</option>
                                            <option value="11">بهمن</option>
                                            <option value="12">اسفند</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-3 col-sm-12 mb-3 mt-3 me-3">
                                        <select class="form-select no-arrow" wire:model.lazy="license_years" id="customSelect">
                                            <option value="0" selected>سال صدور</option>
                                            @for($i=1300;$i<1390;$i++)
                                                <option>{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    @if($errors->has('license_day'))
                                        <span style="font-size: 27px;color: red;margin-right: auto"
                                              class="me-2 fa mt-4 fa-times-circle error-message show" aria-hidden="true"></span>
                                    @elseif($errors->has('license_month'))
                                        <span style="font-size: 27px;color: red"
                                              class="me-2 fa mt-4 fa-times-circle error-message show" aria-hidden="true"></span>
                                    @elseif($errors->has('license_years'))
                                        <span style="font-size: 27px;color: red"
                                              class="me-2 fa mt-4 fa-times-circle error-message show" aria-hidden="true"></span>
                                    @endif

                                </div>

                                @if($errors->has('license_day'))
                                    <p style="font-size: 12px" class="me-2 text-danger">{{ $errors->first('license_day') }}</p>

                                @elseif($errors->has('license_month'))
                                    <p style="font-size: 12px" class="me-2 text-danger">{{ $errors->first('license_month') }}</p>

                                @elseif($errors->has('license_years'))
                                    <p style="font-size: 12px" class="me-2 text-danger">{{ $errors->first('license_years') }}</p>

                                @endif

                            </div>


                        </div>
                        <div class="col-lg-6 col-sm-12 mb-4">
                            <div class="form-field d-lg-flex align-items-center @error('license_image') invalid-form @enderror">
                                <input id="license-file" type="file" wire:model.lazy="license_image" class="d-none" placeholder="">
                                <label wire:model.lazy="license_image" id="license-label" for="license-file" >
                                    <span class="w-100 btn custom-primary mt-3 mb-3 h-sm-50">تصویر پروانه کسب را اپلود کنید</span>
                                </label>
                                @error('license_image')
                                <span style="font-size: 27px;color: red" class="fa fa-times-circle error-message show"
                                      aria-hidden="true"></span>
                                @enderror

                                @if($license_image)
                                    <div class="w-sm-100">
                                        <img class="avatar mb-3 mt-3 mx-2" src="{{asset($license_image)}}" width="120px"
                                             height="120px">

                                    </div>
                                @endif
                            </div>

                        </div>
                        <div class="col-lg-6 col-sm-12 mb-4">
                            <div class="form-field d-lg-flex align-items-center ">
                                <input id="image-file" type="file" wire:model.lazy="avatar" class="d-none" placeholder="">
                                <label wire:model.lazy="avatar" id="image-label" for="image-file">
                                    <span class="w-100 btn custom-primary mt-3 mb-3">تصویر خود را اپلود کنید</span>
                                </label>
                                @if($avatar)
                                    <div class="w-sm-100">
                                        <img class="avatar mb-3 mt-3 mx-2" src="{{asset($avatar)}}" width="120px"
                                             height="120px">

                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 mb-4">
                            <div class="label-input">
                                <p class="mb-0 mx-2">
                                    نوع مالکیت
                                </p>
                            </div>
                            <div class="form-field d-flex align-items-center p-2 @error('type') invalid-form @enderror">

                                <div class="w-100 d-flex">
                                    <button  wire:click="set_type('مالک')"  type="submit" class="btn w-lg-50 w-sm-100 custom-{{$type == 'مالک' ? 'green' : 'primary'}} mt-3 mb-3 mx-2 ">مالک
                                    </button>
                                    <button wire:click="set_type('استیجاری')" type="submit" class="btn w-lg-50 w-sm-100 custom-{{$type == 'استیجاری' ? 'green' : 'primary'}} mt-3 mb-3">استیجاری
                                    </button>
                                </div>
                                @error('type')
                                <span style="font-size: 27px;color: red" class="fa fa-times-circle error-message show"
                                      aria-hidden="true"></span>
                                @enderror
                            </div>
                            @error('type')
                            <p style="font-size: 12px" class="me-2 text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            @if($user && $user->status == 1)

                                <div class="custom-card d-flex justify-content-center align-items-center mt-4">
                                    <p class="mb-0 fs-sm-20">«کاربر گرامی، اطلاعات شما در حال بررسی و تأیید می باشد.»</p>

                                </div>
                            @endif
                        </div>
                        <div class="col-lg-2 col-sm-12">
                            @if($user)
                                <button style="width: 100%" wire:loading.remove wire:click="user_update()" type="submit"
                                        class="btn custom-primary mt-3 mb-3"
                                        @if(($user->status ?? 0) == 2) disabled @endif >ویرایش اطلاعات
                                </button>
                            @else
                                <button style="width: 100%" wire:loading.remove wire:click="register_user()" type="submit"
                                        class="btn custom-primary mt-3 mb-3"
                                        @if(($user->status ?? 0) == 2) disabled @endif >ثبت اطلاعات
                                </button>

                            @endif
                                <div wire:loading class="spinner-grow text-primary" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                        </div>
                    </div>
                @endif
            </div>

        </div>
    @else
        <div class="wrapper">
            <div class="logo">
                <img src="{{asset('home/images/logo.png')}}"
                     alt="">
            </div>
            <div class="text-center mt-3 name mb-4">
                <p>فرم ثبت نام</p>
            </div>
            @if($status)
                <div>
                    <p class="mb-1" style="direction: rtl; font-size: 12px;color: #acacac">کد ارسال شده به شماره همراه
                        : {{$phone}}</p>
                    <div class="form-field d-flex align-items-center">
                        <span class="fa fa-barcode"></span>
                        <input type="text" wire:model.lazy="code" placeholder="کد 5 رقمی*">

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
