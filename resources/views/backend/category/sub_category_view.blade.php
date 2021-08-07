@extends('admin.admin_master')

{{-- section id is yeild name  --}}

@section('admin')

<div class="container-full"> 
 <section class="content">

<div class="row">
    <div class="col-lg-8">

       <div class="box">
         <div class="box-header with-border">
           <h3 class="box-title">Sub Category List</h3>
         </div>
         <!-- /.box-header -->
         <div class="box-body">
             <div class="table-responsive">
               <table id="example1" class="table table-bordered table-striped">
                 <thead>
                     <tr>
                         <th> Sub Category Id</th>                     
                         <th>Category Id</th>                     
                         <th>Sub Category Name</th>
                         <th>Action</th>
                        
                     </tr>
                 </thead>
                 <tbody>

                   @foreach ($subcategory as $item)
                   <tr>
                    <td>  {{ $item->id }}</td>
                    <td>  {{ $item->category_id }}</td>          
                     <td>{{ $item->sub_category_name }}</td>
                      
                     
                       <td width="30%">
                           <a href="{{ route('subcategory.edit', $item->id ) }}" class="btn btn-success">Edit</a> 

                           <a href="{{ route('subcategory.delete', $item->id ) }}" class="btn btn-danger" id="#">Delete</a>
                       </td>  
                       
                       
                   </tr>  
                   @endforeach
                     
                     
                 </tbody>
             
               </table>
               </div> <!-- table res.. end -->
             </div>  <!-- box body end -->      
          </div>      <!-- box end -->       
     </div> <!-- col end --> 



<!--================================form add Category======================================- -->

<div class="col-lg-4">

 <div class="box">
   <div class="box-header with-border">
     <h3 class="box-title">Add Sub Category</h3>
   </div>
   <!-- /.box-header -->
   <div class="box-body">
       <div class="table-responsive">
        

         <form  method="POST" action="{{ route('subcategory.store') }}" >
            
            @csrf   

            <div class="form-group">
                <h5> Category Name <span class="text-danger">*</span></h5>
                <div class="controls">
                    <select name="category_id"  required="" id="category_id" class="form-control" aria-invalid="false">
                        <option value="" selected="" disabled="" >Select Category </option>
                        @foreach($categorys as $category)
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
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
                      <input type="text" id="sub_category_name" name="sub_category_name" class="form-control" > 
                       
                      @error('sub_category_name')
                      <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>	
                      </span>
                  @enderror                     
                     </div>
                      </div>


                  <div class="text-xs-right">
                  <input type="submit" class="btn btn-rounded btn-info" value="Add Sub Category">
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

