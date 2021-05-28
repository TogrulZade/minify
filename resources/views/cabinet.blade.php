@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
       <div class="col-xs-12">
           <ul class="cabinet-tab">
               <li class="tab-item aktiv-link"><a class="active" href="#aktiv">Aktiv Elanlar ({{count($aktivElanlar)}})</a></li>
               <li class="tab-item yoxlanilan-link"><a href="#yoxlanilan">Yoxlanılır ({{count($yoxlanilanElanlar)}})</a></li>
               <li class="tab-item balans-link"><a href="#">Balans əməliyyatları</a></li>
           </ul>

           <div class="cabinet-body">
               <div class="tab-body aktiv-body">
                @if (count($aktivElanlar)>0)
                    @foreach ($aktivElanlar as $aktiv)
                        <div class="col-md-3 col-sm-4 col-xs-6">
                            <a href="/product/{{$aktiv->slug}}" class="card-mini">
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
                        </div>
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
           </div>

       </div>
    </div>
</div>
@endsection