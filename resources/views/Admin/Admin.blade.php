@extends('Admin/Layouts/layout')

@section('main')
@foreach ($tables as $table)
    
    @if(is $table->editable)
    <div class="col-3 float-left mb-5">
        <a href="admin/table/{{$table->Tables_in_shopin}}" class="card bg-blue text-white">
            <div class="card-body">
                <h4 class="card-title">{{$table->Tables_in_shopin}}</h4>
            </div>
        </a>
    </div>
    @endif
@endforeach
@endsection