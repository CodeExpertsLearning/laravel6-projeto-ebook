@extends('layouts.app')

@section('content')
    <form action="{{route('posts.update', ['post' => $post->id])}}" method="post"  enctype="multipart/form-data">

        @csrf
        @method("PUT")

        <div class="form-group">
            <label>Titulo</label>
            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{$post->title}}">
            @error('title')
                <p class="invalid-feedback">{{$message}}</p>
            @enderror
        </div>

        <div class="form-group">
            <label>Descrição</label>
            <input type="text" name="description" class="form-control  @error('description') is-invalid @enderror" value="{{$post->description}}">
            @error('description')
                <p class="invalid-feedback">{{$message}}</p>
            @enderror
        </div>

        <div class="form-group">
            <label>Conteúdo</label>
            <textarea name="content" id="" cols="30" rows="10" class="form-control  @error('content') is-invalid @enderror">{{$post->content}}</textarea>
            @error('content')
                <p class="invalid-feedback">{{$message}}</p>
            @enderror
        </div>

        <div class="form-group">
            <label>Foto de Capa</label>
            <input type="file" name="thumb" class="form-control  @error('thumb') is-invalid @enderror">
            @error('thumb')
                <p class="invalid-feedback">{{$message}}</p>
            @enderror
        </div>

        <div class="form-group">
            <label>Categorias</label>
            <div class="form-group">
                @foreach($categories  as $c)
                    <div class="col-2 custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input @error('categories') is-invalid @enderror" name="categories[]" value="{{$c->id}}"
                               @if($post->categories->contains($c)) checked @endif>
                        <label class="custom-control-label">
                            {{$c->name}}
                        </label>

                    </div>
                @endforeach
            </div>
        </div>

        <div class="form-group">
            <button class="btn btn-lg btn-success">Atualizar Postagem</button>
        </div>

    </form>
    <hr>
    <form action="{{route('posts.destroy', ['post' => $post->id])}}" method="post">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-lg btn-danger">Remover Post</button>
    </form>
@endsection