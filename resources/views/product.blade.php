@extends('layouts.app')

@section('content')
<div class="container p-0">
    <div class="row p-0">
    	<div class="col-md-10 col-md-offset-1 p-0">

			<div class="col-md-12">
    			<h2 class="shop-title">{{$product->product_name}}</h2>
    		</div>
    		<div class="col-md-12 mb-5">
    			<div class="col-md-8 line">
    				<div class="shop-img">
    					<div class="big-img">
    						<img src="{{asset('storage/'.$pictures[0]->url)}}" alt="">
    					</div>
						@foreach($pictures as $pic)
						<div class="col-md-3 p-0">
		    				<div class="min-img">
		    					<img src="{{asset("storage/".$pic->url)}}" alt="">
		    				</div>
		    			</div>
		    			@endforeach

	    			</div>


	    			<div class="col-md-12 p-0">
			    		<div class="shop-extra mt-5">
			    			<h2>Haqqında</h2>
							<p>{!! nl2br(e($product->product_description))!!}</p>

			    			{{-- <h2>Çatdırılma</h2>
			    			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa sed vel ab possimus modi, totam id animi doloribus, assumenda ducimus autem. --}}

			    			<div class="line-bottom"></div>

			    			<i>Alış sonrası problem yaşayarsınızsa xahiş edirik <a class="weight-6" href="#">Bizimlə Əlaqə</a> saxlayın.</i>
			    		</div>


			    	</div>

    			</div>

    			<div class="col-md-4">
    				<div class="bg-white shop-desc">
						<div class="col-md-12 p-0 desc-text">
							<div class="shop-icon">
								@if($product->market !='')
								<div class="col-md-12 p-0 mb-2">
									<div class="shop-company">
										<i class="fas fa-store company-icon"></i> <span>{{$product->market}}</span>
										{{-- <div class="badge badge-primary">5.0 <div class="glyphicon glyphicon-star"></div></div> --}}
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
									{{-- <a href="#" class="save-shop">Yadda saxla</a> --}}
									<div class="save">
										<i class="far fa-heart unsave pull-right"></i>
										<span>{{$product->product_price}} AZN</span>
									</div>
								</div>

								{{-- <div class="shop-price">
									Sifariş et
								</div> --}}

								<div class="col-md-12 bought center mt-2 p-0">
									<i class="fas fa-check-circle"></i> <span>5 nəfər alıb</span>
									<span class="pull-right"><i class="far fa-eye"></i> 2123</span> 
								</div>

								{{-- <div class="col-md-4 text-center p-0">
									<div class="glyphicon glyphicon-eye-open"></div> 
								</div>
								<div class="col-md-4 text-center p-0">Satış</div>
								<div class="col-md-4 text-center p-0">Stokda</div>

								<div class="col-md-4 text-center p-0"><b>10234</b></div>
								<div class="col-md-4 text-center p-0"><b>3</b></div>
								<div class="col-md-4 text-center p-0"><b>19</b></div> --}}
							</div>

							{{-- <br>
							<br>
							<br> --}}

							{{-- <div class="line-bottom"></div>
								<div class="col-md-12 p-0">
		    						<select name="" id="">
		    							<option value="">Size</option>
		    							<option value="">XS</option>
		    							<option value="">S</option>
		    							<option value="">M</option>
		    							<option value="">L</option>
		    							<option value="">XL</option>
		    						</select>


		    						<select name="" id="">
		    							<option value="">Color</option>
		    							<option value="">Red</option>
		    							<option value="">Yellow</option>
		    							<option value="">Brown</option>
		    							<option value="">Orange</option>
		    						</select>
	    						</div> --}}

							<div class="line-bottom mt-0"></div>

							<div class="col-md-12 p-0 mt-2 mb-2" style="font-weight: 600">
								<div class="col-md-6 p-0 mb-2">Şəhər</div>
								<div class="col-md-6 p-0 mb-2"><span class="pull-right"><strong>{{$product->city}}</strong></span></div>

								<div class="col-md-6 p-0 mb-2">Malın növü</div>
								<div class="col-md-6 p-0 mb-2"><span class="pull-right"><strong>Smartfon</strong></span></div>

								<div class="col-md-6 p-0 mb-2">Model</div>
								<div class="col-md-6 p-0 mb-2"><span class="pull-right"><strong>Digər</strong></span></div>

								<div class="col-md-6 p-0 mb-2">Yeni</div>
								<div class="col-md-6 p-0 mb-2"><span class="pull-right"><strong>{{$product->new == 0 ? 'Xeyr' : 'Bəli'}}</strong></span></div>

								<div class="col-md-6 p-0 mb-2">Çatdırılma</div>
								<div class="col-md-6 p-0 mb-2"><span class="pull-right"><strong>{{$product->delivery == 0 ? 'Xeyr' : 'Bəli'}}</strong></span></div>
							</div>

							<div class="col-md-12 p-0 contact">
								<p class="text-center satici">Satıcı | <span>Toğrul Sadıqzadə</span></p>
								<p class="text-center call-number"> <i class="fas fa-phone-volume"></i> 
									{{$product->merchant_number}}
								</p>
							</div>

    					</div>
    				</div>
    			</div>



