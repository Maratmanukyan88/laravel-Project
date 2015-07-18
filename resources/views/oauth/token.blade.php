
	{!! Form::open(['method' => 'POST','class'=>'form-horizon']) !!}
	{!! Form::hidden('client_id', $params['client_id']) !!}
	{!! Form::hidden('client_secret', $params['client_secret']) !!}
	{!! Form::hidden('code', $params['code']) !!}
	{!! Form::hidden('redirect_uri', $params['redirect_uri']) !!}
	{!! Form::hidden('grant_type', 'authorization_code') !!}
	{!! Form::submit('Get API key', ['value' => 1, 'class'=>'btn btn-success get-api']) !!}
	{!! Form::close() !!}
