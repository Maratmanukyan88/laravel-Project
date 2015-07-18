@extends('app')
@include('navbar.navbar1')
@section('content')    

<div class="container" style="margin-top: 84px;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{!! trans('Phrase') !!}</div>
                    <table class='table table-bordered table-striped table-hover table-responsive'>
                        <tbody style="text-align: center;">
                            <tr>
                                <td>#</td>
                                <td>phrase</td>
                                <td>Website</td>
                                <td colspan="2">Tools</td>
                            </tr>
                            @foreach($websites as $website)
                            @foreach($website->phrases as $phrases)
                            <tr>

                                <td>{!!$phrases->id!!}</td>
                                <td>{!!$phrases->phrase!!}</td>
                                <td>{!!$website->url!!}</td>
                                <td><button data-href="{!!URL::to('phrases-delete', ['id' => $phrases->id])!!}" type="button" class="btn btn-primary myDeleteModal" >Delete</button></td>
                                <td><a type="button" class="btn btn-success"  href="{!!URL::to('phrase-update', ['id' => $phrases->id])!!}">Update</a></td>
                            </tr>
                            @endforeach
                            @endforeach

                        </tbody>
                        <tr>
                            <td><button type="button" class="btn btn-success myModal" data-toggle="modal" data-target="#create_modal" data-href="{!!URL::to('new-phrase')!!}" data-whatever="@mdo">Create</button></td>
                        </tr>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@include('_partials._create_modal')
@include('_partials._delete_modal')

@endsection
@section('footer_js')
<script type="text/javascript">
    $(document).ready(function () {

        $('body').on('click', '.myModal', function () {
            var href = $(this).attr('data-href');
            $('#phrase_crud').attr('action', href);

        });
        $('body').on('click', '.myDeleteModal', function () {
            var href = $(this).attr('data-href');
            $('#user_delete_button').attr('href', href);
            $('.delete-modal').modal();
        });

    });

</script>

@endsection
