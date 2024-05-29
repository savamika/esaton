<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@lang("languages.titles.user_page")</title>
    <link rel="stylesheet" href="{{ asset('css/desktoplog.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700;800&display=swap" rel="stylesheet">
    <script src="{{ asset('js/javascript.js') }}"></script>
</head>
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
                        <span class="successful">@lang("languages.notif.register_success")</span>
                    </div>
                </div>
                <div class="rounded-rectangle">
            <div class="navigation-container">
                <div class="esaton">
                <img class="esaton-icon" src="{{ asset('images/esaton.svg') }}" alt="ESATON Icon">

                <div class="buttonis">
                <div class="cancel-button-container">
                    <button class="button cancel-button" onclick="">@lang("languages.buttons.setting")</button>
                </div>

                <div class="header">
                    <button class="button log-out-button" onclick="location.href='/'">@lang("languages.buttons.logout")</button>
                </div>

                </div>

            </div>



            <p class="lorem">
                <b>@lang("languages.informations.members_invited"):</b> 0 <br>
                <b>@lang("languages.informations.bonus_point"):</b> 0<br>
                <b>@lang("languages.informations.referral_code"):</b> HSiuq1842<br>

            </p>

            </div>

            <div class="chat-box">
                <label for="chat-toggle" class="chat-header">@lang("languages.chats.title") </label>
                <div class="chat-content">
                    <div class="message received">
                        <p>@lang("languages.chats.cov1")</p>
                    </div>
                    <div class="message sent">
                        <p>@lang("languages.chats.cov2")</p>
                    </div>
                    <!-- Placeholder for additional messages -->
                    <div class="chat-input-container">
                        <textarea class="chat-input" placeholder="@lang("languages.chats.type")"></textarea>
                        <button class="send-button">@lang("languages.buttons.send")</button>
                    </div>
                </div>
            </div>

    </div>
            </div>
        </div>
    </div>

</body>
</html>
