<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pago con stripe</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    
    <style>
        /**
        * The CSS shown here will not be introduced in the Quickstart guide, but shows
        * how you can use CSS to style your Element's container.
        */
        .StripeElement {
        box-sizing: border-box;

        height: 40px;

        padding: 10px 12px;

        border: 1px solid transparent;
        border-radius: 4px;
        background-color: white;

        box-shadow: 0 1px 3px 0 #e6ebf1;
        -webkit-transition: box-shadow 150ms ease;
        transition: box-shadow 150ms ease;
        }

        .StripeElement--focus {
        box-shadow: 0 1px 3px 0 #cfd7df;
        }

        .StripeElement--invalid {
        border-color: #fa755a;
        }

        .StripeElement--webkit-autofill {
        background-color: #fefde5 !important;
        }
    </style>
</head>
<body>
    
    <div class="row mt-5">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Formulario de pago <b>Stripe</b> personalizado
                </div>
                <div class="card-body">
                    <script src="https://js.stripe.com/v3/"></script>
                    <form action="/jjjj" method="post" id="payment-form">
                        @csrf
                        
                        <input type="hidden" name="token" />

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Card number</label>
                                    <!--<input type="text" type="text" size="20" data-stripe="number" class="form-control">-->
                                    <div id="card-number-element" class="field"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Expiration (MM/YY)</label>
                                    <!--<input type="text" type="text" size="2" data-stripe="exp_month" class="form-control">-->
                                    <div id="card-expiry-element" class="field"></div>                                    
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>CVC</label>
                                    <!--<input type="text" type="text" size="4" data-stripe="cvc" class="form-control">-->
                                    <div id="card-cvc-element" class="form-control"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Billing Zip</label>
                                    <input type="text" id="postal-code" name="postal_code" class="form-control" placeholder="55070" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 text-center">
                                <input type="submit" class="btn btn-primary btn-md submit" value="Submit Payment">
                            </div>
                        </div>

                        <div class="outcome">
                            <div class="error"></div>
                            <div class="success">
                              Success! Your Stripe token is <span class="token"></span>
                            </div>
                          </div>

                    </form>
                </div>
            </div>
        </div>
    </div>    

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <script>
        // Create a Stripe client.
        var stripe = Stripe("{{ config('services.stripe.key') }}");

        // Create an instance of Elements.
        var elements = stripe.elements();

        var style = {
            base: {
                iconColor: '#666EE8',
                color: '#31325F',
                fontWeight: 300,
                fontFamily: 'Arial, sanserif',
                fontSize: '15px',
                '::placeholder': {
                    color: '#6c757d',
                    opacity: '1',
                },
            },
        };

        var cardNumberElement = elements.create('cardNumber', {
            style: style
        });
        cardNumberElement.mount('#card-number-element');

        var cardExpiryElement = elements.create('cardExpiry', {
            style: style
        });
        cardExpiryElement.mount('#card-expiry-element');

        var cardCvcElement = elements.create('cardCvc', {
            style: style
        });
        cardCvcElement.mount('#card-cvc-element');

        function setOutcome(result) {
            var successElement = document.querySelector('.success');
            var errorElement = document.querySelector('.error');
            successElement.classList.remove('visible');
            errorElement.classList.remove('visible');

            if (result.token) {
                // In this example, we're simply displaying the token
                successElement.querySelector('.token').textContent = result.token.id;
                successElement.classList.add('visible');

                // In a real integration, you'd submit the form with the token to your backend server
                var form = document.querySelector('form');
                //alert(result.token.id);
                form.querySelector('input[name="token"]').setAttribute('value', result.token.id);
                form.submit();
            } else if (result.error) {
                errorElement.textContent = result.error.message;
                errorElement.classList.add('visible');
            }
        }

        cardNumberElement.on('change', function(event) {
            setOutcome(event);
        });

        cardExpiryElement.on('change', function(event) {
            setOutcome(event);
        });

        cardCvcElement.on('change', function(event) {
            setOutcome(event);
        });

        document.querySelector('form').addEventListener('submit', function(e) {
            e.preventDefault();
            var options = {
                address_zip: document.getElementById('postal-code').value,
            };
            stripe.createToken(cardNumberElement, options).then(setOutcome);
        });

    </script>

</body>
</html>