<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>ایجاد نقش</h2>
            </div>
            <div class="body">
                <form class="form-horizontal" wire:submit="save()">
                    <div class="row clearfix" style="direction: rtl !important;">
                        @foreach($permission_all ?? [] as $item )
                            <div class="col-lg-3 col-md-2 col-sm-4 col-xs-5 form-control-label" style="direction: rtl !important;">
                                <div class="form-check">
                                    <div class="form-check m-l-10">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" value="">{{$item}}

                                            <span class="form-check-sign">
                                                <span class="check"></span>
                                            </span>
                                        </label>
                                    </div>

                                </div>
                            </div>
                        @endforeach

                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5">
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <input type="checkbox" id="remember_me_4" class="filled-in">
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">ثبت</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
