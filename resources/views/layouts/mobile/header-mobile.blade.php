<div class="header-mobile">
    <div class="header-container">
        <div class="search-bar">
            <form action="/axtar" method="GET">
                <input type="text" name="axtar" placeholder="Əşya və ya xidmət axtarışı">
                <button type="submit" class="icon-search">
                    <i class="feather-search"></i>
            </form>
            </div>
        </div>
        <div class="mobile-category">
            <ul>
                @foreach ($cat as $c)
                    <li><a href="/c/{{$c->slug}}">{{$c->name}}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
</div>