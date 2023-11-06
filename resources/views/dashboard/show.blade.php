@extends('template.index') @section('container')
<section class="heading">
    <div class="createPost createShow">
        <div class="tableAction">
            <form
                action="/dashboard/admin/posts/{{ $post->id }}/edit"
                method="get"
            >
                <button id="edit" class="edit-show">
                    <i class="fa-solid fa-pen-to-square"></i>
                </button>
            </form>
            <!-- Delete -->
            <form action="/dashboard/admin/posts/{{$post->id}}" method="post">
                @method('delete') @csrf
                <button
                    id="delt"
                    class="delt-show"
                    onclick="return confirm('are you sure?')"
                >
                    <i class="fa-solid fa-trash"></i>
                </button>
            </form>
        </div>
    </div>

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
                    <img
                        src="{{
                            asset(
                                'storage/post-image/Y2bX3CJ9zKDpRBvDxPxuoKFING7lDheznMWMitw1.png'
                            )
                        }}"
                        alt=""
                    />
                    <img
                        src="{{
                            asset(
                                'storage/post-image/Y2bX3CJ9zKDpRBvDxPxuoKFING7lDheznMWMitw1.png'
                            )
                        }}"
                        alt=""
                    />
                    <img
                        src="{{
                            asset(
                                'storage/post-image/Y2bX3CJ9zKDpRBvDxPxuoKFING7lDheznMWMitw1.png'
                            )
                        }}"
                        alt=""
                    />
                    <img
                        src="{{
                            asset(
                                'storage/post-image/Y2bX3CJ9zKDpRBvDxPxuoKFING7lDheznMWMitw1.png'
                            )
                        }}"
                        alt=""
                    />
                    <img
                        src="{{
                            asset(
                                'storage/post-image/Y2bX3CJ9zKDpRBvDxPxuoKFING7lDheznMWMitw1.png'
                            )
                        }}"
                        alt=""
                    />
                    <img
                        src="{{
                            asset(
                                'storage/post-image/Y2bX3CJ9zKDpRBvDxPxuoKFING7lDheznMWMitw1.png'
                            )
                        }}"
                        alt=""
                    />
                    <img
                        src="{{
                            asset(
                                'storage/post-image/Y2bX3CJ9zKDpRBvDxPxuoKFING7lDheznMWMitw1.png'
                            )
                        }}"
                        alt=""
                    />
                    <img
                        src="{{
                            asset(
                                'storage/post-image/Y2bX3CJ9zKDpRBvDxPxuoKFING7lDheznMWMitw1.png'
                            )
                        }}"
                        alt=""
                    />
                    <img
                        src="{{
                            asset(
                                'storage/post-image/Y2bX3CJ9zKDpRBvDxPxuoKFING7lDheznMWMitw1.png'
                            )
                        }}"
                        alt=""
                    />
                    <img
                        src="{{
                            asset(
                                'storage/post-image/Y2bX3CJ9zKDpRBvDxPxuoKFING7lDheznMWMitw1.png'
                            )
                        }}"
                        alt=""
                    />
                    <img
                        src="{{
                            asset(
                                'storage/post-image/Y2bX3CJ9zKDpRBvDxPxuoKFING7lDheznMWMitw1.png'
                            )
                        }}"
                        alt=""
                    />
                    <img
                        src="{{
                            asset(
                                'storage/post-image/Y2bX3CJ9zKDpRBvDxPxuoKFING7lDheznMWMitw1.png'
                            )
                        }}"
                        alt=""
                    />
                    <img
                        src="{{
                            asset(
                                'storage/post-image/Y2bX3CJ9zKDpRBvDxPxuoKFING7lDheznMWMitw1.png'
                            )
                        }}"
                        alt=""
                    />
                </div>
            </div>
        </div>
    </div>
    <div class="createPost createShow">
        <a href="/dashboard/admin/posts" class="back"
            ><-Back To Dahboard Admin</a
        >
    </div>
</section>
@endsection
