@extends('layouts.app')

@section('content')
@if(!$agent->isMobile())
    @include('partial.sticky')
@else
    @include('layouts.mobile.header-mobile')
@endif
<div class="container">
    <div class="row">
        @if (!$agent->isMobile())    
            {{-- <div class="col-xs-12">
                <div class="banner">
                    <h4 class="text-center">Sizin Reklamınız Burada</h4>
                </div>
            </div> --}}
        @endif

        @if(!empty($vips))
        <div class="col-xs-12">
        @foreach ($vips as $i=>$vip)
            @if ($vip->id && $i == 0)
            <div class="col-xs-12">
                <h3 class="black mb-5" style="color: #8d94ad; font-size: 16px;">VIP Elanlar</h3>
            </div>
            @endif

            <div class="col-md-3 col-sm-4 col-xs-6">
                <a href="/product/{{$vip->slug}}" class="card">

                    <div class="card-img">
                        <img src="{{asset('storage/'.$vip->product_cover)}}" alt="">
                        <div class="vip-icon">
                            <i class="fas fa-gem"></i>
                        </div>
                    </div>
                    
                    <div class="card-title">
                        {{$vip->product_price}} AZN
                    </div>
                    
                    <div class="card-body">
                        <h5 class="mb-0">{{$vip->product_name}}</h5>
                    </div>

                    <div class="card-footer">
                        <p>{{$vip->created_at}}</p>
                    </div>
                </a>
            </div>

            {{-- <div class="col-md-4 col-xs-6 col-sm-4 mb-3 col-lg-3">
                <a href="/product/{{$vip->slug}}" class="box">
                    <img src="{{asset('storage/'.$vip->product_cover)}}" alt="">
                    <div class="box-footer">
                        <div class="wrap-footer">
                        <h4>{{$vip->product_name}}</h4>
                        <div class="price">
                            {{$vip->product_price}} AZN
                        </div>
                        </div>
                    </div>
                </a>
            </div> --}}
        @endforeach
        </div>
        @endif

        @php $z = 0;@endphp
        @if (count($products) == 0 || empty($vips))
        <div class="col-xs-12">
            <div class="col-sm-6 col-sm-offset-3">
                <div class="row">
                    <div class="wrap">
                        <div class="wrap-content">
                            <i class="fas fa-box-open"></i>
                            <p>Göstəriləcək məhsul tapılmadı</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="col-xs-12">
            @if($categoryName == '')
            <div class="col-xs-12 mb-3">
                <h4>BÜTÜN ELANLAR</h4>
            </div>
            @else
            <div class="col-xs-12 mb-3">
                <h4 class="black mb-5">{{$categoryName}}</h4>
            </div>
                
            @endif
        </div>
        @endif

        @foreach($products as $pr_index => $pr)
        <div class="col-md-3 col-sm-4 col-xs-6">
            <a href="/product/{{$pr->slug}}" target="_blank" class="{{ $agent->isMobile() ? 'card-mini' : 'card' }}">
                <div class="card-img">
                    <img src="{{asset('storage/'.$pr->product_cover)}}" alt="">
                        @foreach ($favs as $fav)
                            @if ($fav->id == $pr->id)
                            @php $z = $pr->id @endphp
                                <div class="add_favorite" data-product_id="{{$pr->id}}" style="{{$fav->id == $pr->id ? 'color: red' : ''}}">
                                    <i class="fas fa-heart"></i>
                                </div>
                            @endif
                        @endforeach
                        @if ($z != $pr->id)
                        <div class="add_favorite" data-product_id="{{$pr->id}}" style="">
                            <i class="fas fa-heart"></i>
                        </div>
                        @endif
                </div>
                            
                <div class="card-title">
                    {{$pr->product_price}} AZN
                </div>
                
                <div class="card-body">
                    <strong class="mb-0">{{$pr->product_name}}</strong>
                </div>

                <div class="card-footer">
                    <p>{{$pr->created_at}}</p>
                </div>
            </a>
        </div>

            {{-- End card --}}
        @endforeach

        <div id="autoload"></div>
        <div id="load-image" style="display: none">Loading...</div>
    </div>
</div>
@endsection
