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
                        <span>{{ Illuminate\Support\Carbon::parse( $paste->created_at )->diffForHumans( Illuminate\Support\Carbon::now()) }}</span>
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
                    <span>{{ str_replace(' before', '', Illuminate\Support\Carbon::parse( $paste->created_at )->diffForHumans( Illuminate\Support\Carbon::now())) }}</span>
                </div>
            </div>
        @endforeach
    </div>
</div>
