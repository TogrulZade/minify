@extends('admin.layouts.layout')

@section('content')
<div class="col-xs-8 col-xs-offset-3">
{{-- <div class="container"> --}}
    {{-- <div class="row"> --}}
    @if(count($products) > 0)
        <div class="col-xs-12 mb-3">
            <h3>Təsdiq gözləyən elanlar</h3>
        </div>
        @foreach($products as $pr_index => $pr)
        <div class="col-md-3 col-sm-4 col-xs-6">
            <a href="/product/{{$pr->slug}}" class="card">
                <div class="card-img">
                    <img src="{{asset('storage/'.$pr->product_cover)}}" style="height: 140px" alt="">
                </div>

                    <div class="col-xs-6">
                        <div class="tesdiqle" data-product_id='{{$pr->id}}'>Tesdiqle</div>
                    </div>

                    <div class="col-xs-6 mt-1">
                        <div onclick="window.location.href='/admin/edit/{{$pr->id}}'; return false" class="btn btn-sm btn-block btn-info" data-product_id='{{$pr->id}}'>Düzəliş et</div>
                    </div>

                    <div class="col-xs-12 mb-1">
                        <div onclick="window.location.href='/admin/delete/{{$pr->id}}'; return false" class="btn btn-xs btn-danger btn-block delete-link">Remove</div>
                    </div>
                <div class="card-title-wrap">
                    <div class="card-title">
                        {{$pr->product_price}} AZN
                    </div>
                </div>
                <div class="card-body">
                    <strong class="mb-0">{{$pr->product_name}}</strong>
                </div>

                {{-- <div class="card-footer">
                    <p>{{$pr->created_at}}</p>
                </div> --}}
            </a>
        </div>

            {{-- End card --}}
        @endforeach
        @else
            <div class="wrap">
                <div class="wrap-content">
                    <i class="fas fa-box-open"></i>
                    <p>Təsdiq gözləyən elanlar yoxdur.</p>
                </div>
            </div>
        @endif
    </div>
{{-- </div> --}}
{{-- </div> --}}
@endsection