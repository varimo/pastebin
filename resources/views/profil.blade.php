@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-between">
    <div class="d-flex flex-column profil-pastes">
        <table>
            <thead>
                <tr>
                    <th>Name / Title</th>
                    <th>Added</th>
                    <th>Expires</th>
                    <th>Syntax</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pastes as $paste)
                    <tr>
                        <th>
                            <a href="{{ $paste->url }}" class="text-decoration-none">{{ $paste->title }}</a>
                        </th>
                        <th>{{ $paste->created_at->format('M d, Y') }}</th>
                        @switch($paste->term)
                            @case(600)
                                <th>10 Minutes</th>
                                @break
                            @case(3600)
                                <th>1 Hour</th>
                                @break
                            @case(10800)
                                <th>3 Hour</th>
                                @break
                            @case(86400)
                                <th>1 Day</th>
                                @break
                            @case(604800)
                                <th>1 Week</th>
                                @break
                            @case(2592000)
                                <th>1 Month</th>
                                @break
                            @default
                                <th>Never</th>
                        @endswitch
                        @if( !is_null( $paste->language ))
                            <th>{{ $paste->language }}</th>
                        @else
                            <th>None</th>
                        @endif

                    </tr>
                @endforeach

            </tbody>
        </table>

        <div class="profil-pagination">
            {{ $pastes->links() }}
        </div>
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
