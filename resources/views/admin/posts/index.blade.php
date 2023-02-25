@extends('admin.layouts.main')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Посты</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Admin</a></li>
              <li class="breadcrumb-item active">Посты</li>
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
            <div class="col-1 mb-3">
              <a href="{{route('admin.post.create')}}" class="btn btn-block btn-primary">Создать</a>
            </div>
        </div>
      <div class="row">
            <div class="col-6">
              <div class="card">
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Названия</th>
                      <th colspan="3" class="text-center">Действия</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($posts as $post)
                    <tr>
                      <td>{{$post->id}}</td>
                      <td>{{$post->title}}</td>
                      <td class="text-center"><a href="{{route('admin.post.show', $post->id)}}"><i class="fas fa-eye"></i></i></a></td>
                      <td class="text-center"><a href="{{route('admin.post.edit', $post->id)}}" class="text-success"><i class="fas fa-pen"></i></a></td>
                      <td class="text-center">
                        <form action="{{route('admin.post.destroy', $post->id)}}" method="post">
                          @csrf
                          @method('delete')
                          <button type="submit" class="border-0 bg-transparent">
                            <i class="fas fa-trash text-danger" role="button"></i>
                          </button>
                        </form>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              </div>
            </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  @endsection