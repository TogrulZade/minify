@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="sell-content" style="{{$agent->isMobile() ? 'margin-top: 90px;' : ''}}">
				<div class="sell-header"><h3><span class="shop-span" style="font-weight: 600">minify</span> <span class="weight-3">| Elan yerləşdir</span></h3></div>
				{{-- <div class="line-bottom"></div> --}}
				<div class="sell-body">
					<div class="col-md-12 p-0">
						
						<p class="success">{{ old("success") }}</p>

						{{-- <img src="{{asset('storage/products/z08H75nV1HYoWIlvJqhmTeLkHiqftWGuoFl4F6tc.jpeg')}}" alt=""> --}}

						<form action="/sell" method="POST" enctype="multipart/form-data">
							{{@csrf_field()}}
							
							@if($errors->has("picture_not_found"))
								<p class="error">{{ $errors->first('picture_not_found') }}</p>
							@endif

							@if(count($markets) >0)
							<div class="form-group">
								@if($errors->has("market"))
									<p class="error">{{ $errors->first('market') }}</p>
								@endif
								<select name="market">
										<option disabled selected>Mağaza seç</option>
										<option value="0">Fərdi elan</option>
										@foreach ($markets as $market)
											<option {{ old("market") == $market->id ? "selected":"" }} value="{{$market->id}}">{{$market->name}}</option>
										@endforeach
								</select>
							</div>
							@endif

							<div class="form-group kateqoriya">
								@if($errors->has("product_category"))
									<p class="error">{{ $errors->first('product_category') }}</p>
								@endif
								<select name="product_category" id="">
									<option selected>Kateqoriya seç</option>
									@foreach ($getCategory as $cat)
										<option disabled>{{$cat->name}}</option>
										@foreach ($cat->childrenCategories as $childe)
											<option {{ old("product_category") == $childe->id ? "selected":"" }} value="{{$childe->id}}">{{$childe->name}}</option>
										@endforeach
									@endforeach
								</select>
							</div>

							<div class="update_detail"></div>

							<div class="form-group">
								@if($errors->has("product_name"))
									<p class="error">{{ $errors->first('product_name') }}</p>
								@endif

								<input type="text" class="form-control shop-form" placeholder='Məhsulun adı' value="{{ old('product_name') }}" name="product_name">
							</div>

							{{-- <div class="form-group">
								@if($errors->has("image.*"))
									<p class="error">{{ $errors->first('image.*') }}</p>
								@endif
								@if($errors->has("image"))
									<p class="error">{{ $errors->first('image') }}</p>
								@endif

								<input type="file" multiple accept="image/*" name="image[]" id="imgfile" class="my-pond" style="display: none;"/>
								<label for="imgfile" class="image"><i class="fas fa-camera"></i> Şəkil əlavə et</label>

								<div class="izle col-md-12">

								</div>
							</div> --}}

							<div class="form-group">
								<input type="file" name="image[]" id="file" multiple accept="image/*">
								<div class="izle col-md-12">

								</div>
								<div class="col-xs-12 progress-box"></div>
							</div>

							{{-- <div class="input-field form-group">
								<label class="active">Photos</label>
								<div class="input-images-1" style="padding-top: .5rem;"></div>
							</div> --}}
							

							<div class="form-group">
								@if($errors->has("product_price"))
									<p class="error">{{ $errors->first('product_price') }}</p>
								@endif

								<input type="number" value="{{ old('product_price') }}" class="form-control shop-form" placeholder='0.00 AZN' name="product_price">
							</div>

							<div class="form-group">
								<label for="">Şəhər</label>
								@if($errors->has("city"))
									<p class="error">{{ $errors->first('city') }}</p>
								@endif
								<select name="city" id="">
									@foreach ($cities as $city)
										<option value="{{$city->id}}" {{$city->id == 9 ? 'selected' : ''}}>{{$city->name}}</option>
									@endforeach
								</select>
							</div>

							<div class="form-group">
								<label for="">Yeni?</label>
								@if($errors->has("new"))
									<p class="error">{{ $errors->first('new') }}</p>
								@endif
								<select name="new" id="">
									<option value="0">Xeyr</option>
									<option value="1" selected>Bəli</option>
								</select>
							</div>

							<input type="hidden" name="t" class="t" value="{{$uniqid}}">

							<div class="form-group">
								<label for="">Çatdırılma</label>
								@if($errors->has("delivery"))
									<p class="error">{{ $errors->first('delivery') }}</p>
								@endif
								<select name="delivery" id="">
									<option value="0">Xeyr</option>
									<option value="1" selected>Bəli</option>
								</select>
							</div>

							<div class="form-group">
								@if($errors->has("product_description"))
									<p class="error">{{ $errors->first('product_description') }}</p>
								@endif

								<textarea name="product_description" class="shop-form form-control" placeholder='Məhsul haqqında' id="" cols="10" rows="4">{{ old('product_description') }}</textarea>
							</div>

							<div class="form-group">
								@if($errors->has("product_merchant"))
									<p class="error">{{ $errors->first('product_merchant') }}</p>
								@endif

								<input type="text" value="{{ old('product_merchant') }}" class="form-control shop-form" placeholder='Adınız' name="product_merchant">
							</div>


							<div class="form-group">
								@if($errors->has("merchant_number"))
									<p class="error">{{ $errors->first('merchant_number') }}</p>
								@endif

								<input type="text" class="form-control shop-form" value="{{ old('merchant_number') }}" placeholder='Əlaqə nömrəsi' name="merchant_number">
							</div>

							<div class="form-group">
								<button type="submit" class="btn btn-sm sell-share pull-right">Yerləşdir</a>
							</div>
						</form>

					</div>
				</div>
			</div>
		</div>
    </div>
</div>

@endsection
@push('sell')
<script src="{{ asset('js/sell.js?r=') }}<?php echo rand(0,99999)?>"></script>
@endpush
