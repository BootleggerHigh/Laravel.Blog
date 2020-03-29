<div class="form-group">
    <label for="exampleFormControlInput1">Заголовок для поста</label>
    <input type="text" class="form-control" id="exampleFormControlInput1" name="title"
           placeholder="Введите заголовок поста" value="{{$post->title ?? ''}}">
</div>

<div class="form-group">
    <label for="exampleFormControlTextarea1">Основной текст поста</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Введите текст поста"
              name="description" rows="3">{{$post->descr ?? ''}}</textarea>
</div>
<div class="form-group">
    <label for="inputGroupFile01">Загрузить картинку для поста</label>
    <div class="input-group mb-2">
        <div class="input-group-prepend">
            <span class="input-group-text">Загрузить файл</span>
        </div>
        <div class="custom-file">
            <input type="file" class="custom-file-input" name="img" id="inputGroupFile01">
            <label class="custom-file-label" for="inputGroupFile01">Выбрать файл</label>
        </div>
    </div>
</div>
