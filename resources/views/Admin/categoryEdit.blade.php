@extends('admin.layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-md-offset-2 p-0 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1" style="margin-top: 70px">
            <div class="col-sm-6">
            @foreach ($getCategory as $gc)
                @if ($gc->parent_id == 0)
                    <h5>{{$gc->name}}</h5>
                @endif
                @foreach ($gc->childrenCategories as $childCategory)
                    @include('admin/childe', ['child_category' => $childCategory])
                @endforeach
            @endforeach
            </div>
            <div class="col-sm-6">
                {{-- Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto minima quo est, natus odit dicta expedita, sapiente distinctio maiores explicabo, deleniti vero in. Velit, delectus aliquid consectetur porro cum quibusdam! --}}
            </div>
        </div>
    </div>
</div>
@endsection