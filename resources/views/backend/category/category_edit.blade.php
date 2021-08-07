@extends('admin.admin_master')

{{-- section id is yeild name  --}}

@section('admin')

<div class="container-full"> 
 <section class="content">

<div class="row">

<!--================================form add Category======================================- -->

<div class="col-lg-12">

 <div class="box">
   <div class="box-header with-border">
     <h3 class="box-title">Edit  Category</h3>
   </div>
   <!-- /.box-header -->
   <div class="box-body">
       <div class="table-responsive">
        

         <form  method="POST" action="{{ route('category.update', $category->id ) }}" >
             @csrf    
             
             <input type="hidden" name="id" value="{{ $category->id }}" />
            
                  <div class="form-group">
                      <h5> <span class="text-danger">*</span> Category Name</h5>
                      <div class="controls">
                      <input type="text" id="category_name" value="{{ $category->category_name }}" name="category_name" class="form-control" > 
                       
                      @error('category_name')
                      <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>	
                      </span>
                  @enderror
                     
                     </div>

                                        


                      </div>                  
              
                  <div class="form-group">
                      <h5>Category Icon <span class="text-danger">*</span></h5>
                      <div class="controls">
                      <input type="text"  id="category_icon" value="{{ $category->category_icon }}" name="category_icon" class="form-control" > 
                     
                      @error('category_icon')
                      <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>	
                      </span> 
                  @enderror
                     
                     </div> 
                      </div>   

               </div>   
              
                  <div class="text-xs-right">
                  <input type="submit" class="btn btn-rounded btn-info" value="Update Category">
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

