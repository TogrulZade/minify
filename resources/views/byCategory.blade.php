@extends('layouts.app')

@section('title')
{{$title ?? $categoryName ?? null}}
@endsection



@section('content')
@if(!$agent->isMobile())
    @include('partial.sticky')
@else
    @include('layouts.mobile.navCategory',['categoryName'=>$categoryName])
    @include('layouts.mobile.header-mobile')
@endif
<div class="{{$agent->isMobile() ? 'container-fluid' : 'container'}}">
    <div class="row">
        @if (!$agent->isMobile())    
            {{-- <div class="col-xs-12">
                <div class="banner">
                    <h4 class="text-center">Sizin Reklamınız Burada</h4>
                </div>
            </div> --}}
        @endif

        <div class="col-xs-12 mt-5 mb-2 {{$agent->isMobile() ? 'mobile-content' : ''}}" style="{{$agent->isMobile() ? 'padding: 0 15px;' : ''}} border-radius: 6px">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="elanlar">Bütün kateqoriyalar</a>
                    </li>
                    @foreach ($current_cat as $n=>$cc)
                    <li class="breadcrumb-item active" aria-current="page">
                        @if ($n !=count($current_cat)-1)
                            <a href="/c/{{$cc->slug}}">{{$cc->name}}</a></li>
                        @else
                            {{$cc->name}}
                        @endif
                    @endforeach
                </ol>
                </nav>
                    
        </div>

        @if(!empty($vips))
        <div class="col-xs-12">
        @foreach ($vips as $i=>$vip)
            @if ($vip->id && $i == 0)
            <div class="col-xs-12 section-title">
                <h3 class="black mb-5" style="color: #8d94ad; font-size: 16px;font-weight: 700;">VIP Elanlar</h3>
                <a href="/elanlar/vip">Bütün VİP Elanlar</a>
            </div>
            @endif

            <div class="col-md-3 col-sm-4 col-xs-6">
                <a href="/product/{{$vip->slug}}" class="card">

                    <div class="card-img">
                        <img src="{{asset('storage/'.$vip->product_cover)}}" alt="">
                        <div class="icon-group">
                            @if (count($vip->premium) >0)
                                <div class="premium-icon" style="margin-right: 5px;">
                                    <i class="fas fa-crown"></i>
                                </div>
                            @endif

                            <div class="vip-icon">
                                <i class="fas fa-gem"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-title-wrap">
                        <div class="card-title">
                            {{$vip->product_price}} AZN
                        </div>
                        @php $z = 0;@endphp
                        @foreach ($favs as $fav)
                            @if ($fav->id == $vip->id)
                            @php $z = $vip->id @endphp
                                <div class="add_favorite" data-product_id="{{$vip->id}}" style="{{$fav->id == $vip->id ? 'color: red' : ''}}">
                                    <i class="fas fa-heart"></i>
                                </div>
                            @endif
                        @endforeach
                        @if ($z != $vip->id)
                        <div class="add_favorite" data-product_id="{{$vip->id}}" style="">
                            <i class="fas fa-heart"></i>
                        </div>
                        @endif
                    </div>
                    
                    <div class="card-body">
                        <h5 class="mb-0">{{$vip->product_name}}</h5>
                    </div>

                    <div class="card-footer">
                        <p>{{$vip->created_at}}</p>
                    </div>
                </a>
            </div>
        @endforeach
        </div>
        @endif

        @php $z = 0;@endphp
        @if (count($products) == 0 && count($vips) == 0)
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
        @endif

        @if(count($products) > 0)
        <div class="col-xs-12">
            <h3 class="black mb-5" style="color: #8d94ad; font-size: 16px;font-weight: 700;">SON ELANLAR</h3>
        </div>
            @foreach($products as $pr_index => $pr)
                <div class="col-md-3 col-sm-4 col-xs-6">
                    <a href="/product/{{$pr->slug}}" target="_blank" class="{{ $agent->isMobile() ? 'card' : 'card' }}">
                        <div class="card-img">
                            <img src="{{asset('storage/'.$pr->product_cover)}}" alt="">
                        </div>
                        <div class="card-title-wrap">    
                            <div class="card-title">
                                {{$pr->product_price}} AZN
                            </div>
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
            
        @endif
        
        <div id="autoloadPremium"></div>
        <div id="load-image" style="display: none">Loading...</div>
    </div>
</div>
@endsection