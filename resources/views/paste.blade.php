@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-between">
    <div class="d-flex flex-column single-paste">
        <span class="fs-5">{{ $single_paste->title }}</span>
        <div class="d-flex">
            @if ($single_paste->name != null)
                <span class="text-uppercase text-danger" style="margin-right: 10px; ">{{ $single_paste->name }}</span>
            @else
                <span class="text-uppercase text-danger" style="margin-right: 10px; ">guest</span>
            @endif
            <span class="text-uppercase">{{ $single_paste->created_at->format('M d, Y') }}</span>
        </div>
        <span class="text-uppercase text-success" style="margin-right: 10px; ">{{ $single_paste->language }}</span>
        <div class="paste-text mt-2">
            <pre><code>{{ $single_paste->text }}</code></pre>
        </div>
    </div>
    <script>hljs.highlightAll();</script>
    @include('layouts.sidebar')
</div>
@endsection
