<div>
    @push('styles')
        <link href="{{asset('dashboard/js/bundles/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.css')}}" rel="stylesheet" />
        <link href="{{asset('dashboard/js/bundles/multiselect/css/multi-select.css')}}" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('home/login/datepicker/jalalidatepicker.min.css')}}">

    @endpush

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>تنضیمات سایت</h2>
                </div>
                <div class="body">
                    <form class="form-horizontal" wire:submit="save()">
                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label>نام فروشگاه</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text"
                                               wire:model.defer="name"
                                               class="form-control"
                                               placeholder="نام فروشگاه را وارد کنید">
                                        @error('name')
                                        <p class="text-danger mt-1">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label> زمان شروع سفارش گیری</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text"
                                               data-jdp
                                               wire:model.defer="start"
                                               class="form-control"
                                               placeholder="زمان شروع">
                                        @error('start')
                                        <p class="text-danger mt-1">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label> زمان پایان سفارش گیری</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text"
                                               data-jdp
                                               wire:model.defer="end"
                                               class="form-control"
                                               placeholder="زمان پایان">
                                        @error('end')
                                        <p class="text-danger mt-1">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="email_address_2">وضعیت فروشگاه</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div wire:ignore  class="select2 input-field col s12">
                                    <select wire:model.defer="status">
                                        <option value="" disabled selected>گزینه خود را انتخاب کنید</option>
                                        <option value="1">بسته</option>
                                        <option value="2">باز</option>
                                    </select>
                                </div>
                                @error('status')
                                <p class="text-danger mt-1">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
ُ
                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="email_address_2">توضیحات</label>
                            </div>
                            <div wire:ignore class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <textarea>{{$description}}</textarea>
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
            <script type="text/javascript" src="{{asset('home/login/datepicker/jalalidatepicker.min.js')}}"></script>
            <script>
                jalaliDatepicker.startWatch({
                    minDate: "attr",
                    maxDate: "attr",
                    time:true,
                    separatorChars:{
                        date:"-"
                    }
                });
            </script>
    @endpush

</div>
