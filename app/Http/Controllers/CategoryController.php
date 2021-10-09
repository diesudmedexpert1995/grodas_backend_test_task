<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    protected $rules = [
        'name'=> 'required|min:3|max:128',
        'code' => 'required|min:3|max:128',
        'description'=>'required|min:3|max:256',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = Category::all();
        if ($categories->isEmpty()) return response()->json(['message' => 'Not found'], 404);
        return response()->json($categories,201);
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
        }else {
            $category = Category::create($request->all());
            return response()->json($category,201);
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
        $category = Category::find($id);
        if (is_null($category)){
            return response()->json(['message'=>'Not found'], 404);
        }

        return response()->json($category, 200);
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
    public function update(Request $request, int $id)
    {
        //
        $category = Category::findOrFail($id);
        if (is_null($category)){
            return response()->json(['message'=>'Not found'], 404);
        }
        $validation = Validator::make(Request::all(),$this->rules);

        if ($validation->fails()){
            return response()->json(['message'=>$validation->errors()],500);
        }else {
            $category -> update($request->all());
            return response()->json($category, 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        //
        $category = Category::findOrFail($id);
        if (is_null($category)){
            return response()->json(['message'=>'Not found'], 404);
        }
        $products = $category->products()->get();
        if(sizeof($products) != 0) return response()->json(['message'=>'Category isn`t empty'], 500);
        $category->delete();
        return response()->json(null, 204);
    }
}
