 <div class="container">

   <div class="card o-hidden border-0 shadow-lg my-5 col-sm-6 mx-auto ">
     <div class="card-body p-0">
       <!-- Nested Row within Card Body -->
       <div class="row">

         <div class="col ">
           <div class="p-5">
             <div class="text-center">
               <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
             </div>
             <form class="user text-center" action="<?= base_url('auth/register') ?>" method="post">

               <div class="form-group  ">
                 <input type="name" class="form-control form-control-user text-center" id="name" placeholder="Full Name" name="name">
                 <?= form_error('name', '<div class="text-danger">', '</div>'); ?>
               </div>
               <div class="form-group">
                 <input type="email" class="form-control text-center form-control-user" id="email" placeholder="Email Address" name="email">
                 <?= form_error('email', '<div class="text-danger">', '</div>'); ?>
               </div>
               <div class="form-group row">
                 <div class="col-sm-6 mb-3 mb-sm-0">
                   <input type="password" class=" text-center form-control form-control-user" id="password1" placeholder="Password" name="password1">
                   <?= form_error('password1', '<div class="text-danger">', '</div>'); ?>
                 </div>
                 <div class="col-sm-6">
                   <input type="password" class=" text-center form-control form-control-user" id="password2" placeholder="Repeat Password" name="password2">
                   <?= form_error('password2', '<div class="text-danger">', '</div>'); ?>
                 </div>
               </div>
               <button href="<?= base_url('auth/register'); ?>" class="btn btn-primary btn-user btn-block">
                 Register Account
               </button>
               <hr>

             </form>
             <hr>
             <div class="text-center">
               <a class="small" href="forgot-password.html">Forgot Password?</a>
             </div>
             <div class="text-center">
               <a class="small" href="<?= base_url(); ?>">Already have an account? Login!</a>
             </div>
           </div>
         </div>
       </div>
     </div>
   </div>

 </div>