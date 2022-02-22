<div class="full-opacity"></div>
<div id="nav" class="navbar-fixed-top">
    <div class="drawermenu_button" style="">
        <i class="feather-menu"></i>
    </div>

    <div class="brand">
        <a href="/">Şəxsi kabinet</a>
    </div>

    <div class="">
        <a style="color: #fff" href="/logout">Çıxış</a>
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
                    @if (Auth::user())
                        <li><a class="icon-card"href="/logout"><i class="feather-log-out"></i> Çıxış</a></li>
                    @endif
                </ul>
                <ul class="section">
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

<div class="col-xs-12 bg-primary" style="margin-top: 60px; padding: 15px 0;">
    <div style="padding: 0 15px">
        <div>
            <div style="display:flex; flex-direction: row; align-items: center; justify-content: space-between; margin-bottom: 10px">
                <div style="display:flex; ">
                    <img style="margin-right: 10px" src="{{asset('storage/src/no_profile.svg')}}" alt="">
                    <div style="display:flex; flex-direction: column;justify-content: center">
                        <span>{{Auth::user()->name}}</span>
                        <span>{{Auth::user()->phone}}</span>
                    </div>
                </div>

                <div style="font-size: 16px">
                    <i class="fas fa-edit"></i>
                </div>

                </div>
            </div>

            <div class="col-xs-12 box-balans p-3 bg-white" style="
            display:flex;  color: #000; flex-direction: column; border-radius: 10px; justify-content: space-between;">
                <div style="display:flex;flex-direction: row; justify-content: space-between; align-items: center; ">
                    <div style="display:flex;flex-direction: column;">
                        <span style="color: #8d94ad">Şəxsi hesab</span>
                        <span style="font-size: 18px; font-weight: 900">{{Auth::user()->balans}} AZN</span>
                    </div>
                    <div>
                        <a href="#" class="btn btn-primary">Artır</a>
                    </div>
                </div>
            </div>
        </div>
        <div>

        </div>
    </div>
</div>
