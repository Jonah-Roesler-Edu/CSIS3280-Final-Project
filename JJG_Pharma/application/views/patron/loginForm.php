
<h2><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('JJG_Pharma/index.php/patron/login'); 
//for some reason needed a more complete path than tutorial...
?>


<table>
      <tr>
        <td>UserName</td>
        <td><input type="text" name="userLogin" class="userInput" value="<?php echo set_value('userLogin'); ?>"></td>
      </tr>
      <tr>
        <td>Password</td>
        <td><input type="text" name="passLogin" class="userInput" ></td>
      </tr>
      <tr>
      <td></td>
      <td><input type="submit" name="register" value="Login"></td>
    </tr>
    </table>
  </form>
