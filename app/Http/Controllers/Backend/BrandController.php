<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Image;
// use Str;



class BrandController extends Controller
{
    // brand view
    public function BrandView(){
        $brands = Brand::latest()->get();
        return view('backend.brand.brand_view', compact('brands') );
     
         }
      
   // store brand
  public function BrandStore(Request $request){   
      
    // validation 
        $request->validate([
            'brand_name_cats_eye' => 'required',
            'brand_name_easy' => 'required',
            'brand_image' => 'required',       
          ],[ 
            'brand_name_cats_eye.required' => 'Input The Brand Name in Cats Eye',
            'brand_name_easy.required' => 'Input The Brand Name in Easy',
           
         
          ]);

          // img upload and save
          $image = $request->file('brand_image');
          $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
          Image::make($image)->resize(300,300)->save('upload/brand/'.$name_gen);
          $save_url = 'upload/brand/'.$name_gen;

       // Brand Insert    
          Brand::insert([
           'brand_name_cats_eye' => $request->brand_name_cats_eye,
           'brand_name_easy' => $request->brand_name_easy,

           'brand_slug_cats_eye' => strtolower(str_replace(' ', '-', $request->brand_name_cats_eye)),
           'brand_slug_easy' => (str_replace(' ','-', $request->brand_slug_easy)),
           'brand_image' => $save_url,

          ]);

          $notification = array(
            'message' =>  'Brand Add Sucessyfuly',
            'alert-type' => 'success'
        ); 

        return redirect()->back()->with($notification);

          

  } // end method 
 
   
           // edit brand
            public function BrandEdit($id){

                $brands = Brand::findOrfail($id);

                return view('backend.brand.brand_edit', compact('brands'));                
            }



            // update brand
            public function BrandUpdate(Request $request){

                $brand_id = $request->id;
                $old_img  = $request->old_image;

                if ($request->file('brand_image')) {

                    unlink($old_img);
                    $image = $request->file('brand_image');
                    $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                    Image::make($image)->resize(300,300)->save('upload/brand/'.$name_gen);
                    $save_url = 'upload/brand/'.$name_gen;
          
                 // Brand Update    
                    Brand::findOrFail($brand_id)->update([
                     'brand_name_cats_eye' => $request->brand_name_cats_eye,
                     'brand_name_easy' => $request->brand_name_easy,
          
                     'brand_slug_cats_eye' => strtolower(str_replace(' ', '-', $request->brand_name_cats_eye)),
                     'brand_slug_easy' => (str_replace(' ','-', $request->brand_slug_easy)),
                     'brand_image' => $save_url,
          
                    ]);
          
                    $notification = array(
                      'message' =>  'Brand Update Sucessyfuly',
                      'alert-type' => 'info'
                  ); 
          
                  return redirect()->route('all.brand')->with($notification);
          

                }else{
                    Brand::findOrFail($brand_id)->update([
                        'brand_name_cats_eye' => $request->brand_name_cats_eye,
                        'brand_name_easy' => $request->brand_name_easy,
             
                        'brand_slug_cats_eye' => strtolower(str_replace(' ', '-', $request->brand_name_cats_eye)),
                        'brand_slug_easy' => (str_replace(' ','-', $request->brand_slug_easy)),
                        // 'brand_image' => $save_url,
             
                       ]);
             
                       $notification = array(
                         'message' =>  'Brand Update Sucessyfuly',
                         'alert-type' => 'info'
                     ); 
             
                     return redirect()->route('all.brand')->with($notification);
             

                } // else end

            } // method end


        //     public function destroy($id){
        //       Brand::findOrFail($id)->delete();
              
        //        return redirect()->back();
     
        //  }
     
        //=============Brand Delete=================
     
              public function BrandDelete($id){

                $brand = Brand::findOrFail($id);

                $img = $brand->brand_image;
                unlink($img);

                Brand::findOrFail($id)->delete();

                $notification = array(
                'message' =>  'Brand Delete Sucessyfully',
                'alert-type' => 'info'
            ); 

            return redirect()->back()->with($notification);


              } // end mathod

        

  

}
