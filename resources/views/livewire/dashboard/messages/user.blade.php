<div>
    @push('styles')
        <link href="{{asset('dashboard/js/bundles/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.css')}}" rel="stylesheet" />
        <link href="{{asset('dashboard/js/bundles/multiselect/css/multi-select.css')}}" rel="stylesheet">
    @endpush
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
            <div class="card">
                <div class="body">
                    <div id="plist" class="people-list">
                        <div class="form-line m-b-15">
                            <input type="text" class="form-control" placeholder="جستجو..." />
                        </div>
                        <div class="tab-content">
                            <div id="chat_user">
                                <ul class="chat-list list-unstyled m-b-0">
                                    @foreach($user->chats ?? [] as $item)
                                        <li wire:click="set_chat({{$item->id}})" wire:key="chat_id_{{$item->id}}"
                                            class="clearfix {{request()->get('chat_id') == $item->id ? 'active' : ''}} {{($chat->id ?? 0 )== $item->id ? 'active' : ''}}">
                                            <img src="{{asset($item->user->avatar ?? '/home/images/user.png')}}" alt="avatar">
                                            <div class="about">
                                                <div class="name">{{$item->title}}</div>
                                                @if($item->messages->count() > 0)
                                                    <div class="status">
                                                        <i class="material-icons offline">fiber_manual_record</i>
                                                        {{ verta($item->messages->sortByDesc('id')->first()['created_at'])->formatDifference() }}</div>
                                                @else
                                                    <div class="status">
                                                        <i class="material-icons offline">fiber_manual_record</i>
                                                        {{ verta($item->created_at)->formatDifference() }}</div>
                                                @endif

                                            </div>
                                        </li>
                                    @endforeach


                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
            @if($chat)
                <div class="card">
                    <div class="chat">
                        <div class="chat-header clearfix">
                            <img src="{{asset($chat->user->avatar ?? '/home/images/user.png')}}" alt="avatar">
                            <div class="chat-about">
                                <div class="chat-with"> {{$chat->user->name}}</div>
                                <div class="chat-num-messages">{{$chat->messages->where('seen',0)->count()}} پیام جدید</div>
                            </div>
                        </div>
                        <div class="chat-history" id="chat-conversation">
                            <ul>
                                @foreach($chat->messages ?? [] as $message)
                                    @if($message->sender->role_id == 2)
                                        <li class="clearfix">
                                            <div class="message-data text-right">
                                            <span class="message-data-time">
                                                {{ verta($message->created_at)->formatDifference() }}
                                            </span>
                                                <span class="message-data-name">{{$message->sender->name}}</span>
                                            </div>
                                            <div class="message other-message float-right"> {{$message->message ?? ''}} </div>
                                        </li>

                                    @else
                                        <li>
                                            <div class="message-data">
                                                <span class="message-data-name">{{$message->sender->name}} </span>
                                                <span class="message-data-time">  {{ verta($message->created_at)->formatDifference() }}</span>
                                            </div>
                                            <div class="message my-message">
                                                <p>{{$message->message ?? ''}}</p>
                                                <div class="row">
                                                </div>
                                            </div>
                                        </li>

                                    @endif
                                @endforeach
                            </ul>
                        </div>
                        <div class="chat-message clearfix">
                            <div class="form-group">
                                <div class="form-line">
                                    <input wire:model.laze="message" type="text" class="form-control" placeholder="متن را اینجا وارد کنید .." />
                                </div>
                            </div>
                            <div class="chat-upload">
{{--                                <button type="button" class="btn btn-circle waves-effect waves-circle waves-float bg-deep-orange">--}}
{{--                                    <i class="material-icons">attach_file</i>--}}
{{--                                </button>--}}
                                <button wire:click="save()" type="button" class="btn btn-circle waves-effect waves-circle waves-float bg-deep-orange">
                                    <i class="material-icons">send</i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            @endif
        </div>
    </div>
</div>
@push('scripts')
    <script src="{{asset('dashboard/js/form.min.js')}}"></script>
    <script src="{{asset('dashboard/js/pages/apps/chat.js')}}"></script>
    <script src="{{asset('dashboard/js/bundles/multiselect/js/jquery.multi-select.js')}}"></script>
    <script src="{{asset('dashboard/js/bundles/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.js')}}"></script>
    <script src="{{asset('dashboard/js/pages/forms/advanced-form-elements.js')}}"></script>
@endpush

