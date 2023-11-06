@extends('template.index') @section('container')
<section class="heading">
    @include('home.notifikasi')
    @include('dashboard.searchUser')

    <div class="actionAdmin">
        <div class="actionInput">
            <a href="/dashboard/admin/posts" class="back"
            ><-Back To Dahboard Admin</a>
        </div>
    </div>
    <table>
        <caption>
            Data Product
        </caption>
        <thead>
            <tr>
                <th scope="col">username</th>
                <th scope="col">email</th>
                <th scope="col">status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td data-label="username">{{ $user->username }}</td>
                <td data-label="email">{{ $user->email }}</td>
                <td data-label="status">{{ ($user->IsAdmin == 0) ? 'User':'Admin' }}</td>
                <td data-label="action">
                    <div class="tableAction">
                        
                        <!-- edit -->
                        <form
                            action="/changeStatusUser"
                            method="post"
                        >
                            @csrf
                            <input type="hidden" value="{{ $user->id }}" name="id">
                            <input type="hidden" value="{{ $user->IsAdmin }}" name="IsAdmin">
                            <button id="edit" onclick="return confirm('are you sure change status?')" style="background: {{ ($user->IsAdmin == 0) ? '':'yellow' }}">
                                <i class="fa-solid {{ ($user->IsAdmin == 0) ? 'fa-user':'fa-user-secret' }}"></i>
                            </button>
                        </form>



                        <!-- Delete -->
                        <form
                            action="/deleteUser"
                            method="post"
                        >
                            @csrf
                            <input type="hidden" value="{{ $user->id }}" name="id">
                            <button
                                id="delt"
                                onclick="return confirm('are you sure delete?')"
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
