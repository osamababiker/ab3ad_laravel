<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Item;
use App\Models\Category;


class ItemsController extends Controller
{
    public function getTable(){
        $items = Item::all();
        $categories = Category::all();
        return view('dashboard/items/table',compact(['items','categories']));
    }

    public function getForm(){
        $categories = Category::all();
        return view('dashboard/items/form', compact(['categories']));
    }

    public function postForm(Request $request){
        $this->validate($request,[
            'name' => 'required|string',
            'price' => 'required',
            'image' => 'nullable',
            'categoryId' => 'required'
        ]);

        if($request->has('image')){
            $image = $request->file('image');
            $image_name = time().'_'. rand(1000, 9999). '.' .$image->extension();
            $image->move(public_path('upload/items'),$image_name);
        }

        $item = new Item();
        $item->name = $request->name;
        $item->price = $request->price;
        $item->categoryId = $request->categoryId;
        $item->image = $image_name;
        $item->save();

        session()->flash('feedback', 'تمت اضافة العنصر بنجاح');
        return redirect()->back();
    }

    public function postTable(Request $request){
        if($request->has('edit_item_btn')){
            $item = Item::findOrFail($request->item_id);
            $this->validate($request,[
                'name' => 'required|string',
                'price' => 'required',
                'image' => 'nullable',
                'categoryId' => 'required'
            ]);
    
            if($request->has('image')){
                $image = $request->file('image');
                $image_name = time().'_'. rand(1000, 9999). '.' .$image->extension();
                $image->move(public_path('upload/items'),$image_name);
            }else $image_name = $item->image;
    
            $item->name = $request->name;
            $item->price = $request->price;
            $item->categoryId = $request->categoryId;
            $item->image = $image_name;
            $item->save();
    
            session()->flash('feedback', 'تمت تحديث العنصر بنجاح');
            return redirect()->back();
        }
        if($request->has('delete_item_btn')){
            Item::where('id', $request->item_id)->delete();
            session()->flash('feedback', 'تمت ازالة العنصر بنجاح');
            return redirect()->back();
        }
    }
}
