@extends('admin.admin_master')

{{-- section id is yeild name  --}}

@section('admin')

{{-- js for sub category  --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="container-full"> 
 <section class="content">

<div class="row">
    <div class="col-lg-8">

       <div class="box">
         <div class="box-header with-border">
           <h3 class="box-title">Sub-Sub Category List</h3>
         </div>
         <!-- /.box-header -->
         <div class="box-body">
             <div class="table-responsive">
               <table id="example1" class="table table-bordered table-striped">
                 <thead>
                     <tr>
                        <th> Category Name</th>                  
                        <th> Sub Category Name</th>                  
                         <th>Sub Sub Category Name</th>
                                             
                         <th>Action</th>
                        
                     </tr>
                 </thead>
                 <tbody>

                   
                   @foreach ($subsubcategory as $item)
                   <tr>                 
                    <td> {{ $item['category']['category_name'] }} </td>
                    <td> {{ $item['subcategory']['sub_category_name'] }} </td>
                    <td>{{ $item->subsubcategory_name }}r</td>
                      
                       <td width="30%">
                        {{-- <a href="{{ route('subcategory.edit',$item->id) }}" class="btn btn-info" title="Edit Data"><i class="fa fa-pencil"></i> </a> --}}
                        <a href="{{ route('subsubcategory.edit',$item->id) }}" class="btn btn-info" title="Edit Data"><i class="fa fa-pencil"></i> </a>
                           <a href="{{ route('subsubcategory.delete',$item->id) }}" class="btn btn-danger" id="#">Delete</a>                                                    
                      
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
     <h3 class="box-title">Add Sub Sub Category</h3>
   </div>
   <!-- /.box-header -->
   <div class="box-body">
       <div class="table-responsive">      

         <form  method="POST" action="{{ route('subsubcategory.store') }}" >
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
                        <h5> Sub Category Name <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <select name="subcategory_id"  required="" id="subcategory_id" class="form-control" aria-invalid="false">
                                <option value="" selected="" disabled="" >Select Category </option>                   
                              
                               

                            </select>
                            @error('subcategory_id')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>	
                            </span>
                        @enderror
                    </div>


                  <div class="form-group">
                      <h5>Sub Sub Category Name <span class="text-danger">*</span></h5>
                      <div class="controls">
                      <input type="text"  id="subsubcategory_name" name="subsubcategory_name" class="form-control" > 

                      @error('subsubcategory_name')
                      <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>	
                      </span>
                      @enderror  

                   </div>  
                  </div>

              
                  <div class="text-xs-right">
                  <input type="submit" class="btn btn-rounded btn-info" value="Sub Sub Category Add">
              </div>

          </form>





         </div> <!-- table res.. end -->
       </div>  <!-- box body end -->      
    </div>      <!-- box end -->       
</div> <!-- col end -->

</div> <!--  row end-->
</section> <!--  content end-->
</div> <!--  row end-->


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
  });
  </script>



@endsection

