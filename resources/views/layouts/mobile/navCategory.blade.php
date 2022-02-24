<div class="full-opacity"></div>
<div id="nav" class="navbar-fixed-top" style="{{$agent->isMobile() && isset($isCategoryRoute) && $isCategoryRoute ? 'background-color: #fff; box-shadow: none' : ''}}">
    @if($agent->isMobile() && isset($isCategoryRoute) && $isCategoryRoute)
        <a href="{{$parent_category ? $parent_category->slug : '/' }}" class="goBack"><i class="feather-chevron-left"></i></a>
    @else
    <div class="drawermenu_button" style="{{$agent->isMobile() && isset($isCategoryRoute) && $isCategoryRoute ? 'color: #444' : ''}}">
        <i class="feather-menu"></i>
    </div>
    @endif

    <div class="brand {{$agent->isMobile() && isset($isCategoryRoute) && $isCategoryRoute ? 'mobile' : ''}}">
        @if($agent->isMobile() && isset($isCategoryRoute) && $isCategoryRoute)
            <a href="">{{$categoryName}}</a>
        @else
            <a href="/">Minify.az</a>
        @endif
    </div>

    <div class="add_elan">
        <a href="/sell"><i class="feather-plus"></i></a>
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
                        @if(Auth::user()->id == 1)
                            <li><a class="username" href="/admin"><i class="feather-monitor"></i> Admin Panel</a></li>
                        @endif
                        <li><a class="username" href="/cabinet"><i class="feather-user"></i>{{Auth::user()->name}}</a></li>
                        
                    @else
                        <li><a class="login" href="/login"><i class="feather-user"></i> Giriş</a></li>
                    @endif
                    <div class="seperator"></div>
                    <li><a class="favorite" href="/showFavs"><i class="feather-heart"></i> Seçilmişlər</a></li>
                    <li><a class="icon-card"href="#"><i class="feather-credit-card"></i> Balansını artır</a></li>
                    <div class="seperator"></div>
                    <li><a class="icon-card"href="/logout"><i class="feather-log-out"></i> Çıxış</a></li>
                </ul>
                <ul class="section">
                    {{-- <li><a href="#">Tam versiya</a></li> --}}
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
