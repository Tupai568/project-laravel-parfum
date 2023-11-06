@extends('template.index') @section('container')

<section class="heading heading--category">
    @include('home.search') @include('home.login')

    <div class="container__category__logo">
        <img
            src="{{
                asset(
                    'asset/'.$judul.'.png'
                )
            }}"
            alt=""
        />
        <h3>{{ $judul }}</h3>
    </div>

    <div class="container__all__views">
        @foreach ($posts as $post)
        <div class="container__all__content">
            <div class="container__all__image">
                @if ($post->image)
                <a href="/detail/{{ $post->id }}">
                    <img src="{{asset('storage/'.$post->image)}}" alt="" />
                </a>
                @else
                <a href="/detail/{{ $post->id }}">
                    <img src="{{ asset('asset/NotImage.png') }}" alt="" />
                </a>
                @endif
                <p>{{ $post->status->name }}</p>
                <!-- ... Kode lainnya ... -->
                @auth 
                    @if ($post->like)
                    <button class="like-button like" data-postid="{{ $post->id }}">
                        <i class="fa-solid fa-heart love"></i>
                        <span class="like-count">{{ $post->like_count }}</span>
                        <!-- Menampilkan jumlah "Suka" -->
                    </button>
                    @else
                    <button class="like-button like" data-postid="{{ $post->id }}">
                        <i class="fa-solid fa-heart" id="notlove"></i>
                        <span class="like-count">{{ $post->like_count }}</span>
                        <!-- Menampilkan jumlah "Suka" -->
                    </button>
                    @endif 

                @endauth 
                @guest
                <span class="like">
                    <i class="fa-solid fa-heart" id="notlove"></i>
                    <span class="like-count">{{ $post->like_count }}</span>
                </span>
                @endguest
            </div>
            <a href="/detail/{{ $post->id }}">
                <div class="container__all__body">
                    <h1>{{ $post->judul }}</h1>
                    <h3>RP: {{ number_format($post->harga, 0, ',', '.') }}</h3>
                </div>
            </a>
            <button class="btn-card">buy</button>
        </div>
        @endforeach
    </div>
    {{ $posts->links('vendor.pagination.paginator') }}
</section>
@include('home.footer')
@endsection
