@extends('app')

@section('content')

<div id="user-edit" class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="header-title text-uppercase">{!! trans('Websites') !!}</h2>
        </div>
        <div class="col-md-12 content">
        	<h3 class="header-subtitle text-uppercase text-muted">Add new website</h3>

            @include('_partials.messages')

            {!! Form::open(['class' => 'form form-profile form-default']) !!}

                <div class="form-group">
                    <label>WEBSITE URL</label>
                    {!! Form::text('url', old('email'),array('class' => 'form-control')) !!}
                </div>

                <div class="form-group">
                    <label>PLAN</label>
                    {!! Form::select('plan', $plans, old('username'),array('class' => 'form-control create_select')) !!}
                </div>

                <script type="text/javascript">
                    var plans = {
                    @foreach($_plans as $plan)
                        '{{$plan->id}}': '{{$plan->price}}',
                    @endforeach
                    };

                    jQuery(document).ready(function() {

                        var planChange = function(value) {
                            var chosen = plans[value];
                            var freePlaceholder    = '{!! Form::button('ADD WEBSITE', ['class' => 'btn btn-primary btn-lg', 'type'=>'submit']) !!}';
                            var paymentPlaceholder = '<script id="stripe-payment" src="https://checkout.stripe.com/checkout.js" class="stripe-button" data-key="{{getenv('STRIPE_API_KEY')}}" data-amount="' + chosen + '" data-name="Laravel" data-description="Add new website" data-email="{{$user->email}}">\<\/script>';

                            if (value == 1) {
                                jQuery('#stripe-holder').html(freePlaceholder);
                            } else {
                                jQuery('#stripe-holder').html(paymentPlaceholder);
                            }

                        }

                        jQuery('[name="plan"]').change(function(){

                            planChange(jQuery(this).val());

                        });

                        planChange(1);
                    })
                </script>

                <div id="stripe-holder" style="margin-top:30px;" class="text-right"></div>

            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
