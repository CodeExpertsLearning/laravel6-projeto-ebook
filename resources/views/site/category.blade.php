@extends('layouts.site')


@section('content')
    <div class="row">
        <div class="col-8">
            <div class="col-12">
                <h2>Categoria: {{$category->name}}</h2>
                <hr>
            </div>
            @forelse($posts as $post)
                <div class="col-12">
                    @if($post->thumb)
                        <img src="{{asset('storage/' . $post->thumb)}}" alt="" class="img-fluid" style="margin-bottom: 20px;">
                    @else
                        <img src="{{asset('img/no-photo.jpg')}}" alt="" class="img-fluid" style="margin-bottom: 20px;">
                    @endif
                    <h3>{{$post->title}}</h3>
                    <p>
                        {{$post->description}}
                    </p>
                    <a href="{{route('site.single', ['slug' => $post->slug])}}">Leia mais...</a>
                    <hr>
                </div>
            @empty
                <div class="alert alert-warning">Sem posts para esta categoria!</div>
            @endforelse
            <div class="col-12">
                {{$posts->links()}}
            </div>
        </div>
        <div class="col-4">
            <div class="col-12">
                <h2>Sidebar</h2>
                <hr>
            </div>
        </div>
    </div>
    </div>
@endsection