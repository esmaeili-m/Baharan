<div>
    @push('styles')
        <link href="{{asset('dashboard/js/bundles/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.css')}}" rel="stylesheet" />
        <link href="{{asset('dashboard/js/bundles/multiselect/css/multi-select.css')}}" rel="stylesheet">
    @endpush
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <a href="{{route('product.create')}}"><button class="btn-hover btn-border-radius color-7 border-radius-custom">افزودن محصول</button></a>
                    <a href="{{route('product.trash')}}"><button class="btn-hover btn-border-radius color-8 border-radius-custom">سطل آشغال ( {{\App\Models\Product::onlyTrashed()->count()}} )</button></a>
                </div>
                <div class="row mt-3 mx-2">
                    <div class="col-lg-2 col-sm-6 col-md-6">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text"
                                       wire:model.defer="name"
                                       class="form-control"
                                       placeholder="نام محصول را وارد کنید">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-6 col-md-6">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text"
                                       wire:model.defer="barcode"
                                       class="form-control"
                                       placeholder="بارکد محصول را وارد کنید">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-6 col-md-6">
                        <div wire:ignore class="select2 input-field col s12">
                            <select wire:model.defer="category_id">
                                <option value="" disabled >دسته محصول</option>
                                <option value="0" selected> همه</option>
                                @foreach(\App\Models\Category::where('status',2)->pluck('title','id') as $key => $item)
                                    <option value="{{$key}}">{{$item}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-6 col-md-6">
                        <div wire:ignore class="select2 input-field col s12">
                            <select wire:model.defer="status">
                                <option value="" disabled >وضعیت محصول</option>
                                <option value="0" selected> همه</option>
                                <option value="1">غیر فعال</option>
                                <option value="2">فعال</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-2">
                        <div wire:loading.remove class="btn-group " role="group">
                            <button wire:click="fillter()"  style="height: 55px;border-radius: 5px" class="btn btn-outline-info"><i class="fa fa-search"></i></button>
                            <button wire:click="reset_search()" type="button" style="height: 55px;border-radius: 5px" class="btn btn-outline-warning"><i class="fa fa-times"></i></button>

                        </div>
                        <div wire:loading class="spinner-grow text-warning" style="width: 3rem; height: 3rem;" role="status"></div>

                    </div>
                </div>
                <div class="body table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>تصویر</th>
                            <th>نام</th>
                            <th>بارکد</th>
                            <th>قیمت</th>
                            <th>موجودی</th>
                            <th>وضعیت</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody >
                        @php
                            $counter = ($data->currentPage() - 1) * $data->perPage() + 1;
                        @endphp
                        @foreach($data ?? [] as $item)
                            <tr >
                                <th scope="row">{{$counter}}</th>
                                <td>
                                    <img width="80px" height="80px" style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;border-radius: 5px"
                                         alt="{{$item->name}}" src="{{asset($item->image ?? 'uploads/default/categories/default.png')}}">
                                </td>
                                <td>{{$item->name}}</td>
                                <td>#{{$item->barcode}}</td>
                                <td>{{number_format($item->price)}} تومان</td>
                                <td>{{number_format($item->stock)}} {{$type[$item['type']] ?? 'UNKNOW'}}</td>
                                <td>
                                    @if($item->status == 1)
                                        <button wire:click="change_status({{$item->id}})"  type="button" class="btn btn-outline-danger btn-border-radius">غیر فعال</button>
                                    @else
                                        <button wire:click="change_status({{$item->id}})" type="button" class="btn btn-outline-success btn-border-radius">فعال</button>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('product.update',$item->id)}}"><button class="btn tblActnBtn">
                                            <i class="material-icons">mode_edit</i>
                                        </button>
                                    </a>
                                    <button wire:click="delete({{$item->id}})" class="btn tblActnBtn">
                                        <i class="material-icons">delete</i>
                                    </button>
                                </td>
                            </tr>
                            @php($counter++)
                        @endforeach

                        </tbody>

                    </table>

                    <div class="row mt-5 ">
                        <div class="col-lg-2 col-sm-4">
                            <div wire:ignore class="input-field col s12 mb-10">
                                <select wire:model.lazy="paginate_count">
                                    <option value="20">صفحه بندی</option>
                                    <option value="50000">نمایش همه</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-5 col-sm-4">
                            {{ $data->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script src="{{asset('dashboard/js/form.min.js')}}"></script>
    <script src="{{asset('dashboard/js/bundles/multiselect/js/jquery.multi-select.js')}}"></script>
    <script src="{{asset('dashboard/js/bundles/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.js')}}"></script>
    <script src="{{asset('dashboard/js/pages/forms/advanced-form-elements.js')}}"></script>
@endpush

