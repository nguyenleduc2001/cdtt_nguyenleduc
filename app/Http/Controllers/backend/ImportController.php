<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Import;
use Illuminate\Support\Str;
class ImportController extends Controller
{
    public function index()
    {
        $title = 'Danh sách sản phẩm';   #$title...
        $list = Import::where("import.status", '<>', '0')
        ->join('category', 'category.id', '=', 'import.category_id')
        ->join('brand', 'brand.id', '=', 'import.brand_id')
        ->select("import.*", "category.name as category_name", "brand.name as brand_name")
        ->orderBy('import.created_at', 'asc')
        ->get();
        return view('backend.import.index', compact('list', 'title'));
    }
    public function create()
    {
        $title = 'Tạo';
        $list = Import::where('status', '<>', '0')->orderBy('created_at', 'desc')->get();
        $html_category_id = '';
        $html_brand_id = '';
        foreach ($list as $item) {
            $html_category_id .= "<coption value =''" . $item->id . "'>" . $item->name . "</option>";
            $html_brand_id .= "<coption value =''" . ($item->brand_id + 1) . "'>" . $item->name . "</option>";
        }
        return view("backend.import.create", compact('html_category_id', 'html_brand_id', 'title'));
    }
    public function store(Request $request)
    {
        $import = new Import();
        $import->name = $request->name;
        $import->slug = Str::of($request->name)->slug('-');;
        $import->category_id = $request->category_id;
        $import->brand_id = $request->brand_id;
        $import->metakey = $request->metakey;
        $import->detail = $request->detail;
        $import->price = $request->price;
        $import->metadesc = $request->metadesc;
        $import->created_at = date('Y-m-d H:i:s');
        $import->updated_at = date('Y-m-d H:i:s');
        $import->updated_by = 1;
        $import->created_by = 1;
        $import->status = 2;

        $file = $request->file('image');
        if ($file != NULL) {
            var_dump('file');
            $extention = $file->getClientOriginalExtension();
            if (in_array($extention, ['png', 'jpg'])) {
                $fileName = $import->slug . '.' . $extention;
                $file->move(public_path('images/import'), $fileName);
                $import->image = $fileName;
            }
        }


        $import->save();
        return redirect()->route('import.index')->with('message', ['type' => 'success', 'mgs' => 'Thêm thành công']);
    }

    public function show(string $id)
    { {
            $row = Import::find($id);                                                                                           //$row1=Category::where([['id','=',$id],['status','!=',0]])..
            if ($row == NULL) {
                return redirect()->route('import.index')->with('message', ['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
            }
            $title = "Chi tiết mãu tin";
            return view('backend.import.show', compact('row', 'title'));
        }
    }
}