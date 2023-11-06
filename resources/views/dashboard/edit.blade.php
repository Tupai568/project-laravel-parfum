@extends('template.index') @section('container')
<section class="heading">
    @include('home.notifikasi')
    <div class="createPost">
        <h1 class="logos">Edit Data</h1>
        <form
            action="/dashboard/admin/posts/{{ $post->id }}"
            method="post"
            class="formCreate"
            enctype="multipart/form-data"
        >
            @method('put'); @csrf
            <input
                type="text"
                name="judul"
                placeholder="Judul..."
                class="inputCreate"
                value="{{ $post->judul }}"
            />
            @error('judul')
            <span class="notif">{{ $message }}</span>
            @enderror
            <input
                type="number"
                name="harga"
                placeholder="Harga..."
                class="inputCreate"
                value="{{ $post->harga }}"
            />
            @error('harga')
            <span class="notif">{{ $message }}</span>
            @enderror
            <select name="status_id" id="status" class="inputCreate">
                @foreach ($statuses as $status) @if ($post->status_id ==
                $status->id)
                <option value="{{ $status->id }}" selected>
                    {{ $status->name }}
                </option>
                @else
                <option value="{{ $status->id }}">{{ $status->name }}</option>
                @endif @endforeach
            </select>
            @error('status_id')
            <span class="notif">{{ $message }}</span>
            @enderror
            <select name="category_id" id="category" class="inputCreate">
                @foreach ($categories as $categori) @if ($post->category_id ==
                $categori->id)
                <option value="{{ $categori->id }}" selected>
                    {{ $categori->name }}
                </option>
                @else
                <option value="{{ $categori->id }}">
                    {{ $categori->name }}
                </option>
                @endif @endforeach
            </select>
            @error('category_id')
            <span class="notif">{{ $message }}</span>
            @enderror @if ($post->image)
            <div class="container__image">
                <img src="{{asset('storage/'.$post->image)}}" alt="Not Found" />
                <span>old image</span>
            </div>
            @else
            <div class="container__image">
                <img class="img-preview" />
            </div>
            @endif
            <input type="hidden" name="oldIMG" value="{{$post->image}}" />
            <input
                type="file"
                name="image"
                id="image"
                class="inputCreate"
                onchange="previewImage()"
            />
            @error('image')
            <span class="notif">{{ $message }}</span>
            @enderror
            <textarea
                name="descripsi"
                id=""
                cols="30"
                rows="10"
                placeholder="Descripsi..."
                >{{ $post->descripsi }}</textarea
            >
            @error('descripsi')
            <span class="notif">{{ $message }}</span>
            @enderror
            <button>Edit Data</button>
        </form>
        <a href="/dashboard/admin/posts" class="back"
            ><-Back To Dahboard Admin</a
        >
    </div>
</section>
<script>
    const imgPreview = document.querySelector(".img-preview");
    imgPreview.style.display = "none";

    function previewImage() {
        const image = document.querySelector("#image");
        const imgPreview = document.querySelector(".img-preview");

        imgPreview.style.display = "block";
        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);
        oFReader.onload = function (oFREvent) {
            imgPreview.src = oFREvent.target.result;
        };
    }
</script>
@endsection
