<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Image;
use App\Product;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = DB::table('products')
            ->join('categories', 'products.category', '=', 'categories.id')
            ->select('products.*', 'categories.name as category_name')
            ->get()->toArray();

//        $products = Product::all()->toArray();
//        $products = json_decode($products, true);
//        var_dump($products);
        return view('pages.admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all()->toArray();


        return view('pages.admin.product.create', compact('categories'));
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $product = $this->validate(request(), [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|integer',
            'category' => 'required',
        ]);

        $product['price'] = (int)$product['price'];

//        var_dump($product);

        Product::create($product);
//
        return back()->with('success', 'Product has been added');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function import(Request $request)
    {

        $data = $request->all();

        if ($request->hasFile('file') && $request->file('file')->isValid()) {


            $total = DB::table('images')
                ->select(DB::raw('count(*) as total'))
                ->where('product', '=', $id)
                ->get()[0]->total;

            $name = "{$id}-{$total}";
            $extension = $request->image->extension();
            $nameFile = "{$name}.{$extension}";

            $upload = $request->image->storeAs($data['product'], $nameFile);


            if ($upload) {
                $image = ["name" => $nameFile,
                    "extension" => $extension,
                    "product" => $id
                ];

                Image::create($image);

                $categories = Category::all()->toArray();

                $images = Image::where('product', $id);

                $product = Product::find($id);


                return redirect("admin/product/{$id}/edit")->with('success', 'Product has been  deleted');
            } else {
                return back()->with('error', 'Error on upload image!');
            }


        } else {
            return back()->with('error', 'Error on upload image!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

//        dd($id);
        $categories = Category::all()->toArray();

        $images = Image::where('product', $id)->get()->toArray();

//        dd($images);

        $product = Product::find($id);


        return view('pages.admin.product.edit', compact('product', 'id', 'categories', 'images'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $product = Product::find($id);
        $this->validate(request(), [
            'name' => 'required',
        ]);
        $product->name = $request->get('name');
        $product->save();
        return redirect('admin/product')->with('success', 'Product has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $product = Product::find($id);
        $product->delete();
        return redirect('admin/product')->with('success', 'Product has been  deleted');
    }
}
