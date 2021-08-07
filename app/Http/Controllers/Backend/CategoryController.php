<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;


class CategoryController extends Controller
{
    //  categoary view 
    public function CategoryView(){

        $category = Category::latest()->get();
        return view('backend.category.category_view', compact('category') );

    }  // end mathod


       // store category
  public function CategoryStore(Request $request){   
      
    // validation 
        $request->validate([
            'category_name' => 'required',
            'category_icon' => 'required',
       
          ],[ 
            'category_name.required' => 'Input The Category Name',
            'category_icon.required' => 'Input The Category Name',
           
         
          ]);

        // Category Insert    
          Category::insert([
           'category_name' => $request->category_name,
           'category_icon' => $request->category_icon,
           'category_slug_name' => strtolower(str_replace(' ', '-', $request->category_slug_name)),       

          ]); 

          $notification = array(
            'message' =>  'Category Add Sucessyfuly',
            'alert-type' => 'success'
        ); 

        return redirect()->back()->with($notification);

          

  } // end method 


    // edit category    
    public function CategoryEdit($id){
      $category = Category::findOrfail($id);
      return view('backend.category.category_edit', compact('category')); 

    } // end mathod

    // Category Update
  public function CategoryUpdate(Request $request){

    $cat_id = $request->id;


      // Category Update    
      Category::findorfail($cat_id)->update([
        'category_name' => $request->category_name,
        'category_icon' => $request->category_icon,
        'category_slug_name' => strtolower(str_replace(' ', '-', $request->category_slug_name)),       

       ]); 

       $notification = array(
         'message' =>  'Category Update Sucessyfully',
         'alert-type' => 'success'
     ); 

     return redirect()->route('all.category')->with($notification);
  } // end mathod

  

    public function CategoryDelete($id){

      Category::findOrFail($id)->delete();

      $notification = array(
        'message' =>  'Category Delete Sucessyfully',
        'alert-type' => 'success'
    ); 

    return redirect()->back()->with($notification);

    } // end mathod 

}
