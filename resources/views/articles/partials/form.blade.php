<label for="">Статус</label>
<select class="form-control" name="published">
    @if (isset($article->id))
        <option value="0" @if (!$article->published) selected="" @endif>Не опубликовано</option>
        <option value="1" @if ($article->published) selected="" @endif>Опубликовано</option>
    @else
        <option value="1">Опубликовано</option>
    @endif
</select>

<label for="">Заголовок</label>
<input type="text" class="form-control" name="title" placeholder="Заголовок новости" value="{{$article->title or ""}}" required>

<input type="hidden" name="slug" value="{{$article->slug or ""}}">

<input type="hidden" name="category_id" value="{{$article->category_id or ""}}">

<label for="">Выберите категорию</label>
<select class="form-control" name="category_id" required>
        @foreach($categories as $category)
                <option value="{{$category->id}}" >{{$category->title}}</option>
        @endforeach
</select>
<br>
<label for="">Краткое описание</label>
<textarea class="form-control" id="description_short" name="description_short" required>{{$article->description_short or ""}}</textarea>

<label for="">Полное описание</label>
<textarea class="form-control" id="description" name="description" required>{{$article->description or ""}}</textarea>

<label for="">Загрузка изображения</label>
<input type="file" name="image" id="" accept="image/*">
<hr />

<input type="hidden" class="form-control" name="meta_title" placeholder="Мета заголовок" value="{{$article->meta_title or "Мета заголовок"}}">
<input type="hidden" class="form-control" name="meta_description" placeholder="Мета описание" value="{{$article->meta_description or "Мета описание"}}">
<input type="hidden" class="form-control" name="meta_keyword" placeholder="Ключевые слова, через запятую" value="{{$article->meta_keyword or "Ключевые слова, через запятую"}}">

<hr />

<input class="btn btn-primary" type="submit" value="Сохранить">
