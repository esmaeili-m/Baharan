<div>
    @push('styles')
        <link href="{{asset('dashboard/js/bundles/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.css')}}" rel="stylesheet" />
        <link href="{{asset('dashboard/js/bundles/multiselect/css/multi-select.css')}}" rel="stylesheet">
    @endpush
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <a href="{{route('article.create')}}"><button class="btn-hover btn-border-radius color-7 border-radius-custom">افزودن مقاله</button></a>
                    <a href="{{route('article.trash')}}"><button class="btn-hover btn-border-radius color-8 border-radius-custom">سطل آشغال ( {{\App\Models\Article::onlyTrashed()->count()}} )</button></a>

                </div>
                <div class="body table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>

                            <th>#</th>
                            <th>تصویر</th>
                            <th>عنوان</th>
                            <th>لینک</th>
                            <th>وضعیت</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody id="sortable-list">
                        @php
                            $counter = ($data->currentPage() - 1) * $data->perPage() + 1;
                        @endphp
                        @foreach($data ?? [] as $item)
                            <tr data-id="{{$item->id}}" class="sortable-item">
                                <th scope="row">{{$counter}}</th>
                                <td>
                                    <img src="{{asset($item->image)}}" width="80" height="80" alt="portfolio">
                                </td>
                                <td>{{$item->title}}</td>
                                <td>{{$item->slug}}</td>
                                <td>
                                    @if($item->status)
                                        <button wire:click="change_status({{$item->id}})" type="button" class="btn btn-outline-success btn-border-radius">فعال</button>
                                    @else
                                        <button wire:click="change_status({{$item->id}})" type="button" class="btn btn-outline-danger btn-border-radius">غیرفعال</button>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('article.update',$item->id)}}"><button class="btn tblActnBtn">
                                            <i class="material-icons">mode_edit</i>
                                        </button></a>
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
    <script src="{{asset('dashboard/js/Sortable.min.js')}}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var el = document.getElementById('sortable-list');
            var sortable = Sortable.create(el, {
                animation: 150,
                handle: '.sortable-item',
                onEnd: function (evt) {
                    var tasks=document.getElementsByClassName("sortable-item");
                    var data=[];
                    for ( i=0;i<tasks.length;i++){
                        data.push(tasks[i].dataset.id);
                    }
                @this.set('sort',data,true);
                }
            });
        });
    </script>
@endpush

