<meta name="csrf-token" content="{{ csrf_token() }}">
<header class="chat-header">
    <div class="chat-partner">@lang('languages.chats.chat_with') {{ $name }}</div>
    <small class="sent-success" style="color:green;display:none">@lang('languages.notif.chat.warning_sent_success')</small>
    <small class="sent-failed" style="color:red;display:none">@lang('languages.notif.chat.warning_sent_failed')</small>
</header>
<div class="chat-messages">
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
            echo '<div class="message ' . $chats->type . '"><span style="font-size:8px">' . $chats->created_at . '</span><br>' . $chats->message . '</div>';
        }
    } else {
        // echo __('languages.notif.chat.warning_no_message');
    }
    ?>
</div>
<footer class="chat-footer">
    <?php
    if (Auth::user()->role === 'admin') {
        $typeTo = 'sent';
    } elseif (Auth::user()->role === 'visitor') {
        $typeTo = 'received';
    }
    ?>
    <input type="hidden" id="userid" value="{{ $userid }}">
    <input type="hidden" id="typeTo" value="{{ $typeTo }}">
    <input type="text" id="message" placeholder="@lang('languages.chats.type')">
    <button type="submit" id="submitMessage">@lang('languages.buttons.send')</button>
</footer>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script src="/js/app.js"></script>
<script>
    var userid = '<?= $userid ?>';
    $(document).ready(function() {
        function loadMessages() {
            $.get('/chat/getMessage/admin/' + userid, function(data) {
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
                        url: '/chat/postMessage',
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
                    url: '/chat/postMessage',
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
            if (datas.message.sendFrom == 'visitor' && datas.message.type == 'received') {
                position = 'received';
            } else {
                position = 'sent';
            }
            $('.chat-messages').append(
                `<div class="message ${position}"><span style="font-size:8px">${datas.message.sendTime}</span><br>${datas.message.message}</div>`
                );
        });
    });
</script>
