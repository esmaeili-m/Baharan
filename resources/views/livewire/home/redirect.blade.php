<div>
    <form name="forms" action="https://sep.shaparak.ir/OnlinePG/OnlinePG" method="post">
        <input type="hidden" name="Token" value="{{ $token }}" />
        <input name="GetMethod" type="text" value="{{ $getMethod }}" />
    </form>

    <script type="text/javascript">
        // ارسال خودکار فرم پس از بارگذاری صفحه
        window.onload = function() {
            document.forms['forms'].submit();
        };
    </script>
</div>

