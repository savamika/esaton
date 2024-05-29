<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@lang("languages.titles.home")</title>
    <link rel="stylesheet" href="{{ asset('css/desktop.css') }}" media="screen and (min-width: 769px)">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" media="screen and (max-width: 768px)">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700;800&display=swap" rel="stylesheet">
</head>
<body>

    <div class="background">
        <div class="overlay"></div>

        <div class="content">

            <div class="rounded-rectangle">
                <div class="line-container">

                    <div class="text">
                        <img class="esaton-icon" src="{{ asset('images/esaton.svg') }}" alt="ESATON Icon">
                        <div class="icon">
                            <img class="webicon" src="{{ asset('images/Web icon.png') }}" alt="Web Icon">
                        </div>
                    </div>

                </div>
                <p id="description">@lang("languages.description")</p>
            </div>
            <div class="buttons">
                <button class="blue-button" onclick="window.location.href='login'">@lang("languages.buttons.login")</button>
                <button class="blue-button" onclick="window.location.href='register'">@lang("languages.buttons.register")</button>
            </div>

            <div class="design-line"></div>

        </div>
        <div class="legal">
            <div class="footer">
                <div class="language-select">
                    <select onchange="changeLanguage(this)">
                        <option value="en" <?=(Session::get('setLanguage') == 'en'?'selected':'')?> >English</option>
                        <option value="de" <?=(Session::get('setLanguage') == 'de'?'selected':'')?> >Deutsch</option>
                    </select>
                </div>
                <div class="legal-text">
                <p><a href="legal">@lang("languages.labels.legal_information")</a></p></div>
            </div>

        </div>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ asset('js/javascript.js') }}"></script>
</html>
