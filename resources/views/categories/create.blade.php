@extends('layouts.app')

@section('content')
    <form action="{{route('categories.store')}}" method="post">

        @csrf

        <div class="form-group">
            <label>Nome</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}">
            @error('name')
                <p class="invalid-feedback">
                    {{$message}}
                </p>
            @enderror
        </div>

        <div class="form-group">
            <label>Descrição</label>
            <input type="text" name="description" class="form-control" value="{{old('description')}}">
        </div>
        
        <button class="btn btn-lg btn-success">Criar Categoria</button>
    </form>
@endsection