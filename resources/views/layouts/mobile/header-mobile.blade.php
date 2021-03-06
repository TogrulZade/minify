<div class="header-mobile">
    <div class="header-container">
        <div class="search-bar">
            <form action="/axtar" method="GET" class="form-search-mobile" autocomplete="off">
                <input type="text" name="axtar" placeholder="Əşya və ya xidmət axtarışı">
                <button type="submit" class="icon-search">
                    <i class="feather-search"></i>
                </button>
                <div class="box-result">
                    <div class="result"></div>
                </div>
            </form>
            </div>
        </div>
        @if(isset($subCategory))
            @if(count($subCategory) > 0)
            <div class="mobile-category">
                <ul>
                    <li class="kat">
                        <a href="#" class="kataloq"><i class="feather-grid"></i></a>
                    </li>
                    @foreach ($subCategory as $c)
                        <li><a href="{{$c->slug}}"><i class="fas {{$c->icon}}" style="color: {{$c->color}}; font-size: 18px"></i> {{$c->name}}</a></li>
                    @endforeach
                </ul>
            </div>
            @endif
        @else
            <div class="mobile-category">
                <ul>
                    <li class="kat">
                        <a href="#" class="kataloq"><i class="feather-grid"></i></a>
                    </li>
                    @foreach ($getCategory as $c)
                        <li><a href="/c/{{$c->slug}}/"><i class="fas {{$c->icon}}" style="color: {{$c->color}}; font-size: 18px"></i> {{$c->name}}</a></li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</div>