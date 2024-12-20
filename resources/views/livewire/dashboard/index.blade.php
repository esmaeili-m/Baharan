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
                            <label  wire:click="set_status(1)" class="form-check-label">
                                <input {{$status == 1 ? 'checked' : ''}} class="form-check-input" type="radio" name="status" value="1"> سفارشات
                                <span class="form-check-sign">
                                     <span class="check"></span>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-12">
                        <div class="form-check m-l-10">
                            <label  wire:click="set_status(2)" class="form-check-label">
                                <input {{$status == 2 ? 'checked' : ''}} class="form-check-input" type="radio" name="status" value="2"> محصولات
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-12">
                        <div class="form-check m-l-10">
                            <label  wire:click="set_status(4)" class="form-check-label">
                                <input {{$status == 4 ? 'checked' : ''}} class="form-check-input" type="radio" name="status" value="4"> کاربران
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

                            @if($status == 2)
                                <div style="max-height: 200px;overflow-y: auto">
                                    <table class="table table-striped" >
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>نام محصول</th>
                                            <th>انتخاب</th>

                                        </tr>
                                        </thead>
                                        <tbody >

                                        @php($counter=1)
                                        <th scope="row">{{$counter}}</th>
                                        <td>همه</td>
                                        <td>
                                            <div class="col-sm-6 col-lg-3">
                                                <div class="form-check m-l-10">
                                                    <label class="form-check-label">
                                                        <input wire:model="selectedProduct.all" class="form-check-input" type="checkbox" value="all">
                                                        <span class="form-check-sign">
                                                                        <span class="check"></span>
                                                             </span>
                                                    </label>
                                                </div>
                                            </div>
                                        </td>
                                        @foreach(\App\Models\Product::pluck('name','id') ?? [] as $key => $item)
                                            <tr >
                                                <th scope="row">{{$counter}}</th>
                                                <td >{{$item}}</td>
                                                <td >
                                                    <div class="col-sm-6 col-lg-3">
                                                        <div class="form-check m-l-10">
                                                            <label class="form-check-label">
                                                                <input wire:model="selectedProduct.{{$key}}" class="form-check-input" type="checkbox" value="{{$key}}">
                                                                <span class="form-check-sign">
                                                                    <span class="check"></span>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @php($counter++)
                                        @endforeach

                                        </tbody>

                                    </table>

                                </div>

                            @elseif($status == 4)
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
                                            <th scope="row">{{$counter}}</th>
                                            <td>همه</td>
                                            <td>
                                                <div class="col-sm-6 col-lg-3">
                                                    <div class="form-check m-l-10">
                                                        <label class="form-check-label">
                                                            <input wire:model="selectedUser.all" class="form-check-input" type="checkbox" value="all">
                                                            <span class="form-check-sign">
                                                                        <span class="check"></span>
                                                             </span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </td>
                                        @foreach(\App\Models\User::pluck('name','id') ?? [] as $key => $item)
                                            <tr >
                                                <th scope="row">{{$counter}}</th>
                                                <td >{{$item}}</td>
                                                <td >
                                                    <div class="col-sm-6 col-lg-3">
                                                        <div class="form-check m-l-10">
                                                            <label class="form-check-label">
                                                                <input wire:model="selectedUser.{{$key}}" class="form-check-input" type="checkbox" value="{{$key}}">
                                                                <span class="form-check-sign">
                                                                    <span class="check"></span>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @php($counter++)
                                        @endforeach

                                        </tbody>

                                    </table>

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
                <div class="col-2 d-flex justify-content-center align-items-center" >
                    <button wire:click="fillter()" class="btn-hover color-7">جستجو</button>
                </div>
            <hr>

        </div>

            @if($status == 1 && $invoice)
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="info-box7 l-bg-green order-info-box7">
                            <div class="info-box7-block">
                                <h4 class="m-b-20">سفارشات دریافت شده</h4>
                                <h2 class="text-right"><i
                                        class="fas fa-cart-plus pull-left"></i><span>{{$invoice->count()}}</span>
                                </h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="info-box7 l-bg-purple order-info-box7">
                            <div class="info-box7-block">
                                <h4 class="m-b-20">سفارشات تکمیل شده</h4>
                                <h2 class="text-right"><i
                                        class="fas fa-business-time pull-left"></i><span>{{$invoice->where('status',2)->count()}}</span>
                                </h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="info-box7 l-bg-orange order-info-box7">
                            <div class="info-box7-block">
                                <h4 class="m-b-20">سفارشات جدید</h4>
                                <h2 class="text-right"><i
                                        class="fas fa-chart-line pull-left"></i><span>{{$invoice->where('status',1)->count()}}</span>
                                </h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="info-box7 l-bg-cyan order-info-box7">
                            <div class="info-box7-block">
                                <h4 class="m-b-20">مجموع درآمد</h4>
                                <h2 class="text-right"><i
                                        class="fas fa-dollar-sign pull-left"></i><span>{{number_format( $invoice->sum('price'))}}</span>
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif($status == 2 )
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
            let barChart = null;
            let pieChart = null;

            Livewire.on('created-chart', (event) => {
                var productSales = event.products;

                if (barChart !== null) {
                    barChart.destroy();
                }
                if (pieChart !== null) {
                    pieChart.destroy();
                }

                var barOptions = {
                    series: [{
                        data: productSales.totals
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
