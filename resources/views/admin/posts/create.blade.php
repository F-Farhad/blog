@extends('admin.layouts.main')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Добавление поста</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.post.index')}}">Home</a></li>
              <li class="breadcrumb-item active">Добавление поста</li>
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

          <form action="{{route('admin.post.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group w-25">
              <input type="text" name="title" class="form-control" placeholder="Название поста" value="{{old('title')}}">
              <div class="text-danger">
                {{$errors->first('title')}}
              </div>
            </div>
            <div class="form-group">
              <textarea id="summernote" name="content" >{{old('content')}}</textarea>
              <div class="text-danger">
                {{$errors->first('content')}}
              </div>
            </div>

            <div class="form-group">
              <label>Добавить превью</label>
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
                  <option 
                    {{$category->id == old('category_id')?' selected':''}}
                  value="{{$category->id}}">{{$category->title}}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <input type="submit" class="btn btn-primary" value="Добавить">
            </div>
          </form>
        </div>
      <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  @endsection