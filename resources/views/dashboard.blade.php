@extends('frontend.main_master')

@section('index') 

   <div class="body-content">
       <div class="container">
           <div class="row">
               <div class="col-md-2">
                <img class="cart-img-top" style="border-radius:50%" src="{{ (!empty($user->profile_photo_path))?url('upload/users_images/' 
                    .$user->profile_photo_path):url('upload/avatar-1.png') }}" alt="User Avatar" height="150px" weight="150px">   
                       <br>
                       <br>                   
                 
                     <div class="list-group" id="list-tab" role="tablist">
                       <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="{{ url('dashboard') }}" role="tab" aria-controls="home">Home</a>
                       <a class="list-group-item list-group-item-success" id="list-profile-list" data-toggle="list" href="{{ route('user.profile') }}" role="tab" aria-controls="profile">Profile Update</a>
                       <a class="list-group-item list-group-item-secondary" id="list-messages-list" data-toggle="list" href="{{ route('change.password') }}" role="tab" aria-controls="messages">Change Password</a>
                       <a class="list-group-item list-group-item-danger" id="list-settings-list" data-toggle="list" href="{{ route('user.logout') }}" role="tab" aria-controls="settings">Logout</a>
                     </div>
                
                 
           </div> 
                <div class="col-md-2">

               </div> 
                <div class="col-md-6">
                 <div class="card">
                   <h2 class="text-center"><span class="text-success">Hi,..</span><strong>{{ Auth::user()->name }}</strong></h2>
                   <h1 class="text-center" >Welcome To Shop Now</h1>
                 </div>
               </div>  {{-- col-md-6 end --}}
           </div> 
       </div>
   </div> 

@endsection
