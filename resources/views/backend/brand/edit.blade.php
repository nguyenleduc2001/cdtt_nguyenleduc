@extends('layouts.admin')

@section('title', $title ?? 'Trang quản lý')
@section('content')

    <form action="{{ route('brand.update', ['brand' => $row->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>CẬP NHẬT THƯƠNG HIỆU</h1>
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
                   
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="mb-3">
                                <label for="name">Tên danh mục</label>
                                <input type="text" name="name" id="name" value="{{ old('name', $row->name) }}"
                                    class="form-control">

                                @if ($errors->has('name'))
                                    <div class="text-danger">
                                        {{ $errors->first('name') }}
                                    </div>
                                @endif

                            </div>
                            <div class="mb-3">
                                <label for="metakey">Từ khóa</label>
                                <textarea name="metakey" id="metakey" class="form-control">{{ old('metakey', $row->metakey) }}</textarea>
                                @if ($errors->has('metakey'))
                                    <div class="text-danger">
                                        {{ $errors->first('metakey') }}
                                    </div>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="metadesc">Mô tả</label>
                                <textarea name="metadesc" id="metadesc" class="form-control">{{ old('metadesc', $row->metadesc) }}</textarea>
                                @if ($errors->has('metadesc'))
                                    <div class="text-danger">
                                        {{ $errors->first('metadesc') }}
                                    </div>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="sort_order">Sắp xếp</label>
                                <select name="sort_order" id="sort_order" class="form-control">
                                    <option value="0">Cấp cha</option>
                                    {!! $html_sort_order !!}
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="image">Hình đại diện</label>
                                <input name="image" id="image" type="file" class="form-control btn-sm">
                            </div>
                             <div class="row">
                        <div class="col-12 text-right">
                            <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-save"></i>Lưu</button>
                            <a href="{{ route('brand.index') }}" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i>Xóa</a>
                            <a class="btn btn-sm btn-info" href="{{ route('brand.index') }}">
                                <i class="fas fa-arrow-circle-left"></i> QUAY VỀ DANH SÁCH
                            </a>
                        </div>
                    </div>
                        </div>
                         <div class="col-7">
                        <div class="card-body">
                            @includeIf('backend.message')
                            <table class="table table-bordered table-striped " id="dataTable">
                                <thead>
                                    <tr class="bg-primary">
                                        <th class="text-center" style="width:20px;"><input type="checkbox"
                                                name="checkId[]  "></th>
                                        <th>TÊN THƯƠNG HIỆU</th>
                                        <th style="width:100px">HÌNH ĐẠI DIỆN</th>
                                        <th>NGÀY TẠO</th>
                                        <th>CHỨC NĂNG</th>
                                        <th>ID</th>
                                        <th style="width: 20px"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($list as $row)
                                        <tr>
                                            <td><input type="checkbox" name="checkId[]" value="{{ $row->id }}"></td>
                                            <td>{{ $row->name }}</td>
                                            <td><img src="{{ asset('images/brand/' . $row->image) }}" class="img-fluid"
                                                    alt="{{ $row->image }}"></td>
                                            <td>{{ $row->created_at }}</td>
                                            <td>
                                                @if ($row->status == 2)
                                                    <a href="{{ route('brand.status', ['brand' => $row->id]) }}"
                                                        class="btn btn-sm btn-success">
                                                        <i class="fas fa-toggle-on"></i></a>
                                                @else
                                                    <a href="{{ route('brand.status', ['brand' => $row->id]) }}"
                                                        class="btn btn-sm btn-danger">
                                                        <i class="fas fa-toggle-off"></i></a>
                                                @endif
                                                <a href="{{ route('brand.edit', ['brand' => $row->id]) }}"
                                                    class="btn btn-sm btn-info">
                                                    <i class="fas fa-wrench"></i></a>
                                                <a href="{{ route('brand.show', ['brand' => $row->id]) }}"
                                                    class="btn btn-sm btn-primary "><i class="far fa-eye"></i></a>

                                                <a href="{{ route('brand.delete', ['brand' => $row->id]) }}"
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


                </div>
        </div>
        <!-- /.card-body -->
        <div class="card-header">
            <div class="row">
                <div class="col-12 text-right">
                    <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-save"></i>Lưu</button>



                    <a href="{{ route('brand.index') }}" class="btn btn-sm btn-danger">
                        <i class="fas fa-trash"></i>Xóa</a>
                    <a class="btn btn-sm btn-info" href="{{ route('brand.index') }}">
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
