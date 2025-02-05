<div>
    @push('styles')
        <link href="{{asset('dashboard/js/bundles/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.css')}}" rel="stylesheet" />
        <link href="{{asset('dashboard/js/bundles/multiselect/css/multi-select.css')}}" rel="stylesheet">
    @endpush
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>ساخت کاربر</h2>
                </div>
                <div class="body">
                    <form class="form-horizontal" wire:submit="save()">
                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label>نام کاربر</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text"
                                               wire:model.defer="name"
                                               class="form-control"
                                               placeholder="نام کاربر را وارد کنید">
                                        @error('name')
                                        <p class="text-danger mt-1">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label>نام پدر</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text"
                                               wire:model.defer="father"
                                               class="form-control"
                                               placeholder="نام پدر کاربر را وارد کنید">
                                        @error('father')
                                        <p class="text-danger mt-1">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="email_address_2">شماره همراه</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text"
                                               wire:model.lazy="phone"
                                               class="form-control"
                                               placeholder="شماره همراه کاربر را وارد کنید">
                                        @error('phone')
                                        <p class="text-danger mt-1">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="email_address_2">آدرس کاربر</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text"
                                               wire:model.lazy="address"
                                               class="form-control"
                                               placeholder="آدرس کاربر را وارد کنید">
                                        @error('address')
                                        <p class="text-danger mt-1">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="email_address_2">شماره پروانه / مجوز</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text"
                                               wire:model.lazy="license_number"
                                               class="form-control"
                                               placeholder="شماره پروانه / مجوز">
                                        @error('license_number')
                                        <p class="text-danger mt-1">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="email_address_2">کدملی</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text"
                                               wire:model.lazy="code_meli"
                                               class="form-control"
                                               placeholder="کدملی کاربر را وارد کنید">
                                        @error('code_meli')
                                        <p class="text-danger mt-1">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="email_address_2">تاریخ تولد کاربر</label>
                            </div>
                            <div class="col-lg-3 col-md-10 col-sm-8 col-xs-7 mb-0">
                                <div wire:ignore class="select2 input-field col s12">
                                    <select wire:model.defer="day">
                                        <option value=""  selected>روز تولد کاربر</option>
                                        @for($i=1;$i<31;$i++)
                                            @if($i<10)
                                                <option value="0{{$i}}">{{$i}}</option>

                                            @else
                                                <option value="{{$i}}">{{$i}}</option>
                                            @endif
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-10 col-sm-8 col-xs-7 mb-0">
                                <div wire:ignore class="select2 input-field col s12">
                                    <select wire:model.defer="month">
                                        <option value=""  selected>ماه تولد کاربر</option>
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
                            </div>
                            <div class="col-lg-3 col-md-10 col-sm-8 col-xs-7 mb-0">
                                <div wire:ignore class="select2 input-field col s12">
                                    <select wire:model.defer="years">
                                        <option value=""  selected>سال تولد کاربر</option>
                                        @for($i=1300;$i<1390;$i++)
                                            <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-10 col-sm-8 col-xs-7"></div>
                            @if($errors->has('day'))
                                <p class="text-danger mb-4 mx-3">{{$errors->first('day')}}</p>

                            @elseif($errors->has('month'))
                                <p class="text-danger mb-4 mx-3">{{$errors->first('month')}}</p>

                            @elseif($errors->has('years'))
                                <p class="text-danger mb-4 mx-3">{{$errors->first('years')}}</p>

                            @endif

                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="email_address_2">تاریخ صدور مجوز</label>
                            </div>
                            <div class="col-lg-3 col-md-10 col-sm-8 col-xs-7 mb-0">
                                <div wire:ignore class="select2 input-field col s12">
                                    <select wire:model.defer="license_day">
                                        <option value=""  selected>روز صدور</option>
                                        @for($i=1;$i<31;$i++)
                                            @if($i<10)
                                                <option value="0{{$i}}">{{$i}}</option>

                                            @else
                                                <option value="{{$i}}">{{$i}}</option>
                                            @endif
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-10 col-sm-8 col-xs-7 mb-0">
                                <div wire:ignore class="select2 input-field col s12">
                                    <select wire:model.defer="license_month">
                                        <option value=""  selected>ماه صدور</option>
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
                            </div>
                            <div class="col-lg-3 col-md-10 col-sm-8 col-xs-7 mb-0">
                                <div wire:ignore class="select2 input-field col s12">
                                    <select wire:model.defer="license_years">
                                        <option value=""  selected>سال صدور</option>
                                        @for($i=1300;$i<1390;$i++)
                                            <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-10 col-sm-8 col-xs-7"></div>
                            @if($errors->has('license_day'))
                                <p class="text-danger mb-4 mx-3">{{$errors->first('license_day')}}</p>

                            @elseif($errors->has('license_month'))
                                <p class="text-danger mb-4 mx-3">{{$errors->first('license_month')}}</p>

                            @elseif($errors->has('license_years'))
                                <p class="text-danger mb-4 mx-3">{{$errors->first('license_years')}}</p>

                            @endif

                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="email_address_2">نوع مالکیت</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div wire:ignore class="select2 input-field col s12">
                                    <select wire:model.defer="type">
                                        <option value="" disabled selected>گزینه خود را انتخاب کنید</option>
                                        <option value="مالک">مالک</option>
                                        <option value="استیجاری">استیجاری</option>
                                    </select>
                                </div>
                                @error('type')
                                <p class="text-danger mt-1">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="email_address_2">نقش کاربر</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div wire:ignore class="select2 input-field col s12">
                                    <select wire:model.defer="role_id">
                                        <option value="" disabled selected>گزینه خود را انتخاب کنید</option>
                                        @foreach(\App\Models\Role::where('status',2)->pluck('title','id') as $key => $item)
                                            <option value="{{$key}}">{{$item}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="email_address_2">وضعیت کاربر</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div wire:ignore class="select2 input-field col s12">
                                    <select wire:model.defer="status">
                                        <option value="" disabled selected>گزینه خود را انتخاب کنید</option>
                                        <option value="1">عدم تایید</option>
                                        <option value="2">دردرانتظار تایید نهایی</option>
                                        <option value="3">تایید شده</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="email_address_2">توضیحات</label>
                            </div>
                            <div wire:ignore class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <textarea>{{$description}}</textarea>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="email_address_2">تصویر مجوز</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="file-field input-field">
                                    <div class="btn">
                                        <span>فایل</span>
                                        <input wire:model="license_image" type="file">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input wire:model="license_image" class="file-path  form-line" type="text">
                                    </div>
                                </div>
                                @if ($license_image ?? 0)
                                    <img width="100px" height="100" class="border-radius-per-12" alt="image" src="{{ asset($license_image) }}">
                                @endif
                                @error('license_image')
                                <p class="text-danger mt-1">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="email_address_2">تصویر کاربر</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="file-field input-field">
                                    <div class="btn">
                                        <span>فایل</span>
                                        <input wire:model="avatar" type="file">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input wire:model="avatar" class="file-path  form-line" type="text">
                                    </div>
                                </div>
                                @if ($avatar ?? 0)
                                    <img width="100px" height="100" class="border-radius-per-12" alt="image" src="{{ asset($avatar) }}">
                                @endif
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5">
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <input type="checkbox" id="remember_me_4" class="filled-in">
                                <button wire:loading.remove type="submit" class="btn btn-primary m-t-15 waves-effect">ثبت</button>
                                <div wire:loading class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="{{asset('dashboard/js/form.min.js')}}"></script>
        <script src="{{asset('dashboard/js/bundles/multiselect/js/jquery.multi-select.js')}}"></script>
        <script src="{{asset('dashboard/js/bundles/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.js')}}"></script>
        <script src="{{asset('dashboard/js/pages/forms/advanced-form-elements.js')}}"></script>
        <script src="{{asset('dashboard/js/tinymce.min.js')}}" referrerpolicy="origin"></script>
        <script>
            tinymce.init({
                menubar: false,
                language:'fa',
                statusbar: false,
                selector: 'textarea',
                plugins: 'autolink autosave save directionality code fullscreen link media codesample charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount charmap emoticons accordion image imagetools',
                toolbar: "undo redo | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | image rtl ltr",
                image_title: true,
                automatic_uploads: true,
                images_upload_url: '/dashboard/upload-image-tinymce', // مسیر آپلود تصویر
                file_picker_types: 'image',
                file_picker_callback: function (callback, value, meta) {
                    if (meta.filetype === 'image') {
                        var input = document.createElement('input');
                        input.setAttribute('type', 'file');
                        input.setAttribute('accept', 'image/*');
                        input.onchange = function () {
                            var file = this.files[0];
                            var reader = new FileReader();
                            reader.onload = function () {
                                var id = 'blobid' + (new Date()).getTime();
                                var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                                var base64 = reader.result.split(',')[1];
                                var blobInfo = blobCache.create(id, file, base64);
                                blobCache.add(blobInfo);

                                callback(blobInfo.blobUri(), { title: file.name });
                            };
                            reader.readAsDataURL(file);
                        };

                        input.click();
                    }
                },
                setup: function (editor) {
                    editor.on('change', function () {
                        editor.save();
                    @this.set('description',editor.getContent(),false)
                    });
                }
            });
        </script>
    @endpush

</div>
