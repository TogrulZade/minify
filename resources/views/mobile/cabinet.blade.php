@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mt-5">
       <div class="col-xs-12 p-0 mt-2">
           <ul class="cabinet-tab mobile">
               <li class="tab-item aktiv-link"><a class="active" href="#aktiv">Aktiv Elanlar ({{count($aktivElanlar)}})</a></li>
               <li class="tab-item yoxlanilan-link"><a href="#yoxlanilan">Yoxlanılır ({{count($yoxlanilanElanlar)}})</a></li>
               <li class="tab-item duzelis-link"><a href="#duzelis">Düzəliş gözləyən ({{count($duzelisElanlar)}})</a></li>
               <li class="tab-item balans-link"><a href="#">Balans əməliyyatları</a></li>
           </ul>

           <div class="cabinet-body">
               <div class="tab-body aktiv-body">
                   @if (count($aktivElanlar)>0)
                   @php $z = 0;@endphp
                    @foreach ($aktivElanlar as $aktiv)
                        {{-- <div class="col-md-3 col-sm-4 col-xs-6">
                            <a href="/product/{{$aktiv->slug}}" class="card">
                                <div class="card-img">
                                    <img src="{{asset('storage/'.$aktiv->product_cover)}}" alt="">
                                </div>
                                            
                                <div class="card-title">
                                    {{$aktiv->product_price}} AZN
                                </div>
                                
                                <div class="card-body">
                                    <strong class="mb-0">{{$aktiv->product_name}}</strong>
                                </div>
                
                                <div class="card-footer">
                                    <p>{{$aktiv->created_at}}</p>
                                </div>
                            </a>
                        </div> --}}

                        <div class="col-md-3 col-sm-4 col-xs-6">
                            <a href="/product/{{$aktiv->slug}}" target="_blank" class="{{ $agent->isMobile() ? 'card-mini' : 'card' }}">
                                <div class="card-img">
                                    <img src="{{asset('storage/'.$aktiv->product_cover)}}" alt="">
                                    @if (count($aktiv->premium) >0 || count($aktiv->vip) >0)
                                    <div class="icon-group">
                                        @if (count($aktiv->premium) >0)
                                            <div class="premium-icon" style="margin-right: 5px;">
                                                <i class="fas fa-crown"></i>
                                            </div>
                                        @endif
                                        @if (count($aktiv->vip) >0)
                                        <div class="vip-icon">
                                            <i class="fas fa-gem"></i>
                                        </div>
                                        @endif
                                    </div>
                                    @endif
                                </div>
                                <div class="card-title-wrap">    
                                    <div class="card-title">
                                        {{$aktiv->product_price}} AZN
                                    </div>
                                    @foreach ($favs as $fav)
                                        @if ($fav->id == $aktiv->id)
                                        @php $z = $aktiv->id @endphp
                                            <div class="add_favorite" data-product_id="{{$aktiv->id}}" style="{{$fav->id == $aktiv->id ? 'color: red' : ''}}">
                                                <i class="fas fa-heart"></i>
                                            </div>
                                        @endif
                                    @endforeach
                                    @if ($z != $aktiv->id)
                                    <div class="add_favorite" data-product_id="{{$aktiv->id}}" style="">
                                        <i class="fas fa-heart"></i>
                                    </div>
                                    @endif
                                </div>
                                <div class="card-body">
                                    <strong class="mb-0">{{$aktiv->product_name}}</strong>
                                </div>
            
                                <div class="card-footer">
                                    <p>{{$aktiv->created_at}}</p>
                                </div>
                            </a>
                        </div>
            
                            {{-- End card --}}
                    @endforeach
                    @else
                    <div class="centered">
                        <h4 style="color: #c2c2c2">Aktiv elanınız yoxdur!</h4>
                        <a href="/sell" class="btn btn-primary">Elan yerləşdir</a>
                    </div>
                    @endif
               </div>

               <div class="tab-body yoxlanilan-body">
                @if (count($yoxlanilanElanlar)>0)
                @foreach ($yoxlanilanElanlar as $yoxlanilan)
                    <div class="col-md-3 col-sm-4 col-xs-6">
                        <a href="/product/{{$yoxlanilan->slug}}" class="card-mini">
                            <div class="card-img">
                                <img src="{{asset('storage/'.$yoxlanilan->product_cover)}}" alt="">
                            </div>
                                        
                            <div class="card-title">
                                {{$yoxlanilan->product_price}} AZN
                            </div>
                            
                            <div class="card-body">
                                <strong class="mb-0">{{$yoxlanilan->product_name}}</strong>
                            </div>
            
                            <div class="card-footer">
                                <p>{{$yoxlanilan->created_at}}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
                @else
                <div class="centered">
                    <h4 style="color: #c2c2c2">Yoxlanilan elanınız yoxdur!</h4>
                    <a href="/sell" class="btn btn-primary">Elan yerləşdir</a>
                </div>
                @endif
               </div>


               <div class="tab-body duzelis-body">
                @if (count($duzelisElanlar)>0)
                @foreach ($duzelisElanlar as $duzelis)
                    <div class="col-md-3 col-sm-4 col-xs-6">
                        <a href="/product/{{$duzelis->slug}}" class="card-mini">
                            <div class="card-img">
                                <img src="{{asset('storage/'.$duzelis->product_cover)}}" alt="">
                            </div>
                                        
                            <div class="card-title">
                                {{$duzelis->product_price}} AZN
                            </div>
                            
                            <div class="card-body">
                                <strong class="mb-0">{{$duzelis->product_name}}</strong>
                            </div>
            
                            <div class="card-footer">
                                <p>{{$duzelis->created_at}}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
                @else
                <div class="centered">
                    <h4 style="color: #c2c2c2">Düzəliş gözləyən elanınız yoxdur!</h4>
                    <a href="/sell" class="btn btn-primary">Elan yerləşdir</a>
                </div>
                @endif
               </div>




           </div>

       </div>
    </div>
</div>
@endsection