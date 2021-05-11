@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="sell-content">
				<div class="sell-header"><h3><span class="shop-span" style="font-weight: 600">minify</span> <span class="weight-3">| Elan yerləşdir</span></h3></div>
				{{-- <div class="line-bottom"></div> --}}
				<div class="sell-body">
					<div class="col-md-12 p-0">
						
						<p class="success">{{ old("success") }}</p>

						{{-- <img src="{{asset('storage/products/z08H75nV1HYoWIlvJqhmTeLkHiqftWGuoFl4F6tc.jpeg')}}" alt=""> --}}

						<form action="/sell" method="POST" enctype="multipart/form-data">
							{{@csrf_field()}}
							<div class="form-group">
								@if($errors->has("product_category"))
									<p class="error">{{ $errors->first('product_category') }}</p>
								@endif
								<select name="product_category" id="">
										<option disabled selected>Kateqoriya seç</option>
										@foreach ($category as $cat)
											<option {{ old("product_category") == $cat->id ? "selected":"" }} value="{{$cat->id}}">{{$cat->name}}</option>
										@endforeach
								</select>
							</div>

							<div class="form-group">
								@if($errors->has("product_name"))
									<p class="error">{{ $errors->first('product_name') }}</p>
								@endif

								<input type="text" class="form-control shop-form" placeholder='Məhsulun adı' value="{{ old('product_name') }}" name="product_name">
							</div>

							<div class="form-group">
								@if($errors->has("image.*"))
									<p class="error">{{ $errors->first('image.*') }}</p>
								@endif

								<input type="file" multiple accept="image/*" name="image[]" id="imgfile" style="display: none;"/>
								<label for="imgfile" class="image"><i class="fas fa-camera"></i> Şəkil əlavə et</label>

								<div class="izle col-md-12">

								</div>
							</div>
							

							<div class="form-group">
								@if($errors->has("product_price"))
									<p class="error">{{ $errors->first('product_price') }}</p>
								@endif

								<input type="number" value="{{ old('product_price') }}" class="form-control shop-form" placeholder='0.00 AZN' name="product_price">
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