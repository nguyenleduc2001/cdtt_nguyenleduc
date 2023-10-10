<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Page;
use Illuminate\Support\Str;
use App\Http\Requests\StorePageRequest;
use App\Http\Requests\UpdatePageRequest;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title ='Danh sách trang đơn';                                                                                                         
        $list = Page::where('status','<>','0')->get();                                                         
        return view('backend.page.index',compact( 'list','title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $title = 'Tạo';
        $list = Page::where('status', '<>', '0')->orderBy('created_at', 'desc')->get();
        return view("backend.page.create", compact( 'title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePageRequest $request)
    {
        $Page = new Page();
        $Page ->title = $request->title;
        $Page->content = $request->content;
        $Page->created_at=date('Y-m-d H:i:s');
        $Page->created_by= 1;
        $Page->updated_by= 1;
        $Page->updated_at= date('Y-m-d H:i:s');
        $Page->status=2;
        $file = $request->file('image');
        if($file!= NULL)
        {
            var_dump('file');
             $extention = $file ->getClientOriginalExtension();
             if(in_array($extention, ['png', 'jpg']))
             {
                $fileName = $Page ->slug. '.'.$extention;
                $file->move(public_path('images/page'),$fileName);
                $Page->image = $fileName;
              
             }
        }
        $Page->save();    
        return redirect()->route('page.index')->with('message',['type' => 'success', 'mgs' => 'Thêm thành công']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        {
            $row = Page::find($id);                                                                                           //$row1=Category::where([['id','=',$id],['status','!=',0]])..
            if($row == NULL)
            {
                return redirect()->route('page.index')->with('message',['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
            }
            $title = "Chi tiết mãu tin";
            return view('backend.page.show',compact('row','title'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $row = Page::find($id);                                                                                           //$row1=brand::where([['id','=',$id],['status','!=',0]])..
        if($row == NULL)
        {
            return redirect()->route('page.index')->with('message',['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
        }
        $list = Page ::where('status','<>','0')->orderBy('created_at','desc')->get();  


        $title = "Cập nhập mẫu tin";
        return view('backend.page.edit',compact('row','title','list'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePageRequest $request, string $id)
    {
        $row = Page::find($id);                                                                                           //$row1=brand::where([['id','=',$id],['status','!=',0]])..
        if($row == NULL)
        {
            return redirect()->route('page.index')->with('message',['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
        }

        $row ->title = $request->title;
        $row->content = $request->content;
        $row->metakey = $request->metakey;
        $row->metadesc=$request->metadesc;
        $row->created_at=date('Y-m-d H:i:s');
        $row->created_by= 1;
        $row->updated_by= 1;
        $row->updated_at= date('Y-m-d H:i:s');
        $row->status=2;
        
        $file = $request->file('image');
        if($file!= NULL)
        {
            var_dump('file');
             $extention = $file ->getClientOriginalExtension();
             if(in_array($extention, ['png', 'jpg']))
             {
                $fileName = $row ->slug. '.'.$extention;
                $file->move(public_path('images/page'),$fileName);
                $row->image = $fileName;
                //$brand ->image = $request->image;
             }
        }
        $row->save();
        return redirect()->route('page.index')->with('message',['type' => 'success', 'mgs' => 'Cập nhập thành công']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $row = Page::find($id);
        if($row == NULL)
        {
            return redirect()->route('page.index')->with('message',['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
        }
        $row->delete();
            return redirect()->route('page.index')->with('message', ['type' => 'success', 'mgs' => 'Xóa sản phẩm thành công']);

    }
    public function delete($id)
    {
        $row = Page::find($id);
        if ($row == NULL) {
            return redirect()->route('page.index')->with('message', ['type' => 'danger', 'mgs' => 'Xóa không thành công']);
        } else {
            $row->status = 0;
            $row->updated_at = date('Y-m-d H:i:s');
            $row->updated_by = 1;
            $row->save();

            return redirect()->route('page.index')->with('message', ['type' => 'success', 'mgs' => 'Xóa thành công']);
        }
    }
    public function trash()
    {                                                                                                        
        $list = Page::where('status','=','0')->orderBy('created_at','asc')->get();                                                                                   #orwhere la them 1 dieu kien nua {get lay nhieu mau tin} ['tenbien' => $list,'tieude' => $title]  ,compact($list)
        return view('backend.page.trash',compact('list'));
    }
}