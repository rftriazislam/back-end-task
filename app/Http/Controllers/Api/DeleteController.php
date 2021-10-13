<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
   public function  delete_category(Request $request,$id){
    $request['id']=$id;
    $validatedID =   $this->validate($request, [
        'id' => 'required|exists:categories,id',
    ]);
    $category=Category::where('id',$validatedID['id'])->delete();
    if($category){
     return response(['success' => true, 'message' =>'successfull delete'], 200);
 }else{
     return response(['success' => false, 'message' => 'category empty '], 400);

 }
   }
   public function  delete_news(Request $request,$id){
    $request['id']=$id;
    $validatedID =   $this->validate($request, [
        'id' => 'required|exists:news,id',
    ]);
    $news=News::where('id',$validatedID['id'])->delete();
    if($news){
     return response(['success' => true, 'message' =>'successfull delete'], 200);
 }else{
     return response(['success' => false, 'message' => 'news empty '], 400);

 }
   }
}
