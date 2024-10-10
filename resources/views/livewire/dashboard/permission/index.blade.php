<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>دسترسی ها</h2>
            </div>
            <div class="body">
                <form class="form-horizontal" wire:submit="save()">
                    <div class="row clearfix text-right" >
                        @php($counter=1)
                        @foreach($permission_all ?? [] as $key => $item )
                            <div wire:key="permission-{{$counter}}" class="col-lg-3 col-md-2  text-left col-sm-4 col-xs-5 form-control-label" style="direction: rtl !important;">
                                <div style="border: 2px dashed #097ef3;border-radius: 10px" class="p-3">
                                    <div class="form-check">
                                        <div class="form-check m-l-10">
                                            <label class="form-check-label">
                                                <input  wire:model.defer="permissions_allow.{{$counter}}" value="{{$counter}}" class="form-check-input" type="checkbox" >{{$item}}
                                                <span class="form-check-sign">
                                                <span class="check"></span>
                                            </span>
                                            </label>
                                        </div>

                                    </div>

                                </div>
                            </div>
                            @php($counter++)
                        @endforeach

                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <input type="checkbox" id="remember_me_4" class="filled-in">
                            <button wire:click="save()" type="submit" class="btn btn-primary m-t-15 waves-effect">ثبت</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
