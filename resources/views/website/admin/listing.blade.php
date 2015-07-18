@extends('app')

@section('content')

<div id="user-listing" class="container">
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
                        <th class="title" scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist">
                            <span class="bor">OWNER</span>
                        </th>
                        <th class="title" scope="col" data-tablesaw-sortable-col data-tablesaw-sortable-default-col data-tablesaw-priority="3">
                            <span class="bor">PLAN</span>
                        </th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($websites as $website)
                    <tr>
                        <td>{{$website->id}}</td>
                        <td>{{$website->name}}</td>
                        <td>{{$users->find($website->user_id)->email}}</td>
                        <td>{{$plans->find($website->plan_id)->plan}}</td>
                        <td>
                            
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection