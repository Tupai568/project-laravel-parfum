@extends('template.index') @section('container')
<section class="heading">
    @include('home.notifikasi')

    <div class="createPost">
        <h1 class="logos">Tambah Data</h1>
        <form
            action="/dashboard/admin/posts"
            method="post"
            class="formCreate"
            enctype="multipart/form-data"
        >
            @csrf
            <input
                type="text"
                name="judul"
                placeholder="Judul..."
                class="inputCreate"
                value="{{ old('judul') }}"
            />
            @error('judul')
            <span class="notif">{{ $message }}</span>
            @enderror
            <input
                type="number"
                name="harga"
                placeholder="Harga..."
                class="inputCreate"
                value="{{ old('harga') }}"
            />
            @error('harga')
            <span class="notif">{{ $message }}</span>
            @enderror
            <select name="status_id" id="status" class="inputCreate">
                @foreach ($statuses as $status)
                <option value="{{ $status->id }}">{{ $status->name }}</option>
                @endforeach
            </select>
            @error('status')
            <span class="notif">{{ $message }}</span>
            @enderror
            <select name="category_id" id="category" class="inputCreate">
                @foreach ($categories as $categori)
                <option value="{{ $categori->id }}">
                    {{ $categori->name }}
                </option>
                @endforeach
            </select>
            <p>file png</p>
            @error('category_id')
            <span class="notif">{{ $message }}</span>
            @enderror
            <div class="container__image">
                <img class="img-preview" />
            </div>
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
                >{{ old("descripsi") }}</textarea
            >
            @error('descripsi')
            <span class="notif">{{ $message }}</span>
            @enderror
            <button>Tambah Data</button>
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
