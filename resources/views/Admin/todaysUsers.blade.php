@extends('admin.layouts.layout')

@section('content')
<div class="col-xs-6 col-xs-offset-3" style="margin-top: 80px">
    <form action="todaysusers" method="POST">
        @csrf
    <div class="col-sm-6">
        <div class="form-group">
            <label for="my-input">Tarix</label>
            <input id="my-input" name="from" class="form-control" value="{{$from ?? $today}}" type="date" name="">
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <label for="my-input">Tarix</label>
            <input id="my-input" name="to" class="form-control" value="{{$to ?? $today}}" type="date" name="">
            <hr/>
        </div>
    </div>

    <button type="submit" class="btn-block btn btn-success">Bax</button>

    </form>
</div>

<div class="col-xs-8 col-xs-offset-3 mt-5">
    @if (isset($users))
    <table class="table">
    <thead class="thead-dark">
        <tr class="active">
        <td>#</td>
        <td>ID</td>
        <td>Adı</td>
        <td>Email</td>
        <td>Mobile</td>
        <td>Mağaza</td>
        <td>Tarix</td>
        </tr>
    </thead>
    @foreach ($users as $i=>$user)
        <tr style="font-size: 18px">
            <td>{{$i+1}}) </td>
            <td> {{$user->id}}</td>
            <td> {{$user->name}}</td>
            <td> {{$user->email}}</td>
            <td> {{$user->phone}}</td>
            <td> 
                @isset($user->market)
                    @foreach ($user->market as $market)
                        <a href="/market/{{$market->slug}}">{{$market->name}}</a>
                    @endforeach
                @endisset
            </td>
            <td> {{$user->created_at}}</td>
        </tr>

        @endforeach
    </table>
    @endif
</div>
@endsection