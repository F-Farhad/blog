@extends('admin.layouts.main')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Редактирование поста</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.post.index')}}">Home</a></li>
              <li class="breadcrumb-item active">Редактирование поста</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">

          <form action="{{route('admin.post.update', $post->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="form-group w-25">
              <input type="text" name="title" class="form-control" placeholder="Название поста" value="{{$post->title}}">
              <div class="text-danger">
                {{$errors->first('title')}}
              </div>
            </div>
            <div class="form-group">
              <textarea id="summernote" name="content" >{{$post->content}}</textarea>
              <div class="text-danger">
                {{$errors->first('content')}}
              </div>
            </div>

            <div class="form-group">
              <label>Добавить превью</label>
              <div class="w-25 mb-2">
                <img src="{{asset('storage/' . $post->preview_image)}}" alt="preview_image" class="w-50">
              </div>
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" name="preview_image">
                  <label class="custom-file-label" >Выберите изображение</label>
                </div>
                <div class="input-group-append">
                  <span class="input-group-text">Загрузить</span>
                </div>
              </div>
              <div class="text-danger">
                  {{$errors->first('preview_image')}}
              </div>
            </div>

            <div class="form-group">
              <label>Добавить изображение</label>
              <div class="w-25 mb-2">
                <img src="{{url('storage/' . $post->main_image)}}" alt="main_image" class="w-50">
              </div>
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" name="main_image">
                  <label class="custom-file-label" >Выберите изображение</label>
                </div>
                <div class="input-group-append">
                  <span class="input-group-text">Загрузить</span>
                </div>
              </div>
              <div class="text-danger">
                  {{$errors->first('main_image')}}
              </div>
            </div>

            <div class="form-group ">
              <label>Выберите категорию</label>
              <select class="form-control" name="category_id">
                @foreach($categories as $category)
                  <option {{$category->id == $post->category_id ? 'selected':''}}
                    value="{{$category->id}}">{{$category->title}}
                </option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
                  <label>Теги</label>
                  <select class="select2" name="tag_ids[]" multiple="multiple" data-placeholder="Выберите теги" style="width: 100%;">
                  @foreach($tags as $tag)
                    <option 
                    {{ is_array($post->tags->pluck('id')->toArray()) && in_array($tag->id, $post->tags->pluck('id')->toArray())? 'selected':''}}
                    value="{{$tag->id}}">{{$tag->title}}</option>
                  @endforeach
                  </select>
            </div>

            <div class="form-group">
              <input type="submit" class="btn btn-primary" value="Обновить">
            </div>
          </form>
        </div>
        <!-- /.row -->
        
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  @endsection