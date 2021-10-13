<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // ----------------------------------------category--------------------------------------
    public function store_category(Request $request){
        $validatedData =   $this->validate($request, [
            'title' => 'required|unique:categories',
            'description' => 'required',
        ]);
        $storecategory=Category::create($validatedData);
        if($storecategory){
            return response(['success' => true, 'message' => 'successful save category'], 200);
        }else{
            return response(['success' => false, 'message' => 'Something went to error in database'], 400);

        }
    }
    // ----------------------------------------category--------------------------------------
    // ----------------------------------------news-----------------------------------------
    public function store_news(Request $request){
        $validatedData =   $this->validate($request, [
            'category_id'=>'required|exists:categories,id',
            'user_id'=>'required|exists:users,id',
            'title' => 'required|unique:news',
            'description' => 'required',
            'image'=>'nullable'
        ]);

            if ($request->file("image")) {
                $image = $request->file('image');
                $filename =  $request->user_id.time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('/storage/image/'), $filename);
                $validatedData['image']=$filename;
            }

        $storenews=News::create($validatedData);
        if($storenews){
            return response(['success' => true, 'message' => 'successful save news'], 200);
        }else{
            return response(['success' => false, 'message' => 'Something went to error in database'], 400);

        }
    }
    // ----------------------------------------news-----------------------------------------


}
