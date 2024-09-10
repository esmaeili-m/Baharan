<div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <input type="file" id="file" wire:model="images" multiple class="d-none">
                    <button id="file-btn" type="button" class="btn-hover btn-border-radius color-7 border-radius-custom">افزودن تصاویر</button>
                </div>
                <div class="body table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>تصویر</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody id="sortable-list">
                        @php
                            $counter =1;
                        @endphp
                        @foreach($data ?? [] as $item)
                            <tr data-id="{{$item->id}}" class="sortable-item">
                                <th scope="row">{{$counter}}</th>
                                <td>
                                    <img src="{{asset($item->image)}}" width="80" height="80" alt="portfolio">
                                </td>

                                <td>
                                    <button wire:click="delete({{$item->id}})" class="btn tblActnBtn">
                                        <i class="material-icons">delete</i>
                                    </button>
                                </td>
                            </tr>
                            @php($counter++)
                        @endforeach

                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        document.getElementById('file-btn').addEventListener('click', function() {
            document.getElementById('file').click();
        });
    </script>
@endpush

