@extends('pages.layout')
@section('content')
    {{--Chat--}}
    <div id="chat">
        <div class="chat-header">
            <h5 class="header-name"> {{'test'}}</h5>
        </div>
        <div class="chat-body">
            <ul class="list-group body-message list-unstyled">
            </ul>
        </div>

        <div class="chat-footer">
            <form id="notification_chat" action="" method="post">
                <div class="col-lg-10 padding0">
                    <input type="text" class="form-control footer-input" name="" placeholder="Mesajınız">
                </div>

                <div class="col-lg-2 padding0">
                    <button type="submit" name="button" class="btn footer-btn"><i class="fa fa-paper-plane-o"></i></button>
                </div>
            </form>
        </div>
    </div>
    <script
            src="https://code.jquery.com/jquery-2.2.4.min.js"
            integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/1.7.2/socket.io.js"></script>
    <script type="text/javascript">
        var socket = io(':3000');
        var date = new Date();
        var data_chat = {
            sender_id :{{Auth::user()->id}},
            receiver_id: {{$chat->receiver_id}},
            message :  ""
            created_at: date.getFullYear() + "-" + date.getMonth() + "-" + date.getDay() + " " + date.getHours() + ":" + date.getMinutes() + ":" + date.getSeconds();
            updated_at: date.getFullYear() + "-" + date.getMonth() + "-" + date.getDay() + " " + date.getHours() + ":" + date.getMinutes() + ":" + date.getSeconds();
        };
        socket.emit('data',data_chat);
        $('#notification_chat').submit(function () {
            data_chat.message = $('.footer-input').val();
            socket.emit('send_message', data_chat);
            $('.footer-input').val("");
//            $('.chat-body').text('');
            socket.on('all_data',function (allData) {
                $('.chat-body ul').text('');
                $.each(allData,function (key,value) {
                    if (value.sender_id == {{Auth::user()->id}}){
                        $('.body-message').append(
                            '<li class="pull-right">' +
                            '<p class="message-content">'+value.message+'</p>'+
                            '<img src="/image/'+value.avatar+'" class="message-img" alt="user-image">'+
                            '</li>'+
                            '<div class="clearfix"></div>'
                        );
                    }else if (value.sender_id == {{$chat->receiver_id}} && value.receiver_id == {{Auth::user()->id}}){
                        $('.chat-body ul').append(
                            '<li class="pull-left">' +
                            '<img src="/image/'+value.avatar+'" class="message-img" alt="user-image">'+
                            '<p class="message-content">'+value.message+'</p>'+
                            '</li>'+
                            '<div class="clearfix"></div>'
                        );
                    }
                });
            })
            return false;
        });
        socket.on('all_data',function (allData) {
            $('.chat-body ul').text('');
            $.each(allData,function (key,value) {
                if (value.sender_id == {{Auth::user()->id}}){
                    $('.body-message').append(
                        '<li class="pull-right">' +
                        '<p class="message-content">'+value.message+'</p>'+
                        '<img src="/image/'+value.avatar+'" class="message-img" alt="user-image">'+
                        '</li>'+
                        '<div class="clearfix"></div>'
                    );
                }else if (value.sender_id == {{$chat->receiver_id}} && value.receiver_id == {{Auth::user()->id}}){
                    $('.chat-body ul').append(
                        '<li class="pull-left">' +
                        '<img src="/image/'+value.avatar+'" class="message-img" alt="user-image">'+
                        '<p class="message-content">'+value.message+'</p>'+
                        '</li>'+
                        '<div class="clearfix"></div>'
                    );
                }
            });
        })
    </script>
@endsection
