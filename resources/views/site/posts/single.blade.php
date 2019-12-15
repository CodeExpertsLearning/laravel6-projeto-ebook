@extends('layouts.site')


@section('content')
    <div class="row">
        <div class="col-8">
            <div class="col-12">
                <h2>{{$post->title}}</h2>
                <hr>
            </div>

            <div class="col-12">
                @if($post->thumb)
                    <img src="{{asset('storage/' . $post->thumb)}}" alt="" class="img-fluid" style="margin-bottom: 20px;">
                @else
                    <img src="{{asset('img/no-photo.jpg')}}" alt="" class="img-fluid" style="margin-bottom: 20px;">
                @endif
                <p>
                    {!! $post->content !!}
                </p>

            </div>
            @include('site.includes.comments')
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