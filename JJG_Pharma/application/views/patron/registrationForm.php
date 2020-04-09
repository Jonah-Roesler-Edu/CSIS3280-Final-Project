<h2><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('JJG_Pharma/index.php/patron/register'); 
//for some reason needed a more complete path than tutorial...
?>

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

 