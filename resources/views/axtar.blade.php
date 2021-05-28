@extends('layouts.app')

@section('content')
@include('partial.sticky')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="banner">
                <h4 class="text-center">Sizin Reklamınız Burada</h4>
            </div>
        </div>
        @if(!empty($vips))
        <div class="col-xs-12">
        @foreach ($vips as $i=>$vip)
            @if ($vip->id && $i == 0)
            <div class="col-md-12 text-center">
                <h3 class="black mb-5">VIP Elanlar</h3>
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

        <div class="col-xs-12">
            @if($categoryName == '')
                <h3 class="black text-center mb-5">Bütün Elanlar</h3>
            @else
                <h3 class="black text-center mb-5">{{$categoryName}}</h3>
            @endif
        </div>

        @php $z = 0;@endphp
        @foreach($products as $pr_index => $pr)
        <div class="col-md-2 col-sm-4 col-xs-6">
            <a href="/product/{{$pr->slug}}" class="card-mini">
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
    </div>
</div>
@endsection