{{--     			<div class="col-md-2 p-0">
    				<div class="bg-white shop-desc">
    					<h4 class="m-0">{{$product->product_name}}</h4>
    					<p>
    						Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est repellendus quae vel deleniti quidem, inventore dolores. Aperiam, optio, neque, sapiente molestias odio quod eos, labore autem sit aspernatur animi rerum.
    					</p>
    				</div>
    			</div> --}}


    		</div>
    	</div>



		<div class="col-md-10 col-md-offset-1">
			<div class="col-md-12 mt-10">
				<h2>Müştərilər həmçinin baxdılar</h2>
			</div>

			{{-- Card --}}
			<div class="col-md-3">
	            <a href="/product/{{$product->slug}}" class="card-mini">
	                <div class="price">
	                    {{$product->product_price}} AZN
	                </div>

	                <div class="card-img">
	                    <img src="{{ asset('img/iphone2.jpg') }}" alt="">
	                </div>
	                
	                <div class="card-title">
	                    <h4 class="mb-0">{{$product->product_name}}</h4>
	                </div>
	                
	                <div class="card-body">
	                    Lorem ipsum dolor sit amet.
	                </div>

	                <div class="card-footer">
	                    <p><?php echo date("d-m-Y H:i"); ?></p>
	                </div>
	            </a>
        	</div>


			{{-- Card --}}
			<div class="col-md-3">
	            <a href="/{{$product->slug}}" class="card-mini">
	                <div class="price">
	                    {{$product->product_price}} AZN
	                </div>

	                <div class="card-img">
	                    <img src="{{ asset('img/iphone2.jpg') }}" alt="">
	                </div>
	                
	                <div class="card-title">
	                    <h4 class="mb-0">{{$product->product_name}}</h4>
	                </div>
	                
	                <div class="card-body">
	                    Lorem ipsum dolor sit amet.
	                </div>

	                <div class="card-footer">
	                    <p><?php echo date("d-m-Y H:i"); ?></p>
	                </div>
	            </a>
        	</div>


			{{-- Card --}}
			<div class="col-md-3">
	            <a href="/{{$product->slug}}" class="card-mini">
	                <div class="price">
	                    {{$product->product_price}} AZN
	                </div>

	                <div class="card-img">
	                    <img src="{{ asset('img/iphone2.jpg') }}" alt="">
	                </div>
	                
	                <div class="card-title">
	                    <h4 class="mb-0">{{$product->product_name}}</h4>
	                </div>
	                
	                <div class="card-body">
	                    Lorem ipsum dolor sit amet.
	                </div>

	                <div class="card-footer">
	                    <p><?php echo date("d-m-Y H:i"); ?></p>
	                </div>
	            </a>
        	</div>


			{{-- Card --}}
			<div class="col-md-3">
	            <a href="/{{$product->slug}}" class="card-mini">
	                <div class="price">
	                    {{$product->product_price}} AZN
	                </div>

	                <div class="card-img">
	                    <img src="{{ asset('img/iphone2.jpg') }}" alt="">
	                </div>
	                
	                <div class="card-title">
	                    <h4 class="mb-0">{{$product->product_name}}</h4>
	                </div>
	                
	                <div class="card-body">
	                    Lorem ipsum dolor sit amet.
	                </div>

	                <div class="card-footer">
	                    <p><?php echo date("d-m-Y H:i"); ?></p>
	                </div>
	            </a>
        	</div>

        	<div class="col-md-12">
        		<h2>Müştəri rəyləri</h2>
        	</div>

		</div>
    	{{-- @endforeach --}}


    </div>
</div>

@endsection