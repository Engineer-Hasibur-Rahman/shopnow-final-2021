@extends('admin.admin_master')

{{-- section id is yeild name  --}}

@section('admin')

<div class="container-full"> 
 <section class="content">

<div class="row">
    <div class="col-lg-8">

       <div class="box">
         <div class="box-header with-border">
           <h3 class="box-title">Category List</h3>
         </div>
         <!-- /.box-header -->
         <div class="box-body">
             <div class="table-responsive">
               <table id="example1" class="table table-bordered table-striped">
                 <thead>
                     <tr>
                         <th>Category Id</th>                     
                         <th>Category Icon</th>                     
                         <th>Category Name</th>
                         <th>Action</th>
                        
                     </tr>
                 </thead>
                 <tbody>

                   @foreach ($category as $item)
                   <tr>
                    <td>  {{ $item->id }}</td>
                    <td> <span><i class="{{ $item->category_icon }}"></i></span> </td>
                     <td>{{ $item->category_name }}</td>
                      
                     
                       <td width="35%">
                           <a href="{{ route('category.edit', $item->id ) }}" class="btn btn-success">Edit</a> 

                           <a href="{{ route('category.delete', $item->id ) }}" class="btn btn-danger" >Delete</a>
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
     <h3 class="box-title">Add Category</h3>
   </div>
   <!-- /.box-header -->
   <div class="box-body">
       <div class="table-responsive">
        

         <form  method="POST" action="{{ route('category.store') }}" >
            
            @csrf           
            
                  <div class="form-group">
                      <h5> <span class="text-danger">*</span> Category Name</h5>
                      <div class="controls">
                      <input type="text" id="category_name" name="category_name" class="form-control" > 
                       
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
                      <input type="text"  id="category_icon" name="category_icon" class="form-control" > 
                     
                      @error('category_icon')
                      <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>	
                      </span> 
                  @enderror
                     
                     </div> 
                      </div>   

               </div>   
              
                  <div class="text-xs-right">
                  <input type="submit" class="btn btn-rounded btn-info" value="Add Category">
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

