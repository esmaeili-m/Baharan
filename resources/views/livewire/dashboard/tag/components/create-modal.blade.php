<div >
    <div   class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
         aria-labelledby="formModal" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModal">افزودن تگ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit="save()">
                        <label for="email_address1"> عنوان تگ</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" wire:model.lazy="title" id="email_address1" class="form-control "
                                       placeholder="عنوان تگ خود را وارد کنید">
                                @error('title')
                                    <p class="text-danger mt-1">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <label for="password">لینک</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" wire:model.lazy="link" id="password" class="form-control"
                                       placeholder="لینک خود را وارد کنید">
                                @error('link')
                                <p class="text-danger mt-1">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button  type="submit" class="btn btn-info waves-effect">ذخیره</button>
                            <button wire:click="close" id="close_modal" type="button" class="btn btn-danger waves-effect"
                                    data-dismiss="modal">لغو</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('close_modal', (event) => {
                document.getElementById('close_modal').click();
            });
        });
    </script>
    <script>


    </script>
</div>
