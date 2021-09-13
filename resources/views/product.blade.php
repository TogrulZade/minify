@extends('layouts.app')

@section('content')
<div class="full-opacity"></div>
	<div class="mini-slide-cover">
		<div class="mini-slide">
			<img alt="">
			<div class="mini-close"><i class="feather-x"></i></div>
			<div class="left"><i class="feather-chevron-left"></i></div>
			<div class="right"><i class="feather-chevron-right"></i></div>
		</div>		
	</div>

	@if ($agent->isMobile())
		<div class="col-xs-12 p-0">
			<p class="success">{{ old("success") }}</p>
			<h2>{{$product->name}}</h2>
			<div id="swipe" class="swipe">
				<div class="swipe-wrap">
					@if(count($pictures) < 1)
						<img data-index="{{$index}}" src="{{asset("storage/images/not-found.jpeg")}}" />
					@else
					@foreach($pictures as $index=>$pic)
						<img data-index="{{$index}}" src="{{asset("storage/".$pic->url)}}" />
						@endforeach
					@endif
				</div>
				</div>
		</div>
		@endif

<div class="container">
    <div class="row">
		@if($product->market !='')
				<div class="col-xs-12 p-5" style="background-color: #fffede">
					<div class="p-0" style="float: left; margin-right: 15px">
						<img style="width: 162px; height: 162px" src="{{asset('storage/'.$product->picture)}}" alt="">
						<div style="display: flex; justify-content: center; align-items: center; height: 40px; background-color:#635acc; width: 162px; margin-top: 10px">
							<span style="color: #fff">300 elan</span>
						</div>
					</div>
					<div class="col-md-9 p-0">
						<div class="col-md-8" style="border-right: 1px solid #b4b1db">
							
							<h1 class="m-0" style="font-size: 22px; "><strong>{{$product->market}}</strong></h1>
							<div class="mt-1">
								<i class="fas fa-eye"></i> <span>84 232</span>
							</div>
							<div class="mt-1" style="line-height: 1.25; height: 75px; overflow: hidden">
								<p>{{$product->about}}</p>
							</div>

							<div style="font-size: 16px; color: #635acc">
								<i class="far fa-clock"></i> <span>{{$product->open_at}}-{{$product->close_at}}</span>
							</div>
							
						</div>
						
						<div class="col-md-4 p-3" style="font-size: 16px">
							<div class="mb-3">
								<i class="fas fa-phone" style="color: #635acc"></i> <span>{{$product->tel}}</span>
							</div>
							<div>
								<i style="color: #635acc" class="fas fa-thumbtack"></i> <span style="font-size: 14px">{{$product->unvan}}</span>
							</div>
						</div>

						<div class="col-xs-12" style="height: 40px;background-color: #635acc;width: 100%;margin-top: 21px;color: #fff;line-height: 40px;text-align: center;">
							<i style="transform: rotate(-10deg); font-size: 18px;" class="fas fa-star"></i> <span>{{$product->slogan}}</span>
						</div>

					</div>


				</div>
			@endif
    	<div class="col-md-10 col-md-offset-1 p-0">
			@if (!$agent->isMobile())
    		<div class="col-md-12 mb-5">
    			<div class="col-md-8 col-sm-8 col-xs-12 line h-cover">
					@if(old('success'))
					<div class="alert alert-success">
						{{ old("success") }}
					</div>
					@endif

					@if($product->user_id == Auth::id() && $product->active == 0)
						<div class="alert alert-info" style="">
							<i class="fas fa-user-clock" style="font-size: 20px"></i> <span>Məhsulunuz <strong>Minify moderatorları</strong> tərəfindən təsdiq gözləyir</span>
						</div>
					@endif
					<h2 style="padding-left: 20px">{{$product->product_name}}</h2>
					<div class="shop-img">	
						<div class="col-xs-12">									
							<ul id="mini-gallery">
								@if(count($pictures) < 1)
									@if($product->product_cover != '')
									<div class="cover-photo col-md-12">
										<li>
										<img src="{{asset("storage/$product->product_cover")}}" />
										</li>
									</div>
									@else
									<img src="{{asset("storage/images/not-found.jpeg")}}" />
									@endif
								@else
								@foreach($pictures as $index=>$pic)
									<div class="{{$index == 0 ? 'cover-photo col-md-12' : 'mini-photo col-md-3 col-sm-3 col-xs-6 col-xs-12'}}">
										<li>
											<img data-index="{{$index}}" src="{{asset("storage/".$pic->url)}}" />
										</li>
									</div>
								@endforeach
								@endif
							</ul>
						</div>
					</div>
					@endif
					
	    			<div class="col-xs-12 p-0">
			    		<div class="shop-extra mt-5">

							@if($product->active == 2 and (Auth::id() == $product->user_id or Auth::id() == 1))
							<a href="/verifyEdition/{{$product->pid}}" class="btn btn btn-success">Düzəlişi təsdiqlə</a>
							@endif

							

							@if (Auth::id() == 1)
							<a href="/admin/edit/{{$product->pr_id}}" class="btn btn btn-info">Elana düzəlişi et</a>
							@endif

			    			
							<h3>Haqqında</h3>
							<p>{!! nl2br(e($product->product_description))!!}</p>
			    			<div class="line-bottom"></div>

			    			{{-- <i>Alış sonrası problem yaşayarsınızsa xahiş edirik <a class="weight-6" href="#">Bizimlə Əlaqə</a> saxlayın.</i> --}}
			    		</div>
			    	</div>

    			</div>

    			<div class="col-md-4 col-sm-12 col-xs-12" style="margin-top: 50px">
    				<div class="bg-white shop-desc">
						<div class="col-md-12 p-0 desc-text">
							<div class="shop-icon">
								@if($product->market !='')
								<div class="col-md-12 p-0 mb-2">
									<div class="shop-company">
										<i class="fas fa-store company-icon"></i> <span>{{$product->market}}</span>
										<div class="stars pull-right">
											<i class="fas yellow fa-star"></i>
											<i class="fas yellow fa-star"></i>
											<i class="fas yellow fa-star"></i>
											<i class="fas fa-star"></i>
											<i class="fas fa-star"></i>
										</div>
									</div>
								</div>
								@endif
								<div class="col-md-12 p-0">
									<div class="save">
										<i style="{{$isFav ? 'color: red' : ''}}" data-product_id="{{$product->pr_id}}" class="bookmarks {{$isFav ? 'fas' : 'far'}} fa-heart pull-right"></i>
										<span>{{$product->product_price}} AZN</span>
									</div>
								</div>

								<div class="col-md-12 bought center mt-2 p-0">
									{{-- <i class="fas fa-check-circle"></i> <span>5 nəfər alıb</span> --}}
									<span class="pull-right"><i class="far fa-eye"></i> {{$count_seen}}</span> 
								</div>

							</div>

							<div class="line-bottom mt-0"></div>

							<div class="col-md-12 p-0 mt-2 mb-2" style="font-weight: 600">
								@if($product->city)
									<div class="col-xs-6 p-0 mb-2">Şəhər</div>
									<div class="col-xs-6 p-0 mb-2">
										<span class="pull-right">
											<strong>{{$product->city}}</strong>
										</span>
									</div>
								@endif
								@if($product->tip)
									<div class="col-xs-6 p-0 mb-2">Malın növü</div>
									<div class="col-xs-6 p-0 mb-2"><span class="pull-right"><strong>Smartfon</strong></span></div>
								@endif
								@if($product->model)
									<div class="col-xs-6 p-0 mb-2">Model</div>
									<div class="col-xs-6 p-0 mb-2"><span class="pull-right"><strong>Digər</strong></span></div>
								@endif
								<div class="col-xs-6 p-0 mb-2">Yeni</div>
								<div class="col-xs-6 p-0 mb-2"><span class="pull-right"><strong>{{$product->new == 0 ? 'Xeyr' : 'Bəli'}}</strong></span></div>

								<div class="col-xs-6 p-0 mb-2">Çatdırılma</div>
								<div class="col-xs-6 p-0 mb-2"><span class="pull-right"><strong>{{$product->delivery == 0 ? 'Xeyr' : 'Bəli'}}</strong></span></div>
							</div>

							<div class="col-md-12 p-0 contact">
								<p class="text-center satici">Satıcı | <span>{{$product->product_merchant}}</span></p>
								<p class="text-center call-number"> <i class="fas fa-phone-volume"></i> 
									{{$product->merchant_number}}
								</p>
							</div>

    					</div>
    				</div>
    			</div>

    		</div>
    	</div>



		<div class="col-md-10 col-md-offset-1">
			<div class="col-xs-12 mt-10">
				<h2>Müştərilər həmçinin baxdılar</h2>
			</div>
			@php $z = 0;@endphp
			@foreach ($more_products as $more)
			<div class="col-md-3 col-sm-4 col-xs-6">
				<a href="/product/{{$more->slug}}" class="card-mini">
					<div class="card-img">
						<img src="{{asset('storage/'.$more->product_cover)}}" alt="">
							@foreach ($favs as $fav)
								@if ($fav->id == $more->id)
								@php $z = $more->id @endphp
									<div class="add_favorite" data-product_id="{{$more->id}}" style="{{$fav->id == $more->id ? 'color: red' : ''}}">
										<i class="fas fa-heart"></i>
									</div>
								@endif
							@endforeach
							@if ($z != $more->id)
							<div class="add_favorite" data-product_id="{{$more->id}}" style="">
								<i class="fas fa-heart"></i>
							</div>
							@endif
					</div>
								
					<div class="card-title">
						{{$more->product_price}} AZN
					</div>
					
					<div class="card-body">
						<strong class="mb-0">{{$more->product_name}}</strong>
					</div>
	
					<div class="card-footer">
						<p>{{$more->created}}</p>
					</div>
				</a>
			</div>
			@endforeach


        	{{-- <div class="col-xs-12">
        		<h2>Müştəri rəyləri</h2>
        	</div> --}}

		</div>
    	{{-- @endforeach --}}


    </div>
</div>

@endsection