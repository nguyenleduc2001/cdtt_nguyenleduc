<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Product;
use App\Http\Requests\StoreCategoryRequest;
use Illuminate\Support\Str;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Danh sách sản phẩm';   #$title...
        $list = Product::where("product.status", '<>', '0')
        ->join('category', 'category.id', '=', 'product.category_id')
        ->join('brand', 'brand.id', '=', 'product.brand_id')
        ->select("product.*", "category.name as category_name", "brand.name as brand_name")
        ->orderBy('product.created_at', 'asc')
        ->get();
        return view('backend.product.index', compact('list', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tạo';
        $list = Product::where('status', '<>', '0')->orderBy('created_at', 'desc')->get();
        $html_category_id = '';
        $html_brand_id = '';
        foreach ($list as $item) {
            $html_category_id .= "<option value='" . $item->id . "'>" . $item->name . "</option>";
            $html_brand_id .= "<option value='" . ($item->brand_id + 1) . "'>" . $item->name . "</option>";
        }
        return view("backend.product.create", compact('html_category_id', 'html_brand_id', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->slug = Str::of($request->name)->slug('-');;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->metakey = $request->metakey;
        $product->detail = $request->detail;
        $product->qty = $request->qty;
        $product->price = $request->price;
        $product->pricesale = $request->pricesale;
        $product->metadesc = $request->metadesc;
        $product->created_at = date('Y-m-d H:i:s');
        $product->created_by = 1;
        $product->status = 2;

        $file = $request->file('image');
        if ($file != NULL) {
            var_dump('file');
            $extention = $file->getClientOriginalExtension();
            if (in_array($extention, ['png', 'jpg'])) {
                $fileName = $product->slug . '.' . $extention;
                $file->move(public_path('images/product'), $fileName);
                $product->image = $fileName;
            }
        }


        $product->save();
        return redirect()->route('product.index')->with('message', ['type' => 'success', 'mgs' => 'Thêm thành công']);
    }
    public function show(string $id)
    { {
            $row = Product::find($id);                                                                                           //$row1=Category::where([['id','=',$id],['status','!=',0]])..
            if ($row == NULL) {
                return redirect()->route('post.index')->with('message', ['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
            }
            $title = "Chi tiết mãu tin";
            return view('backend.product.show', compact('row', 'title'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Sửa';
        return view("backend.product.edit", compact('title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}