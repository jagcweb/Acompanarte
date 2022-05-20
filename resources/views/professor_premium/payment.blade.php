@extends('layouts.app')

@section('title') Convertirme a pianista Premium @endsection

@section('content')

    <main class="page payment-page">
        <section class="payment-form dark">
            <div class="container">
                <div class="block-heading">
                    @if(str_contains(url()->current(), '/payment2'))
                    <p>Pago de suscripción pianista premium {{$type}} por {{$cantidad}}€</p>
                    <p>Acompañarte usa Stripe como plataforma de pago y no almacena ningún tipo de información.</p>
                    @else
                    <p>Pago de {{$cantidad}}€ de solicitud de contacto</p>
                    <p>Acompañarte usa Stripe como plataforma de pago y no almacena ningún tipo de información.</p>
                    @endif
                </div>
                @if (Session::has('success'))

                    <div class="alert alert-success text-center">

                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>

                        <p>{{ Session::get('success') }}</p>

                    </div>

                @endif
                <form id="payment-form">
                    <div class="form-group pt-2">
                        <div id="card-element">
                            <!-- Elements will create input elements here -->
                        </div>
                        <!-- We'll put the error messages in this element -->
                    </div>
                    <div class="form-group pt-2">
                        @if(str_contains(url()->current(), '/payment2'))
                        <button id="submit" class="btn btn-block btn-success paynow">Suscribirme</button>
                        @else
                        <button id="submit" class="btn btn-block btn-success paynow">Pagar solicitud de contacto</button>
                        @endif
                    </div>
                    @if(str_contains(url()->current(), '/payment2'))
                    <div class="col-md-12 d-flex align-items-center flex-direction-row">
                        <input
                            style="margin-top: 0px;"
                            type="checkbox"
                            value="1"
                            class="auto_renew form-control"
                            name="renovar"
                        />
                        <label for="check-1" class="ml-2" style="margin-bottom: 2px;">{{
                            __("Renovar suscripción automáticamente")
                        }}</label>
                    </div>


                    @endif

                    <div id="card-errors" role="alert" style="color: red;"></div>
                    <div id="card-thank" role="alert" style="color: green;"></div>
                    <div id="card-message" role="alert" style="color: green;"></div>
                    <div id="card-success" role="alert" style="color: green;font-weight:bolder"></div>
                </form>
            </div>
        </section>
    </main>



@endsection


@section('js')

    <script type="text/javascript">
        // Set your publishable key: remember to change this to your live publishable key in production
        // See your keys here: https://dashboard.stripe.com/account/apikeys
        $('#card-success').text('');
        $('#card-errors').text('');
        const stripe = Stripe('pk_test_51Kksx2HXud5qSDIwwtnhBBrlhJm70OiAvGqDbsD9v57Nq3yXB1PDqf5aCgNN3vzsN5k14Spu5gm0UNGWvnLoEj5J00m3QSn6kI');
        const elements = stripe.elements();
        $('#submit').prop('disabled', true);
        // Set up Stripe.js and Elements to use in checkout form
        const style = {
            base: {
                color: "#32325d",
            }
        };

        auto_renew = 0;
        $( ".auto_renew" ).change(function() {
            if ($(this).is(':checked')) {
                auto_renew = 1;
            }
         });
    


        const card = elements.create("card", { style: style });
        card.mount("#card-element");
        card.addEventListener('change', ({error}) => {
            const displayError = document.getElementById('card-errors');
            if (error) {
                displayError.textContent = error.message;
                $('#submit').prop('disabled', true);
            } else {
                displayError.textContent = '';
                $('#submit').prop('disabled', false);
            }
        });
        const form = document.getElementById('payment-form');
        const paycheck = false;
        form.addEventListener('submit', function(ev) {
            ev.preventDefault();
            $(".paynow").html('Acompañarte esta conectando con su banco, espere...');
            //cardnumber,exp-date,cvc
            stripe.confirmCardPayment('{{ $client_secret }}', {
                payment_method: {
                    card: card,
                    billing_details: {
                        name: '{{ \Auth::user()->name }}',
                        email: '{{ \Auth::user()->email }}'
                    }
                },
                setup_future_usage: 'off_session'
            }).then(function(result) {
                $('.loading').css('display','none');
                // return false;
                if (result.error) {
                    // Show error to your customer (e.g., insufficient funds)
                    $('#card-errors').text(result.error.message);
                } else {
                    // The payment has been processed!
                    if (result.paymentIntent.status === 'succeeded') {
                        $('#card-success').text("Pago realizado con éxito");
                        $(".paynow").html('Gracias por confiar en Acompañarte');
                        $('#submit').prop('disabled', true);

                        setTimeout(function(){
                            if(!document.referrer.includes('ver-solicitud')){
                                if (auto_renew == 1) {
                                    window.location.href = "{{ route('configuration_premium.premium', ['type' => \Crypt::encryptString($type), 'auto_renew' => 1]) }}";
                                }else{
                                    window.location.href = "{{ route('configuration_premium.premium', ['type' => \Crypt::encryptString($type), 'auto_renew' => NULL]) }}";
                                }

                                
                            }else{
                                window.location.href = `{{ route('contact_request.update', ['type' => \Crypt::encryptString($type)]) }}`;
                            }
                        }, 2000);
                    }
                }
            });

        });

    </script>
