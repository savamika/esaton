<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@lang('languages.titles.login_page')</title>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <script src="{{ asset('js/javascript.js') }}"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700;800&display=swap" rel="stylesheet">
</head>

<body>
    <div class="background">
        <div class="overlay"></div>
        <div class="content">
            <div class="navigation-container">
                <div class="cancel-button-container">
                    <button class="cancel-button" onclick="location.href='/'">&larr; @lang('languages.buttons.cancel')</button>
                </div>
                <div class="tabs-container">
                    <div class="form-switcher">
                        <span class="switcher login active">@lang('languages.buttons.login')</span>
                        <span class="switcher register" onclick="location.href='register'">@lang('languages.buttons.register')</span>
                    </div>
                </div>
            </div>
            <form action="login" method="POST" class="form-box">
                @if (Session::has('success'))
                    <<div class="content-box">
                        <div class="pops">
                            <p><span style="color:green">{{ Session::get('success') }}</span></p>
                        </div>
                    </div>
                @endif
                @if ($errors->any())
                    <div class="content-box">
                        <div class="pops">
                            @foreach ($errors->all() as $item)
                                <p><span class="failed">{{ $item }}</span></p>
                            @endforeach
                        </div>
                    </div>
                @endif
                @csrf
                <div class="form-group">
                    <label for="email">@lang('languages.labels.email')</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                        oninvalid="this.setCustomValidity('@lang('languages.notif.login.warning_email')')" oninput="this.setCustomValidity('')"
                        required>
                </div>
                <div class="form-group">
                    <label for="password">@lang('languages.labels.password')</label>
                    <input type="password" id="password" name="password" value="{{ old('password') }}"
                        oninvalid="this.setCustomValidity('@lang('languages.notif.login.warning_password')')" oninput="this.setCustomValidity('')"
                        required>
                </div>
                <div class="buttons">
                    <button type="submit" class="blue-button">@lang('languages.buttons.login')</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
