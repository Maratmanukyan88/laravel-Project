Welcome!

We have changed plan of your website <strong>{{ $website }}</strong>.
New plan: <strong>{{ $plan->plan }}</strong>

@if( intval($plan->price) > 0 )
From now, we will charge your card every month until subscription would be cancelled.
@endif