@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
    	<div class="col-md-10 col-md-offset-1 p-0 mt-5 mb-5">
            <h1>Mağazalarım</h1>
            @foreach ($market as $item)
                <div class="col-md-3 col-sm-4 col-xs-6">
                    <a href="/market/{{$item->slug}}" class="{{ $agent->isMobile() ? 'card-mini' : 'card' }}">
                        <div class="card-img">
                            <img src="{{asset('storage/'.$item->picture)}}" alt="">
                        </div>
                        
                        <div class="card-body">
                            <strong style="display: block; margin-top: 5px" class="mb-0">{{$item->name}}</strong>
                            <p style="color: #000;">{{$item->slogan}}</p>
                        </div>
        
                        <div class="card-footer">
                            <p>{{$item->created_at}}</p>
                        </div>
                    </a>
                </div>
            @endforeach


        </div>
    </div>
</div>
@endsection