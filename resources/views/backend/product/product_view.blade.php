@extends('admin.admin_master')

{{-- section id is yeild name  --}}

@section('admin')

<div class="container-full"> 
 <section class="content">

<div class="row">
    <div class="col-lg-12">

       <div class="box">
         <div class="box-header with-border">
           <h3 class="box-title">All Product List</h3>
         </div>
         <!-- /.box-header -->
         <div class="box-body">
             <div class="table-responsive">
               <table id="example1" class="table table-bordered table-striped">
                 <thead>
                     <tr>
                        <th>Image </th>
                        <th>Product Name</th>    
                        <th>Product Price</th>  
                        <th>Quantity</th>                  
                        <th>Discount </th>
                        <th>Status </th>
                        <th>Action</th>
                        
                     </tr>
                 </thead>
                 <tbody>

                    @foreach($product as $item)
                    <tr>
                       <td> <img src="{{ asset($item->product_thambnail) }}" style="width: 60px; height: 50px;">  </td>
                       <td>{{ $item->product_name }}</td>  
                       <td>{{ $item->selling_price }} $</td>                
                        <td>{{ $item->product_qty }}</td>


                        <td>                         

                           @if($item->discount_price == NULL)
                              <span class="badge badge-pill badge-danger">No Discount</span>
                           @else
                        
                           {{-- @php
                              $amount = $item->selling_price * $item->discount_price;
                              // $discount = ((100*$item->discount_price)/$item->selling_price);
                              $discount = ($item->discount_price * 100)/$item->selling_price;
                           @endphp --}}

                              @php
                              $amount = $item->selling_price - $item->discount_price;
                              
                              $discount = ($amount/$item->selling_price) * 100;
                              @endphp


                                {{--only  Discount Price Show not discount % amount --}}
                                {{-- @php
                                $amount = $product->selling_price - $product->discount_price;
                                $discount = ($amount/$product->selling_price) * 100;
                            @endphp --}}


                          <span class="badge badge-pill badge-danger">{{ round($discount) }} %</span>

                           @endif                        
                        
                        </td>


                     <td>
                        @if($item->status == 1)
                           <span class="badge badge-pill badge-success">Active</span>
                        @else
                        <span class="badge badge-pill badge-success">Deactive</span>
                        @endif
                     </td>

                       <td>
                <a href="{{ route('product.edit',$item->id) }}" class="btn btn-primary" title="Product View Data"><i class="fa fa-eye"></i> </a>
                <a href="{{ route('product.edit',$item->id) }}" class="btn btn-info" title="Edit Data"><i class="fa fa-pencil"></i> </a>
                <a href="{{ route('product.delete',$item->id) }}" class="btn btn-danger" title="Delete Data" id="#">
                  <i class="fa fa-trash"></i>   
               </a>
              

                    @if($item->status == 1)
                    <a href="{{ route('product.deactive',$item->id) }}" class="btn btn-danger" title="Product Deactive Now"><i class="fa fa-arrow-down"></i> </a>
                 @else
                 <a href="{{ route('product.active',$item->id) }}" class="btn btn-success" title="Product Active Now"><i class="fa fa-arrow-up"></i> </a>
                 @endif


                       </td>
               
                    </tr>
                     @endforeach
                     
                     
                 </tbody>
             
               </table>
               </div> <!-- table res.. end -->
             </div>  <!-- box body end -->      
          </div>      <!-- box end -->       
     </div> <!-- col end --> 
</div> <!--  row end-->
</section> <!--  content end-->
</div> <!--  row end-->

@endsection

