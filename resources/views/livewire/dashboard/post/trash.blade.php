<div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <a href="{{route('post.create')}}"><button class="btn-hover btn-border-radius color-7 border-radius-custom">افزودن پست</button></a>
                    <a href="{{route('post.list')}}"><button class="btn-hover btn-border-radius color-8 border-radius-custom">بازگشت</button></a>
                </div>
                <div class="body table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>تصویر</th>
                            <th>عنوان</th>
                            <th>لینک</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($counter=1)
                        @foreach($data ?? [] as $item)
                            <tr>
                                <th scope="row">{{$counter}}</th>
                                <td>
                                    <img src="{{asset($item->image)}}" width="80" height="80" alt="portfolio">
                                </td>
                                <td>{{$item->title}}</td>
                                <td>{{$item->slug}}</td>
                                <td>

                                    <button wire:click="restore({{$item->id}})" class="btn tblActnBtn">
                                        <i class="material-icons">restore</i>
                                    </button>
                                    <button wire:click="delete({{$item->id}})" class="btn tblActnBtn">
                                        <i class="material-icons">delete</i>
                                    </button>
                                </td>
                            </tr>
                            @php($counter++)
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
