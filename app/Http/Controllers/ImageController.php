<?php

namespace App\Http\Controllers;

use App\Category;
use App\Image;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
        $data = $request->all();


        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            $id = $data['product'];

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

        $image = Image::find($id);

        $product = Product::find($image['product']);

        $id = $product['id'];


        $image->delete();

        return redirect("admin/product/{$id}/edit")->with('success', 'Product has been  deleted');
    }
}
