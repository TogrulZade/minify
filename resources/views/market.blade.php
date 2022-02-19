@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
    	<div class="col-md-12 p-0 mt-5 mb-5">
            <div class="col-xs-12 p-5" style="background-color: #fffede">
                <div class="p-0" style="float: left; margin-right: 15px">
                    <img style="width: 162px; height: 162px" src="{{asset('storage/'.$market->picture)}}" alt="">
                    <div style="display: flex; justify-content: center; align-items: center; height: 40px; background-color:#635acc; width: 162px; margin-top: 10px">
                        <span style="color: #fff">{{count($marketItems)}} elan</span>
                    </div>
                </div>
                <div class="col-md-9 p-0">
                    <div class="col-md-8" style="border-right: 1px solid #b4b1db">
                        
                        <h1 class="m-0" style="color: #009688;font-size: 22px; "><strong>{{$market->name}}</strong></h1>
                        <div class="mt-1" style="color: #009688">
                            <i class="fas fa-eye"></i> <span>{{$seen}}</span>
                        </div>
                        <div class="mt-1" style="line-height: 1.25; height: 75px; overflow: hidden">
                            <p>{{$market->about}}</p>
                        </div>

                        <div style="font-size: 16px; color: #635acc">
                            <i class="far fa-clock"></i> <span>{{$market->open_at}}-{{$market->close_at}}</span>
                        </div>
                        
                    </div>
                    
                    <div class="col-md-4 p-3" style="font-size: 16px">
                        <div class="mb-3">
                            <i class="fas fa-phone" style="color: #635acc"></i> <span>{{$market->tel}}</span>
                        </div>
                        <div>
                            <i style="color: #635acc" class="fas fa-thumbtack"></i> <span style="font-size: 14px">{{$market->unvan}}</span>
                        </div>
                    </div>

                    <div class="col-xs-12" style="height: 40px;background-color: #635acc;width: 100%;margin-top: 21px;color: #fff;line-height: 40px;text-align: center;">
                        <i style="transform: rotate(-10deg); font-size: 18px;" class="fas fa-star"></i> <span>{{$market->slogan}}</span>
                    </div>

                </div>


            </div>

        </div>
    </div>
</div>

<div style="background-color: #f6f7fa; width: 100%;">
    <div class="container">
        <div class="row">
            <div class="col-xs-12" style="margin: 20px 0;">
                <h4 style="color: #8d94ad"><strong>ELANLAR</strong></h4>
            </div>
            
            @php $z = 0;@endphp
            @foreach ($marketItems as $pr)
                <div class="col-md-3 col-sm-4 col-xs-6">
                    <a href="/product/{{$pr->slug}}" target="_blank" class="{{ $agent->isMobile() ? 'card-mini' : 'card' }}">
                        <div class="card-img">
                            @if($pr->market_id)
                            <div style="position: absolute; bottom: 10px;left: 5px; background-color: #fee500; padding: 2px 14px; border-radius: 5px">
                                Mağaza
                            </div>
                            @endif
                            <img src="{{asset('storage/'.$pr->product_cover)}}" alt="">
                            @if (count($pr->vip)>0 || count($pr->premium)>0)
                                <div class="icon-group">
                                    @if(count($pr->premium)>0)
                                    <div class="vip-icon" style="margin-right: 5px">
                                        <i class="fas fa-crown"></i>
                                    </div>
                                    @endif

                                    @if(count($pr->vip) > 0)
                                    <div class="vip-icon" style="margin-top: 3px">
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
    </div>
</div>
@endsection