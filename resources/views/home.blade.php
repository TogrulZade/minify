@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-12">
            <div class="banner">
                <h4 class="text-center">Sizin Reklamınız Burada</h4>
            </div>
        </div>

        <div class="col-md-12 text-center">
            <h3 class="black mb-5">VIP Elanlar</h3>
        </div>
        

        <div class="col-md-3">
            <div class="box">
                <img src="{{asset('img/note9.jpg')}}" alt="">
                <div class="box-footer">
                    <h4>Jackets</h4>
                    <div class="price">
                        2350 AZN
                    </div>
                </div>

            </div>
        </div>


        <div class="col-md-3">
            <div class="box">
                <img src="{{asset('img/reklam1.jpg')}}" alt="">
                <div class="box-footer">
                    <h4>Jackets</h4>
                    <div class="price">
                        50 AZN
                    </div>
                </div>

            </div>
        </div>


        <div class="col-md-3">
            <div class="box">
                <img src="{{asset('img/reklam1.jpg')}}" alt="">
                <div class="box-footer">
                    <h4>Jackets</h4>
                    <div class="price">
                        50 AZN
                    </div>
                </div>

            </div>
        </div>


        <div class="col-md-3">
            <div class="box">
                <img src="{{asset('img/reklam1.jpg')}}" alt="">
                <div class="box-footer">
                    <h4>Jackets</h4>
                    <div class="price">
                        50 AZN
                    </div>
                </div>

            </div>
        </div>

        

        <div class="col-md-12">
            @if($categoryName == '')
                <h3 class="black text-center mb-5">Bütün Elanlar</h3>
            @else
                <h3 class="black text-center mb-5">{{$categoryName}}</h3>
            @endif
        </div>

        @foreach($products as $pr)
        

        {{-- Card --}}
        <div class="col-md-3 col-xs-6" style="padding: 20px;">
            <a href="/product/{{$pr->slug}}" class="card">

                <div class="card-img">
                    <img src="{{asset('storage/'.$pr->product_cover)}}" alt="">
                </div>
                
                <div class="card-title">
                    {{$pr->product_price}} AZN
                </div>
                
                <div class="card-body">
                    <h4 class="mb-0">{{$pr->product_name}}</h4>
                </div>

                <div class="card-footer">
                    <p><?php echo date("d-m-Y H:i"); ?></p>
                </div>
            </a>
        </div>

        
        @endforeach


        



    </div>
</div>
@endsection
