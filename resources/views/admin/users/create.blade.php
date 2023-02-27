@extends('admin.layouts.main')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Добавление пользователей</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.user.index')}}">Home</a></li>
              <li class="breadcrumb-item active">Добавление пользователя</li>
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

          <form action="{{route('admin.user.store')}}" class="w-25" method="post">
            @csrf
            <div class="form-group">
              <input type="text" name="name" class="form-control" placeholder="Имя пользователя">
              <div class="text-danger">
                {{$errors->first('title')}}
              </div>
            </div>

            <div class="form-group">
              <input type="text" name="email" class="form-control" placeholder="Email">
              @error('email')
                <div class="text-danger">{{$message}}</div>
              @enderror
            </div>

            <div class="form-group">
              <input type="text" name="password" class="form-control" placeholder="Пароль">
              @error('password')
                <div class="text-danger">{{$message}}</div>
              @enderror
            </div>

            <div class="form-group ">
              <label>Выберите роль</label>
              <select class="form-control" name="role">
                @foreach($roles as $id => $role)
                  <option value="{{$id}}"
                    {{$id == old('$role')? 'selected':''}}
                    >{{$role}}
                </option>
                @endforeach
              </select>
              @error('role')
                <div class="text-danger">{{$message}}</div>
              @enderror
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