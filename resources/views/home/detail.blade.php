@extends('template.index') @section('container')
<section class="heading">
    @include('home.search')
    @include('home.login')

    <div class="container_detail">
        <div class="card-detail">
            <div class="image-detail">
                @if ($post->image)
                <img src="{{ asset('storage/'.$post->image) }}" alt="" />
                @else
                <img
                    src="{{
                        asset(
                            'storage/post-image/Y2bX3CJ9zKDpRBvDxPxuoKFING7lDheznMWMitw1.png'
                        )
                    }}"
                    alt=""
                />
                @endif
            </div>
            <div class="content-detail">
                <div class="status-detail">
                    <span>{{ $post->status->name }}</span>
                    <span>{{ $post->category->name }}</span>
                </div>
                <h3>{{ $post->judul }}</h3>
                <h6>
                    Rp. <span>{{ $post->harga }}</span>
                </h6>
                <div class="descripsi-detail">
                    <p>{{ $post->descripsi }}</p>
                </div>
                <div class="detail-pembayaran">
                    <h3>Pembayaran</h3>
                    <div class="pembayaran-image">
                        @for ($i = 1; $i < 7; $i++)
                            <img
                                src="{{
                                    asset(
                                        'asset\pembayaran'.$i.'.png'
                                    )
                                }}"
                                alt=""
                            />
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container_coment">
        <h1 class="judul-coment">Coments <span>({{ count($post->coments) }})</span></h1>
        @auth
            <form action="/coment" method="post" class="form_container">
                @csrf
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <input type="hidden" name="post_id" value="{{ $post->id }}">
                <input type="hidden" name="parent_id">
                @error('coment')
                    <span>{{ $message }}</span>
                @enderror
                <textarea name="coment" id="" cols="30" rows="10" placeholder="comment..."></textarea>
                <button>submit</button>
            </form>
        @endauth
        <div class="container-result-coment">
            @foreach ($comments as $comment)
                @if ($comment->parent_id === null)
                    <div class="result-coment">
                        <h3>{{ $comment->user->username }}</h3>
                        <p>{{ $comment->coment }}</p>
                        @auth
                            <div class="coment-action">
                                <div class="text-action">
                                    <p class="replies">replie</p>
                                    @if ($comment->user_id == Auth::user()->id)
                                        <form action="" method="post" class="form-text">
                                            @csrf
                                            <button>edite</button>
                                        </form>
                                        <form action="" method="post" class="form-delete">
                                            @csrf
                                            <button>delete</button>
                                        </form>
                                    @endif
                                </div>
                                <form action="/coment" method="post" class="form-action">
                                    @csrf
                                    <input
                                        type="hidden"
                                        name="user_id"
                                        value="{{ Auth::user()->id }}"
                                    />
                                    <input type="hidden" name="post_id" value="{{ $post->id }}" />
                                    <input type="hidden" name="parent_id" value="{{ $comment->id }}" />
                                    <input type="text" name="coment" placeholder="Reply...">
                                    <button>submit</button>
                                </form>
                            </div>
                        @endauth
                        @if($comment->replies->isNotEmpty())
                            <p class="see-more">Lihat Selengkapnya</p>

                            @foreach ($comment->replies as $coment)
                                <div class="balas-coment  has-cild">
                                    <h3>{{ $coment->user->username }} <span style="color: gray; font-size: 8px;">reply {{ $comment->user->username }}</span></h3>
                                    <p>{{ $coment->coment }}</p>
                                    <div class="coment-action">
                                        @auth
                                            <div class="text-action">
                                                <p class="replies">replie</p>
                                                        @if ($coment->user_id == Auth::user()->id)
                                                            <form action="" method="post" class="form-text">
                                                                @csrf
                                                                <button>edite</button>
                                                            </form>
                                                            <form action="" method="post" class="form-delete">
                                                                @csrf
                                                                <button>delete</button>
                                                            </form>
                                                        @endif
                                            </div>
                                        @endauth
                                        @auth
                                            <form action="/coment" method="post" class="form-action">
                                                @csrf
                                                <input
                                                    type="hidden"
                                                    name="user_id"
                                                    value="{{ Auth::user()->id }}"
                                                />
                                                <input type="hidden" name="post_id" value="{{ $post->id }}" />
                                                <input type="hidden" name="parent_id" value="{{ $coment->id }}" />
                                                <input type="text" name="coment" placeholder="Reply...">
                                                <button>submit</button>
                                            </form>
                                        @endauth
                                    </div>
                                    @if ($coment->replies->isNotEmpty())
                                        <p class="see-more-cild">Lihat Selengkapnya</p>
                                    @endif
                                    @include('home.coment', ['comment' => $comment])
                                </div>
                            @endforeach
                        @endif
                    </div>
                @endif
            @endforeach
        </div>
        

    </div>
    
</section>
@include('home.footer')

@endsection
