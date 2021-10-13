<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;

class GetController extends Controller
{
   public function categories(){
       $categories=Category::all();
       if(count($categories)>0){
        return response(['success' => true, 'categories' =>$categories], 200);
    }else{
        return response(['success' => false, 'message' => 'category empty '], 400);

    }
   }

   public function news_list(){
    $news=News::all();
    if(count($news)>0){
     return response(['success' => true, 'newslists' =>$news], 200);
 }else{
     return response(['success' => false, 'message' => 'news empty '], 400);

 }
}
}
