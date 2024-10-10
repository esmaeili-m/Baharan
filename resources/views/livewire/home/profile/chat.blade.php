<div>

    <div class="c-shadow p-lg-5 p-sm-1 content-profile">
        <div class="row">
            <div class="col-lg-3 col-sm-12">
                <div class="mt-2 p-2" style="border: 2px dashed #002aff;border-radius: 10px">
                    <div class="w-100 p-2 justify-content-center align-content-center" style="border-radius: 8px">
                        <button wire:click="new_chat()" style="border-radius: 8px;background-color: #8bb7f6;color: #FFFFFF" class="mb-3 w-100 btn-shadow btn btn-light-primary">
                            ایجاد پیام</button>
                        @foreach($chats ?? [] as $item)
                            <button wire:click="set_chat({{$item->id}})"
                                    style="border-radius: 8px"
                                    class="{{$item->messages_seen_count > 0 ? 'message-blink' : ''}} mb-4 w-100 btn-shadow btn btn-light-primary">
                                {{$item->title}}
                            </button>
                        @endforeach

                    </div>
                </div>
            </div>
            @if($form_chat)
                <div class="col-lg-9 col-sm-12">
                    <div class="mt-2 p-lg-5 p-sm-1" style="border: 2px dashed #002aff;border-radius: 10px">
                        <div class="">
                            <div class="form-field d-flex align-items-center @error('chat_message') invalid-form @enderror">
                                <input type="text" wire:model.lazy="chat_message" class="" placeholder="عنوان پیام*" >
                                <label class=" p-2 mb-2 mt-2 text-center" style="">عنوان پیام</label>
                                @error('chat_message')
                                <span style="font-size: 27px;color: red" class="fa fa-times-circle error-message show"
                                      aria-hidden="true"></span>
                                @enderror

                            </div>
                            @error('chat_message')
                            <p style="font-size: 12px" class="me-2 text-danger">{{$message}}</p>
                            @enderror
                            <button wire:click="save_chat()"
                                    style="border-radius: 8px;background-color: #8bb7f6;color: #FFFFFF"
                                    class="mb-3  c-shadow btn btn-light-primary">
                                ثبت پیام</button>
                        </div>
                    </div>
                </div>
            @endif
            @if($chat)
                <div class="col-lg-9 col-sm-12">
                    <div class="mt-2 p-4" style="border: 2px dashed #002aff;border-radius: 10px">
                        <button
                                style="border-radius: 8px;color: #FFFFFF"
                                class="mb-3  btn-shadow btn bg-light-primary">
                            {{$chat->title}}</button>
                        <div class="c-shadow chat-page btn-shadow p-3">
                            @foreach($chat->messages ?? [] as $message)
                                @if($message->sender_id == auth()->user()->id)
                                    <div class="message-container " style="text-align: right;">
                                        <div class="message btn-shadow bg-light-primary text-white p-2 mb-4 btn-shadow" style="">
                                            <p class="mb-1">{{ $message->message }}</p>
                                            <div class="d-flex">
                                                <p class="mb-0" style="font-size: 10px">{{ verta($message->created_at)->format('H:i') }}</p>
                                                <div style="margin-right: auto">
                                                    @if($message->seen)
                                                        <i style="font-size: 10px" class="fa fa-check"></i>
                                                    @endif
                                                    <i style="font-size: 10px" class="fa fa-check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="message-container" style="text-align: left;">
                                        <div class="message bg-light text-dark p-2 mb-4 btn-shadow" >
                                            <p class="mb-1">{{ $message->message }}</p>
                                            <div class="d-flex">
                                                <p class="mb-0 text-muted" style="font-size: 10px">{{ verta($message->created_at)->format('H:i') }}</p>
                                                <div style="margin-right: auto">
                                                    @if($message->seen)
                                                        <i style="font-size: 10px" class="fa fa-check"></i>
                                                    @endif
                                                    <i style="font-size: 10px" class="fa fa-check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>

                        <div class="mt-3">
                            <div class="form-field d-flex align-items-center @error('message') invalid-form @enderror">
                                <input type="text" wire:model.lazy="message" class="" placeholder="عنوان پیام*" >
                                <label class=" p-2 mb-2 mt-2 text-center d-none d-md-block" style="">عنوان پیام</label>
                                @error('message')
                                <span style="font-size: 27px;color: red" class="fa fa-times-circle error-message show"
                                      aria-hidden="true"></span>
                                @enderror

                            </div>
                            @error('message')
                            <p style="font-size: 12px" class="me-2 text-danger">{{$message}}</p>
                            @enderror
                            <button wire:click="save_message()"
                                    style="border-radius: 8px;color: white"
                                    class="mb-3  c-shadow btn bg-light-primary btn-shadow">
                                ثبت پیام</button>
                        </div>

                    </div>
                </div>

            @endif
        </div>

    </div>
</div>
