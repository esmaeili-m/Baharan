<div>
    <div class="card p-2">
        <div id="chart"></div>

        <div class="col-12">
            <div class="row">
                <div class="col-2">
                    <p>متغییر</p>
                    <div class="col-sm-6 col-lg-12">
                        <div class="form-check m-l-10">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="color" value="purple"> فاکتورها
                                <span class="form-check-sign">
                                     <span class="check"></span>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-12">
                        <div class="form-check m-l-10">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="color" value="purple"> محصولات
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-12">
                        <div class="form-check m-l-10">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="color" value="purple"> دسته بندی
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-12">
                        <div class="form-check m-l-10">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="color" value="purple"> کاربران
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div>
                    </div>

                </div>
                <div class="col-5">
                    <p>فیلتر</p>
                    @if($status == 1)
                        <div class="col-sm-6 col-lg-12">
                            <div class="form-check m-l-10">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="color" value="purple">تمام فاکتور ها
                                    <span class="form-check-sign">
                                     <span class="check"></span>
                                </span>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-12">
                            <div class="form-check m-l-10">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="color" value="purple"> فاکتور ثبت شده
                                    <span class="form-check-sign">
                                     <span class="check"></span>
                                </span>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-12">
                            <div class="form-check m-l-10">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="color" value="purple"> فاکتور تایید شده
                                    <span class="form-check-sign">
                                     <span class="check"></span>
                                </span>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-12">
                            <div class="form-check m-l-10">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="color" value="purple"> فاکتور تحویل داده شده
                                    <span class="form-check-sign">
                                     <span class="check"></span>
                                </span>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-12">
                            <div class="form-check m-l-10">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="color" value="purple"> فاکتور لفو شده
                                    <span class="form-check-sign">
                                     <span class="check"></span>
                                </span>
                                </label>
                            </div>
                        </div>
                    @elseif($status == 2)
                        <div class="col-sm-6 col-lg-12">
                            <div class="form-check m-l-10">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="color" value="purple">تمام دسته بندی ها
                                    <span class="form-check-sign">
                                     <span class="check"></span>
                                </span>
                                </label>
                            </div>
                        </div><div class="col-sm-6 col-lg-12">
                            <div class="form-check m-l-10">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="color" value="purple"> دسته بندی های فعال
                                    <span class="form-check-sign">
                                     <span class="check"></span>
                                </span>
                                </label>
                            </div>
                        </div><div class="col-sm-6 col-lg-12">
                            <div class="form-check m-l-10">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="color" value="purple">   دسته بندی های غیر فعال
                                    <span class="form-check-sign">
                                     <span class="check"></span>
                                </span>
                                </label>
                            </div>
                        </div>
                    @elseif($status == 4)
                        <div class="row">
                            <div class="col-5">
                                <div class="col-sm-12 col-lg-12">
                                    <div class="form-check m-l-10">
                                        <label wire:click="get_users('all')" class="form-check-label">
                                            <input {{$fillter_user== 'all' ? 'selected' : ''}} class="form-check-input" type="radio" name="user" value="all"> همه کاربران
                                            <span class="form-check-sign">
                                     <span class="check"></span>
                                </span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-lg-12">
                                    <div class="form-check m-l-10">
                                        <label wire:click="get_users('select')" class="form-check-label">
                                            <input  {{$fillter_user== 'a' ? 'select' : ''}} class="form-check-input" type="radio" name="user" value="select">کاربر خاص
                                            <span class="form-check-sign">
                                     <span class="check"></span>
                                </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-7">
                                @if($users ?? 0)
                                    <div style="max-height: 200px;overflow-y: auto">
                                        <table class="table table-striped" >
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>نام کابر</th>
                                                <th>انتخاب</th>

                                            </tr>
                                            </thead>
                                            <tbody >
                                            @php($counter=1)
                                            @foreach($users ?? [] as $key => $item)
                                                <tr >
                                                    <th scope="row">{{$counter}}</th>
                                                    <td >{{$item}}</td>
                                                    <td > <div class="col-sm-6 col-lg-3">
                                                            <div class="form-check m-l-10">
                                                                <label class="form-check-label">
                                                                    <input wire:model="selectedUser.{{$key}}" class="form-check-input" type="checkbox" value="{{$key}}">
                                                                    <span class="form-check-sign">
                                                                    <span class="check"></span>
                                                                </span>
                                                                </label>
                                                            </div>
                                                        </div></td>

                                                </tr>
                                                @php($counter++)
                                            @endforeach

                                            </tbody>

                                        </table>

                                    </div>

                                @endif

                            </div>
                        </div>

                    @endif
                    <button wire:click="fillter()" class="btn-hover color-7">دکمه</button>

                </div>
            </div>
            <div class="d-flex">
                <button wire:click="set_status(1)" type="button"
                        class="{{$status == 1 ?'btn btn-success waves-effect' : 'btn btn-outline-primary'}} "
                        style="border-bottom-right-radius: 25px;border-top-right-radius: 25px">فاکتورها
                </button>

                <button wire:click="set_status(2)" type="button"
                        class="{{$status == 2 ?'btn btn-success waves-effect' : 'btn btn-outline-primary'}} " س>دسته
                    بندی ها
                </button>

                <button wire:click="set_status(3)" type="button"
                        class="{{$status == 3 ?'btn btn-success waves-effect' : 'btn btn-outline-primary'}} " س>محصولات
                </button>

                <button wire:click="set_status(4)" type="button"
                        class="{{$status == 4 ?'btn btn-success waves-effect' : 'btn btn-outline-primary'}} " س>کاربران
                </button>

                <button wire:click="set_status(5)" type="button"
                        class="{{$status == 5 ?'btn btn-success waves-effect' : 'btn btn-outline-primary'}} "
                        style="border-bottom-left-radius: 25px;border-top-left-radius: 25px">پیام های جدید
                </button>

            </div>
            <hr>
            @if($status == 1)
                <div class="row">


                    <div class="col-lg-3 col-sm-6">
                        <div class="info-box7 l-bg-green order-info-box7">
                            <div class="info-box7-block">
                                <h4 class="m-b-20">سفارشات دریافت شده</h4>
                                <h2 class="text-right"><i
                                        class="fas fa-cart-plus pull-left"></i><span>{{\App\Models\Invoice::count()}}</span>
                                </h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6">
                        <div class="info-box7 l-bg-purple order-info-box7">
                            <div class="info-box7-block">
                                <h4 class="m-b-20">سفارشات تکمیل شده</h4>
                                <h2 class="text-right"><i
                                        class="fas fa-business-time pull-left"></i><span>{{\App\Models\Invoice::where('status',2)->count()}}</span>
                                </h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6">
                        <div class="info-box7 l-bg-orange order-info-box7">
                            <div class="info-box7-block">
                                <h4 class="m-b-20">سفارشات جدید</h4>
                                <h2 class="text-right"><i
                                        class="fas fa-chart-line pull-left"></i><span>{{\App\Models\Invoice::where('status',1)->count()}}</span>
                                </h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6">
                        <div class="info-box7 l-bg-cyan order-info-box7">
                            <div class="info-box7-block">
                                <h4 class="m-b-20">مجموع درآمد</h4>
                                <h2 class="text-right"><i
                                        class="fas fa-dollar-sign pull-left"></i><span>{{number_format( \App\Models\Invoice::where('status',3)->sum('price'))}}</span>
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>

            @elseif($status == 2)
                <div class="row">


                    <div class="col-lg-4 col-sm-6">
                        <div class="info-box7 l-bg-green order-info-box7">
                            <div class="info-box7-block">
                                <h4 class="m-b-20">دسته بندی ها</h4>
                                <h2 class="text-right"><i
                                        class="fas fa-cart-plus pull-left"></i><span>{{\App\Models\Category::count()}}</span>
                                </h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-6">
                        <div class="info-box7 l-bg-purple order-info-box7">
                            <div class="info-box7-block">
                                <h4 class="m-b-20">دسته بندی ها فعال</h4>
                                <h2 class="text-right"><i
                                        class="fas fa-business-time pull-left"></i><span>{{\App\Models\Category::where('status',2)->count()}}</span>
                                </h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-6">
                        <div class="info-box7 l-bg-orange order-info-box7">
                            <div class="info-box7-block">
                                <h4 class="m-b-20">دسته بندی ها غیر فعال </h4>
                                <h2 class="text-right"><i
                                        class="fas fa-chart-line pull-left"></i><span>{{\App\Models\Category::where('status',1)->count()}}</span>
                                </h2>
                            </div>
                        </div>
                    </div>

                </div>

            @elseif($status == 3)
                <div class="row">


                    <div class="col-lg-4 col-sm-6">
                        <div class="info-box7 l-bg-green order-info-box7">
                            <div class="info-box7-block">
                                <h4 class="m-b-20">محصولات ها</h4>
                                <h2 class="text-right"><i
                                        class="fas fa-cart-plus pull-left"></i><span>{{\App\Models\Product::count()}}</span>
                                </h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-6">
                        <div class="info-box7 l-bg-purple order-info-box7">
                            <div class="info-box7-block">
                                <h4 class="m-b-20">محصولات فعال</h4>
                                <h2 class="text-right"><i
                                        class="fas fa-business-time pull-left"></i><span>{{\App\Models\Product::where('status',2)->count()}}</span>
                                </h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-6">
                        <div class="info-box7 l-bg-orange order-info-box7">
                            <div class="info-box7-block">
                                <h4 class="m-b-20">محصولات غیر فعال </h4>
                                <h2 class="text-right"><i
                                        class="fas fa-chart-line pull-left"></i><span>{{\App\Models\Product::where('status',1)->count()}}</span>
                                </h2>
                            </div>
                        </div>
                    </div>

                </div>

            @elseif($status == 4)
                <div class="row">


                    <div class="col-lg-4 col-sm-6">
                        <div class="info-box7 l-bg-green order-info-box7">
                            <div class="info-box7-block">
                                <h4 class="m-b-20">کاربران</h4>
                                <h2 class="text-right"><i
                                        class="fas fa-cart-plus pull-left"></i><span>{{\App\Models\User::count()}}</span>
                                </h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-6">
                        <div class="info-box7 l-bg-purple order-info-box7">
                            <div class="info-box7-block">
                                <h4 class="m-b-20">کاربران تایید نشده</h4>
                                <h2 class="text-right"><i
                                        class="fas fa-business-time pull-left"></i><span>{{\App\Models\User::whereIn('status',[2,1])->count()}}</span>
                                </h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-6">
                        <div class="info-box7 l-bg-orange order-info-box7">
                            <div class="info-box7-block">
                                <h4 class="m-b-20">کاربران تایید شده</h4>
                                <h2 class="text-right"><i
                                        class="fas fa-chart-line pull-left"></i><span>{{\App\Models\User::where('status',3)->count()}}</span>
                                </h2>
                            </div>
                        </div>
                    </div>

                </div>

            @elseif($status == 5)
                <div class="row">


                    <div class="col-lg-3 col-sm-6">
                        <div class="info-box7 l-bg-green order-info-box7">
                            <div class="info-box7-block">
                                <h4 class="m-b-20">سفارشات دریافت شده</h4>
                                <h2 class="text-right"><i
                                        class="fas fa-cart-plus pull-left"></i><span>{{\App\Models\Invoice::count()}}</span>
                                </h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6">
                        <div class="info-box7 l-bg-purple order-info-box7">
                            <div class="info-box7-block">
                                <h4 class="m-b-20">سفارشات تکمیل شده</h4>
                                <h2 class="text-right"><i
                                        class="fas fa-business-time pull-left"></i><span>{{\App\Models\Invoice::where('status',2)->count()}}</span>
                                </h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6">
                        <div class="info-box7 l-bg-orange order-info-box7">
                            <div class="info-box7-block">
                                <h4 class="m-b-20">سفارشات جدید</h4>
                                <h2 class="text-right"><i
                                        class="fas fa-chart-line pull-left"></i><span>{{\App\Models\Invoice::where('status',1)->count()}}</span>
                                </h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6">
                        <div class="info-box7 l-bg-cyan order-info-box7">
                            <div class="info-box7-block">
                                <h4 class="m-b-20">مجموع درآمد</h4>
                                <h2 class="text-right"><i
                                        class="fas fa-dollar-sign pull-left"></i><span>{{number_format( \App\Models\Invoice::where('status',1)->sum('price'))}}</span>
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>

            @endif
        </div>
    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>

    document.addEventListener('livewire:init', () => {
        Livewire.on('created-chart', (event) => {
            var productSales = event.products;

            var productSales = event.products;

            var options = {
                series: productSales.totals,  // داده‌های مجموع سفارشات
                chart: {
                    width: 380,
                    type: 'pie',
                },
                labels: productSales.names,  // نام محصولات
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 200
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]
            };

            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();

        });
    });

</script>
