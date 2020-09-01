<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Comment;
use App\Product;
use Illuminate\Support\Carbon;


class CommentController extends Controller
{
    public function postComment($id,Request $request){
        $product_id = $id;
        $product = Product::find($id);
        $comment = new Comment;
        $comment->product_id = $product_id;
        $comment->user_id = $request->session()->get('key')->id;
        $comment->content = $request->content;
        $comment->save();
        return redirect('product/'.$product->slug)->with('thongbao','viet binh luan thanh cong');
    }
   
}