<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $rules = [
        'name'=> 'required|min:3|max:128',
        'code' => 'required|min:3|max:128',
        'description'=>'required|min:3|max:256',
        'products'=>'required|integer'
    ];
    public function index($id)
    {
        $category = Category::find($id);
        if (is_null($category)) return response()->json(['message'=> 'Not found'],404);
        return response()->json([$category->name, $category->products()->get()],201);
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
            return response()->json(['Errors: '=>$validation->errors()],500);
        } else{
            $category = Category::create(['id'=>$request->input('id'), 'name'=>$request->input('name'), 'code'=>$request->input('code'), 'description'=>$request->input('description')]);
            $products = explode(',',$request->input('categories'));
            $category->products()->attach($products);
            return response()->json(['Category: '=>$category, 'Products in category: '=> $category->products()->get()], 201);
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
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validation = Validator::make(Request::all(),$this->rules);
        $category = Category::findOrFail($id);
        if (is_null($category)){
            return response()->json(['message'=>'Not found'], 404);
        }
        if ($validation->fails()){
            return response()->json(['Errors: '=>$validation->errors()],500);
        } else{
            $category->products()->detach();
            $products = explode(',',$request->input('products'));
            $category->products()->attach($products);
            $category->update($request->all());
            return response()->json(['Category: '=>$category, 'Products in category: '=>$category->products()->get()], 201);
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
        $category = Category::findOrFail($id);
        if (is_null($category)){
            return response()->json(['message'=>'Not found'], 404);
        }
        $category->products()->detach();
        $category->delete();

        return response()->json(null, 204);
    }
}
