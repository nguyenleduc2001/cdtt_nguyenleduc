<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use Illuminate\Support\Str;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {                       
        $title ='Danh sách thành viên';                                                                                                             #$title...
        $list = User::where('status','<>','0')->get();                                                                                       #orwhere la them 1 dieu kien nua {get lay nhieu mau tin} ['tenbien' => $list,'tieude' => $title]  ,compact($list)
        return view('backend.user.index',compact('list','title'));
    }
    public function create()
    {
        $title = 'Tạo';
        $list = User::where('status','<>','0')->orderBy('created_at','desc')->get();  
        return view("backend.user.create", compact('title'));
    }
    public function store(StoreUserRequest $request)
    {
        $row=new User();
        $row->name=$request->name;
        $row->username= $request->username;
        $row->password=$request->password;
        $row->email=$request->email;
        $row->gender=$request->gender;
        $row->phone=$request->phone;
        $row->roles=$request->roles;
        $row->address=$request->address;
        $row->created_at=date('Y-m-n H:i:s');
        $row->created_by=1;
        $row->updated_at=date('Y-m-n H:i:s');
        $row->updated_by=1;
        $row->status=2;
        $file = $request->file('image');
        if ($file != NULL) {
            $extension = $file->getClientOriginalExtension();
            if (in_array($extension, ['png', 'jpg', 'webp', 'gif'])) {
                $fileName = $row->slug . '.' . $extension;
                $file->move(public_path('images/user'), $fileName);
                $row->image = $fileName;
            }
        }
        $row->save();
        return redirect()->route('user.index')->with('message',['type'=>'success','mgs'=>'Thêm thành công']);
    }

    public function show($id)
    {
        {
            $row = User::find($id);  
            if($row == NULL)
            {
                return redirect()->route('post.index')->with('message',['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
            }
            $title = "Chi tiết thành viên";
            return view('backend.user.show',compact('row','title'));
        }
    }
    public function edit($id)
    {
        $row = user::find($id);                                                                                           //$row1=brand::where([['id','=',$id],['status','!=',0]])..
        if($row == NULL)
        {
            return redirect()->route('user.index')->with('message',['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
        }
        $list = user ::where('status','<>','0')->orderBy('created_at','desc')->get();  
        $title = "Cập nhập mẫu tin";
        return view('backend.user.edit',compact('row','title'));
    }
public function update(UpdateUserRequest $request,$id)
    {
        $row = user::find($id);                                                                                           //$row1=topic::where([['id','=',$id],['status','!=',0]])..
        if($row == NULL)
        {
            return redirect()->route('user.index')->with('message',['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
        }
        $row->name=$request->name;
        $row->username= $request->username;
        $row->password=$request->password;
        $row->email=$request->email;
        $row->gender=$request->gender;
        $row->phone=$request->phone;
        $file=$request->file('image');
        if($file!=NULL)
        {
            $extension=$file->getClientOriginalExtension();
            if(in_array($extension,['png','jpg','webp','gif']))
            {
                $fileName=$row->slug.'.'.$extension;
                $file->move(public_path('images/user'),$fileName);
                $row->image=$fileName;
            }
        }
        $row->roles=$request->roles;
        $row->address=$request->address;
        $row->created_at=date('Y-m-n H:i:s');
        $row->created_by=1;
        $row->updated_at=date('Y-m-n H:i:s');
        $row->updated_by=1;
        $row->status=1;


        $row->save();
        return redirect()->route('user.index')->with('message',['type' => 'success', 'mgs' => 'Cập nhập thành công']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $row = User::find($id);
        if($row == NULL)
        {
            return redirect()->route('user.index')->with('message',['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
        }
        $row->delete();
            return redirect()->route('user.index')->with('message', ['type' => 'success', 'mgs' => 'Xóa sản phẩm thành công']);

    }
    public function trash()
    {                                                                                                        
        $list = User::where('status','=','0')->orderBy('created_at','asc')->get();                                                                                   #orwhere la them 1 dieu kien nua {get lay nhieu mau tin} ['tenbien' => $list,'tieude' => $title]  ,compact($list)
        return view('backend.user.trash',compact('list'));
    }
}