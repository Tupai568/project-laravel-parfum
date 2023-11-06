@extends('template.index')
@section('container')

<section class="heading heading--category">
    @include('home.search') @include('home.login')
    @if (session()->has('error'))
    <div class="container-flash">
        <span class="error">{{ session("error") }}</span>
    </div>
    @endif @if (session()->has('success'))
    <div class="container-flash">
        <span class="success">{{ session("success") }}</span>
    </div>
    @endif



    
    
    <div class="container__category__logo">
        <img src="{{ asset('asset/Baner1.png') }}" alt="" class="slider" />
        <img src="{{ asset('asset/Baner2.png') }}" alt="" class="slider" />
        <img src="{{ asset('asset/Baner3.png') }}" alt="" class="slider" />
    </div>
    <div class="content_logo">
        <header>
            <div class="logo_image"></div>
            <h3>ambergeis</h3>
            <h6>selling only pleasures</h6>
        </header>
        <div class="body_logo">
            <div class="cild_body_logo">
                <i class="fa-solid fa-users"></i>
                <p>about</p>
            </div>
            <div class="cild_body_logo">
                <i class="fa-solid fa-store"></i>
                <p>store</p>
            </div>
            <div class="cild_body_logo">
                <i class="fa-brands fa-blogger-b"></i>
                <p>blog</p>
            </div>
        </div>
    </div>
</section>
<section class="best">
    <h1>Unisex</h1>
    <div class="best-container">
        @foreach ($unisexs as $unisex)
        <div class="content-best-image">
            @if ($unisex->image)
            <a href="/detail/{{ $unisex->id }}">
                <img src="{{asset('storage/'.$unisex->image)}}" alt="" />
            </a>
            @else
            <a href="/detail/{{ $unisex->id }}">
                <img src="{{ asset('asset/NotImage.png') }}" alt="" />
            </a>
            @endif
            <div class="body-content">
                <h3>{{ $unisex->judul }}</h3>
                <p>
                    Rp.
                    <span
                        >{{ number_format($unisex->harga, 0, ',', '.') }}</span
                    >
                </p>
            </div>
            <button class="btn-card btn-best">buy</button>
        </div>
        @endforeach
    </div>

    <h1>Females</h1>
    <div class="best-container">
        @foreach ($females as $female)
        <div class="content-best-image">
            @if ($female->image)
            <a href="/detail/{{ $female->id }}">
                <img src="{{asset('storage/'.$female->image)}}" alt="" />
            </a>
            @else
            <a href="/detail/{{ $female->id }}">
                <img src="{{ asset('asset/NotImage.png') }}" alt="" />
            </a>
            @endif
            <div class="body-content">
                <h3>{{ $female->judul }}</h3>
                <p>
                    Rp.
                    <span
                        >{{ number_format($female->harga, 0, ',', '.') }}</span
                    >
                </p>
            </div>
            <button class="btn-card btn-best">buy</button>
        </div>
        @endforeach
    </div>

    <h1>Male</h1>
    <div class="best-container">
        @foreach ($males as $male)
        <div class="content-best-image">
            @if ($male->image)
            <a href="/detail/{{ $male->id }}">
                <img src="{{asset('storage/'.$male->image)}}" alt="" />
            </a>
            @else
            <a href="/detail/{{ $male->id }}">
                <img src="{{ asset('asset/NotImage.png') }}" alt="" />
            </a>
            @endif
            <div class="body-content">
                <h3>{{ $male->judul }}</h3>
                <p>
                    Rp.
                    <span>{{ number_format($male->harga, 0, ',', '.') }}</span>
                </p>
            </div>
            <button class="btn-card btn-best">buy</button>
        </div>
        @endforeach
    </div>
</section>

<section class="favorit heading--category">
    <h1>FAVORIT</h1>
    <div class="body-favorit">
        @foreach ($likes as $favorit)
        <div class="card-favorit">
            <img src="{{ asset('asset/NotImage.png') }}" alt="" />
            <div class="body-content body-content-cild">
                <h3>{{ $favorit->judul }}</h3>
                <p>Rp. {{ number_format($favorit->harga, 0, ',', '.') }}</p>
            </div>
            <button class="btn-favorit" style="z-index: 1">buy</button>
        </div>
        @endforeach
    </div>
</section>
@include('home.footer') @endsection
