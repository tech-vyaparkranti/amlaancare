<!DOCTYPE html>
<body>
    <script src="https://sdk.cashfree.com/js/v3/cashfree.js"></script>
<script>
    const cashfree = Cashfree({
        mode:"{{ $mode }}" // sandbox or production
    });
    let checkoutOptions = {
                    paymentSessionId: "{{ $payment_session_id }}",
                    redirectTarget: "_self" //optional ( _self, _blank, or _top)
                }
        cashfree.checkout(checkoutOptions); 
</script>
</body>
</html>