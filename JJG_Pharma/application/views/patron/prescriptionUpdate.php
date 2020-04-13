<div class="container">
    <div class = "row">
        <h3>Edit Prescription</h3>    
    </div>
    <div class = "row">
        <form method = "POST" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
            <div class = "column">
                <p>Medicine Name</p>
            </div>
            <div class = "column">
                <input type="text" name="medicinename" value="<?php echo $editprescription->MedicineName; ?>">
            </div>
            <div class = "column">
                <p>Description</p>
            </div>
            <div class = "column">
                <input type="text" name="description" value="<?php echo $editprescription->Description; ?>">
            </div>
            <input type="hidden" name="prescriptionid" value="<?php echo $editprescription->PrescriptionID; ?>">
            <input type="submit" name="submit" value="edit">
        </form>
    </div>
</div>