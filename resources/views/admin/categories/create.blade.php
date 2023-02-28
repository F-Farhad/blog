@extends('admin.layouts.main')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Добавление категории</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.category.index')}}">Категории</a></li>
              <li class="breadcrumb-item active">Добавление категории</li>
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

          <form action="{{route('admin.category.store')}}" class="w-25" method="post">
            @csrf
            <div class="form-group">
              <input type="text" name="title" class="form-control" placeholder="Название категории">
              <div class="text-danger">
                {{$errors->first('title')}}
              </div>
            </div>
            
            <input type="submit" class="btn btn-primary" value="Добавить">
          </form>
        </div>
        <!-- /.row -->
        
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  @endsection