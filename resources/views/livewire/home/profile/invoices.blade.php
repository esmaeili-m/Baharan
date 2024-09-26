<div>
    <div class="c-shadow p-5 content-profile">
        @if($invoice_select)
            <table class="table table-striped invoices">
                <thead>
                <tr>
                    <th>#</th>
                    <th>بارکد</th>
                    <th>محصولات</th>
                    <th>قیمت</th>
                    <th>وضعیت سفارش</th>
                    <th>تاریخ ثبت سفارش</th>
                </tr>
                </thead>
                <tbody>
                @php($counter=1)
                @foreach($invoice_select as $test)
                    <tr>
                        <td>{{$counter}}</td>
                        <td>BN{{$item->barcode}}</td>
                        <td>
                            @foreach($item->products ?? [] as $product)
                                <p class="">{{$product['name']}} -> {{$product['order']}}</p>
                            @endforeach

                        </td>
                        <td>
                            {{number_format($item->price)}}
                        </td>
                        <td>
                            @if($invoice->status == 0)
                                <span class="badge bg-warning text-dark">ثبت شده</span>
                            @else
                                <span class="badge bg-success">تحویل داده شده</span>
                            @endif
                        </td>
                        <td>
                            {{verta($item->crated_at)->format('H:i:s Y-m-d')}}
                        </td>

                    </tr>
                    @php($counter++)
                @endforeach

                </tbody>
            </table>

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
                        <td>BN{{$invoice->barcode}}</td>
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
