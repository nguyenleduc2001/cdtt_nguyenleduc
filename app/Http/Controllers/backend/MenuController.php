<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Links;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $idmenu = Menu::where("status", '!=', 0)->get();
        return view("backend.menu.index", compact("idmenu"));
    }
    public function create()
    {
        $idmenu = Menu::where("status", "!=", 0)->get();
        return view("backend.menu.create", compact("idmenu"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $menu = new Menu();
        $menu->name = $request->name;
        $menu->table_id = $request->table_id;
        $menu->link = $request->link;
        $menu->type = $request->type;
        $menu->created_at = date('Y-m-d H:i:s');
        $menu->updated_at = date('Y-m-d H:i:s');
        $menu->status = $request->status;
        $menu->save();
        return redirect()->route('menu.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $menu = Menu::find($id);
        return view("backend.menu.show", compact("menu"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $idmenu = Menu::where("status", "!=", 0)->get();
        $menu = Menu::find($id);
        if ($menu == null) {
            return redirect()->route('menu.index')->with("message", ['type' => 'danger', 'msf' => 'không tồn tại mẫu tin này']);
        }
        $list = Menu::all();
        return view("backend.menu.edit", compact("menu", "idmenu"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $menu = Menu::find($id);
        $menu->name = $request->name;
        $menu->table_id = $request->table_id;
        $menu->link = $request->link;
        $menu->type = $request->type;
        $menu->created_at = date('Y-m-d H:i:s');
        $menu->updated_at = date('Y-m-d H:i:s');
        $menu->status = $request->status;
        //up load file
        if ($menu->save()) {

            return redirect()->route('menu.index')->with('message', ['type' => 'success', 'mgs' => 'Cập nhật mẫu tin thành công!']);
        }
        return redirect()->route('menu.trash')->with('message', ['type' => 'success', 'mgs' => 'Cập nhật không thành công thành công']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroys(string $id)
    {
        $menu = Menu::find($id);
        if ($menu == NULL) {
            return redirect()->route('menu.trash')->with('message', ['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
        }
        if ($menu->delete()) {

            return redirect()->route('menu.trash')->with('message', ['type' => 'success', 'mgs' => 'Xóa khỏi CSDL thành công']);
        }
        return redirect()->route('menu.trash')->with('message', ['type' => 'danger', 'mgs' => 'Xóa khỏi CSDL không thành công']);
    }
    public function trash()
    {
        $list = Menu::where('status', '=', '0')->orderBy('created_at', 'desc')->get();
        return view('backend.menu.trash', compact('list'));
    }
    public function delete($id)
    {

        $menu = Menu::find($id);
        if ($menu == NULL) {
            return redirect()->route('menu.index')->with('message', ['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại!']);
        } else {
            $menu->status = 0;
            $menu->updated_at = date('Y-m-d H:i:s');

            $menu->save();
            return redirect()->route('menu.index')->with('message', ['type' => 'success', 'mgs' => 'Xóa vào thùng rác thành công!']);
        }
    }
    public function restore($id)
    {
        $list_menu = Menu::find($id);
        if ($list_menu == NULL) {
            return redirect()->route('menu.index')->with('message', ['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại!']);
        } else {
            $list_menu->status = 2;
            $list_menu->updated_at = date('Y-m-d H:i:s');
            $list_menu->updated_by = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : 1;
            $list_menu->save();
            return redirect()->route('menu.trash')->with('message', ['type' => 'success', 'mgs' => 'Khôi phục thành công!']);
        }
    }
    public function status($id)
    {
        $row = Menu::find($id);
        if ($row == NULL) {
            return redirect()->route('menu.index')->with('message', ['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
        }
        $row->updated_by = Auth::id() ?? 1; //đăng nhập
        $row->updated_at = date('Y-m-d H:i:s'); //ngày tạoo
        $row->status = ($row->status == 1) ? 2 : 1; // trạng thái chưa xuất mã
        $row->save();
        return redirect()->route('menu.index')->with('message', ['type' => 'success', 'mgs' => 'Thay đổi trạng thái thành công!']);
    }
}