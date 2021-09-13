@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
    	<div class="col-md-10 col-md-offset-1 p-0">
            <div class="col-md-8 col-md-offset-2 mt-5 mb-5">
                <form action="makeMarket" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-card">
                        @if (old("success"))
                            <div class="alert alert-success">
                                {{old("success")}}
                            </div>
                        @endif
                        <h1 class="mb-5">Mağaza yarat</h1>
                        <hr>
                        <div class="form-group">
                            @error("name")
                                <h3>{{$errors->first()}}</h3>
                            @enderror
                            <label for="market_name">Mağazanın adı</label>
                            <input id="market_name" name="name" max="50" placeholder="max 50 hərf" type="text" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="market_slogan">Mağazanızın sloganı</label>
                            <input id="market_slogan" name="slogan" max="100" placeholder="max 100 hərf" type="text" class="form-control">
                        </div>

                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="open_at">Açılma saatı</label>
                            </div>
                            <div class="col-xs-6">
                                <label for="close_at">Bağlanma saatı</label>
                            </div>
                            <div class="col-xs-6">
                                <input class="form-control mb-3" placeholder="09:00" type="text" id="open_at" name="open_at">
                            </div>
                            <div class="col-xs-6">
                                <input class="form-control mb-3" placeholder="19:00" type="text" id="close_at" name="close_at">
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="unvan">Ünvan</label>
                            <input type="text" placeholder="Bakı ş., Nərimanov r., Təbriz küçəsi" class="form-control" name="unvan" id="unvan">
                        </div>

                        <div class="form-group">
                            <label for="tel">Əlaqə</label>
                            <input placeholder="0xx-xxx-xx-xx" type="text" class="form-control" name="tel" id="tel">
                        </div>

                        <div class="form-group">
                            <label for="about">Haqqında</label>
                            <textarea placeholder="Mağazanız haqqında məlumat" class="form-control" name="about" id="about"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="market_picture">Mağazanın profil şəkli</label>
                            <input type="file" name="image" id="market_picture">
                        </div>

                        <div class="form-group">
                            <label for="market_cover">Mağazanın geniş şəkli</label>
                            <input type="file" name="cover" id="market_cover">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Mağaza Yarat</button>
                        </div>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection