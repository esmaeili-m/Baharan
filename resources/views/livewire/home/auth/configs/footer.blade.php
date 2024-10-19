<div>
    <div style="" class="footer">
        <div class="row p-3" style="direction: rtl">
            <div class="col-lg-4 col-sm-12 text-white p-3 "  >
                <p>درباره ما:</p>
                <div class="footer-about">
                    {!! \App\Models\Setting::find(1)->about ?? '1' !!}
                </div>
            </div>
            <div class="col-lg-2 col-sm-12 text-white p-3 "  >
                <div class="links" style="line-height: 26px">
                    <p>صفحات</p>
                    <ul>
                        <li><a class="link-page" href="{{route('profile.index',['status'=>3])}}" >فروشگاه</a></li>
                        <li><a class="link-page" href="{{route('profile.index',['status'=>3])}}" >سفارشات</a></li>
                        <li><a class="link-page" href="{{route('profile.index',['status'=>3])}}" >ارسال تیکت</a></li>
                        <li><a class="link-page" href="{{route('profile.index')}}" >پروفایل کاربری</a></li>
                        <li><a class="link-page" href="{{route('profile.index',['status'=>3])}}" >قوانین و مقررات</a></li>
                    </ul>
                </div>

            </div>
            <div class="col-lg-2 col-sm-12 text-white p-3 "  >
                <div >

                </div>

            </div>
        </div>
        <hr class="mt-0 mb-0 text-white">
        <div class="p-3 design" style="direction: rtl">
            <p style="font-size: 12px" class="mb-0 text-white"> تمامی حقوق برای سایت شرکت تعاونی متحد زرین قم محفوظ است. </p>
            <a  href="https://addcode.ir/" style="font-size:12px;margin-right: auto" class=" mb-0 text-white text-decoration-none">طراحی شده توسط ادکد</a>
        </div>
    </div>

</div>
