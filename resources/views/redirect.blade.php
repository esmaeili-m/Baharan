<div>
    <form onload="document.forms['forms'].submit()"
          action="https://sep.shaparak.ir/OnlinePG/OnlinePG"
          method="post">
        <input type="hidden" name="Token" value="{{ $token }}" />
        <input name="GetMethod" type="text" value="{{ $getMethod }}" />
    </form>
</div>
