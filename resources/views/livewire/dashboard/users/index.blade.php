<div>
    @push('styles')
        <link href="{{asset('dashboard/js/bundles/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.css')}}" rel="stylesheet" />
        <link href="{{asset('dashboard/js/bundles/multiselect/css/multi-select.css')}}" rel="stylesheet">
    @endpush
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <a href="{{route('user.create')}}"><button class="btn-hover btn-border-radius color-7 border-radius-custom">افزودن کاربر</button></a>
                    <a href="{{route('user.trash')}}"><button class="btn-hover btn-border-radius color-8 border-radius-custom">سطل آشغال ( {{\App\Models\User::onlyTrashed()->count()}} )</button></a>
                </div>
                <div class="row mt-3 mx-2">
                    <div class="col-2">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text"
                                           wire:model.defer="name"
                                           class="form-control"
                                           placeholder="نام کاربر را وارد کنید">
                                </div>
                            </div>
                    </div>
                    <div class="col-2">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text"
                                           wire:model.defer="phone"
                                           class="form-control"
                                           placeholder="شماره کاربر را وارد کنید">
                                </div>
                            </div>
                    </div>
                    <div class="col-2">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text"
                                           wire:model.defer="code_meli"
                                           class="form-control"
                                           placeholder="کدملی کاربر را وارد کنید">
                                </div>
                            </div>
                    </div>
                    <div class="col-2">
                        <div wire:ignore class="select2 input-field col s12">
                            <select wire:model.defer="role_id">
                                <option value="" disabled >نقش ها</option>
                                <option value="0" selected>همه</option>
                                @foreach(\App\Models\Role::where('status',1)->pluck('title','id') as $key => $item)
                                    <option value="{{$key}}">{{$item}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-2">
                        <div wire:ignore class="select2 input-field col s12">
                            <select wire:model.defer="status">
                                <option value="" disabled >وضعیت کاربر</option>
                                <option value="0" selected> همه</option>
                                <option value="1">عدم تایید</option>
                                <option value="2">درانتضار تایید نهایی</option>
                                <option value="3">تایید شده</option>
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
                            <th>نام</th>
                            <th>شماره</th>
                            <th>کدملی</th>
                            <th>نقش</th>
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
                                <td>{{$item->name}}</td>
                                <td>{{$item->phone}}</td>
                                <td>{{$item->code_meli}}</td>
                                <td>{{$item->role->title ?? 'Unknow'}}</td>

                                <td>
                                    @if($item->status == 1)
                                        <button  type="button" class="btn btn-outline-danger btn-border-radius">عدم تایید</button>
                                    @elseif($item->status == 2)
                                        <button  type="button" class="btn btn-outline-warning btn-border-radius">درانتظار تایید</button>
                                    @else
                                        <button type="button" class="btn btn-outline-success btn-border-radius">تایید شده</button>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('user.update',$item->id)}}"><button class="btn tblActnBtn">
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

