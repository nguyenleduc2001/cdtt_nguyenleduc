<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Str;

use App\Http\Requests\StoreTopicRequest;
use App\Http\Requests\UpdateTopicRequest;

use App\Models\Topic;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Danh sách sản phẩm';                                                                                                             #$title...
        $list = Topic::where('status', '!=', '0')->get();
        $html_parent_id = '';
        $html_sort_order = '';
        foreach ($list as $item) {
            $html_parent_id .= "<option value =''" . $item->id . "'>" . $item->name . "</option>";
            $html_sort_order .= "<option value ='' " . ($item->sort_order + 1) . "'>" . $item->name . "</option>";
        }                                                                                      #orwhere la them 1 dieu kien nua {get lay nhieu mau tin} ['tenbien' => $list,'tieude' => $title]  ,compact($list)
        return view('backend.topic.index', compact('html_parent_id', 'html_sort_order', 'list', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tạo';
        $list = Topic::where('status', '<>', '0')->orderBy('created_at', 'desc')->get();
        $html_parent_id = '';
        $html_sort_order = '';
        foreach ($list as $item) {
            $html_parent_id .= "<option value =''" . $item->id . "'>" . $item->name . "</option>";
            $html_sort_order .= "<option value ='' " . ($item->sort_order + 1) . "'>" . $item->name . "</option>";
        }
        return view("backend.topic.create", compact('html_parent_id', 'html_sort_order', 'title'));
    }

    public function store(StoreTopicRequest $request)
    {
        $row = new Topic();
        $row->name = $request->name;
        $row->slug = Str::of($request->name)->slug('-');;
        $row->parent_id = $request->parent_id;
        $row->sort_order = 1;
        $row->metakey = $request->metakey;
        $row->metadesc = $request->metadesc;
        $row->created_at = date('Y-m-d H:i:s');
        $row->created_by = 1;
        $row->status = 2;

        $file = $request->file('image');
        if ($file != NULL) {
            var_dump('file');
            $extention = $file->getClientOriginalExtension();
            if (in_array($extention, ['png', 'jpg'])) {
                $fileName = $row->slug . '.' . $extention;
                $file->move(public_path('images/topic'), $fileName);
                $row->image = $fileName;
            }
        }


        $row->save();
        return redirect()->route('topic.index')->with('message', ['type' => 'success', 'mgs' => 'Thêm thành công']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    { {
            $row = Topic::find($id);                                                                                           //$row1=topic::where([['id','=',$id],['status','!=',0]])..
            if ($row == NULL) {
                return redirect()->route('topic.index')->with('message', ['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
            }
            $title = "Chi tiết mãu tin";
            return view('backend.topic.show', compact('row', 'title'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $row = topic::find($id);                                                                                           //$row1=topic::where([['id','=',$id],['status','!=',0]])..
        if ($row == NULL) {
            return redirect()->route('topic.index')->with('message', ['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
        }
        $list = topic::where('status', '<>', '0')->orderBy('created_at', 'desc')->get();
        $html_parent_id = '';
        $html_sort_order = '';
        foreach ($list as $item) {
            if ($item->id == $row->parent_id) {
                $html_parent_id .= "<option selected value ='" . $item->id . "'>" . $item->name . "</option>";
            } else {
                $html_parent_id .= "<option value ='" . $item->id . "'>" . $item->name . "</option>";
            }
            if ($item->sort_order == $row->sort_order) {
                $html_sort_order .= "<option selected value =' " . ($item->sort_order + 1) . "'>" . $item->name . "</option>";
            } else {
                $html_sort_order .= "<option value =' " . ($item->sort_order + 1) . "'>" . $item->name . "</option>";
            }
        }
        $title = "Cập nhập mẫu tin";
        return view('backend.topic.edit', compact('list','row', 'title', 'html_sort_order', 'html_parent_id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTopicRequest $request, $id)
    {
        $row = topic::find($id);                                                                                           //$row1=topic::where([['id','=',$id],['status','!=',0]])..
        if ($row == NULL) {
            return redirect()->route('topic.index')->with('message', ['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
        }
        $row->name = $request->name;
        $row->slug = Str::of($request->name)->slug('-');;
        $row->parent_id = $request->parent_id;
        $row->sort_order = $request->sort_order;
        $row->metakey = $request->metakey;
        $row->metadesc = $request->metadesc;
        $row->updated_at = date('Y-m-d H:i:s');
        $row->updated_by = 1;
        $row->status = 2;

        $file = $request->file('image');
        if ($file != NULL) {
            var_dump('file');
            $extention = $file->getClientOriginalExtension();
            if (in_array($extention, ['png', 'jpg'])) {
                $fileName = $row->slug . '.' . $extention;
                $file->move(public_path('images/topic'), $fileName);
                $row->image = $fileName;
                //$topic ->image = $request->image;
            }
        }


        $row->save();
        return redirect()->route('topic.index')->with('message', ['type' => 'success', 'mgs' => 'Cập nhập thành công']);
    }
    public function status($id)
    {
        $row = Topic::find($id);
        if ($row == NULL) {
            return redirect()->route('topic.index')->with('message', ['type' => 'danger', 'mgs' => 'Thay đổi trạng thái không thành công']);
        }
        $row->status = ($row->status == 1) ? 2 : 1;
        $row->updated_at = date('Y-m-d H:i:s');
        $row->updated_by = 1;
        $row->save();
        return redirect()->route('topic.index')->with('message', ['type' => 'success', 'mgs' => 'Thay đổi trạng thái thành công']);
    }
    public function delete($id)
    {
        $row = Topic::find($id);
        if ($row == NULL) {
            return redirect()->route('topic.index')->with('message', ['type' => 'danger', 'mgs' => 'Xóa không thành công']);
        } else {
            $row->status = 0;
            $row->updated_at = date('Y-m-d H:i:s');
            $row->updated_by = 1;
            $row->save();

            return redirect()->route('topic.index')->with('message', ['type' => 'success', 'mgs' => 'Xóa thành công']);
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $row = topic::find($id);
        if ($row == NULL) {
            return redirect()->route('topic.index')->with('message', ['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
        }
        $row->delete();
        return redirect()->route('topic.index')->with('message', ['type' => 'success', 'mgs' => 'Xóa sản phẩm thành công']);
    }
    public function trash()
    {
        $list = topic::where('status', '=', '0')->orderBy('created_at', 'asc')->get();                                                                                   #orwhere la them 1 dieu kien nua {get lay nhieu mau tin} ['tenbien' => $list,'tieude' => $title]  ,compact($list)
        return view('backend.topic.trash', compact('list'));
    }
}