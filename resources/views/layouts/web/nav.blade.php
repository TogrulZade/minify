<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">
                Minify
                {{-- <span style="font-size: 22px; font-family: Poppins; font-weight: 600">mini<span style="margin-left: 2px;padding: 5px 8px; background: #222; color: #fff; border-radius: 6px">fy</span></span> --}}
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav navbar-category">
                {{-- <li><a href="#">Mağazalar</a></li> --}}
                {{-- <li class="active"><a href="#">Kateqoriyalar</a></li> --}}
            </ul>
            <form class="navbar-form navbar-left" action="/axtar" role="search">
                <div class="form-group form-search">
                    <input id="axtar" type="text" name="axtar" class="form-control col-md-6" value="{{old('axtar')}}" placeholder="Əşya və ya xidmət axtarın...">
                    <div class="icon"><i class="feather-search" style="font-size: 15px"></i></div>
                </div>
                <button type="submit" class="btn btn-search">Axtarış et</button>
            </form>
            <ul class="nav navbar-nav navbar-right xs-p-3 nav-sign">
                {{-- <li><a class="btn-sel" href="/sell"><i class="fas fa-paper-plane"></i> Elan yerləşdir</a></li> --}}
                @auth
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{Auth::user()->name}} {{Auth::user()->surname}}<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li class="active"><a href="makeMarket">Mağaza aç</a></li>
                        <li><a href="/myMarket">Mağazalarım</a></li>
                        @if(Auth::user()->id == 1)
                            <li><a href="/admin">Admin Panel</a></li>
                        @endif
                        <li><a href="/cabinet">Şəxsi kabinet</a></li>
                        <li><a href="/showFavs">Seçilənlər</a></li>
                        <li><a href="#">Balans</a></li>
                        <li class="divider"></li>
                        {{-- <form action="/logout" method="post"> --}}
                            {{-- @csrf --}}
                            <li><a href="{{url('logout')}}">Təhlükəsiz çıxış</a></li>
                        {{-- </form> --}}
                    </ul>
                </li>
                @else
                <li class="sign">
                    <li><a href="/login">Daxil ol</a></li>
                    <li><a href="/register">Qeydiyyat</a></li>
                </li>
                @endauth
            </ul>
        </div><!-- /.navbar-collapse -->
    </div>
</nav>

{{-- <div class="header navbar navbar-fixed-top">
    <div class="navbar-header">
    <button type="button" class="navbar-toggle navbar-toggle-black collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <div class="container">
            <ul class="nav navbar-nav">
                    
                <li><a href="/c/elektronika">Elektronika</a></li>
                <li><a href="/c/elektronika">Elektronika</a></li>
                <li><a href="/c/geyim">Geyim</a></li>
                <li><a href="/c/shexsi-esyalar">Şəxsi əşyalar</a></li>
                <li><a href="/c/xidmetler">Xidmətlər</a></li>
                <li><a href="/c/usaq">Uşaq</a></li>
                <li><a href="/c/hobbi-ve-asude">Hobbi və asudə</a></li>
                <li><a href="/c/usaq-alemi">Uşaq aləmi</a></li>
                <li><a href="/c/heyvanlar">Heyvanlar</a></li>
                <li><a href="/c/neqliyyat">Nəqliyyat</a></li>
            </ul>
        </div>
    </div>
</div> --}}


<div class="header navbar navbar-fixed-top">
    <div class="navbar-header">
    <button type="button" class="navbar-toggle navbar-toggle-black collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <div class="container">
            <ul class="nav navbar-nav">

                <li class="drop-down"><a href="#"><i class="fas fa-bars"></i> Kataloq</a>
                    <div class="subcategory hide">
                        <ul class="ul_subcategory">
                            @foreach ($getCategory as $gc)
                                <li>
                                    <a href="#">{{$gc->name}} 
                                        @if ($gc->childrenCategories)
                                        <i class="fas fa-chevron-right"></i>
                                        @endif
                                    </a>
                                </li>
                                <ul class="sub_item">
                                    @foreach ($gc->childrenCategories as $childCategory)
                                        @include('child_category', ['child_category' => $childCategory])
                                    @endforeach
                                </ul>
                            @endforeach
                            
                        </ul>
                    </div>
                </li>
                

                <li><a href="/c/elektronika">Elektronika</a></li>
                <li><a href="/c/shexsi-esyalar">Şəxsi əşyalar</a></li>
                <li><a href="/c/xidmetler">Xidmətlər</a></li>
                <li><a href="/c/hobbi-ve-asude">Hobbi və asudə</a></li>
                <li><a href="/c/usaq-alemi">Uşaq aləmi</a></li>
                <li><a href="/c/heyvanlar">Heyvanlar</a></li>
                <li><a href="/c/neqliyyat">Nəqliyyat</a></li>
            </ul>
        </div>
    </div>
</div>

@if(Request::is('/'))
<div style="background-color: #f8f9fd; width: 100%; float: left">
<div class="container" style="margin-top: 100px; margin-bottom: 20px">
    <div class="row">
        <div class="col-xs-12">
            <div class="wrap-category">
                @foreach ($getCategory as $index=>$gc)
                <div class="category-item" href="/c/{{$gc->slug}}" style="border:1px solid {{$gc->color}}">
                    <div class="items-wr">
                    <div class="item-icon">
                    <i class="fas {{$gc->icon}}" style="color: {{$gc->color}}"></i>
                    </div>
                    <span class="item-name">{{$gc->name}}</span>
                    </div>
                    <ul class="subcat">
                        @foreach ($gc->childrenCategories as $childCategory)
                            <li><a href="">{{$childCategory->name}}</a></li>
                        @endforeach
                    </ul>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
</div>

@endif