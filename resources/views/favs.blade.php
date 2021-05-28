@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12 mb-4">
                <h3>SEÇİLMİŞ MƏHSULLAR</h3>
            </div>
            @if($favs->count() > 0)
                @foreach ($favs as $fav)
                    <div class="col-md-2 col-sm-4 col-xs-6">
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
@endsection