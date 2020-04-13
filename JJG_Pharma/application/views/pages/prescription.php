
<div class="container">
    <div class = "row">
        <h3>Add Prescription</h3>    
    </div>
    <div class = "row">
        <form method = "POST" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
            <div class = "column">
                <p>Medicine Name</p>
                <input type="text" name="medicinename" value="">
            </div>
            <div class = "column">
                <p>Description</p>
                <input type="text" name="description" value="">
            </div>
            <input type="submit" name="submit" value="create">
        </form>
    </div>
    <div class = "row">
        <h3>Prescription List</h3>
    </div>
    <div class = "row">
        <table>
            <thead>
                <th>MedicineName</th>
                <th>Description</th>
            </thead>
            <tbody>
                <?php
                if(count($prescriptions) != 0) {
                    foreach($prescriptions as $prescritpion) {
                        echo "<tr>";
                            echo "<td>";
                            echo $prescritpion->MedicineName;
                            echo "</td>";
                            echo "<td>";
                            echo $prescritpion->Description;
                            echo "</td>";
                            ?>
                            <td>
                            <form method = "POST" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
                                <input type="hidden" name="prescriptionid" value="<?php echo $prescritpion->PrescriptionID; ?>">
                                <input type="submit" name="submit" value="delete">
                            </form>
                            </td>
                            <td>
                            <form method = "GET" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
                                <input type="hidden" name="prescriptionid" value="<?php echo $prescritpion->PrescriptionID; ?>">
                                <input type="submit" name="submit" value="edit">
                            </form>
                            </td>
                            <?php
                        echo "</tr>";  
                    }
                } else {
                    echo "You have no prescriptions.";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

