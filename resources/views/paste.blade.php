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
        <div class="paste-text">{{ $single_paste->text }}</div>
    </div>
    <div class="">
        @auth
            <div class="sidebar-block">
                <span class="fw-bold fs-5">My Pastes</span>
                @foreach ($private_paste as $paste)
                    <div>
                        <a href="{{ $paste->url }}" class="text-decoration-none">{{ $paste->title }}</a>
                        <div class="d-flex">
                            <span>{{ $paste->access }} |</span>
                            @if ($paste->language != null)
                                <span>{{ $paste->language }} |</span>
                            @endif
                            <span>{{ Illuminate\Support\Carbon::parse( $paste->created_at )->diff( Illuminate\Support\Carbon::now())->format('%i min ago') }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        @endauth
        <div class="sidebar-block">
            <span class="fw-bold fs-5">Public Pastes</span>
            @foreach ($public_paste as $paste)
                <div>
                    <a href="{{ $paste->url }}" class="text-decoration-none">{{ $paste->title }}</a>
                    <div class="d-flex">
                        <span>{{ $paste->access }} |</span>
                        @if ($paste->language != null)
                            <span>{{ $paste->language }} |</span>
                        @endif
                        <span>{{ Illuminate\Support\Carbon::parse( $paste->created_at )->diff( Illuminate\Support\Carbon::now())->format('%i min ago') }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
