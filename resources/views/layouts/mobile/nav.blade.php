<div class="full-opacity"></div>
<div id="nav">
    <div class="drawermenu_button" style="">
        <i class="feather-menu"></i>
    </div>

    <div class="brand">
        <a href="/">Minify.az</a>
    </div>

    <div class="add_elan">
        <i class="feather-plus"></i>
    </div>

    <div class="drawermenu">
        <div class="drawer_wrapper">
            <div class="drawer_header">
                <span class="drawer_lang"><a class="lang_link" href="">RU</a></span>
                <a href="/" class="drawer_brand">Minify.az</a>
                <span class="drawer_close"><i class="feather-x"></i></span>
            </div>
            <div class="drawer_content">
                <ul class="section">
                    @if (Auth::user())
                        <li><a class="username" href="#"><i class="feather-user"></i>{{Auth::user()->name}}</a></li>
                    @else
                        <li><a class="login" href="/login"><i class="feather-user"></i> Giriş</a></li>
                    @endif
                    <div class="seperator"></div>
                    <li><a class="favorite" href="/showFavs"><i class="feather-heart"></i> Seçilmişlər</a></li>
                    <li><a class="icon-card"href="#"><i class="feather-credit-card"></i> Balansını artır</a></li>
                </ul>
                <ul class="section">
                    <li><a href="#">Tam versiya</a></li>
                    {{-- <div class="seperator"></div> --}}
                    <li><a href="#">Saytda reklam</a></li>
                </ul>
            </div>
            <div class="drawer_footer">
                <div class="drawer_footer_content">
                    <div class="copy">&copy; 2021 - Minify.az</div>
                </div>
            </div>
        </div>
    </div>
</div>