<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <script type="text/javascript">
        function onVisaCheckoutReady() {
            V.init( {
                apikey: "PQ2RY9V2J9Y9ITOKZNLW21QTxx2_6lT_bQUWDiPN2rQfL02Aw",
                encryptionKey: "N1PDDPH3P2PR38M9Z69Q13BLpsNDo89dNEsC0snhXZYTphkbE",
                paymentRequest: {
                    currencyCode: "USD",
                    subtotal: "10.00"
                }
            });

            V.on("payment.success", function(payment) {
                document.write("payment.success: \n" + JSON.stringify(payment));
            });

            V.on("payment.cancel", function(payment) {
                document.write("payment.cancel: \n" + JSON.stringify(payment));
            });
        
            V.on("payment.error", function(payment, error) {
                document.write("payment.error: \n" +
                JSON.stringify(payment) + "\n" +
                JSON.stringify(error));
            });
        }
    </script>

</head>
<body>
    
<img alt="Visa Checkout" class="v-button" role="button" src="https://sandbox.secure.checkout.visa.com/wallet-services-web/xo/button.png" />

<script type="text/javascript" src="https://sandbox-assets.secure.checkout.visa.com/checkout-widget/resources/js/integration/v1/sdk.js"></script>

</body>
</html>