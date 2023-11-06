@extends('template.index') @section('container')
<section class="heading">
    @include('home.notifikasi')
    @include('dashboard.searchAdmin')

    <div class="actionAdmin">
        <div class="actionInput">
            <a href="/dataUser">
                <button class="tambahData" style="background: yellow">Data User</button>
            </a>
            <form action="/dashboard/admin/posts/create" method="get">
                <button class="tambahData">Tambah Data</button>
            </form>
        </div>
    </div>
    <table>
        <caption>
            Data Product
        </caption>
        <thead>
            <tr>
                <th scope="col">judul</th>
                <th scope="col">harga</th>
                <th scope="col">category</th>
                <th scope="col">status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
            <tr>
                <td data-label="judul">{{ $post->judul }}</td>
                <td data-label="harga">{{ $post->harga }}</td>
                <td data-label="category">{{ $post->category->name }}</td>
                <td data-label="status">{{ $post->status->name }}</td>
                <td data-label="action">
                    <div class="tableAction">
                        <form
                            action="/dashboard/admin/posts/{{ $post->id }}"
                            method="get"
                        >
                            <button id="show">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                        </form>
                        <!-- edit -->
                        <form
                            action="/dashboard/admin/posts/{{ $post->id }}/edit"
                            method="get"
                        >
                            <button id="edit">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                        </form>
                        <!-- Delete -->
                        <form
                            action="/dashboard/admin/posts/{{$post->id}}"
                            method="post"
                        >
                            @method('delete') @csrf
                            <button
                                id="delt"
                                onclick="return confirm('are you sure?')"
                            >
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                        <!-- EndDelete -->
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</section>
@endsection
