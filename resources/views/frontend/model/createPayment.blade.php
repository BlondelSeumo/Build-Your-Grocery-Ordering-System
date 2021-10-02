<html>
    <body onload="document.forms['form'].submit()">
        <form method="POST" name="form" action="https://checkout.flutterwave.com/v3/hosted/pay">
            {{-- here --}}
            <input type="hidden" name="public_key" value="{{App\PaymentSetting::find(1)->flutterwave_public_key}}" />
            <input type="hidden" name="customer[email]" value="{{ Auth::user()->email }}" />
            <input type="hidden" name="customer[phone_number]" value="{{ Auth::user()->phone_code.Auth::user()->phone }}" />
            <input type="hidden" name="customer[name]" value="{{ Auth::user()->name }}" />
            <input type="hidden" name="tx_ref" value="{{ $order->id }}" />
            <input type="hidden" name="amount" value="{{ $order->payment }}" />
            <input type="hidden" name="currency" value="{{App\Setting::find(1)->currency}}" />
            <input type="hidden" name="redirect_url" value="{{ url('transction_verify/'.$order->id) }}" />
        </form>
    </body>
</html>