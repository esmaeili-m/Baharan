<div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <a href="{{route('invoice.list')}}">
                        <button class="btn-hover btn-border-radius color-8 border-radius-custom">بازگشت</button></a>

                </div>
                <div class="body table-responsive">
                    <div class="header-details-invoice d-flex">
                        <p class="mb-0 mx-2"> فاکتور BIN{{$invoice->barcode}}</p>
                        <span class="mx-2"> / </span>
                        @if($invoice->status == 1)
                            <p  type="button" class="text-warning">ثبت شده</p>
                        @elseif($invoice->status == 2)
                            <p  type="button" class="text-success">تحویل داده شده</p>
                        @else
                            <p  type="button" class="text-danger ">لفو شده</p>
                        @endif
                    </div>
                    <i class="fa fa-calendar mx-2 mt-3"></i>
                    <span class="text-muted mt-3" style="font-size: 15px">
    {{ verta($invoice->crated_at)->formatWord('l') }} {{ verta($invoice->crated_at)->format('d F Y') }}، {{ verta($invoice->crated_at)->format('h:i A') }}

                </span>
                    <hr>
                    <div class="table-responsive d-none d-md-block">

                        <table class="table table-striped invoices">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">تصویر محصول</th>
                                <th class="text-center">نام محصول</th>
                                <th class="text-center">قیمت</th>
                                <th class="text-center">تعداد سفارش</th>
                                <th class="text-center">جمع</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($counter=1)
                            @foreach($invoice->products ?? [] as $product)
                                <tr>
                                    <td style="font-size: 15px" class="text-center align-middle">{{$counter}}</td>
                                    <td class="text-center align-middle">
                                        <img style="border-radius: 5px;box-shadow: 3px 3px 3px #b1b1b1, -3px -3px 3px #fff;" width="100px" height="60px" src="{{$product['image'] ?? '/home/images/category.jpg'}}">
                                    </td>
                                    <td class="text-center align-middle">
                                        <p style="font-size: 15px" class="mb-0">{{$product['name']}}</p>
                                    </td>
                                    <td class="text-center align-middle">
                                        <p class="mb-0" style="font-size: 15px"> {{number_format($product['price'])}} تومان</p>
                                    </td>
                                    <td class="text-center align-middle">
                                        <p class="mb-0" style="font-size: 15px">{{number_format($product['order'])}} {{$type[$product['type']] ?? 'UNKNOW'}}</p>
                                    </td>
                                    <td class="text-center align-middle">
                                        <p style="font-size: 15px" class="price mb-0">{{number_format($product['price'] * $product['order'])}} تومان</p>
                                    </td>
                                    @php($counter+=1)
                                </tr>

                            @endforeach

                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <p id="total">جمع کل سفارش: {{ $this->getTotalPrice() }} تومان</p>
                </div>
            </div>
        </div>
    </div>
</div>


