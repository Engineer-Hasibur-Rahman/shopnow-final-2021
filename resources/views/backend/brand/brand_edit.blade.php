@extends('admin.admin_master')

{{-- section id is yeild name  --}}

@section('admin')

<div class="container-full"> 
 <section class="content">

<div class="row">
   
<!--================================form add brand======================================- -->

<div class="col-lg-12">

 <div class="box">
   <div class="box-header with-border">
     <h3 class="box-title">Add Brands</h3>
   </div>
   <!-- /.box-header -->
   <div class="box-body">
       <div class="table-responsive">
        

         <form  method="POST" action="{{ route('brand.update', $brands->id) }}" enctype="multipart/form-data" >
           @csrf           
            
            <input type="hidden" name="id" value="{{ $brands->id }}">
            <input type="hidden" name="old_image" value="{{ $brands->brand_image }}">

                  <div class="form-group">
                      <h5> <span class="text-danger">*</span> Cats Eye Brand</h5>
                      <div class="controls">
                      <input type="text" id="brand_name_cats_eye" value="{{ $brands->brand_name_cats_eye }}" name="brand_name_cats_eye" class="form-control" > 
                       
                      @error('brand_name_cats_eye')
                      <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>	
                      </span>
                  @enderror
                     
                     </div>

                                        


                      </div>                  
              
                  <div class="form-group">
                      <h5>Easy Brand <span class="text-danger">*</span></h5>
                      <div class="controls">
                      <input type="text"  id="brand_name_easy" value="{{ $brands->brand_name_easy }}" name="brand_name_easy" class="form-control" > 
                     
                      @error('brand_name_easy')
                      <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>	
                      </span>
                  @enderror
                     
                     </div>             


                      </div>                   

                   
                      <div class="form-group">
                      <h5> Brand Img <span class="text-danger">*</span></h5>
                      <div class="controls">
                      <input type="file" id="brand_image" name="brand_image" class="form-control" > 
                       
                     
                      @error('brand_image')
                      <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>	
                      </span>
                  @enderror
                     
                     
                     </div>




                      </div>   
              
                  <div class="text-xs-right">
                  <input type="submit" class="btn btn-rounded btn-info" value="Update Brand">
              </div>

          </form>





         </div> <!-- table res.. end -->
       </div>  <!-- box body end -->      
    </div>      <!-- box end -->       
</div> <!-- col end -->

</div> <!--  row end-->
</section> <!--  content end-->
</div> <!--  row end-->






@endsection

