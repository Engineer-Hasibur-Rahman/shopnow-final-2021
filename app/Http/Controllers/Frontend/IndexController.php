<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Category;
use App\Models\Slider;
use App\Models\Product;
use App\Models\MultiImg;
use App\Models\Brand;


use Illuminate\Support\Facades\Hash;

class IndexController extends Controller
{

  // Frontend Index show
   public function index(){


     // for  special_deals
  $special_deals = Product::where('special_deals', 1)->orderBy('id', 'DESC')->limit(6)->get();


  // for  Spacial Offer
  $special_offers = Product::where('special_offer', 1)->orderBy('id', 'DESC')->limit(6)->get(); 

  // for  hot_deals
  $hot_deals = Product::where('hot_deals', 1)->where('discount_price','!=',NULL)->orderBy('id', 'DESC')->limit(6)->get(); 
 
    // for featured
    $featureds = Product::where('featured', 1)->orderBy('id', 'DESC')->limit(6)->get(); 
 

      // for product
      $products = Product::where('status', 1)->orderBy('id', 'DESC')->get(); 
     // end product

     // for slider
      $sliders = Slider::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get(); 
     // end slider

     // for Category Data show in forntend 
    $categories = Category::orderBy('category_name', 'ASC')->get();
   
       // single caregory product view
        $skip_category_0 = Category::skip(0)->first();
        $skip_product_0 = Product::where('status',1)->where('category_id',$skip_category_0->id)->orderBy('id','DESC')->get();
        
        // single caregory product view
          $skip_category_1 = Category::skip(1)->first();
          $skip_product_1 = Product::where('status',1)->where('category_id',$skip_category_1->id)->orderBy('id','DESC')->get();
  
  
    // single Brand  product view
      $skip_brand_1 = Brand::skip(1)->first();
      $skip_brand_product_1 = Product::where('status',1)->where('brand_id',$skip_brand_1->id)->orderBy('id','DESC')->get();




       return view('frontend.index',
        compact('categories','sliders', 'products','featureds',
        'hot_deals', 'special_offers','special_deals',
        'skip_category_0','skip_product_0','skip_category_1','skip_product_1','skip_brand_1','skip_brand_product_1'));
   }







  // user logout 
   public function UserLogout(){
    Auth::logout();
    return redirect()->route('login');
}

  // user Profile Update  
  public function UserProfile(){
    // what is id = specify  user and use find id
      $id = Auth::user()->id;
      $user = User::find($id);

      return view('frontend.profile.user_profile', compact('user'));

  }

      // User Profile Store 
      public function UserProfileStore(Request $request){
        // Auth login user id is find 
        $data = User::find(Auth::user()->id);
                $data->name = $request->name;
                $data->email = $request->email;
                $data->phone = $request->phone;
                

                if ($request->file('profile_photo_path')) {
                    $file = $request->file('profile_photo_path');
                    @unlink (public_path('upload/users_images/'.$data->profile_photo_path));

                    $filename = date('YmdHi').$file->getClientOriginalName();
                    $file->move(public_path('upload/users_images'),$filename);
                    $data['profile_photo_path'] = $filename;
                }
                $data->save();

                $notification = array(
                    'message' =>  'Your Profie Update Sucessyfuly',
                    'alert-type' => 'success'
                ); 


                return redirect()->route('dashboard')->with($notification);

      }



          // user password change 
          public function UserChnagePassword(){
            $id = Auth::user()->id;
            $user = User::find($id);
              return view('frontend.profile.change_password', compact('user'));
          }


          // User Update Password          
          public function UserPasswordUpdate(Request $request){

            $validateData = $request->validate([
              'oldpassword' => 'required',
              'password' => 'required|confirmed',
          ]);
          $hashedPassword = Auth::user()->password;
          if (Hash::check($request->oldpassword,$hashedPassword)) {
          $user = User::find(Auth::id());
          $user->password = Hash::make($request->password);
          $user->save();    
    
          Auth::logout();
          return redirect()->route('user.logout');         
    
          }else{
              return redirect()->back();
           }    
    
    
          }  // end mahod


       // product_detalis  
       public function ProductDetails($id){
         // for multi img show
         $product = Product::findOrFail($id);   
          $product_color = $product->product_color; 
          $product_color_all = explode (',',$product_color); 
          
          // for color and size
          $product_size = $product->product_size; 
          $product_size_all = explode (',',$product_size); 


           // for related product show
          $cat_id = $product->category_id;
          $relatedProduct = Product::where('category_id',$cat_id)->where('id','!=',$id)->orderBy('id','DESC')->get();


        $multiimgs =  MultiImg::where('product_id',$id)->get(); 
             
        return view('frontend.product.product_detalis', compact('product','multiimgs','product_color_all',
        'product_size_all','relatedProduct', ));

       } // end mathod   

   public function TagWiseProduct($tag){
     // for tag page 
    $categories = Category::orderBy('category_name', 'ASC')->get();
    $products = Product::where('status', 1)->where('product_tags', $tag)->orderBy('id', 'DESC')->paginate(4);

    return view('frontend.tags.tags_view', compact('products','categories'));

   }




    // Subcategory wise data
	public function SubCatWiseProduct($subcat_id){
		$products = Product::where('status',1)->where('subcategory_id',$subcat_id)->orderBy('id','DESC')->paginate(4);
		$categories = Category::orderBy('category_name','ASC')->get();
		return view('frontend.product.subcategory_view',compact('products','categories'));

	}


     // Subcategory wise data
	public function SubSubCatWiseProduct($subsubcat_id){
		$products = Product::where('status',1)->where('subsubcategory_id',$subsubcat_id)->orderBy('id','DESC')->paginate(4);
		$categories = Category::orderBy('category_name','ASC')->get();
		return view('frontend.product.sub_subcategory_view',compact('products','categories'));

	}

 /// Product View With Ajax
 public function ProductViewAjax($id){


  $product = Product::with('category', 'brand')->findOrFail($id);



  $color = $product->product_color;
  $product_colors = explode(',', $color);

  // size varibale is messing
  $size = $product->product_size;
  $product_sizes = explode(',', $size);

  return response()->json(array(
    'product' =>$product, 
    'color' => $product_colors,
    'size' => $product_sizes,
// problem is same varibale 


  ));

 } // end mathod

  

      }
