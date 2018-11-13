<label for="">Статус</label>
<select class="form-control" name="published">
    @if (isset($article->id))
        <option value="0" @if (!$article->published) selected="" @endif>Не опубликовано</option>
        <option value="1" @if ($article->published) selected="" @endif>Опубликовано</option>
    @else
        <option value="0">Не опубликовано</option>
        <option value="1">Опубликовано</option>
    @endif
</select>

<label for="">Заголовок</label>
<input type="text" class="form-control" name="title" placeholder="Заголовок новости" value="{{$article->title or ""}}"
       required>

<label for="">Slug (Уникальное значение)</label>
<input class="form-control" type="text" name="slug" placeholder="Автоматическая генерация"
       value="{{$article->slug or ""}}" readonly="">

@if(!isset($article->category_id))
    <label for="">Выберите категорию</label>
    <select class="form-control" name="category_id" required>
        @foreach($categories as $category)
            <option value="{{$category->id}}">{{$category->title}}</option>
        @endforeach
    </select>
    <br>
@endif
@foreach($categories as $category)
    @if(isset($category->id) && isset($article->category_id))
        @if($category->id == $article->category_id)
            <label for="">Название категории</label>
            <input type="text" class="form-control" value="{{$category->title}}" readonly>
        @endif
    @endif
@endforeach



<label for="">Краткое описание</label>
<textarea class="form-control" id="description_short"
          name="description_short">{{$article->description_short or ""}}</textarea>

<label for="">Полное описание</label>
<textarea class="form-control" id="description" name="description">{{$article->description or ""}}</textarea>

<br>

<img src="/images/uploads/articles/{{$article->image or ""}}" alt=""><br>
<label for="">Загрузка изображения</label>
<input type="file" name="image" accept="image/*" id="image">
<hr/>


<label for="">Мета заголовок</label>
<input type="text" class="form-control" name="meta_title" placeholder="Мета заголовок"
       value="{{$article->meta_title or ""}}">

<label for="">Мета описание</label>
<input type="text" class="form-control" name="meta_description" placeholder="Мета описание"
       value="{{$article->meta_description or ""}}">

<label for="">Ключевые слова</label>
<input type="text" class="form-control" name="meta_keyword" placeholder="Ключевые слова, через запятую"
       value="{{$article->meta_keyword or ""}}">

<hr/>

<input class="btn btn-primary" type="submit" value="Сохранить">