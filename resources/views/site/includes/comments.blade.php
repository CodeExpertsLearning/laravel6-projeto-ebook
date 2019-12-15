<div class="col-12">
    <hr>
    <h3>Comentários</h3>
    <hr>
    <form action="{{route('site.single.comment')}}" method="post">
        @csrf
        <input type="hidden" name="post_id" value="{{$post->id}}">
        <div class="form-group">
            <label>Criar Comentário</label>
            <textarea name="comment" class="form-control @error('comment') is-invalid @enderror" cols="30" rows="5">{{old('comment')}}</textarea>

            @error('comment')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-lg btn-success">Enviar Comentário</button>
    </form>
</div>
@if($post->comments->count())
<div class="col-12">
    <hr>
    <h3>Comentários</h3>
    <hr>
    @foreach($post->comments()->orderBy('id', 'DESC')->get() as $comment)
    <div class="col-12">
        <small>Comentário enviado em {{date('d/m/Y H:i:s', strtotime($comment->created_at))}}</small>
        <p>{{$comment->comment}}</p>
    </div>
    @endforeach
</div>
@endif