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
     <h3 class="box-title">Edit Sub Category</h3>
   </div>
   <!-- /.box-header -->
   <div class="box-body">
       <div class="table-responsive">       

         <form  method="POST" action="{{ route('subcategory.update') }}" >            
            @csrf   
            <input type="hidden" name="id" value="{{ $subcategory->id }}">
            <div class="form-group">
                <h5> Category Name <span class="text-danger">*</span></h5>
                <div class="controls">
                    <select name="category_id"  required="" id="category_id" class="form-control" aria-invalid="false">
                       
                        <option value="" selected="" disabled="" >Select Category </option>                     
                      
                        @foreach($category as $category)
                        <option value="{{ $category->id }}" {{ $category->id == $subcategory->category_id ?'selected': '' }}>{{ $category->category_name }}</option>
                        @endforeach                             
                      
                    </select>
                    @error('category_id')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>	
                    </span>
                @enderror
            </div>

                  <div class="form-group">
                      <h5> <span class="text-danger">*</span> Sub Category Name</h5>
                      <div class="controls">
                      <input type="text" id="sub_category_name" value="{{ $subcategory->sub_category_name }}" name="sub_category_name" class="form-control" > 
                       
                      @error('sub_category_name')
                      <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>	
                      </span>
                  @enderror                     
                     </div>
                      </div>

                  <div class="text-xs-right">
                  <input type="submit" class="btn btn-rounded btn-info" value="Update Sub Category">
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

