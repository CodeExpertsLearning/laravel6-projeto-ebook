@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <a href="{{route('categories.create')}}" class="btn btn-success float-right">Criar Categoria</a>
            <h2>Categorias Blog</h2>
            <div class="clearfix"></div>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Criado em</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        @forelse($categories as $category)
            <tr>
                <td>{{$category->id}}</td>
                <td>{{$category->name}}</td>
                <td>{{date('d/m/Y H:i:s', strtotime($category->created_at))}}</td>
                <td>
                    <div class="btn-group">
                        <a href="{{route('categories.show', ['category' => $category->id])}}" class="btn btn-sm btn-primary">
                            Editar
                        </a>
                        <form action="{{route('categories.destroy', ['category' => $category->id])}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Remover</button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4">Nada encontrado!</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    {{$categories->links()}}
@endsection