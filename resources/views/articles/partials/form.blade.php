<label for="">Статус</label>
<select class="form-control" name="published">
    @if (isset($article->id))
        <option value="0" @if ($article->published == 0) selected="" @endif>Не опубликовано</option>
        <option value="1" @if ($article->published == 1) selected="" @endif>Опубликовано</option>
    @else
        <option value="1">Опубликовано</option>
    @endif
</select>

<label for="">Заголовок</label>
<input type="text" class="form-control" name="title" placeholder="Заголовок новости" value="{{$article->title or ""}}" required>

<input  type="hidden" name="slug" placeholder="Автоматическая генерация" value="{{$article->slug or ""}}" readonly="">

<label for="">Родительская категория</label>
<select class="form-control" name="categories[]" multiple="" required>
    @include('articles.partials.categories', ['categories' => $categories])
</select>

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
