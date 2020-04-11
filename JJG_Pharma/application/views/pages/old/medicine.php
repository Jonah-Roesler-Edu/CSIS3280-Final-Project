
<div class="container">
    <div class = "row">
        <h1>Medicine List</h1>
    </div>
    <div class = "row">
        <table>
            <thead>
                <th>Medicine</th>
                <th>Treatment for:</th>
                <th>Description</th>
                <!-- <th>Price</th> -->
            </thead>
            <tbody>
                <?php foreach($medicineArr as $medicine) {
                    echo "<tr>";
                        echo "<td>";
                        echo $medicine->getMedicineName();
                        echo "</td>";
                        echo "<td>";
                        echo $medicine->getTreatment();
                        echo "</td>";
                        echo "<td>";
                        echo $medicine->getDescription();
                        echo "</td>";
                        ?>
                        <td>
                        <form method = "GET" enctype="multipart/form-data">
                            <input type="hidden" name="medicineid" value="<?php echo $medicine->getMedicineID ?>">
                            <input type="submit" name="addtocart" value="Add to cart">
                        </form>
                        </td>
                        <td>
                            <form method = "GET" enctype="multipart/form-data">
                                <input type="hidden" name="medicineid" value="<?php echo $medicine->getMedicineID ?>">
                                <input type="submit" name="removecart" value="remove from cart">
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

