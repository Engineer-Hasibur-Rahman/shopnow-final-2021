
@extends('admin.admin_master')
@section('admin')

{{-- js for sub category  --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<div class="container-full">
    <!-- Content Header (Page header) -->


            <!-- Main content -->
            <section class="content">

            <!-- Basic Forms -->
            <div class="box">
                <div class="box-header with-border">
                <h4 class="box-title">Edit Product </h4>

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                <div class="row">
                    <div class="col">


              <form action="{{ route('product_update') }}" method="POST" >
                @csrf
                
                <input type="hidden" name="id" value="{{ $products->id }}" />


                <div class="row">
                 <div class="col-12">	


            <div class="row"> <!-- start 1st row  -->
                <div class="col-md-4">

        <div class="form-group">
        <h5>Brand Select <span class="text-danger">*</span></h5>
        <div class="controls">
            <select name="brand_id" class="form-control" required="" >
                <option value="" selected="" disabled="">Select Brand</option>

                @foreach($brands as $brand)

          <option value="{{ $brand->id }}" {{ $brand->id == $products->brand_id ? 'selected': '' }} >{{ $brand->brand_name_cats_eye }}</option>

                @endforeach
            </select>
            @error('brand_id') 
        <span class="text-danger">{{ $message }}</span>
        @enderror 
        </div>
            </div>

                </div> <!-- end col md 4 -->

                <div class="col-md-4">

                    <div class="form-group">
        <h5>Category Select <span class="text-danger">*</span></h5>
        <div class="controls">
            <select name="category_id" class="form-control" required="" >
                <option value="" selected="" disabled="">Select Category</option>

                @foreach($category as $category)

        <option value="{{ $category->id }}" {{ $category->id == $products->category_id ? 'selected': '' }}>{{ $category->category_name }}</option>	
                @endforeach
            </select>
            @error('category_id') 
        <span class="text-danger">{{ $message }}</span>
        @enderror 
        </div>
            </div>

                </div> <!-- end col md 4 -->


                <div class="col-md-4">

                    <div class="form-group">
        <h5>SubCategory Select <span class="text-danger">*</span></h5>
        <div class="controls">
            <select name="subcategory_id" class="form-control" required="" >

                <option value="" selected="" disabled="">Select SubCategory</option>
             @foreach($subcategory as $subcategory)

            <option value="{{ $subcategory->id }}" {{ $subcategory->id == $products->subcategory_id ? 'selected': '' }}  >{{ $subcategory->sub_category_name }}</option>	
                @endforeach
            </select>
            
            @error('subcategory_id') 
        <span class="text-danger">{{ $message }}</span>
        @enderror 
        </div>
            </div>

                </div> <!-- end col md 4 -->

            </div> <!-- end 1st row  -->







            <div class="row"> <!-- start 2nd row  -->
                <div class="col-md-6">

        <div class="form-group">
        <h5>Sub Sub Category Select <span class="text-danger">*</span></h5>
        <div class="controls">
            <select name="subsubcategory_id" class="form-control" required="" >
                <option value="" selected="" disabled="">Select Brand</option>

                @foreach($subsubcategory as $subsub)
                <option value="{{ $subsub->id }}" {{ $subsub->id == $products->subsubcategory_id ? 'selected': '' }}  >{{ $subsub->subsubcategory_name }}</option>	
                    @endforeach

            </select>
            @error('subsubcategory_id') 
        <span class="text-danger">{{ $message }}</span>
        @enderror 
        </div>
            </div>

                </div> <!-- end col md 4 -->

                <div class="col-md-6">

       
                    <div class="form-group">
                        <h5>Product Name <span class="text-danger">*</span></h5>
                        <div class="controls">
                         <input type="text" value="{{ $products->product_name }}" name="product_name" class="form-control" required=""> </div>
                   
                         @error('product_name') 
                         <span class="text-danger">{{ $message }}</span>
                         @enderror 
                        </div>

                </div> <!-- end col md 4 -->            


            </div> <!-- end 2nd row  -->






            <div class="row"> <!-- start 3rd row  -->
                <div class="col-md-4">

                    <div class="form-group">
                        <h5>Product Code <span class="text-danger">*</span></h5>
                        <div class="controls">
                         <input type="text"  value="{{ $products->product_code }}" name="product_code" class="form-control" required="" > </div>
                   
                         @error('product_code') 
                         <span class="text-danger">{{ $message }}</span>
                         @enderror 
                        </div>

                </div> <!-- end col md 4 -->

                <div class="col-md-4">

       
                    <div class="form-group">
                        <h5>Product Qty <span class="text-danger">*</span></h5>
                        <div class="controls">
                         <input type="text" value="{{ $products->product_qty }}" name="product_qty" name="product_qty" class="form-control" required="" > </div>
                   
                         @error('product_qty') 
                         <span class="text-danger">{{ $message }}</span>
                         @enderror 
                        </div>

                </div> <!-- end col md 4 -->  
                
                <div class="col-md-4">
       
                    <div class="form-group">
                        <h5>Product Tags <span class="text-danger">*</span></h5>
                        <div class="controls">
                         <input type="text" value="{{ $products->product_tags }}" name="product_tags" value="Lorem,Ipsum,Amet" data-role="tagsinput" class="form-control" > </div>
                   
                         @error('product_tags') 
                         <span class="text-danger">{{ $message }}</span>
                         @enderror 
                        </div>

                </div> <!-- end col md 4 -->            


            </div> <!-- end 3rd row  -->



            
            <div class="row"> <!-- start 4th row  -->
                <div class="col-md-4">

                    <div class="form-group">
                        <h5>Product size <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input type="text" value="{{ $products->product_size }}" name="product_size" value="small,large,mediem" data-role="tagsinput" class="form-control" > </div>
                   
                         @error('product_size') 
                         <span class="text-danger">{{ $message }}</span>
                         @enderror 
                        </div>

                </div> <!-- end col md 4 -->

                <div class="col-md-4">

       
                    <div class="form-group">
                        <h5>Product Colors <span class="text-danger">*</span></h5>
                        <div class="controls">
                         <input type="text" value="{{ $products->product_color }}" name="product_color" value="Red,Green,Black" data-role="tagsinput" class="form-control"  > </div>
                   
                         @error('product_color') 
                         <span class="text-danger">{{ $message }}</span>
                         @enderror 
                        </div>

                </div> <!-- end col md 4 -->  
                
                <div class="col-md-2">
       
                    <div class="form-group">
                        <h5>Product Selling Price <span class="text-danger">*</span></h5>
                        <div class="controls">
                         <input type="text" value="{{ $products->selling_price }}" name="selling_price"  class="form-control" required="" > </div>
                   
                         @error('selling_price') 
                         <span class="text-danger">{{ $message }}</span>
                         @enderror 
                        </div>

                </div> <!-- end col md 4 -->   
                
                <div class="col-md-2">
       
                    <div class="form-group">
                        <h5>Product Discount Price <span class="text-danger">*</span></h5>
                        <div class="controls">
                         <input type="text" value="{{ $products->discount_price }}" name="discount_price"  class="form-control"  > </div>
                   
                         @error('discount_price') 
                         <span class="text-danger">{{ $message }}</span>
                         @enderror 
                        </div>

                </div> <!-- end col md 4 -->            


            </div> <!-- end 4th row  -->


            <div class="row"> <!-- start 5th row  -->
                {{-- <div class="col-md-6">
                    <div class="form-group">
                        <h5>Product Thambnail<span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input type="file" name="product_thambnail" class="form-control" onchange="mainThamUrl(this)" required=""> </div>
                   
                         @error('product_thambnail') 
                         <span class="text-danger">{{ $message }}</span>
                         @enderror 

                         <img src="" id="mainThmb"  />
                        </div>

                </div> <!-- end col md 4 --> --}}

                {{-- <div class="col-md-6">       
                    <div class="form-group">
                        <h5>Product Multi Img <span class="text-danger">*</span></h5>
                        <div class="controls">
                         <input type="file" name="multi_img[]"  multiple="" id="MultiImg" class="form-control" required="" > </div>
                   
                         @error('multi_img') 
                         <span class="text-danger">{{ $message }}</span>
                         @enderror 
                         <div class="row" id="preview_img"></div>
                        </div>

                </div> <!-- end col md 4 -->   --}}
                
                
            </div> <!-- end 5th row  -->
            




            <div class="row"> <!-- start 6th row  -->
                <div class="col-md-3">
                    <div class="form-group">
                        <h5>Product Short Descraption<span class="text-danger">*</span></h5>
                            
                          <textarea name="product_short_descp" rows="18"  id="textarea" class="form-control" required placeholder="Textarea text">
                              {!! $products->product_short_descp !!}
                          </textarea>
                           
                   
                         @error('product_short_descp') 
                         <span class="text-danger">{{ $message }}</span>
                         @enderror 
                        </div>

                </div> <!-- end col md 4 -->

                <div class="col-md-9">       
                    <div class="form-group">
                        <h5>Product Long Descraption<span class="text-danger">*</span></h5>
                        	<textarea id="editor1" name="product_long_descp" rows="5" cols="80" >
                                {!! $products->product_long_descp !!}
                             </textarea>

                         @error('product_long_descp') 
                         <span class="text-danger">{{ $message }}</span>
                         @enderror 
                        </div>

                </div> <!-- end col md 4 -->  
                
                
            </div> <!-- end 6th row  -->







           

      
        <div class="row bg-success">
            <div class="col-md-6">
                <div class="form-group">
               
                    <div class="controls">
                        <fieldset>
                            <input type="checkbox" id="checkbox_2" name="hot_deals" value="1" {{ $products->hot_deals == 1 ? 'checked': '' }}>
                            <label for="checkbox_2">Hot Deals</label>
                        </fieldset>
                        <fieldset>
                            <input type="checkbox" id="checkbox_3" name="featured" value="1" {{ $products->featured == 1 ? 'checked': '' }}>
                            <label for="checkbox_3">Featured</label>
                        </fieldset>
                    </div>
                </div>
            </div>


            <div class="col-md-6">
                <div class="form-group">
                 
                    <div class="controls">
                        <fieldset>
                            <input type="checkbox" id="checkbox_4" name="special_offer" value="1" {{ $products->special_offer == 1 ? 'checked': '' }}>
                            <label for="checkbox_4">Special Offer</label>
                        </fieldset>
                        <fieldset>
                            <input type="checkbox" id="checkbox_5" name="special_deals" value="1" {{ $products->special_deals  == 1 ? 'checked': '' }}>
                            <label for="checkbox_5">Special Deals</label>
                        </fieldset>
                    </div>
                </div>
            </div>
       </div> 
       
       <br>
       <br>
       <br>

          <div class="text-xs-right">
            <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update Product">
                            </div>
                        </form>

                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

            </section>
            <!-- /.content -->

	<!-- ///////////////// Start Thambnail Image Update Area ///////// -->

    <section class="content">
        <div class="row">   
         <div class="col-md-12">
                   <div class="box bt-3 border-info">
                     <div class="box-header">
            <h4 class="box-title">Product Thambnail Image <strong>Update</strong></h4>
                     </div>      
           <form method="post" action="{{ route('update-product-thambnail') }}" enctype="multipart/form-data">
           @csrf
   
            <input type="hidden" name="id" value="{{ $products->id }}">
              <input type="hidden" name="old_img" value="{{ $products->product_thambnail }}">
   
               <div class="row row-sm">
   
                   <div class="col-md-3">
   
                <div class="card">
                    <img src="{{ asset($products->product_thambnail) }}" class="card-img-top" style="height: 130px; width: 280px;">
                    <div class="card-body">
                
                    <p class="card-text"> 
                        <div class="form-group">
                            <label class="form-control-label">Change Image <span class="tx-danger">*</span></label>
                    <input type="file" name="product_thambnail" class="form-control" onChange="mainThamUrl(this)"  >
                        <img src="" id="mainThmb">
                        </div> 
                    </p>
                
                    </div>
                </div> 		
   
                   </div><!--  end col md 3		 -->
               </div>	
               <div class="text-xs-right">
              <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update Image">
            </div>
             <br>
             <br>
           </form>
         </div>
        </div>
        </div>
   </div> <!-- // end row  -->   
    </section>
   <!-- ///////////////// End Start Thambnail Image Update Area ///////// -->




		<!-- ///////////////// Start Multiple Image Update Area ///////// -->
        <section class="content">
            <div class="row">       
                   <div class="col-md-12">
                       <div class="box bt-3 border-info">
                         <div class="box-header">
                  <h4 class="box-title">Product Multiple Image <strong>Update</strong></h4>
                        </div>   
               <form method="post" action="{{ route('update_product_img') }}" enctype="multipart/form-data">       
                
                @csrf

                <div class="row row-sm">
                       @foreach($multiimgs as $img)
                       <div class="col-md-3">
       
                        <div class="card">
                            <img src="{{ asset($img->photo_name) }}" class="card-img-top" style="height: 130px; width: 280px;">
                            <div class="card-body">
                            <h5 class="card-title">
                            <a href="{{ route('product.multiimg.delete',$img->id) }}" class="btn btn-sm btn-danger" id="#" title="Delete Data"><i class="fa fa-trash"></i> </a>
                                </h5>
                            <p class="card-text"> 
                                <div class="form-group">
                                    <label class="form-control-label">Change Image <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="file" name="multi_img[{{ $img->id }}]">
                                </div> 
                            </p>                        
                            </div>
                        </div> 	

                       </div><!--  end col md 3		 -->	
                       @endforeach
       
                   </div>	
                   <div class="text-xs-right">
                   <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update Image">
                </div>
                <br>
                <br>
       
               </form>	
             </div>
            </div>
          </div> <!-- // end row  -->
       </section>

    <!-- ///////////////// End Multiple Image Update Area ///////// -->

    </div>


{{-- for sub category  --}}
<script>
    $(document).ready(function() {
      $('select[name="category_id"]').on('change', function(){
          var category_id = $(this).val();
          if(category_id) {
              $.ajax({
                  url: "{{  url('/subsubcategory/subcategory/ajax') }}/"+category_id,
                  type:"GET",
                  dataType:"json",
                  success:function(data) {
                      // sub sub category bug fix
                    $('select[name="subsubcategory_id"]').html('');

                     var d =$('select[name="subcategory_id"]').empty();
                        $.each(data, function(key, value){
                            $('select[name="subcategory_id"]').append('<option value="'+ value.id +'">' + value.sub_category_name + '</option>');
                        });
                  },
              });
          } else {
              alert('danger');
          }
      });


        // sub sub category auto select

        $('select[name="subcategory_id"]').on('change', function(){
                var subcategory_id = $(this).val();
                if(subcategory_id) {
                    $.ajax({
                        url: "{{  url('/subsubcategory/sub-subcategory/ajax') }}/"+subcategory_id,
                        type:"GET",
                        dataType:"json",
                        success:function(data) {
                            var d =$('select[name="subsubcategory_id"]').empty();
                                $.each(data, function(key, value){
                                    $('select[name="subsubcategory_id"]').append('<option value="'+ value.id +'">' + value.subsubcategory_name + '</option>');
                                });
                        },
                    });
                } else {
                    alert('danger');
                }
            });






  });
  </script>


{{-- // Img Tham script --}}

<script type="text/javascript">
	function mainThamUrl(input){
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e){
				$('#mainThmb').attr('src',e.target.result).width(80).height(80);
			};
			reader.readAsDataURL(input.files[0]);
		}
	}	
</script>


{{-- ---------------------------Show Multi Image JavaScript Code ------------------------ --}}

<script>
 
  $(document).ready(function(){
   $('#MultiImg').on('change', function(){ //on file input change
      if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
      {
          var data = $(this)[0].files; //this file data
           
          $.each(data, function(index, file){ //loop though each file
              if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                  var fRead = new FileReader(); //new filereader
                  fRead.onload = (function(file){ //trigger function on successful read
                  return function(e) {
                      var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(80)
                  .height(80); //create image element 
                      $('#preview_img').append(img); //append image to output element
                  };
                  })(file);
                  fRead.readAsDataURL(file); //URL representing the file's data.
              }
          });
           
      }else{
          alert("Your browser doesn't support File API!"); //if File API is absent
      }
   });
  });
   
  </script>
{{-- ================================= End Show Multi Image JavaScript Code. ==================== --}}


@endsection
