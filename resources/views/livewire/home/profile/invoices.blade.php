<div>
    <div class="c-shadow p-5 content-profile">
        @if($invoice_select)
            <button wire:click="all_invoice" class="mb-3  btn btn-outline-primary">نمایش همه<i class="fa fa-arrow-left me-2"></i></button>
            <div class="header-details-invoice d-flex">
                <p class="mb-0 mx-2"> سفارش BIN{{$invoice_select->barcode}}</p>
                @if($invoice_select->status == 0)
                    <span class="badge bg-warning text-dark">ثبت شده</span>
                @else
                    <span class="badge bg-success">تحویل داده شده</span>
                @endif
            </div>
            <i class="fa fa-calendar mx-2"></i>
            <span class="text-muted" style="font-size: 11px">
{{ verta($invoice_select->crated_at)->formatWord('l') }} {{ verta($invoice_select->crated_at)->format('d F Y') }}، {{ verta($invoice_select->crated_at)->format('h:i A') }}

            </span>
            <hr>

            <table class="table table-striped invoices">
                <thead>
                <tr>
                    <th>#</th>
                    <th>تصویر محصول</th>
                    <th>نام محصول</th>
                    <th>قیمت</th>
                    <th>تعداد سفارش</th>
                    <th>جمع</th>
                </tr>
                </thead>
                <tbody>
                @php($counter=1)
                @foreach($invoice_select->products ?? [] as $product)
                <tr>

                        <td>{{$counter}}</td>
                        <td>
                            <img style="border-radius: 5px;box-shadow: 3px 3px 3px #b1b1b1, -3px -3px 3px #fff;" width="100px" height="60px" src="{{$product['image'] ?? '/home/images/category.jpg'}}">
                        </td>
                        <td>
                            <p class="">{{$product['name']}} </p>

                        </td>

                        <td>
                            <p class="">{{number_format($product['price'])}} </p>

                        </td>
                        <td>
                            <p class="">{{number_format($product['order'])}} </p>

                        </td>
                        <td>
                            <p class="price">{{number_format($product['price'] * $product['order'])}} </p>

                        </td>
                        @php($counter+=1)

                </tr>
                @endforeach

                </tbody>
            </table>
            <hr>
            <p id="total">جمع کل سفارش: {{ $this->getTotalPrice() }}</p>
        @else
            <table class="table table-striped invoices">
                <thead>
                <tr>
                    <th>#</th>
                    <th>بارکد</th>
                    <th>محصولات</th>
                    <th>قیمت</th>
                    <th>وضعیت سفارش</th>
                    <th>تاریخ ثبت سفارش</th>
                    <th>جزئیات</th>
                </tr>
                </thead>
                <tbody>
                @php($counter=1)
                @foreach($invoices as $invoice)
                    <tr>
                        <td>{{$counter}}</td>
                        <td>BIN{{$invoice->barcode}}</td>
                        <td>
                            @foreach($invoice->products ?? [] as $product)
                                <p class="">{{$product['name']}} -> {{$product['order']}}</p>
                            @endforeach

                        </td>
                        <td>
                            {{number_format($invoice->price)}}
                        </td>
                        <td>
                            @if($invoice->status == 0)
                                <span class="badge bg-warning text-dark">ثبت شده</span>
                            @else
                                <span class="badge bg-success">تحویل داده شده</span>
                            @endif
                        </td>
                        <td>
                            {{verta($invoice->crated_at)->format('H:i:s Y-m-d')}}
                        </td>
                        <td>
                            <a wire:click="show_invoice({{$invoice->id}})" class="text-primary" style="cursor: pointer">نمایش فاکتور</a>
                        </td>
                    </tr>
                    @php($counter++)
                @endforeach

                </tbody>
            </table>

        @endif
    </div>
</div>
