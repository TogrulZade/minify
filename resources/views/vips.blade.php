@extends('layouts.app')

@section('title')
{{$title ?? $categoryName ?? null}}
@endsection

@section('content')
@if($agent->isMobile())
    @include('layouts.mobile.header-mobile')
@endif
<div class="{{$agent->isMobile() ? 'container-fluid' : 'container'}}">
    <div class="row">
        @if(!empty($vips))
        <div class="col-xs-12">
            @foreach ($vips as $i=>$vip)
                @if ($vip->id && $i == 0)
                <div class="col-xs-12 text-center" style="{{$agent->isMobile() ? 'margin-top: 180px;' : ''}}">
                    <h3 class="black mb-5" style="color: #8d94ad; font-size: 18px;font-weight: 700;">Bütün VIP Elanlar</h3>
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
            @endforeach
            <div class="col-xs-12">
                {{ $vips->links() }}
            </div>
        </div>
        @endif

        @if (count($vips) == 0)
            <div class="col-xs-12">
                <div class="col-sm-6 col-sm-offset-3">
                    <div class="row">
                        <div class="wrap">
                            <div class="wrap-content">
                                <i class="fas fa-box-open"></i>
                                <p>Göstəriləcək VIP məhsul tapılmadı</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        
    </div>
</div>
@endsection
