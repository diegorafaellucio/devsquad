<?php

namespace App\Http\Controllers;

use App\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FileController extends Controller
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

//        dd($request->file);

        if ($request->hasFile('file') && $request->file('file')->isValid()) {

            $total = DB::table('files')
                ->select(DB::raw('count(*) as total'))
                ->get()[0]->total;

            $name = "{$total}";
            $extension = $request->file->extension();
            $nameFile = "{$name}.{$extension}";



            $file = ["name" => $nameFile,
                "processed" => '0',
            ];

            File::create($file);


            $upload = $request->file->storeAs("importProducts", $nameFile);

            if ($upload) {
                return redirect("admin/product")->with('success', 'Import File are Add');
            } else {
                return back()->with('error', 'Error on upload image!');
            }



        } else {
            return back()->with('error', 'Error on upload file!');
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
    }
}
