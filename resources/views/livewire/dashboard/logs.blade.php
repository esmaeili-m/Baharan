<div>
    @push('styles')
        <link href="{{asset('dashboard/js/bundles/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.css')}}" rel="stylesheet" />
        <link href="{{asset('dashboard/js/bundles/multiselect/css/multi-select.css')}}" rel="stylesheet">
    @endpush
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">

                <div class="row mt-3 mx-2">
                    <div class="col-2">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text"
                                       wire:model.defer="title"
                                       class="form-control"
                                       placeholder="عنوان دسته بندی را وارد کنید">
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div wire:ignore class="select2 input-field col s12">
                            <select wire:model.defer="status">
                                <option value="" disabled >وضعیت</option>
                                <option value="0" selected> همه</option>
                                <option value="1">غیرفعال</option>
                                <option value="2">فعال</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-2">
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
                            <th>نام کاربر</th>
                            <th>نوع عملیات</th>
                            <th>بخش</th>
                            <th>یادداشت</th>
                            <th>تاریخ و ساعت</th>
                        </tr>
                        </thead>
                        <tbody >
                        @if($data ?? 0)
                            @php
                                $counter = ($data->currentPage() - 1) * $data->perPage() + 1;
                            @endphp
                            @foreach($data ?? [] as $item)
                                <tr >
                                    <th scope="row">{{$counter}}</th>

                                    <td>{{$item->user->name ?? 'UNKNOW'}}</td>
                                    <td>
                                        @if($item->operation == 1)
                                            <button  type="button" class="btn btn-outline-success btn-border-radius">ساخت</button>
                                        @elseif($item->operation == 2)
                                            <button  type="button" class="btn btn-outline-info btn-border-radius">ویرایش</button>

                                        @elseif($item->operation == 3)
                                            <button  type="button" class="btn btn-outline-warning btn-border-radius">حذف موقت</button>

                                        @elseif($item->operation == 4)
                                            <button  type="button" class="btn btn-outline-danger btn-border-radius">حذف کامل</button>
                                        @elseif($item->operation == 6)
                                            <button  type="button" class="btn btn-outline-dark btn-border-radius">تغییر وضعیت</button>
                                        @else
                                            <button  type="button" class="btn btn-outline-primary btn-border-radius">بازگردانی</button>
                                        @endif
                                    </td>
                                    <td>{{$item->model ?? 'UNKNOW'}}</td>
                                    <td>{{$item->message ?? 'UNKNOW'}}</td>
                                    <td>{{$item->created_at->format('h:i:s Y-m-d') ?? 'UNKNOW'}}</td>
                                </tr>
                                @php($counter++)
                            @endforeach
                        @endif
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

