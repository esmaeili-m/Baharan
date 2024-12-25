<div>
    <form name="forms1" action="https://sep.shaparak.ir/OnlinePG/OnlinePG" method="post">
        <input type="hidden" name="Token" value="{{ $token }}" />
        <input name="GetMethod" type="text" value="{{ $getMethod }}" />
    </form>

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            var form = document.forms['forms1'];
            if (form) {
                form.submit(); // ارسال فرم تنها در صورتی که فرم وجود داشته باشد
            }
        });
    </script>
</div>
