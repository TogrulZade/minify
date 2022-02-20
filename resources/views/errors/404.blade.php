@extends('layouts.error')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="brand mt-5">
                    <a style="color: #494949!important;" href="/">Minify.az</a>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="col-sm-5" style="padding-top: 80px;">
                    {{-- <h2 style="color: #ff6000;font-weight: 600">404 Error!</h1> --}}
                        <h2 style="font-weight: 600; line-height: 1.3">Belə bir səhifəmiz yoxdur, ancaq Sizin üçün misilsiz imkanlarımız var!</h2>
                        <h4 class="" style="color: #484848; line-height: 1.7">
                        Səhifə silinmiş və ya dəyişdirilmiş ola bilər. Aşağıdakı kateqoriyalara baxaraq bütün məhsullarımızı tapa bilərsiniz.
                    </h4>
                </div>
                <div class="col-sm-6 text-center">
                    <h1 style="color: #494949;font-weight: 600; font-size: 14em; margin-top: 50px;">404</h1>
                    <input type="text" class="axtar" name="search" placeholder='Əşya və ya xidmət axtarın....' style="width: 60%; padding: 8px 16px; border-radius: 8px; border: 2px solid #c2c2c2;">
                    {{-- <img src="{{asset('storage/images/404.png')}}" style="width: 100%; height: 430px" alt=""> --}}
                </div>
            </div>

            <div class="col-xs-12 mt-5">
                <h1 class="text-center mb-4">Kateqoriyalar</h1>
                @foreach ($getCategory as $c)
                    <div class="col-sm-3">
                        <a href="/c/{{$c->slug}}" class="box-card">
                            <div class="box-card-body">
                                {{$c->name}}
                            </div>
                        </a>
                    </div>
                @endforeach

                
            </div>
        </div>
    </div>
@endsection