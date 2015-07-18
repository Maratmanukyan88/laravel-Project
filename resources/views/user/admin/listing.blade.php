@extends('app')

@section('content')
<script>
    $(document).ready(function(){
        var hr=$("a.btn-danger").attr('href');
        $("a.btn-danger").attr('href',"#");
        $("a.btn-danger").click(function(){
            bootbox.confirm("Are you sure?", function(result) {

                if (result) {
                    window.location=hr;
                }
            });
        })
    })
</script>

<div id="user-listing" class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="header-title text-uppercase">{!! trans('Users') !!}</h2>
        </div>
        <div class="col-md-12 content">
            <h3  class="header-subtitle text-uppercase text-muted">Listing</h3>

            @include('_partials.messages')

            <table class="tablesaw" data-tablesaw-mode="swipe">
                <thead>
                    <tr>
                        <th class="title" scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist">
                            <span class="bor">#</span>
                        </th>
                        <th class="title" scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist">
                            <span class="bor">E-MAIL</span>
                        </th>
                        <th class="title" scope="col" data-tablesaw-sortable-col data-tablesaw-sortable-default-col data-tablesaw-priority="3">
                            <span class="bor">ROLE</span>
                        </th>
                        <th class="title" scope="col" data-tablesaw-sortable-col data-tablesaw-sortable-default-col data-tablesaw-priority="3">
                            <span class="bor">CREATED</span>
                        </th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$roles->find($user->role)->role}}</td>
                        <td>{{$user->created_at}}</td>
                        <td>
                            <a class="btn btn-warning" href="{{URL::to('admin/user/edit', ['id' => $user->id])}}">
                                <span class="glyphicon glyphicon-pencil"></span>Edit
                            </a>
                            <a class="btn btn-danger" href="{{URL::to('admin/user/password', ['id' => $user->id])}}">
                                Reset Password
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
