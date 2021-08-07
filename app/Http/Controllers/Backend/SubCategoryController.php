<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;
use App\Models\SubSubCategory;


class SubCategoryController extends Controller
{
        //  Sub categoary view 
        public function SubCategoryView(){

            $categorys = Category::orderBy('category_name', 'ASC')->get();
            $subcategory = SubCategory::latest()->get();
            return view('backend.category.sub_category_view', compact('subcategory','categorys'));
    
        }  // end mathod



        // Sub category store
        public function SubCategoryStore(Request $request){
            // Sub category validation 
            $request->validate([
                'sub_category_name' => 'required',                       
            ],[ 
                'sub_category_name.required' => 'Input The Sub Category Name',
                         
            ]);   
      
            // Sub Category Insert    
            SubCategory::insert([
            'category_id' => $request->category_id,         
            'sub_category_name' => $request->sub_category_name,         
            'sub_category_slug_name' => strtolower(str_replace(' ', '-', $request->sub_category_slug_name)),   
        
            ]);    
            $notification = array(
                'message' =>  'Sub Category Add Sucessyfuly',
                'alert-type' => 'success'
            );     
            return redirect()->back()->with($notification);   
             } // end mathod

  // sub category edit
  public function SubCategoryEdit($id){
    $category = Category::orderBy('category_name', 'ASC')->get();
    $subcategory = SubCategory::findOrFail($id);
    return view('backend.category.subcategory_edit', compact('subcategory', 'category'));
    } // end mathod 
 
   public function SubCategoryUpdate(Request $request){
     $subcat_id = $request->id;

        // Sub Category Update    
        SubCategory::findOrFail($subcat_id)->update([
          'category_id' => $request->category_id,         
          'sub_category_name' => $request->sub_category_name,         
          'sub_category_slug_name' => strtolower(str_replace(' ', '-', $request->sub_category_slug_name)),   
      
          ]);    
          $notification = array(
              'message' =>  'Sub Category Update Sucessyfuly',
              'alert-type' => 'success'
          );     
          return redirect()->route('all.subcategory')->with($notification); 
   } // end mathod 

   // delete sub category

      public function SubCategoryDelete($id){

        SubCategory::findOrFail($id)->delete();

        $notification = array(
        'message' => 'SubCategory Deleted Successfully',
        'alert-type' => 'warning'
      );

      return redirect()->back()->with($notification);

    } // end mathod








//==============Sub Sub Category all Mathod ========================

  // sub sub category view 

  public function SubSubCategoryView(){
    $categorys = Category::orderBy('category_name', 'ASC')->get();
    $subsubcategory = SubSubCategory::latest()->get();
    return view('backend.category.sub_subcategory_view', compact('subsubcategory','categorys')); 
  }

     // sub category method
  public function GetSubCategory($category_id){
    $subcat = SubCategory::where('category_id',$category_id)->orderBy('sub_category_name', 'ASC')->get();
    return json_encode($subcat);
  }// end mathod
  
  
  // sub sub auto complate category method
  public function GetSubSubCategory($subcategory_id){
    $subsubcat = SubSubCategory::where('subcategory_id',$subcategory_id)->orderBy('subsubcategory_name', 'ASC')->get();
    return json_encode($subsubcat);
  }// end mathod

  // sub sub category store
  public function SubSubCategoryStore(Request $request){

    $request->validate([
         'category_id' => 'required',
         'subcategory_id' => 'required',
         'subsubcategory_name' => 'required',             
     ],[
         'category_id.required' => 'Please select Any option',
         'subsubcategory_name.required' => 'Input SubSubCategory Name',
     ]);


  // sub  category insert 
    SubSubCategory::insert([
     'category_id' => $request->category_id,
     'subcategory_id' => $request->subcategory_id,
     'subsubcategory_name' => $request->subsubcategory_name,         
     'subsubcategory_slug_name' => strtolower(str_replace(' ', '-',$request->subsubcategory_slug_name)),


     ]);

     $notification = array(
         'message' => 'SubSubCategory Inserted Successfully',
         'alert-type' => 'success'
     );

     return redirect()->route('all.subsubcategory')->with($notification);


} // end mathod


  // sub sub category edit 
    public function SubSubCategoryEdit($id){
      $categories = Category::orderBy('category_name','ASC')->get();
      $subcategory = SubCategory::orderBy('sub_category_name','ASC')->get();
      $subsubcategory = SubSubCategory::findOrFail($id);
      return view('backend.category.sub_subcategory_edit',compact('categories','subcategory','subsubcategory'));

    } // end mathod 



    // sub sub category update

    public function SubSubCategoryUpdate(Request $request){

    	$subsubcat_id = $request->id;

    	SubSubCategory::findOrFail($subsubcat_id)->update([
		'category_id' => $request->category_id,
		'subcategory_id' => $request->subcategory_id,
		'subsubcategory_name' => $request->subsubcategory_name,	
		'subsubcategory_slug_name' => strtolower(str_replace(' ', '-',$request->subsubcategory_slug_name)),
		


    	]);

	    $notification = array(
			'message' => 'Sub-SubCategory Update Successfully',
			'alert-type' => 'success'
		);

		return redirect()->route('all.subsubcategory')->with($notification);

    } // end method 






   // delete sub sub cat... 
   public function SubSubCategoryDelete($id){

    SubSubCategory::findOrFail($id)->delete();
     $notification = array(
        'message' => 'Sub-SubCategory Deleted Successfully',
        'alert-type' => 'info'
    );

    return redirect()->back()->with($notification);

}







}
