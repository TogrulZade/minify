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

<div class="container" style="padding: 0">
    <div class="row">
		{{-- @if($product->market !='')
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
		@endif --}}
    	<div class="col-md-10 col-md-offset-1 p-0">
			@if (!$agent->isMobile())
    		<div class="col-md-12 mb-5 mt-5">
    			<div class="col-md-6 col-sm-6 col-xs-12 h-cover p-0">
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
								{{-- @foreach($pictures as $index=>$pic) --}}
									{{-- <div class="{{$index == 0 ? 'cover-photo col-md-12' : 'mini-photo col-md-3 col-sm-3 col-xs-6 col-xs-12'}}"> --}}
									<div class="cover-photo col-md-12">
										<li>
											<img data-index="" src="{{asset("storage/".$pictures[0]->url)}}" />
										</li>
									</div>
								{{-- @endforeach --}}
								@endif
							</ul>
						</div>
					</div>
					@endif
    			</div>

    			<div class="col-md-6 col-sm-12 col-xs-12 p-0">
    				<div class="bg-white shop-desc">
						<div class="col-md-12 p-0 desc-text">
							<div class="shop-icon">
                            <a style="color: #1a8bff" href="/">{{$product->category_name}}</a>
                            <h2 style="font-weight: 600">{{$product->product_name}}</h2>
								@if($product->market !='')
								<div class="col-md-12 p-0 mb-2">
									<div class="shop-company" style="display: flex">
										{{-- <i class="fas fa-store company-icon"></i> <span>{{$product->market}}</span> --}}
                                            <div class="stars float-left mr-2">
                                                <i class="fas orange fa-star"></i>
                                                <i class="fas orange fa-star"></i>
                                                <i class="fas orange fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="bought center p-0 float-left mr-2" style="margin-top: 3px;">
                                                {{-- <i class="fas fa-check-circle"></i> <span>5 nəfər alıb</span> --}}
                                                <span class=""><i class="far fa-eye"></i> {{$count_seen}}</span> 
                                            </div>

											<div style="margin-top: -3px">
												<a class="merchant-link" href="/market/{{$product->market_slug}}">
													<i class="fas fa-store company-icon" style="font-size: 14px; margin-right: 2px;"></i>{{$product->market}}</a>
											</div>
									</div>
								</div>
								@endif

							</div>

							{{-- <div class="line-bottom mt-0"></div> --}}

							<div class="col-md-12 p-0 mt-2 mb-5" style="font-weight: 600; font-size: 17px; color: #343a40; margin-bottom: 20px">
                                <div>
                                    <h4><strong>Qısa açıqlama</strong></h4>
                                </div>
                                <div class="col-xs-12 p-0" style="margin-bottom: 20px">
								@if($product->city)
									<div class="col-xs-4 p-0 mb-2">Şəhər</div>
									<div class="col-xs-8 p-0 mb-2">
										<span class="">
											{{$product->city}}
										</span>
									</div>
								@endif
								@if($product->tip)
									<div class="col-xs-4 p-0 mb-2">Malın növü</div>
									<div class="col-xs-8 p-0 mb-2"><span class="pull-right"><strong>Smartfon</strong></span></div>
								@endif
								@if($product->model)
									<div class="col-xs-4 p-0 mb-2">Model</div>
									<div class="col-xs-8 p-0 mb-2"><span class="pull-right"><strong>Digər</strong></span></div>
								@endif
								<div class="col-xs-4 p-0 mb-2">Yeni</div>
                                <div class="col-xs-8 p-0 mb-2">
								<span>{{$product->new == 0 ? 'Köhnə' : 'Yenidir'}}</span>
                                </div>

                                    <div class="col-xs-4 p-0 mb-2">Çatdırılma</div>
                                    <div class="col-xs-8 p-0 mb-2">
                                        <span>{{$product->delivery == 0 ? 'Yoxdur' : 'Var'}}</span>
                                    </div>
								</div>
                                
                                <div class="col-xs-12">
									<div class="promo-btn-group">
										<div class="promo-btn ireli-btn">
											<span class="price">1 AZN</span>
											<span><i class="fas fa-long-arrow-alt-right" style="color: #e51a3a;transform: rotate(-90deg)"></i>İrəli çək</span>
										</div>
										<div class="promo-btn vip-btn">
											<span class="price">6 AZN</span>
											<span><i class="fas fa-gem" style="color: #e51a3a;"></i> VIP</span>
										</div>
										<div class="promo-btn premium-btn">
											<span class="price">15 AZN</span>
											<span>
												<i style="color: #e51a3a;" class="fas fa-crown"></i> 
												<span>Premium</span>
											</span>
										</div>
									</div>

									<div class="mt-4">
										<div class="col-sm-6" style="padding-left: 0">
										<a class="btn btn-primary2 p-3 btn-block" href=""> Mesaj yazın</a>
										</div>
										<div class="col-sm-6" style="padding-right: 0">
											@php $x = 0; @endphp
											@foreach ($favs as $f)
												@if ($f->id == $product->pr_id)
												@php $x = $product->pr_id @endphp
													<a class="sevimli btn btn-pink p-3 btn-block" data-product_id="{{$product->pr_id}}" href=""><i class="fas fa-heart" style="{{$f->id == $product->id ? 'background-color: #e51a3a' : ''}};font-size: 18px"></i> Seçilmişlərə əlavə et</a>
												@endif
												@endforeach
												@if ($x != $product->pr_id)
													<a class="sevimli btn btn-pink-outline p-3 btn-block" data-product_id="{{$product->pr_id}}" href=""><i class="fas fa-heart" style="font-size: 18px"></i> {{$product->id}} Seçilmişlərə əlavə et</a>
												@endif
										</div>
									</div>
								</div>
                            </div>



							{{-- <div class="col-md-12 p-0 contact">
								<p class="text-center satici">Satıcı | <span>{{$product->product_merchant}}</span></p>
								<p class="text-center call-number"> <i class="fas fa-phone-volume"></i> 
									{{$product->merchant_number}}
								</p>
							</div> --}}

    					</div>
    				</div>
    			</div>

				@if (count($pictures)>1)
				<div class="col-xs-12 p-0">
					<div class="bg-white p-3 col-xs-12">
						<ul id="mini-gallery">
							@foreach($pictures as $index=>$pic)
								@if($index>0)
								<div class="{{$index == 0 ? 'cover-photo col-md-12' : 'mini-photo col-md-3 col-sm-3 col-xs-6 col-xs-12'}}">
									<li>
										<img data-index="{{$index}}" src="{{asset("storage/".$pic->url)}}" />
									</li>
								</div>
								@endif
							@endforeach	
							</ul>
					</div>
				</div>
				@endif

    		</div>
    	</div>

		<div class="col-md-10 col-md-offset-1">
			<div class="col-xs-12 p-0">
				<div class="shop-extra mt-5">

					@if($product->active == 2 and (Auth::id() == $product->user_id or Auth::id() == 1))
					<a href="/verifyEdition/{{$product->pid}}" class="btn btn btn-success">Düzəlişi təsdiqlə</a>
					@endif

					

					@if (Auth::id() == 1)
					<a href="/admin/edit/{{$product->pr_id}}" class="btn btn btn-info">Elana düzəlişi et</a>
					@endif

					<div id="detail" class="col-xs-12 bg-white mt-4">
						{{-- <div class="col-sm-6">
							<h3 class="">Parametrləri</h3>
						</div> --}}
						{{-- <div class="col-sm-6">
							<h3>Məhsul haqqında</h3>
						</div>
						<div class="col-sm-6 p-0">
							<dl>
								<dt class="col-sm-3 mb-1">Ekran</dt>
								<dd class="col-sm-9 mb-1">13.3-inch LED-backlit display with IPS</dd>

								<dt class="col-sm-3 mb-1">Processor</dt>
								<dd class="col-sm-9 mb-1">2.3GHz dual-core Intel Core i5
								</dd>

								<dt class="col-sm-3 mb-1">Camera</dt>
								<dd class="col-sm-9 mb-1">720p FaceTime HD camera
								</dd>

								<dt class="col-sm-3 mb-1">Memory</dt>
								<dd class="col-sm-9 mb-1">8 GB RAM or 16 GB RAM
								</dd>

								<dt class="col-sm-3 mb-1">Graphics</dt>
								<dd class="col-sm-9 mb-1">Intel Iris Plus Graphics 640
								</dd>
							</dl>
						</div> --}}
						
						{{-- <div class="col-sm-6" style="line-height: 1.6">
						Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero, nobis explicabo. Modi cupiditate eveniet quidem explicabo reprehenderit! Tempore tenetur quisquam quos molestiae aperiam cum commodi, laudantium quasi, ad praesentium ratione.
						</div> --}}

						{{-- <div class="line-bottom"></div> --}}
						<div class="col-xs-12">
							<h2>Məhsul haqqında</h2>
							<p>{!! nl2br(e($product->product_description))!!}</p>
						</div>
					</div>

					{{-- <i>Alış sonrası problem yaşayarsınızsa xahiş edirik <a class="weight-6" href="#">Bizimlə Əlaqə</a> saxlayın.</i> --}}
				</div>
			</div>
		</div>

		<div class="col-md-10 col-md-offset-1">
			<div class="col-xs-12 mt-10">
				<h2>Bənzər məhsullar</h2>
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

		</div>

    </div>
</div>

@endsection