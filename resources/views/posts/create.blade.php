@extends('layouts.app')

@section('content')
    <form action="{{route('posts.store')}}" method="post" enctype="multipart/form-data">

        @csrf

        <div class="form-group">
            <label>Titulo</label>
            <input type="text" name="title" class="form-control" value="{{old('title')}}">
        </div>

        <div class="form-group">
            <label>Descrição</label>
            <input type="text" name="description" class="form-control" value="{{old('description')}}">
        </div>

        <div class="form-group">
            <label>Conteúdo</label>
            <textarea name="content" id="" cols="30" rows="10" class="form-control">{{old('content')}}</textarea>
        </div>

        <div class="form-group">
            <label>Slug</label>
            <input type="text" name="slug" class="form-control" value="{{old('slug')}}">
        </div>

        <div class="form-group">
            <label>Foto de Capa</label>
            <input type="file" name="thumb">
        </div>

        <div class="form-group">
            <label>Categorias</label>
            <div class="row">
                @foreach($categories  as $c)
                    <div class="col-2 checkbox">
                        <label>
                            <input type="checkbox" name="categories[]" value="{{$c->id}}"> {{$c->name}}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="form-group">
            <button class="btn btn-lg btn-success">Criar Postagem</button>
        </div>
    </form>
@endsection