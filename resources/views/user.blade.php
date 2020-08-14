@extends('layouts.master')

@section('title')
<title>Stack Overflow KW | Profil</title>
@endsection

@section('content')
<div class="row">
    <div class="col">
        <!-- Dropdown Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Profil</h6>
            </div>
            <div class="card-body text-center">
                <img src="{{ asset('images/profile_img.png') }}" alt="Foto Profil" width="80" height="80" class="mb-4">

                <div class="user-profile">
                    <span>Nama Pengguna: <span class="font-weight-bold">{{$user->name}}</span></span><br>
                    <span>Email: <span class="font-weight-bold">{{$user->email}}</span></span><br>
                    <span>Poin Reputasi: <span class="font-weight-bold">{{$user->reputation_point}}</span></span><br>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
