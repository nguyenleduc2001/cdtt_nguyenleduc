@extends('layouts.admin')

@section('title', 'Sản phẩm')
@section('content')
    <form acction="{{ route('brand.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('post')
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
                </div>
            </section>
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
                <div class="row">
                    <div class="col-5">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Tên menu</label>
                            <input name="name" type="text" class="form-control" id="exampleFormControlInput1">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">link</label>
                            <textarea name="link" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea2" class="form-label">Id Cha</label>
                            <select name="table_id" class="form-control" id="select1" aria-label="Default select example">
                                <option selected value="0">Không Có</option>
                                @foreach ($idmenu as $item2)
                                    <option value="{{ $item2->id }}">
                                        {{ $item2->name }}
                                    </option>
                                @endforeach

                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea2" class="form-label">kiểu</label>
                            <select name="type" class="form-control" id="select1" aria-label="Default select example">
                                <div>
                                    <option selected value="0"></option>
                                    <option value="mainmenu">mainmenu</option>
                                    <option value="MenuSub">MenuSub</option>
                                </div>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea2" class="form-label">Trạng thái</label>
                            <select name="status" class="form-select" id="select1" aria-label="Default select example">
                                <div>
                                    <option selected></option>
                                    <option value="1">Hien</option>
                                    <option value="2">tat</option>
                                </div>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-12 text-right">
                                <button type="submit" class="btn btn-sm btn-success"><i
                                        class="fas fa-save"></i>Lưu</button>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-7">
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
                                @foreach ($idmenu as $row)
                                    <tr>
                                        <td><input type="checkbox" name="checkId[]" value="{{ $row->id }}"></td>
                                        <td>{{ $row->position }}</td>
                                        <td>{{ $row->name }}</td>
                                        <td>{{ $row->link }}</td>
                                        <td>{{ $row->created_at }}</td>
                                        <td>
                                            <a href="{{ route('contact.edit', ['contact' => $row->id]) }}"
                                                class="btn btn-sm btn-info">Sửa</a>
                                            <a href="{{ route('contact.show', ['contact' => $row->id]) }}"
                                                class="btn btn-sm btn-danger ">Chi tiết</a>
                                        </td>
                                        <td>{{ $row->id }}</td>
                                    </tr>
                                @endforeach
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
