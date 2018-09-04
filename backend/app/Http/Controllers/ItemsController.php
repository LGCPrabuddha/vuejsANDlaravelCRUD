<?php

namespace App\Http\Controllers;

use App\Items;;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    public function postItem(Request $request){
        $item = new Items();

        $expl = explode(',',$request->image);
        $decode = base64_decode($expl[1]);

        if(str_contains($expl[0],'png')){
          $exte = 'png';
        }else {
          $exte = 'jpg';
        }

        $currenttime = time();
        $filename = $currenttime.'.'.$exte;

        $filepath = public_path().'/'.$filename;
        file_put_contents($filepath,$decode);

        $item->name = $request->input('name');
        $item->qantity = $request->input('quantity');
        $item->image = $filename;
        $item->price = $request->input('price');


        $item->save();

        return response()->json(['message'=>$item],201);
    }

    public function getItems()
    {
      $allItems = Items::all();
      return response()->json(['allItems'=>$allItems],200);
    }

    public function getItem($id)
    {
      $item = Items::find($id);
      return response()->json(['item'=>$item],200);
    }

    public function deleteItem($id)
    {
      $item = Items::find($id);

      if (!$item) {
        return response()->json(['msg'=>"Item not found"],404);
      }
      $item->delete();
      return response()->json(['msg'=>"Item Deleted successfully"],201);
    }

    public function editItem(Request $request,$id)
    {
      $item = Items::find($id);

      if (!$item) {
        return response()->json(['msg'=>"Item not found"],404);
      }

      $item->name = $request->input('name');
      $item->qantity = $request->input('qantity');
      $item->price = $request->input('price');
      $item->save();
      return response()->json(['msg'=>$item],200);
    }
}
