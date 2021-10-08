<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    protected $rules = [
        'category_id' => 'required' ,
        'name'=> 'required|min:3|max:128',
        'code'=>'required|min:3|max:72',
        'description'=>'required|min:3|max:256',
        'price'=>'required',
        ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products = Product::all();
        if (sizeof($products) == 0) return response()->json(['message'=>'Not found'], 404);
        return response()->json($products,201);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validation = Validator::make(Request::all(),$this->rules);

        if ($validation->fails()){
            return response()->json(['message'=>$validation->errors()],500);
        }else {
            $product = Product::create($request->all());
            return response()->json($product, 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        if (is_null($product)){
            return response()->json(['message'=>'Not Found'],404);
        }
        return response()->json($product,200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        //
        $product = Product::find($id);
        if (is_null($product)){
            return response()->json(['message'=>'Not Found'],404);
        }

        $validation = Validator::make(Request::all(),$this->rules);

        if ($validation->fails()){
            return response()->json(['message'=>$validation->errors()],500);
        }else {
            $product -> update($request->all());
            return response()->json($product,201);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $product = Product::find($id);
        if (is_null($product)){
            return response()->json(['message'=>'Not Found'],404);
        }
        $product->delete();
        return response()->json(null,204);
    }
}
