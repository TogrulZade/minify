@extends('admin.layouts.layout')

@section('content')
<div class="col-xs-6 col-xs-offset-3" style="margin-top: 80px">
    <form action="todaysusers" method="POST">
        @csrf
    <div class="col-sm-6">
        <div class="form-group">
            <label for="my-input">Tarix</label>
            <input id="my-input" name="from" class="form-control" value="{{isset($from) ? $from : $today}}" type="date" name="">
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <label for="my-input">Tarix</label>
            <input id="my-input" name="to" class="form-control" value="{{isset($to) ? $to : $today}}" type="date" name="">
            <hr/>
        </div>
    </div>

    <button type="submit" class="btn-block btn btn-success">Bax</button>

    </form>
</div>

<div class="col-xs-12 col-xs-offset-3">
    @if (isset($users))
    <table>
        @foreach ($users as $i=>$user)
        <tr style="font-size: 18px">
            <td>{{$i+1}}) </td>
            <td> {{$user->name}}</td>
        </tr>

        @endforeach
    </table>
    @endif
</div>
@endsection