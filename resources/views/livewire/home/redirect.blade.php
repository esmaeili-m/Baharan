<div>
    <form id="payment-form" action="https://sep.shaparak.ir/OnlinePG/OnlinePG" method="post">
        <input type="hidden" name="Token" value="{{ $token }}" />
        <input type="text" name="GetMethod" value="{{ $getMethod }}" />
    </form>
    <script>
        document.getElementById('payment-form').submit();
    </script>
</div>
