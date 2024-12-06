<div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    @can('create-roles')

                    <a href="{{route('role.create')}}">
                        <button class="btn-hover btn-border-radius color-7 border-radius-custom">ایجاد نقش</button></a>
                      @endcan
                </div>
                <div class="body table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>نقش</th>
                            <th>وضعیت</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody >
                        @php($counter=1)
                        @foreach($data ?? [] as $item)
                            <tr >
                                <th scope="row">{{$counter}}</th>
                                <td>{{$item->title}}</td>
                                <td>
                                    @if($item->status == 1)
                                        <button
                                            @can('update-roles')

                                            wire:click="change_status({{$item->id}})"
                                            @endcan
                                            type="button" class="btn btn-outline-danger btn-border-radius">غیر فعال</button>
                                    @else
                                        <button
                                            @can('update-roles')

                                            wire:click="change_status({{$item->id}})"
                                            @endcan
                                            type="button" class="btn btn-outline-success btn-border-radius">فعال</button>
                                    @endif
                                </td>
                                <td>
                                    @can('permissions')

                                    <a href="{{route('role.permission',$item->id)}}"><button class="btn tblActnBtn">
                                            <i class="material-icons">apps</i>
                                        </button>
                                    </a>
                                    @endcan

                                    @if($item->id != 1 && $item->id !=2)
                                        @can('update-roles')

                                        <a href="{{route('role.update',$item->id)}}"><button class="btn tblActnBtn">
                                                <i class="material-icons">mode_edit</i>
                                            </button>
                                        </a>
                                        @endcan
                                            @can('delete-roles')

                                        <button wire:click="delete({{$item->id}})" class="btn tblActnBtn">
                                            <i class="material-icons">delete</i>
                                        </button>
                                            @endcan

                                    @endif


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

