@extends('layouts.admin')

@section('title', $title ?? 'Trang quản lý')
@section('content')

    <form action="{{ route('slider.update', ['slider' => $row->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>CẬP NHẬT SLIDER</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                                <li class="breadcrumb-item active">Blank Page</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">

                <!-- Default box -->
                <div class="card-header">


                    <div class="row">
                        <div class="col-12 text-right">
                            <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-save"></i>Lưu</button>
                            <a href="{{ route('slider.index') }}" class="btn btn-sm btn-primary"><i class=""></i>Quay
                                về danh sách</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                                <div class="mb-3">
                                    <label for="name">Tên slider</label>
                                    <input type="text" name="name" id="name"
                                        value="{{ old('name', $row->name) }}" class="form-control">
                                    @if ($errors->has('name'))
                                        <div class="text-danger">
                                            {{ $errors->first('name') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="link">Link</label>
                                    <input type="link" name="link" id="link"
                                        value="{{ old('link', $row->link) }}" class="form-control">
                                    @if ($errors->has('link'))
                                        <div class="text-danger">
                                            {{ $errors->first('link') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="position">Position</label>
                                    <input type="position" name="position" id="position"
                                        value="{{ old('position', $row->position) }}" class="form-control">
                                    @if ($errors->has('position'))
                                        <div class="text-danger">
                                            {{ $errors->first('position') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="sort_order">Sắp sếp</label>
                                    <select name="sort_order" id="name" class="form-control">
                                        <option value="0">Cấp cha</option>
                                        {!! $html_sort_order !!}
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="image">Hình đại diện</label>
                                    <input name="image" id="name" type="file" class="form-control">
                                </div>
                                <div class="col-12 text-right">
                            <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-save"></i>Lưu</button>
                            <a href="{{ route('slider.index') }}" class="btn btn-sm btn-primary"><i class=""></i>Quay
                                về danh sách</a>
                        
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
                                            <th class="text-center" style="width:20%">TÊN BANNER</th>
                                            
                                            <th class="text-center" style="width:15%">NGÀY TẠO</th>
                                            <th class="text-center" style="width:15%">NGÀY KẾT THÚC</th>
                                            <th class="text-center" style="width:20%">CHỨC NĂNG</th>
                                            <th class="text-center" style="width:5%">ID</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($list as $row)
                                            <tr>
                                                <td><input type="checkbox" name="checkId[]" value="{{ $row->id }}">
                                                </td>
                                                <td>
                                                    <img src="{{ asset('images/slider/' . $row->image) }}"
                                                        class="img-fluid" alt="{{ $row->image }}">
                                                </td>
                                                <td>{{ $row->name }}</td>
                                                <td>{{ $row->created_at }}</td>
                                                <td>{{ $row->created_at }}</td>
                                                <td>
                                                    @if ($row->status == 2)
                                                        <a href="{{ route('slider.status', ['slider' => $row->id]) }}"
                                                            class="btn btn-sm btn-success">
                                                            <i class="fas fa-toggle-on"></i></a>
                                                    @else
                                                        <a href="{{ route('slider.status', ['slider' => $row->id]) }}"
                                                            class="btn btn-sm btn-danger">
                                                            <i class="fas fa-toggle-off"></i></a>
                                                    @endif
                                                    <a href="{{ route('slider.edit', ['slider' => $row->id]) }}"
                                                        class="btn btn-sm btn-info">
                                                        <i class="fas fa-wrench"></i></a>
                                                    <a href="{{ route('slider.show', ['slider' => $row->id]) }}"
                                                        class="btn btn-sm btn-primary "><i class="far fa-eye"></i></a>

                                                    <a href="{{ route('slider.delete', ['slider' => $row->id]) }}"
                                                        class="btn btn-sm btn-danger "><i class="fas fa-trash"></i></a>
                                                </td>
                                                <td>{{ $row->id }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
            <!-- /.card-body -->
            <div class="card-header">
                <div class="row">
                    <div class="col-12 text-right">
                        <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-save"></i>Lưu</button>



                        <a href="{{ route('slider.index') }}" class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i>Xóa</a>
                        <a class="btn btn-sm btn-info" href="{{ route('slider.index') }}">
                            <i class="fas fa-arrow-circle-left"></i> QUAY VỀ DANH SÁCH
                        </a>
                    </div>
                </div>
            </div>

            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

        </section>
        <!-- /.content -->
        </div>
    </form>
@endsection
