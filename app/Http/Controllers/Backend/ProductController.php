<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Models\MultiImg;
use Image;


class ProductController extends Controller
{
    // Product Add
    public function ProductAdd(){
        $category = Category::latest()->get();  
        $brands = Brand::latest()->get(); 
        $subcategory = SubCategory::latest()->get(); 
        
        return view('backend.product.product_add', compact('category','brands','subcategory'));
        
        } // end mathod


          // product store
            public function StoreProduct(Request $request){

           // img upload and save and img intervations packge use
          $image = $request->file('product_thambnail');
          $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
          Image::make($image)->resize(917,1000)->save('upload/products/thambnail/'.$name_gen);
          $save_url = 'upload/products/thambnail/'.$name_gen;

             $product_id =   Product::insertGetId([
                    'brand_id' => $request->brand_id, 
                    'category_id' => $request->category_id, 
                    'subcategory_id' => $request->subcategory_id, 
                    'subsubcategory_id' => $request->subsubcategory_id, 
                    'product_name' => $request->product_name,                    
                    'product_slug_name' =>  strtolower(str_replace(' ', '-', $request->product_slug_name)),
                    
                    'product_code' => $request->product_code, 
                    'product_qty' => $request->product_qty, 
                    'product_tags' => $request->product_tags, 
                    'product_size' => $request->product_size, 
                    'product_color' => $request->product_color, 
                    'selling_price' => $request->selling_price, 
                    'discount_price' => $request->discount_price, 
                    'product_short_descp' => $request->product_short_descp, 
                    'product_long_descp' => $request->product_long_descp, 
                    'product_thambnail' => $request->product_thambnail, 
                    'hot_deals' => $request->hot_deals, 
                    'featured' => $request->featured, 
                    'special_offer' => $request->special_offer, 
                    'special_deals' => $request->special_deals, 
                    'product_thambnail' => $save_url,
                    'status' => 1, 
                    'created_at' => Carbon::now(), 
                    
                ]);


                // Multiple img upload start
                $images = $request->file('multi_img');
                foreach ($images as $img){
                    $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
                    Image::make($img)->resize(917,1000)->save('upload/products/multi-image/'.$make_name);
                    $uploadPath = 'upload/products/multi-image/'.$make_name;

                    MultiImg::insert([
                        // product_id is all info make single id 
                        'product_id' => $product_id,
                        'photo_name' => $uploadPath,
                        'created_at' => Carbon::now(), 
                    ]);

                } // end loop
            // Multiple img end

            $notification = array(
                'message' => 'Product Add Successfully',
                'alert-type' => 'success'
            );
    
            return redirect()->route('manage-product')->with($notification);
                

            } // end mathod








//==========Manage Product================

        public function ManageProduct(){
            $product = Product::latest()->get();
            return view('backend/product/product_view', compact('product'));
        } // end mathod




        // Edit Product
        public function EditProduct($id){

            // Multi img
            $multiimgs = MultiImg::where('product_id', $id)->get();

            $category = Category::latest()->get();
            $brands = Brand::latest()->get();
            $subcategory = SubCategory::latest()->get();
            $subsubcategory = SubSubCategory::latest()->get();
            $products = Product::findOrFail($id);
            return view('backend.product.product_edit',compact('category','brands','subcategory','subsubcategory','products','multiimgs'));
    
        } // end mathod


  // update Product 

   public function UpdateProduct(Request $request){
     
        $product_id = $request->id;

           Product::findOrFail($product_id)->update([

            'brand_id' => $request->brand_id, 
            'category_id' => $request->category_id, 
            'subcategory_id' => $request->subcategory_id, 
            'subsubcategory_id' => $request->subsubcategory_id, 
            'product_name' => $request->product_name,                    
            'product_slug_name' =>  strtolower(str_replace(' ', '-', $request->product_slug_name)),
            
            'product_code' => $request->product_code, 
            'product_qty' => $request->product_qty, 
            'product_tags' => $request->product_tags, 
            'product_size' => $request->product_size, 
            'product_color' => $request->product_color, 
            'selling_price' => $request->selling_price, 
            'discount_price' => $request->discount_price, 
            'product_short_descp' => $request->product_short_descp, 
            'product_long_descp' => $request->product_long_descp, 
            // 'product_thambnail' => $request->product_thambnail, 
            'hot_deals' => $request->hot_deals, 
            'featured' => $request->featured, 
            'special_offer' => $request->special_offer, 
            'special_deals' => $request->special_deals, 
            // 'product_thambnail' => $save_url,
            'status' => 1, 
            'created_at' => Carbon::now(), 
            
        ]);

        $notification = array(
            'message' => 'Product Update Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('manage-product')->with($notification);

   }// end mathod 


        /// Multiple Image Update
        public function UpdateProductMultiImg(Request $request){
            $imgs = $request->multi_img;

            foreach ($imgs as $id => $img) {
            $imgDel = MultiImg::findOrFail($id);
            unlink($imgDel->photo_name);

            $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(917,1000)->save('upload/products/multi-image/'.$make_name);
            $uploadPath = 'upload/products/multi-image/'.$make_name;

            MultiImg::where('id',$id)->update([
                'photo_name' => $uploadPath,
                'updated_at' => Carbon::now(),

            ]);

        } // end foreach

        $notification = array(
                'message' => 'Product Image Updated Successfully',
                'alert-type' => 'info'
            );

            return redirect()->back()->with($notification);



    } // end mathod 

            //// Multi Image Delete ////
            public function MultiImageDelete($id){
                $oldimg = MultiImg::findOrFail($id);
                unlink($oldimg->photo_name);
                MultiImg::findOrFail($id)->delete();

                $notification = array(
                'message' => 'Product Image Deleted Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);

            } // end method 


    //==============Multipat end===================




         /// Product Main Thambnail Update /// 
            public function ThambnailImageUpdate(Request $request){
                $pro_id = $request->id;
                $oldImage = $request->old_img;
                unlink($oldImage);

            $image = $request->file('product_thambnail');
                $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                Image::make($image)->resize(917,1000)->save('upload/products/thambnail/'.$name_gen);
                $save_url = 'upload/products/thambnail/'.$name_gen;

                Product::findOrFail($pro_id)->update([
                    'product_thambnail' => $save_url,
                    'updated_at' => Carbon::now(),

                ]);

                    $notification = array(
                    'message' => 'Product Image Thambnail Updated Successfully',
                    'alert-type' => 'info'
                );

                return redirect()->back()->with($notification);

                } // end method


    //===================Product Active and Deactive =====================

    // Deactive 
    public function ProductDeactive($id){
        Product::findOrFail($id)->update([ 'status' => 0, ]);

        // pass the sms
        $notification = array(
            'message' => 'Product Deactive Successfully',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    }// end mathod 

       // Active 
       public function ProductActive($id){
        Product::findOrFail($id)->update([ 'status' => 1, ]);

        // pass the sms
        $notification = array(
            'message' => 'Product Active Successfully',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    }// end mathod 


   // delete product
    public function ProductDelete($id){
        $product = Product::findOrFail($id);
        unlink($product->product_thambnail);
        Product::findOrFail($id)->delete();

        $images = MultiImg::where('product_id',$id)->get();
        foreach ($images as $img) {
            unlink($img->photo_name);
            MultiImg::where('product_id',$id)->delete();
        }

        $notification = array(
           'message' => 'Product Deleted Successfully',
           'alert-type' => 'success'
       );

       return redirect()->back()->with($notification);

    }// end method 
    

} // main end
