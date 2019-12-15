@extends('layouts.app')

@section('content')
    <form action="{{route('profile.update')}}" method="post" enctype="multipart/form-data">

        @csrf

        <div class="form-group">
            <label>Nome</label>
            <input type="text" name="user[name]" class="form-control @error('user.name') is-invalid @enderror" value="{{$user->name}}">
            @error('user.name')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label>E-mail</label>
            <input type="text" name="user[email]" class="form-control @error('user.email') is-invalid @enderror" value="{{$user->email}}">

            @error('user.email')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Senha</label>
            <input type="password" name="user[password]" class="form-control @error('user.password') is-invalid @enderror" placeholder="Se deseja atualizar sua senha digitie aqui a senha nova...">
            @error('user.password')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Sobre</label>
            <textarea name="profile[about]" id="" cols="30" rows="10" class="form-control">{{$user->profile->about}}</textarea>
        </div>

        <div class="form-group">
            <label>Avatar</label>
            <input type="file" name="avatar" class="form-control @error('avatar') is-invalid @enderror">

            @error('user.email')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror

        </div>


        <div class="form-group">
            <label>Facebook</label>
            <input type="url" name="profile[facebook_link]" class="form-control" value="{{$user->profile->facebook_link}}">
        </div>
        <div class="form-group">
            <label>Instagram</label>
            <input type="url" name="profile[instagram_link]" class="form-control" value="{{$user->profile->instagram_link}}">
        </div>
        <div class="form-group">
            <label>Site</label>
            <input type="url" name="profile[site_link]" class="form-control" value="{{$user->profile->site_link}}">
        </div>


        <div class="form-group">
            <button class="btn btn-lg btn-success">Atualizar Meu Perfil</button>
        </div>
    </form>
@endsection
