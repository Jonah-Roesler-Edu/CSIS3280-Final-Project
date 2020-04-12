
<div class="container">
    <div class = "row">
        <h3>Transaction List</h3>
    </div>
    <div class = "row">
        <table>
            <thead>
                <th>Transaction ID</th>
                <th>Medicine Name</th>
                <th>Date</th>
                <!-- <th>Price</th> -->
            </thead>
            <tbody>
                <?php
                foreach($transactions as $transaction) {
                    echo "<tr>";
                        echo "<td>";
                        echo $transaction["transaction"]->TransactionID;
                        echo "</td>";
                        echo "<td>";
                        echo $transaction["medicine"]->MedicineName;
                        echo "</td>";
                        echo "<td>";
                        echo $transaction["transaction"]->TransDate;
                        echo "</td>";
                    echo "</tr>";  
                }
                    ?>
            </tbody>
        </table>
    </div>
</div>

