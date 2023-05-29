<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel - Razorpay Payment Gateway Integration</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>

<body>

    <div id="app">

        <main class="py-4">

            <div class="container">

                <div class="row">

                    <div class="col-md-6 offset-3 col-md-offset-6">

  

                        @if($message = Session::get('error'))

                            <div class="alert alert-danger alert-dismissible fade in" role="alert">

                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                                    <span aria-hidden="true">×</span>

                                </button>

                                <strong>Error!</strong> {{ $message }}

                            </div>

                        @endif

  

                        @if($message = Session::get('success'))

                            <div class="alert alert-success alert-dismissible fade {{ Session::has('success') ? 'show' : 'in' }}" role="alert">

                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                                    <span aria-hidden="true">×</span>

                                </button>

                                <strong>Success!</strong> {{ $message }}

                            </div>

                        @endif

  

                        <div class="card card-default">

                            <div class="card-header">

                                Laravel - Razorpay Payment Gateway Integration in Easy way

                            </div>

                            <div class="card-body">
                                <div class="container">
                                    <form action="{{ route('razorpay.payment.store') }}" method="POST" id="razorpay-form">
                                          @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Name</label>
                                                      <input type="text" name="name" class="form-control" >
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">

                                                    <label>Amount</label>
                                                      <input type="text" name="amount" class="form-control" >
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </form>
                                </div>

                                @if(session()->has('data'))
                                
                                <div class="alert alert-success">Your paid  amount is {{session()->get('data.amount')}}</div>
                               
                                <form action="{{url('/response-razor')}}" method="POST" >

                                    @csrf
                                    <script src="https://checkout.razorpay.com/v1/checkout.js"

                                            data-key="rzp_test_srBWtqVNh8oFiA"
                                            data-amount="{{session()->get('data.amount')*100}}"
                                            data-buttontext="Pay"
                                           
                                            data-name=""
                                            data-description="Rozerpaysss"

                                            data-image=""

                                            data-prefill.name="akif"

                                            data-prefill.email="akifbaloch3377@gmail.com"

                                            data-theme.color="#ff7529">

                                    </script>
                                     
                                </form>
                                @endif

                            </div>

                        </div>

  

                    </div>

                </div>

            </div>

        </main>

    </div>

    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Razorpay\RazorpayRequest', '#razorpay-form'); !!}

</body>

</html>