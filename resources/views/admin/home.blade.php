<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@lang('languages.tittle.desktop_page')</title>
    <link rel="stylesheet" href="{{ asset('css/userprofile.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    <script src="{{ asset('js/javascript.js') }}"></script>
</head>

<body>
    <div class="background">
        <div class="overlay"></div>
        <div class="alignment">
            <div class="hamburger-menu" onclick="toggleMenu()">
                <i class="fas fa-bars"></i>
            </div>
            <div class="side-menu">
                <span class="menu-item">@lang('languages.informations.members_hallo'), {{ Auth::user()->firstname }}
                    {{ Auth::user()->lastname }}</span>
                <a href="messenger">
                    <div class="menu-item"><i class="fas fa-comments"></i>&nbsp;&nbsp;@lang('languages.menu.chatting')</div>
                </a>
                <a href="home">
                    <div class="menu-item"><i class="fas fa-user-friends"></i>&nbsp;&nbsp;@lang('languages.menu.user_profiles')</div>
                </a>
                <a href="/logout">
                    <div class="menu-item"><i class="fas fa-power-off"></i>&nbsp;&nbsp;@lang('languages.menu.logout')</div>
                </a>

            </div>

            <div class="user-container">
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
                <div class="user-header">
                    <h1>@lang('languages.menu_title.user_management')</h1>

                </div>
                <div class="user-table">
                    <table class="table table-bordered" id="users-table">
                        <thead>
                            <tr>
                                <th>@lang('languages.table_header.photo')</th>
                                <th>@lang('languages.table_header.login')</th>
                                <th>@lang('languages.table_header.last_name')</th>
                                <th>@lang('languages.table_header.first_name')</th>
                                <th>@lang('languages.table_header.company')</th>
                                <th>@lang('languages.table_header.country')</th>
                                <th>@lang('languages.table_header.created_at')</th>
                                <th>@lang('languages.table_header.actions')</th>
                            </tr>
                        </thead>

                    </table>
                </div>
            </div>


        </div>
    </div>
    <input type="hidden" id="btnModify" value="@lang('languages.buttons.modify')" />
    <input type="hidden" id="srcLabel" value="@lang('languages.menu_title.search_for_user')" />
    <input type="hidden" id="language" value="{{ $language }}" />
    <div id="modifyUserModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <div id="contentDisplay"></div>
            <div id="displayForm" class="content">
                <form action="user/modify" id="formModify" method="POST" class="form-box"
                    enctype="multipart/form-data">
                    <input type="hidden" name="userid" id="userid" />

                    @csrf
                    <!-- Row for First Name & Last Name -->
                    <div class="form-row">
                        <div class="form-group">
                            <label for="firstname">@lang('languages.labels.frm_firstname')</label>
                            <input type="text" id="firstname" name="firstname" value="{{ old('firstname') }}"
                                oninvalid="this.setCustomValidity('@lang('languages.notif.register.warning_firstname')')"
                                oninput="this.setCustomValidity('')" required>
                        </div>
                        <div class="form-group">
                            <label for="lastname">@lang('languages.labels.frm_lastname')</label>
                            <input type="text" id="lastname" name="lastname" value="{{ old('lastname') }}"
                                oninvalid="this.setCustomValidity('@lang('languages.notif.register.warning_lastname')')"
                                oninput="this.setCustomValidity('')" required>
                        </div>
                    </div>

                    <!-- Row for Email -->
                    <div class="form-row">
                        <div class="form-group">
                            <label for="email">@lang('languages.labels.frm_email')</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}"
                                oninvalid="this.setCustomValidity('@lang('languages.notif.register.warning_email')')"
                                oninput="this.setCustomValidity('')" required>
                        </div>

                    </div>

                    <!-- Row for Country & City -->
                    <div class="form-row">
                        <div class="form-group">
                            <label for="age">@lang('languages.labels.frm_age')</label>
                            <input type="number" min="1" id="age" name="age"
                                value="{{ old('age') }}" oninvalid="this.setCustomValidity('@lang('languages.notif.register.warning_age')')"
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

                    <div class="buttons">
                        <button type="submit" class="blue-button">@lang('languages.buttons.save_change')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery.js"></script>
<script src="https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script>
    var btnModify = $('#btnModify').val();
    var srcLabel = $('#srcLabel').val();
    var language = $('#language').val();
    var setLanguage = 'en';

    var de = {
        "sEmptyTable": "Keine Daten in der Tabelle vorhanden",
        "sInfo": "_START_ bis _END_ von _TOTAL_ Einträgen",
        "sInfoEmpty": "0 bis 0 von 0 Einträgen",
        "sInfoFiltered": "(gefiltert von _MAX_ Einträgen)",
        "sInfoPostFix": "",
        "sInfoThousands": ".",
        "sLengthMenu": "_MENU_ Einträge anzeigen",
        "sLoadingRecords": "Wird geladen...",
        "sProcessing": "Bitte warten...",
        "sSearch": "Suchen",
        "sZeroRecords": "Keine Einträge vorhanden.",
        "oPaginate": {
            "sFirst": "Erste",
            "sPrevious": "Zurück",
            "sNext": "Nächste",
            "sLast": "Letzte"
        },
        "oAria": {
            "sSortAscending": ": aktivieren, um Spalte aufsteigend zu sortieren",
            "sSortDescending": ": aktivieren, um Spalte absteigend zu sortieren"
        }
    };

    var en = {
        "sEmptyTable": "No data available in table",
        "sInfo": "Showing _START_ to _END_ of _TOTAL_ entries",
        "sInfoEmpty": "Showing 0 to 0 of 0 entries",
        "sInfoFiltered": "(filtered from _MAX_ total entries)",
        "sInfoPostFix": "",
        "sInfoThousands": ",",
        "sLengthMenu": "Show _MENU_ entries",
        "sLoadingRecords": "Loading...",
        "sProcessing": "Processing...",
        "sSearch": "Search:",
        "sZeroRecords": "No matching records found",
        "oPaginate": {
            "sFirst": "First",
            "sLast": "Last",
            "sNext": "Next",
            "sPrevious": "Previous"
        },
        "oAria": {
            "sSortAscending": ": activate to sort column ascending",
            "sSortDescending": ": activate to sort column descending"
        }
    };



    $(function() {

        if (language == 'en') {
            setLanguage = en;
        } else if (language == 'de') {
            setLanguage = de;
        }

        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('admin.index') !!}',
            oLanguage: setLanguage,
            order: [
                [6, 'desc']
            ],
            columns: [{
                    data: 'image',
                    visible: true,
                    render: function(data, type, row, meta) {
                        return `<img style='display:block; width:100px;height:100px;cursor:pointer' onclick="viewImage('${data}')" src='data:image/jpeg;base64, ${data}' />`;
                    }
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'lastname',
                    name: 'lastname'
                },
                {
                    data: 'firstname',
                    name: 'firstname'
                },
                {
                    data: 'company',
                    name: 'company'
                },
                {
                    data: 'country',
                    name: 'country'
                },
                {
                    data: 'reg_date',
                    name: 'reg_date'
                },
                {
                    data: 'id',
                    visible: true,
                    render: function(data, type, row, meta) {
                        return `<button class="modify-button" onclick="openModal('${data}')">${btnModify}</button>`;
                    }
                }
            ]
        });
    });
</script>

</html>
