
<div class="container">

    <div class = "row">
        <h3>Your Doctors</h3>
    </div>
    <div class = "row">
        <table>
            <thead>
                <th>Name</th>
                <th>Specialty</th>
                <th>Email</th>
                <!-- <th>Price</th> -->
            </thead>
            <tbody>
                <?php
                foreach($doctorarr as $doctor) {
                    echo "<tr>";
                        echo "<td>";
                        echo $doctor->getDoctorName();
                        echo "</td>";
                        echo "<td>";
                        echo $doctor->getDoctorType();
                        echo "</td>";
                        echo "<td>";
                        echo $medicine->getDescription();
                        echo "</td>";
                        ?>
                        <td>
                        <form method = "GET" enctype="multipart/form-data">
                            <input type="hidden" name="doctorid" value="<?php echo $doctor->getDoctorID()?>">
                            <input type="submit" name="removedoctor" value="remove">
                        </form>
                        </td>
                        <?php
                    echo "</tr>";  
                }
                    ?>
            </tbody>
        </table>
    </div>

    <div class = "row">
        <h3>All Doctors</h3>
    </div>
    <div class = "row">
        <table>
            <thead>
                <th>Name</th>
                <th>Specialty</th>
                <th>Email</th>
                <!-- <th>Price</th> -->
            </thead>
            <tbody>
                <?php
                foreach($doctorarr as $doctor) {
                    echo "<tr>";
                        echo "<td>";
                        echo $doctor->getDoctorName();
                        echo "</td>";
                        echo "<td>";
                        echo $doctor->getDoctorType();
                        echo "</td>";
                        echo "<td>";
                        echo $medicine->getDescription();
                        echo "</td>";
                        ?>
                        <td>
                        <form method = "GET" enctype="multipart/form-data">
                            <input type="hidden" name="doctorid" value="<?php echo $doctor->getDoctorID()?>">
                            <input type="submit" name="adddoctor" value="Add">
                        </form>
                        </td>
                        <?php
                    echo "</tr>";  
                }
                    ?>
            </tbody>
        </table>
    </div>
</div>

