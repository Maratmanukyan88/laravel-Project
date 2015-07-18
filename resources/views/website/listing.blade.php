@extends('app')

@section('content')
    <div class="container">
        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header" style="padding:35px 50px;">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4><span class="glyphicon glyphicon-lock"></span> Change plan</h4>
                    </div>
                    <div class="modal-body">
                            <div class="form-group">
                                <label ><span ></span>Plan</label>
                                {!! Form::select('plan', $plans_list, old('username'),array('class' => 'form-control')) !!}
                                <script type="text/javascript">
                                    var plans = {
                                        @foreach($_plans_list as $plan_list)
                                        '{{$plan_list->id}}': '{{$plan_list->price}}',
                                        @endforeach
                                        };
                                    jQuery(document).ready(function() {

                                        var planChange = function(value) {
                                            var chosen = plans[value];
                                            var freePlaceholder    = '';
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

                            </div>
                            <div class="form-group">
                                <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
                                <input type="text" class="form-control" id="psw" placeholder="Enter password">
                            </div>

                            <button type="submit" class="btn btn-success btn-block" id="plan_change"><span class="glyphicon glyphicon-off"></span> Change</button>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>

                    </div>
                </div>

            </div>
        </div>
    </div>


    <script  type="text/javascript">
        $(document).ready(function() {
            $( function() {
                $('form').submit(function() {
                    return false;
                });
            });

            $(".myBtn").click(function(){
                $("#myModal").modal();
                window.website=$(this).data("web");
            });
            $("#plan_change").click(function(){
               var plan=$("select").val();
               var password=$("#psw").val();
                $.ajax({
                    type:'post',
                    url: 'changePlan',
                    data:{ plan : plan, password: password,website: website },
                    success: function(result){
                       console.log(result);
                    }
                })
            })
            $(".btn_api").click(function(){
                $("#myMod").modal();
                $("#myMod").fadeIn();
                var client_id=$(this).data("client_id");
                var redirect_uri=$(this).data("redirect_uri");
                var response_type=$(this).data("response_type");

                $.ajax({
                    url: '/oauth/authorize',
                    data:{ client_id : client_id, redirect_uri: redirect_uri,response_type: response_type },
                    success: function(result){
                        $(".api-text").html(result);
                    }
                })
            })
            var ajax_request;
            $(document).on('submit','form.form-horizontal', function(){
               return false;
            });
            $(document).on('submit','form.form-horizon', function(){
                return false;
            });
            $(document).on('click',"input[name='deny']", function() {
                $("#myMod").fadeOut();
            })
            $(document).on('click',"input[name='approve']", function() {
                var url=$("form.form-horizontal").attr("action");
                var _token = $("input[name='_token']").val();
                var client_id = $("input[name='client_id']").val();
                var redirect_uri = $("input[name='redirect_uri']").val();
                var response_type = $("input[name='response_type']").val();
                var state = $("input[name='state']").val();
                var approve = $("input[name='approve']").val();
                $.ajax({
                    type: "post",
                    url:url,
                    data: {_token: _token, client_id: client_id, redirect_uri: redirect_uri,response_type:response_type,state:state,approve:approve},
                    success: function(result){
                        $(".api-text").html(result);
                    }
                })
            })
            $(document).on('click',".get-api", function(){
                 var _token=$("input[name='_token']").val();
                 var client_id=$("input[name='client_id']").val();
                 var client_secret=$("input[name='client_secret']").val();
                 var code=$("input[name='code']").val();
                 var redirect_uri=$("input[name='redirect_uri']").val();
                 var grant_type=$("input[name='grant_type']").val();
                 $.ajax({
                 type:"post",
                 url: "/oauth/generateToken",
                 data:{_token:_token,client_id:client_id,client_secret:client_secret,code:code,redirect_uri:redirect_uri,grant_type:grant_type},
                     success: function(result){
                        console.log(result);
                     }
                 })
             })


        });
    </script>

<div id="user-listing" class="container">
    <!-- Modal -->
    <div class="modal fade" id="myMod" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content" >
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Generate API Token</h4>
                </div>
                <div class="modal-body">
                    <div class="api-text"></div>
                </div>
            </div>

        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <h2 class="header-title text-uppercase">{!! trans('Websites') !!}</h2>
        </div>
        <div class="col-md-12 content">
            <h3 class="header-subtitle text-uppercase text-muted">Listing</h3>

            @include('_partials.messages')

            <table class="tablesaw" data-tablesaw-mode="swipe">
                <thead>
                    <tr>
                        <th class="title" scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist">
                            <span class="bor">#</span>
                        </th>
                        <th class="title" scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist">
                            <span class="bor">NAME</span>
                        </th>
                        <th class="title" scope="col" data-tablesaw-sortable-col data-tablesaw-sortable-default-col data-tablesaw-priority="3">
                            <span class="bor">PLAN</span>
                        </th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($websites as $website)
                    <tr>
                        <td>{{$website->id}}</td>
                        <td>{{$website->name}}</td>
                        <td>{{$plans->find($website->plan_id)->plan}}</td>
                        <td>
                            @if(isset($website->token) && $website->token != '')
                            <a href="#" class="btn" data-toggle="modal">Get API Token</a>
                            @else
                                <a data-client_id='{!! $website->oauth_id !!}' data-redirect_uri="/oauth/token/" data-response_type="code" class="btn btn_api" data-toggle="modal">Generate API Token</a>
                            @endif
                            <span class="btn btn-info check_plan myBtn" data-web="{{$website->id}}">Change plan</span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
    <!-- Modal -->
    <div class="modal fade" id="myMod" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Modal Header</h4>
                </div>
                <div class="modal-body">
                    <p>Some text in the modal.</p>
                </div>
            </div>

        </div>
    </div>

    </div>

    </body>
    </html>

@endsection