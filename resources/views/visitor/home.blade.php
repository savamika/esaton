<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@lang('languages.titles.user_page')</title>
    <link rel="stylesheet" href="{{ asset('css/desktoplog.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700;800&display=swap" rel="stylesheet">
    <script src="{{ asset('js/javascript.js') }}"></script>
</head>
<style>
    div.chat-messages {
        height: 254px;
        width: 744px;
        overflow-y: scroll;
    }
</style>

<body>
    <div class="background">
        <div class="overlay"></div>
        <div class="content">
            <div class="main-container">
                <div class="content-box">
                    <div class="close-button" onclick="closeContentBox()">X</div>
                    <div class="pops">
                        <div class="checkmark-circle">
                            <img src="{{ asset('images/tickmark.svg') }}";>
                        </div>
                        <span class="successful">@lang('languages.notif.login_success')</span>
                    </div>
                </div>
                <div class="rounded-rectangle">
                    <div class="navigation-container">
                        <div class="esaton">
                            <img class="esaton-icon" src="{{ asset('images/esaton.svg') }}" alt="ESATON Icon">

                            <div class="buttonis">
                                <span class="menu-item" style="color:white">@lang('languages.informations.members_hallo'),
                                    {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</span>
                                <div class="cancel-button-container">
                                    <button class="button cancel-button" onclick="">@lang('languages.buttons.setting')</button>
                                </div>

                                <div class="header">
                                    <button class="button log-out-button"
                                        onclick="location.href='/logout'">@lang('languages.buttons.logout')</button>
                                </div>

                            </div>

                        </div>



                        <p class="lorem">
                            <b>@lang('languages.informations.members_invited'):</b> 0 <br>
                            <b>@lang('languages.informations.bonus_point'):</b> 0<br>
                            <b>@lang('languages.informations.referral_code'):</b> HSiuq1842<br>

                        </p>

                    </div>

                    <div class="chat-box">
                        <label for="chat-toggle" class="chat-header">@lang('languages.chats.title')
                            <small class="sent-success"
                                style="color:rgb(57, 255, 57);display:none">@lang('languages.notif.chat.warning_sent_success')</small>
                            <small class="sent-failed" style="color:red;display:none">@lang('languages.notif.chat.warning_sent_failed')</small>
                        </label>
                        <div class="chat-content chat-messages">
                            <?php
                            if (count($chathistory) > 0) {
                                foreach ($chathistory as $chats) {
                                    if (Auth::user()->role === 'admin') {
                                        if ($chats->type == 'received') {
                                            $type = 'sent';
                                        } elseif ($chats->type == 'sent') {
                                            $type = 'received';
                                        }
                                    } elseif (Auth::user()->role === 'visitor') {
                                        if ($chats->type == 'sent') {
                                            $type = 'received';
                                        } elseif ($chats->type == 'received') {
                                            $type = 'sent';
                                        }
                                    }
                                    echo '<div class="message ' . $type . '"><small style="font-size:8px">' . $chats->created_at . '</small><br>' . $chats->message . '</div>';
                                }
                            } else {
                                // echo __('languages.notif.chat.warning_no_message');
                            }
                            ?>
                        </div>
                        <div class="chat-content">
                            <?php
                            if (Auth::user()->role === 'admin') {
                                $typeTo = 'sent';
                            } elseif (Auth::user()->role === 'visitor') {
                                $typeTo = 'received';
                            }
                            ?>
                            <div class="chat-input-container" style="background-color:white">
                                <input type="hidden" id="userid" value="{{ $userid }}">
                                <input type="hidden" id="typeTo" value="{{ $typeTo }}">
                                <textarea class="chat-input" id="message" placeholder="@lang('languages.chats.type')"></textarea>
                                <button class="send-button" id="submitMessage">@lang('languages.buttons.send')</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script src="/js/app.js"></script>
<script>
    var userid = '<?= $userid ?>';
    $(document).ready(function() {

        setTimeout(function() {
            closeContentBox();
        }, 2000);

        function loadMessages() {
            $.get('/chat/getMessage/' + userid, function(data) {
                $('.chat-messages').empty();
                data.forEach(function(response) {
                    $('.chat-messages').append('<li><strong>' + response.id + ':</strong> ' +
                        response.message + '</li>');
                });
            });
        }

        // loadMessages();

        $("#message").on('keyup', function(e) {
            if (e.key === 'Enter' || e.keyCode === 13) {
                var userid = $('#userid').val();
                var type = $('#typeTo').val();
                var message = $('#message').val();
                $('.sent-success, .sent-failed').hide();
                if (message) {

                    $.ajax({
                        url: '/chat/visitor/postMessage',
                        method: 'POST',
                        data: {
                            userid: userid,
                            typeTo: type,
                            message: message,
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.success) {
                                $('.sent-success').show();
                                $('#message').val('');
                            }
                        },
                        error: function(error) {
                            $('.sent-failed').show();
                        }
                    });
                } else {
                    $('.sent-failed').show().text('please insert a message');
                }
            }
        });

        $('#submitMessage').click(function() {
            var userid = $('#userid').val();
            var type = $('#typeTo').val();
            var message = $('#message').val();
            $('.sent-success, .sent-failed').hide();
            if (message) {

                $.ajax({
                    url: '/chat/visitor/postMessage',
                    method: 'POST',
                    data: {
                        userid: userid,
                        typeTo: type,
                        message: message,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            $('.sent-success').show();
                            $('#message').val('');
                        }
                    },
                    error: function(error) {
                        $('.sent-failed').show();
                    }
                });
            } else {
                $('.sent-failed').show().text('please insert a message');
            }

        });
        var position = '';
        let channel = Echo.channel('channel-chat');
        channel.listen('MessageSent', function(data) {
            var datas = data;
            console.log(datas);
            if (datas.message.sendFrom == 'admin' && datas.message.type == 'sent') {
                position = 'received';
            } else {
                position = 'sent';
            }
            $('.chat-messages').append(
                `<div class="message ${position}"><small style="font-size:8px">${datas.message.sendTime}</small><br>${datas.message.message}</div>`
                );
        });
    });
</script>

</html>
