@extends('layouts.admin')

@section('title', 'TRANG ĐƠN')
@section('content')
    <form acction="{{ route('page.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('post')
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>TẤT CẢ TRANG ĐƠN</h1>
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

                        <div class="row">
                            <div class="col-6">
                                <button class="submit btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                            </div>
                            <div class="col text-right">
                                <a href="{{ route('page.trash') }}" class="btn btn-sm btn-danger"><i
                                        class="fas fa-trash"></i>Thùng Rác</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-5">
                        <div class="row">
                            <div class="col-11">
                                <div class="mb-3">
                                    <label for="title">Tiêu đề trang đơn</label>
                                    <input type="text" name="title" id="title" value="{{ old('title') }}"
                                        class="form-control">
                                    @if ($errors->has('name'))
                                        <div class="text-danger">
                                            {{ $errors->first('name') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="content">Nội dung trang đơn</label>
                                    <input type="text" name="content" id="content" value="{{ old('content') }}"
                                        class="form-control">
                                    @if ($errors->has('content'))
                                        <div class="text-danger">
                                            {{ $errors->first('content') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label for="image">Hình đại diện</label>
                                    <input name="image" id="name" type="file" class="form-control">
                                </div>
                                <div class="col-12 text-right">
                                    <button type="submit" class="btn btn-sm btn-success"><i
                                            class="fas fa-save"></i>Lưu</button>
                                    <a href="{{ route('page.index') }}" class="btn btn-sm btn-primary"><i
                                            class=""></i>Quay về
                                        danh sách</a>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="col-7">
                        <div class="card-body">
                            @includeIf('backend.message')
                            <table class="table table-bordered table-striped" id="dataTable">
                                <thead>
                                    <tr class="bg-primary">
                                        <th class="text-center" style="width: 5%">
                                            <div class="form-group select-all">
                                                <input type="checkbox">
                                            </div>
                                        </th>
                                        <th class="text-center" style="width:10%">HÌNH</th>
                                        <th class="text-center" style="width:20%">TIÊU ĐỀ TRANG ĐƠN</th>
                                        <th class="text-center" style="width:15%">NGÀY TẠO</th>
                                        <th class="text-center" style="width:20%">CHỨC NĂNG</th>
                                        <th class="text-center" style="width:5%">ID</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($list as $row)
                                        <tr>
                                            <td><input type="checkbox" name="checkId[]" value="{{ $row->id }}"></td>
                                            <td>
                                                <img src="{{ asset('images/page/' . $row->image) }}" class="img-fluid"
                                                    alt="{{ $row->image }}">
                                            </td>
                                            <td>{{ $row->title }}</td>


                                            <td>{{ $row->created_at }}</td>
                                            <td>
                                                @if ($row->status == 2)
                                                    <a
                                                        href="{{ route('topic.status', ['topic' => $row->id]) }}"class="btn btn-sm btn-success">
                                                        <i class="fas fa-toggle-on"></i></a>
                                                @else
                                                    <a
                                                        href="{{ route('topic.status', ['topic' => $row->id]) }}"class="btn btn-sm btn-danger">
                                                        <i class="fas fa-toggle-off"></i></a>
                                                @endif
                                                <a href="{{ route('page.edit', ['page' => $row->id]) }}"
                                                    class="btn btn-sm btn-info"> <i class="fas fa-wrench"></i></a>
                                                <a href="{{ route('page.show', ['page' => $row->id]) }}"
                                                    class="btn btn-sm bg-primary "><i class="far fa-eye"></i></a>
                                                <a href="{{ route('page.delete', ['page' => $row->id]) }}"
                                                    class="btn btn-sm btn-danger "><i class="fas fa-trash"></i></a>
                                            </td>
                                            <td>{{ $row->id }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
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
    </form>
@endsection