@endsection

@section('css')
    <style type="text/css">
        .payment-form {
            padding-bottom: 50px;
            font-family: 'Montserrat', sans-serif;
        }

        .payment-form.dark {
            background-color: #f6f6f6;
        }

        .payment-form .content {
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.075);
            background-color: white;
        }

        .payment-form .block-heading {
            padding-top: 50px;
            margin-bottom: 40px;
            text-align: center;
        }

        .payment-form .block-heading p {
            text-align: center;
            max-width: 600px;
            margin: auto;
            opacity: 0.7;
        }

        .payment-form.dark .block-heading p {
            opacity: 0.8;
        }

        .payment-form .block-heading h1,
        .payment-form .block-heading h2,
        .payment-form .block-heading h3 {
            margin-bottom: 1.2rem;
            color: #3b99e0;
        }

        .payment-form form {
            border-top: 2px solid #5ea4f3;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.075);
            background-color: #ffffff;
            padding: 20px;
            max-width: 600px;
            margin: auto;

        }

        .payment-form .title {
            font-size: 1em;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            margin-bottom: 0.8em;
            font-weight: 600;
            padding-bottom: 8px;
        }

        .payment-form .products {
            background-color: #f7fbff;
            padding: 25px;
        }

        .payment-form .products .item {
            margin-bottom: 1em;
        }

        .payment-form .products .item-name {
            font-weight: 600;
            font-size: 0.9em;
        }

        .payment-form .products .item-description {
            font-size: 0.8em;
            opacity: 0.6;
        }

        .payment-form .products .item p {
            margin-bottom: 0.2em;
        }

        .payment-form .products .price {
            float: right;
            font-weight: 600;
            font-size: 0.9em;
        }

        .payment-form .products .total {
            border-top: 1px solid rgba(0, 0, 0, 0.1);
            margin-top: 10px;
            padding-top: 19px;
            font-weight: 600;
            line-height: 1;
        }

        .payment-form .card-details {
            padding: 25px 25px 15px;
        }

        .payment-form .card-details label {
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 15px;
            color: #79818a;
            text-transform: uppercase;
        }

        .payment-form .card-details button {
            margin-top: 0.6em;
            padding: 12px 0;
            font-weight: 600;
        }

        .payment-form .date-separator {
            margin-left: 10px;
            margin-right: 10px;
            margin-top: 5px;
        }

        @media (min-width: 576px) {
            .payment-form .title {
                font-size: 1.2em;
            }

            .payment-form .products {
                padding: 40px;
            }

            .payment-form .products .item-name {
                font-size: 1em;
            }

            .payment-form .products .price {
                font-size: 1em;
            }

            .payment-form .card-details {
                padding: 40px 40px 30px;
            }

            .payment-form .card-details button {
                margin-top: 2em;
            }
        }
    </style>
@endsection