<label for="">Статус</label>
<select class="form-control" name="published">
    @if (isset($category->id))
        <option value="0" @if (!$category->published) selected="" @endif>Не опубликовано</option>
        <option value="1" @if ($category->published) selected="" @endif>Опубликовано</option>
    @else
        <option value="0">Не опубликовано</option>
        <option value="1">Опубликовано</option>
    @endif
</select>

<label for="">Наименование</label>
<input type="text" class="form-control" name="title" placeholder="Заголовок категории" value="{{$category->title or ""}}" required>

<label for="">Slug</label>
<input class="form-control" type="text" name="slug" placeholder="Автоматическая генерация" value="{{$category->slug or ""}}" readonly="">

<img src="/images/uploads/categories/{{$category->image or ""}}" alt=""><br>
<label for="">Загрузка изображения</label>
<input type="file" name="image" accept="image/*" id="image">

<hr />

<input class="btn btn-primary" type="submit" value="Сохранить">