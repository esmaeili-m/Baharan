<div>
    @push('styles')
        <link rel="stylesheet" href="{{asset('home/login/datepicker/jalalidatepicker.min.css')}}">
    @endpush
    <div class="card p-2">

        <div class="col-12">
            <div class="row">
                <div class="col-2">
                    <p>متغییر</p>
                    <div class="col-sm-6 col-lg-12">
                        <div class="form-check m-l-10">
                            <label wire:click="set_status(1)" class="form-check-label">
                                <input class="form-check-input" type="radio" name="status" value="1"> فاکتورها
                                <span class="form-check-sign">
                                     <span class="check"></span>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-12">
                        <div class="form-check m-l-10">
                            <label wire:click="set_status(2)" class="form-check-label">
                                <input class="form-check-input" type="radio" name="status" value="2"> محصولات
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-12">
                        <div class="form-check m-l-10">
                            <label wire:click="set_status(3)" class="form-check-label">
                                <input class="form-check-input" type="radio" name="status" value="3"> دسته بندی
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-12">
                        <div class="form-check m-l-10">
                            <label wire:click="set_status(4)" class="form-check-label">
                                <input  class="form-check-input" type="radio" name="status" value="4"> کاربران
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div>
                    </div>

                </div>
                <div class="col-6">
                         <p>فیلتر</p>
                        <div class="mx-10">
                            @if($status == 1)
                                <div class="col-sm-6 col-lg-6">
                                    <div class="form-check m-l-10">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="color" value="purple">تمام فاکتور ها
                                            <span class="form-check-sign">
                                                <span class="check"></span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-6">
                                    <div class="form-check m-l-10">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="color" value="purple"> فاکتور ثبت شده
                                            <span class="form-check-sign">
                                     <span class="check"></span>
                                </span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-6">
                                    <div class="form-check m-l-10">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="color" value="purple"> فاکتور تایید شده
                                            <span class="form-check-sign">
                                     <span class="check"></span>
                                </span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-6">
                                    <div class="form-check m-l-10">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="color" value="purple"> فاکتور تحویل داده شده
                                            <span class="form-check-sign">
                                     <span class="check"></span>
                                </span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-6">
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
                                <div class="col-sm-6 col-lg-6">
                                    <div class="form-check m-l-10">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="color" value="purple">تمام دسته بندی ها
                                            <span class="form-check-sign">
                                     <span class="check"></span>
                                </span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-6">
                                    <div class="form-check m-l-10">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="color" value="purple"> دسته بندی های فعال
                                            <span class="form-check-sign">
                                     <span class="check"></span>
                                </span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-6">
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



                        </div>
            </div>
                <div class="row">
                    <div class="col-sm-6 col-lg-12">
                        <p>تاریخ</p>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text"
                                       data-jdp
                                       wire:model.defer="from"
                                       class="form-control"
                                       placeholder="از تاریخ">
                            </div>
                        </div>
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
                </div>
                <div class="col-2">
                    <button wire:click="fillter()" class="btn-hover color-7">جستجو</button>

                </div>
            <hr>

        </div>

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
    <div class="row " wire:ignore>
        <div class="col-6 ">
            <div class="card">

            <div  id="pie-chart" ></div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div  id="bar-chart" ></div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
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
    <script>
        document.addEventListener('livewire:init', () => {
            let barChart = null; // برای نگه‌داشتن چارت میله‌ای قبلی
            let pieChart = null; // برای نگه‌داشتن چارت دایره‌ای قبلی

            Livewire.on('created-chart', (event) => {
                var productSales = event.products;

                // اگر چارت‌های قبلی وجود داشتند، آنها را تخریب کن
                if (barChart !== null) {
                    barChart.destroy();
                }
                if (pieChart !== null) {
                    pieChart.destroy();
                }

                // چارت اول (میله‌ای افقی)
                var barOptions = {
                    series: [{
                        data: productSales.totals // استفاده از داده‌های پویا
                    }],
                    chart: {
                        type: 'bar',
                        height: 350
                    },
                    plotOptions: {
                        bar: {
                            borderRadius: 4,
                            borderRadiusApplication: 'end',
                            horizontal: true,
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    xaxis: {
                        categories: productSales.names // استفاده از نام‌های پویا
                    }
                };

                barChart = new ApexCharts(document.querySelector("#bar-chart"), barOptions);
                barChart.render();

                // چارت دوم (دایره‌ای)
                var pieOptions = {
                    series: productSales.totals, // داده‌های فروش
                    chart: {
                        width: 380,
                        type: 'pie',
                    },
                    labels: productSales.names, // استفاده از نام‌های پویا
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

                pieChart = new ApexCharts(document.querySelector("#pie-chart"), pieOptions);
                pieChart.render();
            });
        });

    </script>

@endpush
