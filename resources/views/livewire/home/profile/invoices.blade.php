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
                @foreach($invoice_select->products ?? [] as $product)
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
            <hr>
            <p id="total">جمع کل سفارش: {{ $this->getTotalPrice() }} تومان</p>
        @else
            <div class="header">
                <p>لیست فاکتورها</p>
                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-control-custom" >
                            <input id="barcode" wire:model.lazy="barcode" class="" placeholder="شماره فاکتور">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-control-custom" >
                            <input wire:model.lazy="from" id="from" type="text" data-jdp placeholder="از تاریخ" />

                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-control-custom" >
                            <input wire:model.lazy="to" id="to" type="text" data-jdp placeholder="تا تاریخ ">
                        </div>
                    </div>
                    <div class="col-lg-1">
                        <button wire:click="search_invoice()" class="btn w-100 btn-custom-primary-submit p-3 mt-1"><i class="fa fa-search"></i></button>
                    </div>.

                </div>
            </div>
        <hr>
            <table class="table table-striped invoices">
                <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">شماره فاکتور</th>
                    <th class="text-center">محصولات</th>
                    <th class="text-center">قیمت</th>
                    <th class="text-center">وضعیت سفارش</th>
                    <th class="text-center">تاریخ ثبت سفارش</th>
                    <th class="text-center">جزئیات</th>
                </tr>
                </thead>
                <tbody>
                @php($counter=1)
                @foreach($invoices as $invoice)
                    <tr>
                        <td class="text-center align-middle">{{$counter}}</td>
                        <td class="text-center align-middle"><p>BIN{{$invoice->barcode}}</p></td>
                        <td class="text-center align-middle">
                            @foreach($invoice->products ?? [] as $product)
                                <p class="">{{$product['name']}} -> {{$product['order']}} {{$type[$product['type']] ?? 'UNKNOW'}}</p>
                            @endforeach

                        </td>
                        <td class="text-center align-middle">
                            <p>{{number_format($invoice->price)}} تومان</p>
                        </td>
                        <td class="text-center align-middle">
                            @if($invoice->status == 0)
                                <span class="badge bg-warning text-dark">ثبت شده</span>
                            @else
                                <span class="badge bg-success">تحویل داده شده</span>
                            @endif
                        </td>
                        <td class="text-center align-middle">
                            <p>{{verta($invoice->crated_at)->format('H:i:s Y-m-d')}}</p>
                        </td>
                        <td class="text-center align-middle">
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
