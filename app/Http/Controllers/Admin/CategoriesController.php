<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Category;


class CategoriesController extends Controller
{
    public function getForm(){
        return view('dashboard/categories/form');
    }

    public function postForm(Request $request){
        if($request->has('saveCategoryBtn')){
            $this->validate($request,[
                'name' => 'required|string',
                'image' => 'required|image',
            ]);
            if($request->has('image')){
                $image = $request->file('image');
                $image_name = time().'_'. rand(1000, 9999). '.' .$image->extension();
                $image->move(public_path('upload/categories'),$image_name);
            }
            $category = Category::create([
                'name' => $request->name,
                'image' => $image_name,
            ]);
            session()->flash('categoryCreated','تم اضافة التصنيف بنجاح');
            return redirect()->back();
        }
    }


    public function getTable(){
        $categories = Category::get();
        return view('dashboard/categories/table',compact(['categories']));
    }


    public function postTable(Request $request){
        if($request->has('editCategoryBtn')){
            $this->validate($request,[
                'name' => 'required|string',
                'image' => 'nullable',
            ]);
            $category = Category::find($request->categoryId);
            if($request->has('image')){
                if(file_exists(public_path('upload/categories/'.$category->image))){
                    unlink(public_path('upload/categories/'.$category->image));
                }
                $image = $request->file('image');
                $image_name = time().'_'. rand(1000, 9999). '.' .$image->extension();
                $image->move(public_path('upload/categories'),$image_name);
                $category->image = $image_name;
            }
            $category->name = $request->name;
            $category->save();
            session()->flash('categoryUpdated','تم تحديث بيانات التصنيف بنجاح');
            return redirect()->back();
        }

        if($request->has('deleteCategoryBtn')){
            $category = Category::find($request->storeId);
            if(file_exists(public_path('upload/categories/'.$category->image))){
                unlink(public_path('upload/categories/'.$category->image));
            }
            $category->delete();
            session()->flash('storeDeleted','تم حذف  التصنيف بنجاح');
            return redirect()->back();
        }
    }
}
