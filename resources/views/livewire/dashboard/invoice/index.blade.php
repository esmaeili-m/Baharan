<div>
    @push('styles')
        <link href="{{asset('dashboard/js/bundles/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.css')}}" rel="stylesheet" />
        <link href="{{asset('dashboard/js/bundles/multiselect/css/multi-select.css')}}" rel="stylesheet">
    @endpush
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <a href="{{route('invoice.create')}}">
                        @can('create-invoices')

                        <button class="btn-hover btn-border-radius color-7 border-radius-custom">ثبت سفارش جدید</button></a>
                        @endcan
                    <a wire:click="export_excel"><button class="btn-hover btn-border-radius color-1 border-radius-custom">خروجی اکسل</button></a>

                </div>
                <div class="row mt-3 mx-2">
                    <div class="col-3">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text"
                                       wire:model.defer="product"
                                       class="form-control"
                                       placeholder="نام محصول را وارد کنید">
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text"
                                       wire:model.defer="barcode"
                                       class="form-control"
                                       placeholder="شماره سفارش را وارد کنید">
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text"
                                       data-jdp
                                       wire:model.defer="from"
                                       class="form-control"
                                       placeholder="از تاریخ">
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text"
                                       data-jdp
                                       wire:model.defer="to"
                                       class="form-control"
                                       placeholder="تا تاریخ">
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div wire:ignore class="select2 input-field col s12">
                            <select wire:model.defer="status">
                                <option value="" disabled >وضعیت</option>
                                <option value="0" selected> همه</option>
                                <option value="1">ثبت شده</option>
                                <option value="2">تایید شده</option>
                                <option value="3">تحویل داده شده</option>
                                <option value="4">لغو شده</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-3">
                        <div wire:ignore class="select2 input-field col s12">
                            <select wire:model.defer="user_id">
                                <option value="" disabled >وضعیت</option>
                                <option value="0" selected> همه</option>
                                @foreach(\App\Models\User::where('status',3)->pluck('name','id') ?? []  as $key => $user)
                                    <option value="{{$key}}" selected> {{$user}}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                    <div class="col-3">
                        <div wire:loading.remove class="btn-group " role="group">
                            <button wire:click="fillter()"  style="height: 55px;border-radius-: 5px" class="btn btn-outline-info"><i class="fa fa-search"></i></button>
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
                            <th>شماره سفارش</th>
                            <th>نام کاربر</th>
                            <th>محصولات</th>
                            <th>قیمت</th>
                            <th>وضعیت سفارش</th>
                            <th>تاریخ ثبت سفارش</th>
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
                                <td ><a target="_blank" href="{{route('invoice.details',$item->id)}}">BIN{{$item->barcode}}</a></td>
                                <td >{{$item->user->name}}<br>{{$item->user->code_meli}}</td>
                                <td > @foreach($item->products ?? [] as $product)
                                        <p class="">{{$product['name']}} -> {{$product['order']}} {{$type[$product['type']] ?? 'UNKNOW'}}</p>
                                    @endforeach
                                </td>

                                <td>
                                    <p>{{number_format($item->price)}} تومان</p>
                                </td>
                                <td>

                                    @if($item->status == 1)
                                        <button
                                    @can('update-invoices')

                                            wire:click="change_status({{$item->id}},2)"
                                            @endcan
                                            type="button" class="btn btn-outline-warning btn-border-radius">ثبت شده</button>
                                    @elseif($item->status == 2)
                                        <button
                                    @can('update-invoices')

                                            wire:click="change_status({{$item->id}},3)"
                                            @endcan
                                            type="button" class="btn btn-outline-success btn-border-radius">تایید شده</button>
                                    @elseif($item->status == 3)
                                        <button
                                    @can('update-invoices')

                                            wire:click="change_status({{$item->id}},4)"
                                            @endcan
                                            type="button" class="btn btn-outline-primary btn-border-radius">تحویل داده شده</button>
                                    @else
                                        <button
                                    @can('update-invoices')

                                            wire:click="change_status({{$item->id}},1)"
                                            @endcan
                                            type="button" class="btn btn-outline-danger btn-border-radius">لفو شده</button>
                                    @endif
                                </td>
                                <td>

                                    <p>{{verta($item->created_at)->format('H:i:s Y-m-d')}}</p>

                                </td>

                                <td>
                                    @can('update-invoices')

                                    <a href="{{route('invoice.update',$item->id)}}"><button class="btn tblActnBtn">
                                            <i class="material-icons">mode_edit</i>
                                        </button>
                                    </a>
                                    @endcan
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
@push('styles')
    <link rel="stylesheet" href="{{asset('home/login/datepicker/jalalidatepicker.min.css')}}">
@endpush
@push('scripts')
    <script src="{{asset('dashboard/js/form.min.js')}}"></script>
    <script src="{{asset('dashboard/js/bundles/multiselect/js/jquery.multi-select.js')}}"></script>
    <script src="{{asset('dashboard/js/bundles/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.js')}}"></script>
    <script src="{{asset('dashboard/js/pages/forms/advanced-form-elements.js')}}"></script>
    <script type="text/javascript" src="{{asset('home/login/datepicker/jalalidatepicker.min.js')}}"></script>
    <script>
            jalaliDatepicker.startWatch({
                minDate: "attr",
                maxDate: "attr",
                separatorChars:{
                    date:"-"
                }
            });
    </script>
@endpush

