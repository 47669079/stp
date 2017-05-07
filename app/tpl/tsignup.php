
    <?php 
            include 'head_common.php';
            ?>


<div class="signup-form">
     <h1>Sign Up</h1>
     <div id="mens"></div>
     
     <form class="form-signup" action="/stp/signup/sign" method="post">
         
         <label for="Email"> Email: <input type="text" class="form-control" placeholder="email " id="email" name="email"> </label> <br>
     
         <label for="UserName"> Username: <input type="text" class="form-control" placeholder="username " id="username" name="username"> </label> <br>

         <label for="Password"> Password: <input type="password" class="form-control" placeholder="password" id="password" name="password"> </label>
        
        <br>
        
     <button type="submit" class="sig-btn" >Sign In</button>
     
      </form>
       
     </div>
    
     
    
   </div>



    <?php 
            include 'footer_common.php';
    ?>