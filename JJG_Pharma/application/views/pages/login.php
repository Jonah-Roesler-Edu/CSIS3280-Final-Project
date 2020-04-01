<div class="header">
  <h1>Login</h1>

  <from method="POST" action="<?php echo $_SERVER["PHP_SELF"];?>">
    <table>
      <tr>
        <td>UserName</td>
        <td><input type="text" name="userLogin" class="userInput"></td>
      </tr>
      <tr>
        <td>Password</td>
        <td><input type="text" name="passLogin" class="userInput"></td>
      </tr>
      <tr>
      <td></td>
      <td><input type="submit" name="register" value="Login"></td>
    </tr>
    </table>
  </from>

</div> 
<div class="header">
    <h1>Register</h1> 
     
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"];?>">
      <table>
      <tr>
        <td>FirstName</td>
        <td><input type="text" name="firstname" class="userInput"></td>
        
      </tr>
      <tr>
        <td>LastName</td>
        <td><input type="text" name="lastname" class="userInput"></td>    
      </tr>
      <tr>
        <td>UserName</td>
        <td><input type="text" name="username" class="userInput"></td>
      </tr>
      <tr>
        <td>Email</td>
        <td><input type="text" name="email" class="userInput"></td>
      </tr>
      <tr>
        <td>Phone</td>
        <td><input type="text" name="phone" class="userInput"></td>
      </tr>
      <tr>
        <td>Gender</td>
        <td><input type="text" name="gender" class="userInput"></td>
      </tr>
      <tr>
        <td>Age</td>
        <td><input type="text" name="age" class="userInput"></td>  
      </tr>
      <tr>
        <td>Password</td>
        <td><input type="text" name="password" class="userInput"></td>
      </tr>
      <tr>
        <td>Confirm Password</td>
        <td><input type="text" name="password2" class="userInput"></td>
      </tr>
      <tr>
        <td></td>
        <td><input type="submit" name="register" value="Register"></td>
      </tr>
      </table>
    </form>

</div> 
  
