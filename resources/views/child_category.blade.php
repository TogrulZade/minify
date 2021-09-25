<li><a href="">{{ $child_category->name }} 
    @if ($child_category->categories)
    <i class="fas fa-chevron-right"></i>
    @endif
</a>
</li>
@if ($child_category->categories)
<ul class="sub_item">
    @foreach ($child_category->categories as $childCategory)
        @include('child_category', ['child_category' => $childCategory])
    @endforeach
</ul>
@endif


