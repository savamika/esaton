<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@lang('languages.titles.desktop_page')</title>
    <script src="{{ asset('js/javascript.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/messenger.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

</head>
<body>
    <div class="background">
        <div class="overlay"></div>

        <div class="alignment">
            <div class="hamburger-menu" onclick="toggleMenu()">
                <i class="fas fa-bars"></i> </div>
        <div class="side-menu">

           <a href="messenger"> <div class="menu-item"><i class="fas fa-comments"></i> @lang('languages.menu.chatting')</div></a>
           <a href="home"> <div class="menu-item"><i class="fas fa-user-friends"></i> @lang('languages.menu.user_profiles')</div></a>
           <a href="/"> <div class="menu-item"><i class="fas fa-power-off"></i> @lang('languages.menu.logout')</div></a>

        </div>
        <div class="messenger-container">
            <aside class="sidebar">
                <header class="search-container">
                    <input type="text" placeholder="@lang('languages.menu_title.search_for_user')">
                </header>
                <nav class="contact-list">
                    @foreach ($visitorlist as $visitors)
                        <div class="contact" onclick="loadChatPage('{{ $visitors->id }}', '{{ $visitors->firstname }} {{ $visitors->lastname }}')">{{ $visitors->firstname }} {{ $visitors->lastname }}</div>
                    @endforeach
                </nav>
            </aside>
            <section class="chat-area">
                <header class="chat-header">
                    <div class="chat-partner"></div>
                </header>
                <div class="chat-messages">
                    @lang('languages.notif.chat.warning_select_first')
                </div>
                <footer class="chat-footer">
                </footer>
            </section>
        </div>
    </div>
</div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
    function loadChatPage(id, name){
        var fulname = name.replaceAll(" ", "%20");
       $('.chat-area').empty().load('/chat/loadview/'+id+'/'+fulname, function(ret){

       });
    }
</script>
</html>
