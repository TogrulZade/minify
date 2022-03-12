@extends('admin.layouts.layout')

@section('content')
<div class="col-xs-8 col-xs-offset-3" style="margin-top: 80px">
    <h3>Cəm log: {{ count($logregister) }}</h3>
    <hr>
    @foreach ($logregister as $log)
        <div> <b>User Agent</b> {{$log->user_agent}}</div>
        <div> <b>IP ADRESS</b> {{$log->ip_address}}</div>
        {{$log->fbclid ? 'FBCLID: '. $log->fbclid.'' : ''}}
        {{$log->utm_source ? 'utm_source: '. $log->utm_source.'' : ''}}
        <hr>
    @endforeach
</div>
@endsection