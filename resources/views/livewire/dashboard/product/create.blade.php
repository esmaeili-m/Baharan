<div>
    @push('styles')
        <link href="{{asset('dashboard/js/bundles/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.css')}}" rel="stylesheet" />
        <link href="{{asset('dashboard/js/bundles/multiselect/css/multi-select.css')}}" rel="stylesheet">
    @endpush
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>ساخت محصول</h2>
                </div>
                <div class="body">
                    <form class="form-horizontal" wire:submit="save()">
                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label>نام محصول</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text"
                                               wire:model.defer="name"
                                               class="form-control"
                                               placeholder="نام محصول را وارد کنید">
                                        @error('name')
                                        <p class="text-danger mt-1">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="email_address_2">قیمت محصول</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="number"
                                               step="0.0001"
                                               wire:model.lazy="price"
                                               class="form-control"
                                               placeholder="قیمت محصول را وارد کنید">
                                        @error('price')
                                        <p class="text-danger mt-1">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="email_address_2">موجودی</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="number"
                                               step="0.0001"
                                               wire:model.lazy="stock"
                                               class="form-control"
                                               placeholder="موجودی محصول را وارد کنید">
                                        @error('stock')
                                        <p class="text-danger mt-1">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="email_address_2">حداقل سفارش</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="number"
                                               step="0.0001"
                                               wire:model.lazy="min"
                                               class="form-control"
                                               placeholder="حداقل سفارش محصول را وارد کنید">
                                        @error('min')
                                        <p class="text-danger mt-1">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="email_address_2">حداکثر سفارش</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="number"
                                               step="0.0001"
                                               wire:model.lazy="max"
                                               class="form-control"
                                               placeholder="حداکثر سفارش محصول را وارد کنید">
                                        @error('max')
                                        <p class="text-danger mt-1">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="email_address_2">برحسب</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div wire:ignore class="select2 input-field col s12">
                                    <select wire:model.defer="type">
                                        <option value="" disabled >گزینه خود را انتخاب کنید</option>
                                            <option value="1" selected>تعداد</option>
                                            <option value="2">وزن</option>
                                    </select>
                                </div>
                                @error('type')
                                <p class="text-danger mt-1">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="email_address_2">دسته محصول</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div wire:ignore class="select2 input-field col s12">
                                    <select wire:model.defer="category_id">
                                        <option value="0"  selected>گزینه خود را انتخاب کنید</option>
                                        @foreach(\App\Models\Category::where('status',2)->pluck('title','id') as $key => $item)
                                            <option value="{{$key}}">{{$item}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('category_id')
                                <p class="text-danger mt-1">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="email_address_2">توضیحات</label>
                            </div>
                            <div wire:ignore class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <textarea></textarea>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="email_address_2">تصویر</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="file-field input-field">
                                    <div class="btn">
                                        <span>فایل</span>
                                        <input wire:model="image" type="file">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input wire:model="image" class="file-path  form-line" type="text">
                                    </div>
                                </div>
                                @if ($image ?? 0)
                                    <img width="100px" height="100" class="border-radius-per-12" alt="image" src="{{ asset($image) }}">
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
