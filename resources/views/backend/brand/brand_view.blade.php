 @extends('admin.admin_master')

 {{-- section id is yeild name  --}}

 @section('admin')

 <div class="container-full"> 
  <section class="content">

 <div class="row">
     <div class="col-lg-8">

        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Data Table With Full Features</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
              <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                      <tr>
                          <th>Brand Name</th>
                          <th>Brand Name</th>
                          <th>Img</th>
                          <th>Action</th>
                         
                      </tr>
                  </thead>
                  <tbody>

                    @foreach ($brands as $item)
                    <tr>
                        <td>{{ $item->brand_name_cats_eye }}r</td>
                        <td>{{ $item->brand_name_easy }}</td>
                        <td>                          
                          <img src="{{ asset($item->brand_image) }}" style="height:40px; width:70px;">
                                                   
                       
                        </td>
                        <td>
                            <a href="{{ route('brand.edit', $item->id ) }}" class="btn btn-success">Edit</a> 

                            <a href="{{ route('brand.delete', $item->id ) }}" class="btn btn-danger" id="#">Delete</a>
                        </td>  
                        
                        {{-- <td>
                          <a href="{{url('brand/destroy/'.$item->id)}}" onclick=" return confirm('Are you sure data deleted ') " class="btn btn-danger">Delete</a>
                        </td> --}}
                        
                    </tr>  
                    @endforeach
                      
                      
                  </tbody>
              
                </table>
                </div> <!-- table res.. end -->
              </div>  <!-- box body end -->      
           </div>      <!-- box end -->       
      </div> <!-- col end --> 



<!--================================form add brand======================================- -->

<div class="col-lg-4">

  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Add Brands</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="table-responsive">
         

          <form  method="POST" action="{{ route('brand.store') }}" enctype="multipart/form-data" >
            @csrf           
             
                   <div class="form-group">
                       <h5> <span class="text-danger">*</span> Cats Eye Brand</h5>
                       <div class="controls">
                       <input type="text" id="brand_name_cats_eye" name="brand_name_cats_eye" class="form-control" > 
                        
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
                       <input type="text"  id="brand_name_easy" name="brand_name_easy" class="form-control" > 
                      
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
                   <input type="submit" class="btn btn-rounded btn-info" value="Add Brand">
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

