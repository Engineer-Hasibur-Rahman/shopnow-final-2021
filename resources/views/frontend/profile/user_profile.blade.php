@extends('frontend.main_master')

@section('index') 

   <div class="body-content">
       <div class="container">
           <div class="row">
               <div class="col-md-2">
                  <img class="cart-img-top" style="border-radius:50%" src="{{ (!empty($user->profile_photo_path))?url('upload/users_images/' 
                   .$user->profile_photo_path):url('upload/avatar-4.png') }}" alt="User Avatar" height="150px" weight="150px"> 
                       <br>
                       <br>                   
                 
                     <div class="list-group" id="list-tab" role="tablist">
                       <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">Home</a>
                       <a class="list-group-item list-group-item-success" id="list-profile-list" data-toggle="list" href="{{ route('user.profile') }}" role="tab" aria-controls="profile">Profile Update</a>
                       <a class="list-group-item list-group-item-secondary" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab" aria-controls="messages">Change Password</a>
                       <a class="list-group-item list-group-item-danger" id="list-settings-list" data-toggle="list" href="{{ route('user.logout') }}" role="tab" aria-controls="settings">Logout</a>
                     </div>
                
                 
           </div> 
                <div class="col-md-2">

               </div> 
                <div class="col-md-6">
                 <div class="card">                   
                   <h1 class="text-center" > Profile Update</h1>

               
                       
   <form method="POST" action="{{ route('user.profile.store') }}" enctype="multipart/form-data" >
      @csrf




                   <div class="form-group">
                    <label class="info-title" for="exampleInputEmail1">Name <span>*</span></label>
                    <input type="text" class="form-control unicase-form-control text-input" value="{{ $user->name }}" name="name" id="name" >
                  
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>	
                        </span>
                    @enderror        
                </div>   
                
                <div class="form-group">
                    <label class="info-title" for="exampleInputEmail1">Email <span>*</span></label>
                    <input type="email" class="form-control unicase-form-control text-input" value="{{ $user->email }}" name="email" id="email" >
                  
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>	
                        </span>
                    @enderror
        
                </div>  

                <div class="form-group">
                    <label class="info-title" for="exampleInputEmail1">Phone <span>*</span></label>
                    <input type="number" class="form-control unicase-form-control text-input" value="{{ $user->phone }}" name="phone" id="phone" >
                  
                    @error('phone')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>	
                        </span>
                    @enderror
        
                </div>  

                <div class="form-group">
                    <label class="info-title" for="exampleInputEmail1">Your Photo <span>*</span></label>
                    <input type="file" class="from-control" name="profile_photo_path" id="profile_photo_path" >
                  
                    @error('profile_photo_path')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>	
                        </span>
                    @enderror
        
                </div> 
                
                <div class="form-group">
                    <button type="submit" class="btn btn-danger" > Update Profile</button>
                </div>

             </form>
                


                 </div>
               </div>  {{-- col-md-6 end --}}
           </div> 
       </div>
   </div> 

@endsection
