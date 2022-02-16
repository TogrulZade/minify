@extends('layouts.app')

@section('title')
{{$title ?? $categoryName ?? null}}
@endsection



@section('content')
@if(!$agent->isMobile())
    @include('partial.sticky')
@else
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

        @if(!empty($vips))
        <div class="col-xs-12">
        @foreach ($vips as $i=>$vip)
            @if ($vip->id && $i == 0)
            <div class="col-xs-12 section-title">
                <h3 class="black mb-5" style="color: #8d94ad; font-size: 18px;font-weight: 700;">VIP ELANLAR</h3>
                <a href="/elanlar/vip">Bütün VIP elanlar</a>
            </div>
            @endif

            <div class="col-md-3 col-sm-4 col-xs-6">
                <a href="/product/{{$vip->slug}}" target="_blank" class="card">

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
                        <h5 class="mb-0"><strong>{{$vip->product_name}}</strong></h5>
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
        @if (count($products) == 0 && count($vips) == 0 && count($premiums) == 0)
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
        <div class="col-xs-12 mt-5 mb-2" style="{{$agent->isMobile() ? 'background-color: #f7f6f6; padding: 0 15px;' : ''}} border-radius: 6px">
            <div class="col-xs-12 mb-2">
                @if($categoryName == '')
                <div class="col-xs-12 mb-3" style="padding-top: 10px;">
                    <h4 style="color: #8d94ad; font-size: 18px;font-weight: 700;">SON ELANLAR</h4>
                </div>
                @else
                <div class="col-xs-12 mb-3 bl mt-2">
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
                        @if (count($pr->premium) >0 || count($pr->vip) >0)
                        <div class="icon-group">
                            @if (count($pr->premium) >0)
                                <div class="premium-icon" style="margin-right: 5px;">
                                    <i class="fas fa-crown"></i>
                                </div>
                            @endif
                            @if (count($pr->vip) >0)
                            <div class="vip-icon">
                                <i class="fas fa-gem"></i>
                            </div>
                            @endif
                        </div>
                        @endif
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
        </div>
        <div class="col-xs-12 text-center mb-5">
            <div class="col-xs-4 col-xs-offset-4">
                <a href="/elanlar" class="btn-block btn btn-primary br20">Hamısını göstər</a>
            </div>
        </div>

        {{-- Premium Elanlar --}}
        {{-- @php
            print_r($premiums)
        @endphp --}}

        @if(!empty($premiums))
        <div class="col-xs-12">
        @foreach ($premiums as $ii=>$premium)

        {{-- @if ($premium->premium) --}}
            @if ($premium->id && $ii == 0)
            <div class="col-xs-12">
                <h3 class="black mb-5" style="color: #8d94ad; font-size: 18px;font-weight: 700;">PREMIUM ELANLAR</h3>
            </div>
            @endif

            <div class="col-md-3 col-sm-4 col-xs-6">
                <a href="/product/{{$premium->slug}}" target="_blank" class="card">

                    <div class="card-img">
                        <img src="{{asset('storage/'.$premium->product_cover)}}" alt="">
                        <div class="icon-group">
                            <div class="premium-icon">
                                <i class="fas fa-crown"></i>
                            </div>
                            @if(count($premium->vip)>0)
                            <div class="vip-icon mt-1" style="margin-left: 5px">
                                <i class="fas fa-gem"></i>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-title-wrap">
                        <div class="card-title">
                            {{$premium->product_price}} AZN
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
                        <h5 class="mb-0"><strong>{{$premium->product_name}}</strong></h5>
                    </div>

                    <div class="card-footer">
                        <p>{{$premium->created_at}}</p>
                    </div>
                </a>
            </div>
            {{-- @endif --}}
        @endforeach
        </div>
        @endif

        <div id="autoloadPremium"></div>
        <div id="load-image" style="display: none">Loading...</div>
    </div>
</div>
@endsection
