@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">

        <div class="col-md-12">
            <div class="banner">
                <h4 class="text-center">Sizin Reklamınız Burada</h4>
            </div>
        </div>
        @if(!empty($vips))
        <div class="col-md-12 text-center">
            <h3 class="black mb-5">VIP Elanlar</h3>
        </div>
        <div class="col-xs-12">
        @foreach ($vips as $vip)
            <div class="col-md-3 col-xs-6 col-sm-6 mb-3">
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
            </div>
        @endforeach
        </div>
        @endif


        <div class="col-md-12">
            @if($categoryName == '')
                <h3 class="black text-center mb-5">Bütün Elanlar</h3>
            @else
                <h3 class="black text-center mb-5">{{$categoryName}}</h3>
            @endif
        </div>

        @foreach($products as $pr)
            {{-- Card --}}
            <div class="col-md-3 col-xs-6">
                <a href="/product/{{$pr->slug}}" class="card">

                    <div class="card-img">
                        <img src="{{asset('storage/'.$pr->product_cover)}}" alt="">
                    </div>
                    
                    <div class="card-title">
                        {{-- @if(count($pr->vip)>0)
                            <span>VIP</span>
                        @endif --}}
                        {{$pr->product_price}} AZN
                    </div>
                    
                    <div class="card-body">
                        <h4 class="mb-0">{{$pr->product_name}}</h4>
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