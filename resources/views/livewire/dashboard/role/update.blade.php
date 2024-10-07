<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>ویرایش نقش</h2>
            </div>
            <div class="body">
                <form class="form-horizontal" wire:submit="save()">
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label>عنوان</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text"
                                           wire:model.defer="title"
                                           class="form-control"
                                           placeholder="عنوان نقش را وارد کنید">
                                    @error('title')
                                    <p class="text-danger mt-1">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
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
