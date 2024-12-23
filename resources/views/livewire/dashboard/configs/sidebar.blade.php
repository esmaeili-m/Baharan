<div>
    <aside id="leftsidebar" class="sidebar">
        <!-- Menu -->
        <div class="menu">
            <ul class="list">
                <li>
                    <div class="sidebar-profile clearfix">
                        <div class="profile-img">
                            <img src="{{asset(auth()->user()->avatar ?? '/home/images/user.png')}}" alt="profile">
                        </div>
                        <div class="profile-info">
                            <h3>{{auth()->user()->name}}</h3>
                            <p>خوش آمدید !</p>
                        </div>
                    </div>
                </li>
                <li class="header">-- اصلی</li>

                <li  class="{{request()->routeIs('dashboard') ? 'active active_route' : ''}}">
                    <a href="{{route('dashboard')}}">
                        <i class="menu-icon ti-home"></i>
                        <span>داشبورد</span>
                    </a>
                </li>

                @can('list-categories')
                <li  class="{{request()->routeIs('category.*') ? 'active active_route' : ''}}">
                    <a href="{{route('category.list')}}">
                        <i class="menu-icon ti-list"></i>
                        <span>دسته بندی ها</span>
                    </a>
                </li>
                @endcan
                @can('list-products')

                <li  class="{{request()->routeIs('product.*') ? 'active active_route' : ''}}">
                    <a href="{{route('product.list')}}">
                        <i class="menu-icon ti-gallery"></i>
                        <span>محصولات</span>
                    </a>
                </li>
                @endcan
                @can('list-users')

                <li  class="{{request()->routeIs('user.*') ? 'active active_route' : ''}}">
                    <a href="{{route('user.list')}}">
                        <i class="menu-icon ti-user"></i>
                        <span>کاربران</span>
                    </a>
                </li>
                    @endcan
                @can('list-invoices')

                <li  class="{{request()->routeIs('invoice.*') ? 'active active_route' : ''}}">
                    <a href="{{route('invoice.list')}}">
                        <i class="menu-icon ti-list"></i>
                        <span>سفارشات</span>
                    </a>
                </li>
                        @endcan
                @can('chat')

                <li  class="{{request()->routeIs('message.*') ? 'active active_route' : ''}}">
                    <a href="{{route('message.list')}}">
                        <i class="menu-icon ti-comment-alt"></i>
                        <span>پیام ها</span>
                    </a>
                </li>
                            @endcan

                @can('list-roles')

                <li  class="{{request()->routeIs('role.*') ? 'active active_route' : ''}}">
                    <a href="{{route('role.list')}}">
                        <i class="menu-icon ti-list"></i>
                        <span>نقش ها و دسترسی ها</span>
                    </a>
                </li>
                                @endcan
                @can('setting')

                <li  class="{{request()->routeIs('setting') ? 'active active_route' : ''}}">
                    <a href="{{route('setting')}}">
                        <i class="menu-icon ti-settings"></i>
                        <span>تنظیمات سایت</span>
                    </a>
                </li>
                                    @endcan
                @can('logs')

                <li  class="{{request()->routeIs('logs') ? 'active active_route' : ''}}">
                    <a href="{{route('logs')}}">
                        <i class="menu-icon ti-list"></i>
                        <span>لاگ</span>
                    </a>
                </li>
                                        @endcan
{{--                <li  class="{{request()->routeIs('post.*') ? 'active active_route' : ''}}">--}}
{{--                    <a href="{{route('post.list')}}">--}}
{{--                        <i class="menu-icon ti-image"></i>--}}
{{--                        <span>پست ها</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li  class="{{request()->routeIs('article.*') ? 'active active_route' : ''}}">--}}
{{--                    <a href="{{route('article.list')}}">--}}
{{--                        <i class="menu-icon ti-book"></i>--}}
{{--                        <span>مقالات</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li  class="{{request()->routeIs('service.*') ? 'active active_route' : ''}}">--}}
{{--                    <a href="{{route('service.list')}}">--}}
{{--                        <i class="menu-icon ti-money"></i>--}}
{{--                        <span>خدمات سایت</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li  class="{{request()->routeIs('tag.*') ? 'active active_route' : ''}}">--}}
{{--                    <a href="{{route('tag.list')}}">--}}
{{--                        <i class="menu-icon ti-tag"></i>--}}
{{--                        <span>تگ ها</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
            </ul>
        </div>
        <!-- #Menu -->
    </aside>
    <aside id="rightsidebar" class="right-sidebar">
        <ul class="nav nav-tabs tab-nav-right" role="tablist">
            <li role="presentation">
                <a href="#skins" data-toggle="tab" class="active">پوسته ها</a>
            </li>
            <li role="presentation">
                <a href="#settings" data-toggle="tab">تنظیمات</a>
            </li>
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane in active in active stretchLeft" id="skins">
                <div class="demo-skin">
                    <div class="rightSetting">
                        <p>تنظیمات عمومی</p>
                        <ul class="setting-list list-unstyled m-t-20">
                            <li>
                                <div class="form-check">
                                    <div class="form-check m-l-10">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" value="" checked> ذخیره تاریخچه
                                            <span class="form-check-sign">
                                                    <span class="check"></span>
                                                </span>
                                        </label>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="form-check">
                                    <div class="form-check m-l-10">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" value="" checked> نمایش وضعیت
                                            <span class="form-check-sign">
                                                    <span class="check"></span>
                                                </span>
                                        </label>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="form-check">
                                    <div class="form-check m-l-10">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" value="" checked> ثبت مسئله خودکار
                                            <span class="form-check-sign">
                                                    <span class="check"></span>
                                                </span>
                                        </label>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="form-check">
                                    <div class="form-check m-l-10">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" value="" checked> نمایش وضعیت به همه
                                            <span class="form-check-sign">
                                                    <span class="check"></span>
                                                </span>
                                        </label>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="rightSetting">
                        <p>رنگ منو نوار کناری</p>
                        <button type="button" class="btn btn-sidebar-light btn-border-radius p-l-20 p-r-20">روشن</button>
                        <button type="button" class="btn btn-sidebar-dark btn-default btn-border-radius p-l-20 p-r-20">تاریک</button>
                    </div>
                    <div class="rightSetting">
                        <p>رنگ قالب</p>
                        <button type="button" class="btn btn-theme-light btn-border-radius p-l-20 p-r-20">روشن</button>
                        <button type="button" class="btn btn-theme-dark btn-default btn-border-radius p-l-20 p-r-20">تاریک</button>
                    </div>
                    <div class="rightSetting">
                        <p>پوسته ها</p>
                        <ul class="demo-choose-skin choose-theme list-unstyled">
                            <li data-theme="black" class="actived">
                                <div class="black-theme"></div>
                            </li>
                            <li data-theme="white">
                                <div class="white-theme white-theme-border"></div>
                            </li>
                            <li data-theme="purple">
                                <div class="purple-theme"></div>
                            </li>
                            <li data-theme="blue">
                                <div class="blue-theme"></div>
                            </li>
                            <li data-theme="cyan">
                                <div class="cyan-theme"></div>
                            </li>
                            <li data-theme="green">
                                <div class="green-theme"></div>
                            </li>
                            <li data-theme="orange">
                                <div class="orange-theme"></div>
                            </li>
                        </ul>
                    </div>
                    <div class="rightSetting">
                        <p>فضای دیسک</p>
                        <div class="sidebar-progress">
                            <div class="progress m-t-20">
                                <div class="progress-bar l-bg-cyan shadow-style width-per-45" role="progressbar"
                                     aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <span class="progress-description">
                                    <small>26% باقی مانده</small>
                                </span>
                        </div>
                    </div>
                    <div class="rightSetting m-b-15">
                        <p>بارگذاری سرور</p>
                        <div class="sidebar-progress">
                            <div class="progress m-t-20">
                                <div class="progress-bar l-bg-orange shadow-style width-per-63" role="progressbar"
                                     aria-valuenow="63" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <span class="progress-description">
                                    <small>بسیار بارگذاری شده</small>
                                </span>
                        </div>
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane stretchRight" id="settings">
                <div class="demo-settings">
                    <p>تنظیمات عمومی</p>
                    <ul class="setting-list">
                        <li>
                            <span>گزارش استفاده از پانل</span>
                            <div class="switch">
                                <label>
                                    <input type="checkbox" checked>
                                    <span class="lever switch-col-green"></span>
                                </label>
                            </div>
                        </li>
                        <li>
                            <span>تغییر مسیر ایمیل</span>
                            <div class="switch">
                                <label>
                                    <input type="checkbox">
                                    <span class="lever switch-col-blue"></span>
                                </label>
                            </div>
                        </li>
                    </ul>
                    <p>تنظیمات سیستم</p>
                    <ul class="setting-list">
                        <li>
                            <span>اطلاعیه ها</span>
                            <div class="switch">
                                <label>
                                    <input type="checkbox" checked>
                                    <span class="lever switch-col-purple"></span>
                                </label>
                            </div>
                        </li>
                        <li>
                            <span>به روز رسانی خودکار</span>
                            <div class="switch">
                                <label>
                                    <input type="checkbox" checked>
                                    <span class="lever switch-col-cyan"></span>
                                </label>
                            </div>
                        </li>
                    </ul>
                    <p>تنظیمات حساب</p>
                    <ul class="setting-list">
                        <li>
                            <span>آنلاین</span>
                            <div class="switch">
                                <label>
                                    <input type="checkbox" checked>
                                    <span class="lever switch-col-red"></span>
                                </label>
                            </div>
                        </li>
                        <li>
                            <span>مجوز محل سکونت</span>
                            <div class="switch">
                                <label>
                                    <input type="checkbox">
                                    <span class="lever switch-col-lime"></span>
                                </label>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </aside>
</div>
