<!-- <h2><?php echo $title; ?></h2> -->

<?php echo validation_errors(); ?>

<?php echo form_open('JJG_Pharma/index.php/Projjg_webcoder/profile?action=edit'); 
//for some reason needed a more complete path than tutorial...
?>

      <table>
      <tr>
        <td>FirstName</td>
        <td><input type="text" name="firstname" class="userInput" value="<?php echo set_value('firstname'); ?>"></td>
        
      </tr>
      <tr>
        <td>LastName</td>
        <td><input type="text" name="lastname" class="userInput" value="<?php echo set_value('lastname'); ?>"></td>    
      </tr>
      
      <tr>
        <td>Email</td>
        <td><input type="text" name="email" class="userInput" value="<?php echo set_value('email'); ?>"></td>
      </tr>
      <tr>
        <td>Phone</td>
        <td><input type="text" name="phone" class="userInput" value="<?php echo set_value('phone'); ?>"></td>
      </tr>
      <tr>
        <td>Gender</td>
        <td><input type="text" name="gender" class="userInput" value="<?php echo set_value('gender'); ?>"></td>
      </tr>
      <tr>
        <td>Age</td>
        <td><input type="text" name="age" class="userInput" value="<?php echo set_value('age'); ?>"></td>  
      </tr>
      <tr>
       
      <tr>
        <td></td>
        <td><input type="submit" name="update" value="Update Info"></td>
      </tr>
      </table>
    </form>

 