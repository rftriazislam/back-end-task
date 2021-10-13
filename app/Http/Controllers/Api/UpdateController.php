<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    public function update_single_category(Request $request){

        $validatedData =   $this->validate($request, [
            'category_id' => 'required|exists:categories,id',
        ]);
        $category=Category::where('id',$validatedData['category_id'])->first();
        if($category){
            $category->update($request->all());
            return response(['success' => true, 'message' => 'successful Update category'], 200);
        }else{
            return response(['success' => false, 'message' => 'Something went to error in database'], 400);

        }
        }

        public function update_single_news(Request $request){

            $validatedData =   $this->validate($request, [
                'news_id' => 'required|exists:news,id',
            ]);
            $category=News::where('id',$validatedData['news_id'])->first();
            if($category){
                $category->update($request->all());

                if ($request->file("image")) {
                    $image = $request->file('image');
                    $filename =  $request->user_id.time() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('/storage/image/'), $filename);
                    $validatedData['image']=$filename;
                }


                return response(['success' => true, 'message' => 'successful Update news'], 200);
            }else{
                return response(['success' => false, 'message' => 'Something went to error in database'], 400);

            }
            }


}
