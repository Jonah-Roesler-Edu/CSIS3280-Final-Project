
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
                <td>Number of Purchases: <?php echo $NoOfTransactions?></td>
            </tr>
            <tr>
                <td>
                    <form action="logout" method="POST">
                        <button type="submit" class="btn btn-primary">Logout</button>
                    </form>
                </td>
                <td>
                    <form action="" method="GET">
                        <input type="hidden" name="action" value="edit">
                        <button type="submit" class="btn btn-primary">Update Info</button>
                    </form>
                </td>
                <td>
                    <form action="" method="GET">
                        <input type="hidden" name="action" value ="delete">
                        <button type="submit" class="btn btn-primary">Delete Account</button>
                    </form>
                </td>
            </tr>
        </table>