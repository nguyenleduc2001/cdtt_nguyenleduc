@extends('layouts.admin')

@section('title', 'Sản phẩm')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>TẤT CẢ MENU</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Blank Page</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          
          <h3 class="card-title">Title</h3>
          <div class="row">
            <div class="col-12 text-right">
              <a href="{{ route('menu.create') }}" class="btn btn-sm btn-success">Thêm</a>
            </div>
          </div>
        </div>
        </div>
        <div class="card-body">
          <table class="table table-bordered table-striped ">
            <tr class="bg-primary">
              <th class="text-center" style="width:20px;">#</th>
              <th class="text-center">VỊ TRÍ</th>
              <th class="text-center"style="width:100px;">TÊN MENU</th>
              <th class="text-center">LIÊN KẾT</th>
              <th class="text-center" style="width:160px;">NGÀY TẠO</th>
              <th class="text-center" style="width:200px;">CHỨC NĂNG</th>
              <th class="text-center" style="width:20px;">ID</th>
            </tr>
          @foreach ($list as $row)
              <tr >
                <td><input type="checkbox" name="checkId[]" value="{{ $row->id }}"></td>
                <td>{{ $row->position }}</td>
                <td>{{ $row->name }}</td>
                <td>{{ $row->link }}</td>
                <td>{{ $row->created_at }}</td>
                  <td>
                    <a href="{{ route('contact.edit',['contact' => $row ->id]) }}" class="btn btn-sm btn-info">Sửa</a>
                    <a href="{{ route('contact.show',['contact' => $row ->id]) }}" class="btn btn-sm btn-danger ">Chi tiết</a>
                  </td>
                <td>{{ $row->id }}</td>
              </tr>
          @endforeach
        </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          Footer
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
@endsection