@extends('personal.layouts.main')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Комметарии</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('personal.main.index')}}">Главная</a></li>
              <li class="breadcrumb-item active">Комментарии</li>
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

        <form action="{{route('personal.comment.update', $comment->id)}}" class="w-25" method="post">
            @csrf
            @method('patch')
            <div class="form-group">
              <textarea name="message" cols="30" rows="5" placeholder="Комментарий">{{$comment->message}}</textarea>
              <div class="text-danger">
                {{$errors->first('message')}}
              </div>
            </div>
            
            <input type="submit" class="btn btn-primary" value="Обовить">
          </form>
        <!-- /.row -->
        
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  @endsection