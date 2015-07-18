@extends('app')

@section('content')
@include('drips.modal.action')
<div class="bread-container">
    <ul class="breadcrumb2">
        <li >Name</li>
        <li href="" >Recipients</li>
        <li href="" class="active">Logic</li>
        <li href="">Confirm & Save</li>
    </ul>
</div>

<div id="content">
    <div class="container">
        <!-- Form Name -->
        <legend>Logic</legend>

        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                    <p>Avaliable Actions</p>
                    <div class="avaliable-actions">
                        <ul class="actions">
                            <li alt="action" class="action" data-value="sendEmail">Send email</li>
                            <li alt="question" class="box-margin" data-value="questions">Has prospect opened email?

                                <ol class="action-muve">
                                </ol>
                            </li>
                            <li class="action" data-value="hasOpend" >Has prospect clicked link?</li>
                            <li alt="pause" class="action" data-value="pause"><span class="glyphicon glyphicon-pause"></span> Pause</li>
                            <li class="action" data-value="end"><span class="glyphicon glyphicon-stop"></span> End</li>
                        </ul>
                    </div>
                    <button href="#" class="btn btn-primary" id="confirm" >Confirm & Save</button>
                </div>

                <div class="col-md-9">
                    <p>Drip Logic</p>
                    <div id="add-actions" class="drip-logic ">
                        <ul>
                            <li class="start"> <span class="glyphicon glyphicon-triangle-right"></span>Start</li> 
                            <li id="drop">
                                <ol class="addif">
                                    
                                </ol>

                            </li>

                            <li><span class="glyphicon glyphicon-stop"></span>End</li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('footer_js')
<script>
    $(document).ready(function () {
//        var first_array = [{'1': [{'start':'true'}],'2': [{ 'send email' : [{'link': 'hjhjhjjh'}] }]  }];
//        console.log(first_array);
             
            var  tag = '',
                    d = 0,
                    a,
                    p = 0,
                    del,addif,arrowHeight,link,drip_array=[],questions_array=[],
                    arrow='<div class="arrow-icon"><p>no</p><div></div><span class="glyphicon glyphicon-menu-down"></span></div>';
          var listItem=$('.actions').clone().find('.action');
          $('.condition-body').append(listItem);
          $('.condition-body .action').on('click',function(){
              p++;
               del = '<span  class="glyphicon del glyphicon-remove" data-value="addif' + p + '"></span>';
              $(this).clone().append(del).addClass('addif' + p +' tools').appendTo('.'+addif+' .action-muve');
             arrowHeight= $('.'+addif).height();
              $('.'+addif+' .arrow-icon div').css('height',arrowHeight-15);
              $('.close-btn').click();
              
               switch ($(this).attr('alt')){
                case 'action':
                   $('.action_files').modal();
                    break;
                case 'pause':
                    $('.pause_modal').modal();
                    break;
           }
           
          });
           
        $('.actions li').on('click', function () {
            if (tag === '') {
                tag = $(this).clone();
                a = tag.attr('class');
                d = 1;
                p++;
                if (a !== 'no') {
                    del = '<span  class="glyphicon del glyphicon-remove-sign" data-value="addif' + p + '"></span>';
                    tag.addClass('addif' + p +' tools');
                }
            } else {
                d = 2;
            }
            $('body').append(tag);
        });
        $(document).on('mousemove', function (e) {
            $(tag).css({
                position: 'absolute',
                left: e.pageX - 40,
                top: e.pageY - 50
            });
        });
        
        $('.addif').on('click', function () {
            if(tag!==''){
            $(tag).append(del);
            if($(tag).attr('alt')==='question'){
                $(tag).append('<span id="addif'+p+'" class="glyphicon glyphicon-paperclip addif'+p+' add-question"></span>'); 
            }
            $(this).append($(tag).css({
                position: '',
                left: '',
                top: '',
                margin: 0
            }));
           switch ($(tag).attr('alt')){
                case 'action':
                   $('.action_files').modal();
                    break;
                case 'pause':
                    $('.pause_modal').modal();
                    break;
                case 'question':
                    $(arrow).insertBefore('.addif'+p+'  .action-muve');
                    break;
           }
            del = '';
            tag = '';
            }
        });

        $(document).on('click', function () {
            if(tag!==''){
            if (d === 2) {
                $(tag).remove();
                tag = '';
                del = '';
                            d = 0;
                        }
                    }
                    $('.del').on('click', function () {
                        var m = $(this).attr('data-value');
                        $('.' + m).remove();
                        $(this).remove();
                        arrowHeight= $('.'+addif).height();
              $('.'+addif+' .arrow-icon div').css('height',arrowHeight-15);
                    });
                    $('.add-question').on('click', function () {
                        $('.condition_modal').modal();
                        addif=$(this).attr('id');
                    });
                });
                ///////////
                // Modals//
                ///////////
                $('.choose-fil').on('click', function () {
                    link = $('.file-link').val();
                   var file = link.split("/").pop().split('.', 1)[0];
                    $('.fil-link').attr('value', file);
                    $('.addif'+p).attr('data-link',link);
                    $('.addif'+p).append('.<i>' + file + '</i>');
                    if (file === '')
                        $('.addif'+p).remove();

                });
                $('.choose-pause').on('click', function () {
                    var day = $('.pause-limit').val();
                    var days = 'deys';
                    if ($.isNumeric(day)) {
                        if (day === '1')
                            days = 'dey';
                        $('.addif'+p).attr('data-count',day);
                        $('.addif'+p).append('.<i>' + day + ' ' + days + '</i>');
                    } else {
                        $('.addif'+p).remove();
                    }
                });
                function questions(){
                 $('.action-muve > li').each(function(index){
                 switch ($(this).attr('data-value')){
                        case 'sendEmail':
                            questions_array.push({'sendEmail':$(this).attr('data-link')});
                            break;
                            
                        case 'hasOpend':
                            questions_array.push({'hasOpend':'true'});
                            
                            break;
                        case 'pause':
                            questions_array.push({'pause':$(this).attr('data-count')/1});
                            
                            break;
                            
                        case 'end':
                            questions_array.push({'end':'true'});
                            
                            break;
                        case 'questions':
                            questions_array.push({'questions':'true'});
                            
                            break;
                  }
              });
                
                }
                $('#confirm').on('click',function(){
                 drip_array.push({'start':'true'});
               $('.addif >li').each(function(index){
                 
                  switch ($(this).attr('data-value')){
                        case 'sendEmail':
                            drip_array.push({'sendEmail':$(this).attr('data-link')});
                            break;
                            
                        case 'hasOpend':
                            drip_array.push({'hasOpend':'true'});
                            
                            break;
                        case 'pause':
                            drip_array.push({'pause':$(this).attr('data-count')/1});
                            
                            break;
                            
                        case 'end':
                            drip_array.push({'end':'true'});
                            
                            break;
                        case 'questions':
                            questions();
                            drip_array.push({'Has_open_email':questions_array});
                      
//                          console.log(questions_array);
                            
                            break;
                  }
                   
               });
               drip_array.push({'end':'true'});
               
              var data = {'data':JSON.stringify(drip_array) };
            $.ajax({
                method: "post",
                url:"{{URL::to('/confirm')}}",
                data:data,
                datatype:'json'
            }).done(function(){
               window.location = "confirm";

            });
               });
            });
</script>
@endsection

