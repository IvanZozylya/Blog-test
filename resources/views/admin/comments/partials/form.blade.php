<label for="">Статус</label>
<select class="form-control" name="status">
    @if (isset($comment->id))
        <option value="0" @if (!$comment->status) selected="" @endif>Не опубликовано</option>
        <option value="1" @if ($comment->status) selected="" @endif>Опубликовано</option>
    @else
        <option value="0">Не опубликовано</option>
        <option value="1">Опубликовано</option>
    @endif
</select>

@if(!isset($comment->article_id))
    <label for="">Выберите новость</label>
    <select class="form-control" name="article_id">
        @foreach($categories as $category)
            <optgroup label="<-{{$category->title}}->">

                @foreach($articles as $article)

                    @if($category->id == $article->category_id)
                        @if(isset($comment->article_id))
                            @if($comment->article_id == $article->id)
                                <option value="{{$article->id}}" selected>{{$article->title}}</option>
                            @endif
                        @endif
                        <option value="{{$article->id}}">{{$article->title}}</option>
                    @endif
                @endforeach
            </optgroup>
        @endforeach
    </select>
@endif
@if(isset($comment->article_id))
    @foreach($articles as $article)
        @if($comment->article_id == $article->id)
            @foreach($categories as $category)
                @if($category->id == $article->category_id)
                    <label for="">Категория</label>
                    <input type="text" class="form-control" value="{{$category->title}}" readonly>
                @endif
            @endforeach
            <label for="">Название новости</label>
            <input type="text" class="form-control" value="{{$article->title}}" readonly>
        @endif
    @endforeach
@endif


<label for="">Комментарий</label>
<textarea name="text" id="" cols="30" rows="10" class="form-control" placeholder="Ваш комментарий"
          required>{{$comment->text or ""}}</textarea>
<hr/>

<input class="btn btn-primary" type="submit" value="Сохранить">