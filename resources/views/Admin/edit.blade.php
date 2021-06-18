@extends('admin.layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5 col-md-offset-4 p-0 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
            @if($errors->has("isNot"))
                <div class="alert alert-danger">
                    {{ $errors->first('isNot') }}
                </div>
            @endif

            @if(old("success"))
                <div class="alert alert-danger">
                   {{ old('success') }}
                </div>
            @endif
            <form method="POST" action="action">
                @csrf
                <div class="card" style="margin-bottom: 92px;margin-top: 40px;border: 1px solid #e2e2e2; background-color: #fff; box-shadow: 0 0 7px 1px rgba(0,0,0,.2); border-radius: 10px;padding: 20px">
                    <div class="form-group">
                    <a href="/product/{{$product->slug}}" target="_blank">Məhsula keçid et</a>
                    </div>

                    <div class="form-group">
                        <input placeholder="Məhsulun başlığı" type="text" class="form-control" name="name" value="{{$product->product_name}}" required autocomplete="name" autofocus>
                    </div>

                    <div class="form-group">
                        <textarea type="text" name="description" class="form-control" placeholder="Haqqında">{{ $product->product_description }}</textarea>
                    </div>

                    <div class="form-group">
                        <input type="text" onkeypress="return isNum(event)" name="price" class="form-control" placeholder="Qiymət" value="{{$product->product_price}}">
                    </div>

                    <div class="form-group">
                        <input type="text" name="merchant_number" class="form-control" placeholder="Əlaqə vasitəsi" value="{{$product->merchant_number}}">
                    </div>

                    <select name="product_category" id="">
                        <option disabled selected>Kateqoriya seç</option>
                        @foreach ($category as $cat)
                            <option {{ $product->product_category == $cat->id ? "selected":"" }} value="{{$cat->id}}">{{$cat->name}}</option>
                        @endforeach
                    </select>

                    <select name="active" id="">
                        <option value="0" {{$product->active == 0 ? 'selected' : ''}}>Deaktiv</option>
                        <option value="1" {{$product->active == 1 ? 'selected' : ''}}>Aktiv</option>
                        <option value="2" {{$product->active == 2 ? 'selected' : ''}}>Düzəlişə ver</option>
                    </select>

                    <div class="form-group">
                        <label for="started">Başlanğıc tarix</label>
                        <input id="started" type="date" name="started_at" class="form-control" value="{{date('Y-m-d', strtotime($product->started_at))}}">
                    </div>

                    <div class="form-group">
                        <label for="closed">Bitiş tarix</label>
                        <input id="closed" type="date" name="closed_at" class="form-control" value="{{date('Y-m-d', strtotime($product->closed_at))}}">
                    </div>
                    <input type="hidden" name="pid" value="{{$product->id}}">
                    
                    <div class="form-group">
                        <button class="btn btn-md btn-block btn-success">Düzəlişə göndər</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>

@endsection
