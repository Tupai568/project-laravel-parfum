@foreach ($coment->replies as $reply)

<div class="balas-coment cild">
    <h3>
        {{ $reply->user->username }}
        <span class="rep">reply {{ $comment->user->username }}</span>
    </h3>
    <p>{{ $reply->coment }}</p>
    <div class="coment-action">
        @auth
        <div class="text-action">
            <p class="replies">replie</p>
            @if ($reply->user_id == Auth::user()->id)
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
        @endauth @auth
        <form action="/coment" method="post" class="form-action">
            @csrf
            <input
                type="hidden"
                name="user_id"
                value="{{ Auth::user()->id }}"
            />
            <input type="hidden" name="post_id" value="{{ $post->id }}" />
            <input type="hidden" name="parent_id" value="{{ $reply->id }}" />
            <input type="text" name="coment" placeholder="Reply...">
            <button>submit</button>
        </form>
        @endauth
    </div>
</div>
@include('home.coment', ['coment' => $reply]) @endforeach
