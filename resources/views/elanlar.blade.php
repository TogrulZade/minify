@extends('layouts.app')

@section('title')
{{$title ?? $categoryName ?? null}}
@endsection

@section('content')
@if($agent->isMobile())
    @include('layouts.mobile.header-mobile')
@endif
<div class="full-opacity"></div>
{{-- Modal-Vip --}}
<div class="promotion-modal vip">
    <div class="promotion-modal-header">
        <i class="fas fa-gem"></i> VIP et
        <div class="fas fa-times ms-auto click"></div>
    </div>
    <div class="promotion-modal-body">
        <div class="mb-3">
        Elanınız əsas səhifədəki və axtarış nəticələrindəki VIP bölməsində təsadüfi qaydada göstəriləcək.
        </div>

        <div class="form-group">
            <input class="form-control elan" name="elan" type="text" placeholder="Elanın nömrəsini qeyd edin" autocomplete="off">
        </div>
        <div class="form-group">
            <div class="btn btn-primary btn-block vipEt-btn">VIP et</div>
        </div>
    </div>
</div>


<div class="{{$agent->isMobile() ? 'container-fluid' : 'container'}}" style="margin-top: 70px;">
    <div class="row">
        <div class="col-xs-12">
        @if(!empty($vips))
            @foreach ($vips as $i=>$vip)
                @if ($vip->id && $i == 0)
                <div class="col-xs-12 section-title">
                    <h3 class="black mb-5" style="color: #8d94ad; font-size: 18px;font-weight: 700;">Bütün VIP Elanlar</h3>
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
            @endforeach
        @endif

            <div class="col-md-3 col-sm-4 col-xs-6">
                <a href="#" class="card vip-blank">
                    <i class="fas fa-gem"></i>
                    <h4><strong>Öz elanını VIP et!</strong></h4>
                    <div class="card-price">5 gün - 6 AZN</div>
                    <div href="#" class="btn btn-primary btn-block">VIP et</div>
                </a>
            </div>


            {{-- Butun SON ELANLAR --}}
            @foreach ($products as $k=>$product)
                @if ($product->id && $k == 0)
                <div class="col-xs-12 section-title">
                    <h3 class="black mb-5" style="color: #8d94ad; font-size: 18px;font-weight: 700;">SON ELANLR</h3>
                </div>
                @endif

                <div class="col-md-3 col-sm-4 col-xs-6">
                    <a href="/product/{{$product->slug}}" target="_blank" class="card">

                        <div class="card-img">
                            <img src="{{asset('storage/'.$product->product_cover)}}" alt="">
                            <div class="icon-group">
                                @if (count($product->premium) >0)
                                    <div class="premium-icon" style="margin-right: 5px;">
                                        <i class="fas fa-crown"></i>
                                    </div>
                                @endif
                                @if (count($product->vip) >0)
                                <div class="vip-icon">
                                    <i class="fas fa-gem"></i>
                                </div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="card-title-wrap">
                            <div class="card-title">
                                {{$product->product_price}} AZN
                            </div>
                            @php $z = 0;@endphp
                            @foreach ($favs as $fav)
                                @if ($fav->id == $product->id)
                                @php $z = $product->id @endphp
                                    <div class="add_favorite" data-product_id="{{$product->id}}" style="{{$fav->id == $product->id ? 'color: red' : ''}}">
                                        <i class="fas fa-heart"></i>
                                    </div>
                                @endif
                            @endforeach
                            @if ($z != $product->id)
                            <div class="add_favorite" data-product_id="{{$product->id}}" style="">
                                <i class="fas fa-heart"></i>
                            </div>
                            @endif
                        </div>
                        
                        <div class="card-body">
                            <h5 class="mb-0"><strong>{{$product->product_name}}</strong></h5>
                        </div>

                        <div class="card-footer">
                            <p>{{$product->created_at}}</p>
                        </div>
                    </a>
                </div>
            @endforeach            
        </div>
        

        @if (count($products) == 0)
            <div class="col-xs-12">
                <div class="col-sm-6 col-sm-offset-3">
                    <div class="row">
                        <div class="wrap">
                            <div class="wrap-content">
                                <i class="fas fa-box-open"></i>
                                <p>Göstəriləcək elanlar tapılmadı</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        

        <div class="col-xs-12">
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection
