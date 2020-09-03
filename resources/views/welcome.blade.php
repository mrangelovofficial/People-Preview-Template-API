@extends('layout/main')

@section('main')
<div class="company-list-container">
    @if($collection)
    <div class="result">{{$results}} results</div>
    <ul class="company-list">
        @foreach($collection as $row)
        <li class="company-list-row">
            <div class="company-list-profile">
            <img src="{{$row['avatar']}}" onerror="imgError(this);">
            </div>
            <div class="company-list-info">
                <span class="company-list-name">{{$row['name']}}</span>
                <span class="company-list-title">{{$row['address']}}</span>
            </div>

        </li>
        @endforeach
    </ul>
    <div>{{ $collection->withQueryString()->links() }}</div>
    @else
    <script>
        location.reload();
    </script>
    @endif
</div>

@endsection
