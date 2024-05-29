<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@lang('languages.titles.register_page')</title>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
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
                        <span class="switcher login" onclick="location.href='login'">@lang('languages.buttons.login')</span>
                        <span class="switcher register active">@lang('languages.buttons.register')</span>
                    </div>
                </div>
            </div>
            <form action="register" method="POST" class="form-box" enctype="multipart/form-data">
                @if (Session::has('success'))
                    <div class="content-box">
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
                <!-- Row for First Name & Last Name -->
                <div class="form-row">
                    <div class="form-group">
                        <label for="firstname">@lang('languages.labels.frm_firstname')</label>
                        <input type="text" id="firstname" name="firstname" value="{{ old('firstname') }}"
                            oninvalid="this.setCustomValidity('@lang('languages.notif.register.warning_firstname')')" oninput="this.setCustomValidity('')"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="lastname">@lang('languages.labels.frm_lastname')</label>
                        <input type="text" id="lastname" name="lastname" value="{{ old('lastname') }}"
                            oninvalid="this.setCustomValidity('@lang('languages.notif.register.warning_lastname')')" oninput="this.setCustomValidity('')"
                            required>
                    </div>
                </div>

                <!-- Row for Email -->
                <div class="form-row">
                    <div class="form-group">
                        <label for="email">@lang('languages.labels.frm_email')</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            oninvalid="this.setCustomValidity('@lang('languages.notif.register.warning_email')')" oninput="this.setCustomValidity('')"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="conf_email">@lang('languages.labels.frm_confrm_email')</label>
                        <input type="email" id="conf_email" name="conf_email" value="{{ old('conf_email') }}"
                            oninvalid="this.setCustomValidity('@lang('languages.notif.register.warning_conf_email')')"
                            oninput="this.setCustomValidity('')" required>
                    </div>

                </div>
                <div class="form-row">
                    <!-- Password field -->
                    <div class="form-group password-group">
                        <label for="password">@lang('languages.labels.frm_password')</label>
                        <input type="password" id="password" name="password" value="{{ old('password') }}"
                            oninvalid="this.setCustomValidity('@lang('languages.notif.register.warning_password')')"
                            oninput="this.setCustomValidity('')" required>
                    </div>
                    <!-- Password Repeat field -->
                    <div class="form-group password-group">
                        <label for="password-repeat">@lang('languages.labels.frm_confrm_password')</label>
                        <input type="password" id="password-repeat" name="password_repeat"
                            value="{{ old('password_repeat') }}"
                            oninvalid="this.setCustomValidity('@lang('languages.notif.register.warning_password_repeat')')"
                            oninput="this.setCustomValidity('')" required>
                    </div>
                </div>

                <!-- Row for Country & City -->
                <div class="form-row">
                    <div class="form-group">
                        <label for="age">@lang('languages.labels.frm_age')</label>
                        <input type="number" min="1" id="age" name="age" value="{{ old('age') }}"
                            oninvalid="this.setCustomValidity('@lang('languages.notif.register.warning_age')')"
                            oninput="this.setCustomValidity('')" required>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="country">@lang('languages.labels.frm_country')</label>
                        <input type="text" id="country" name="country" value="{{ old('country') }}"
                            oninvalid="this.setCustomValidity('@lang('languages.notif.register.warning_country')')"
                            oninput="this.setCustomValidity('')" required>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="city">@lang('languages.labels.frm_city')</label>
                        <input type="text" id="city" name="city" value="{{ old('city') }}"
                            oninvalid="this.setCustomValidity('@lang('languages.notif.register.warning_city')')"
                            oninput="this.setCustomValidity('')" required>
                    </div>
                </div>

                <!-- Row for Job & Education -->
                <div class="form-row">
                    <div class="form-group">
                        <label for="job">@lang('languages.labels.frm_job')</label>
                        <input type="text" id="job" name="job" value="{{ old('job') }}"
                            oninvalid="this.setCustomValidity('@lang('languages.notif.register.warning_job')')"
                            oninput="this.setCustomValidity('')" required>
                    </div>
                    <div class="form-group">
                        <label for="company">@lang('languages.labels.frm_company')</label>
                        <input type="text" id="company" name="company" value="{{ old('company') }}"
                            oninvalid="this.setCustomValidity('@lang('languages.notif.register.warning_company')')"
                            oninput="this.setCustomValidity('')" required>
                    </div>
                    <div class="form-group">
                        <label for="education">@lang('languages.labels.frm_education')</label>
                        <input type="text" id="education" name="education" value="{{ old('education') }}"
                            oninvalid="this.setCustomValidity('@lang('languages.notif.register.warning_education')')"
                            oninput="this.setCustomValidity('')" required>
                    </div>
                </div>

                <div class="form-group ref-group">
                    <label for="Referral">@lang('languages.labels.frm_referral_code')</label>
                    <input type="Referral" id="Referral" name="referral_code">
                </div>

                <!-- Full-width field for Photo -->
                <div class="form-group">
                    <input type="file" id="photo" name="photo" value="{{ old('photo') }}" accept="image/png, image/jpeg"
                        oninvalid="this.setCustomValidity('@lang('languages.notif.register.warning_photo')')" oninput="this.setCustomValidity('')">
                    <label for="photo" class="custom-file-upload">
                        <i class="fa fa-cloud-upload"></i> @lang('languages.labels.frm_choose_photo')
                    </label>
                </div>

                <div class="buttons">
                    <button type="submit" class="blue-button">@lang('languages.buttons.register')</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
