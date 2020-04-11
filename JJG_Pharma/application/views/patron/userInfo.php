<table>
            <tr>
                <td>User Name: <?php echo $u->getUserName()?></td>
            </tr><tr>
                <td>First Name: <?php echo $u->getFirstName()?></td>
                <td>Last Name: <?php echo $u->getLastName()?></td>
            </tr><tr>
                <td>Email Address: <?php echo $u->getEmail()?></td>
                <td>Phone Number: <?php echo $u->getPhone()?></td>
            </tr><tr>
                <td>Age: <?php echo $u->getAge()?></td>
                <td>Gender: <?php echo $u->getGender()?></td>
            </tr>
            <tr>
                <td>
                    <form action="lab09-jla-22-logout.php" method="POST">
                        <input type="hidden" name="logout">
                        <button type="submit" class="btn btn-primary">Logout</button>
                    </form>
                </td>
            </tr>
        </table>