<div class="right-sticky">
    <ul class="sticky-wrapper">
        <li class="sticky-item">
            <a href="#"><i class="feather-credit-card"></i></a>
            <ul class="stick_hover_menu">
                <li>{!!Auth::user() ? 'Balans: <strong style="color: #fee500">'.Auth::user()->balans.' AZN</strong>' : 'Balansınızı artırın'!!}</li>
            </ul>
        </li>
        <li class="sticky-item favorite">
            <a href="#">
                <i class="feather-heart"></i>
                {{-- <div class="count-favorite">0</div> --}}
            </a>
        </li>
        <li class="sticky-item">
            <a href="#"><i class="feather-message-square"></i></i> </a>
            <ul class="stick_hover_menu">
                <li><a href="#">Gələnlər</a></li>
                <li><a href="#">Göndərdikləriniz</a></li>
            </ul>
        </li>
        <li class="sticky-item">
            <a href="/cabinet"><i class="feather-user"></i></a>
            <ul class="stick_hover_menu">
                <li><a href="/cabinet">Şəxsi kabinet</a></li>
            </ul>
        </li>
    </ul>
</div>

<div class="sticky-body">
    <div class="sticky-body-wrapper">
        <div class="sticky-body-header">
            Bəyəndikləriniz
        </div>
        <div class="sticky-body-content">
            @if($favs->count() > 0)
                @foreach ($favs as $fav)
                    <div class="col-md-6 col-sm-4 col-xs-6">
                        <a href="/product/{{$fav->slug}}" class="card-mini">
                            <div class="card-img">
                                <img src="{{asset('storage/'.$fav->product_cover)}}" alt="">
                                    <div class="add_favorite" data-product_id="{{$fav->id}}" style="color: red;">
                                        <i class="fas fa-heart"></i>
                                    </div>
                            </div>
                                        
                            <div class="card-title">
                                {{$fav->product_price}} AZN
                            </div>
                            
                            <div class="card-body">
                                <strong class="mb-0">{{$fav->product_name}}</strong>
                            </div>
            
                            <div class="card-footer">
                                <p>{{$fav->created_at}}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            @else
                <div class="stick-notify">
                    <div class="stick-body-fav-icon">
                        <i class="feather-heart"></i>
                    </div>
                    <p>Seçilmiş məhsul tapılmadı</p>
                </div>
            @endif
        </div>
    </div>
</div>