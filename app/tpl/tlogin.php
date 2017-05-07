
    <?php 
            include 'head_common.php';
            ?>

<div class="login-form">
     <h1>Login</h1>
     
     <div id="mens"></div>
     
     <form class="form-log" action="/stp/login/log" method="post">
     
         <label for="UserName"> Username: <input type="text" class="form-control" placeholder="username " id="username" name="username"> </label> <br>

         <label for="Password"> Password: <input type="password" class="form-control" placeholder="password" id="password" name="password"> </label>
        
        <br>
        
     <button type="submit" class="log-btn" >Log in</button>
     
      </form>
    
   </div>


    <?php 
            include 'footer_common.php';
    ?>