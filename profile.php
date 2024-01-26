<?php
session_start();
require('config.php');

if (!isset($_SESSION['email'])) {
    header("location:login.php");
}

$sql= "SELECT * FROM admin";
$result=mysqli_query($conn,$sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
} else {
    echo "No data found";
}

?><!DOCTYPE html>
<html lang="en">
<?php
include('head.php');
?>

<body>
    <div class="d-flex">
        <?php
        include 'sidebar.php';
        ?>
        <div class="right">
            <?php
            include 'topbar.php'
            ?>
            <h1>Profile</h1>
            <div class="container p-2">
                <form action="" method="post">
                    <div class="form-group d-flex justify-content-center align-items-center m-3">
                        <label for="name" class="me-2">Name</label>
                        <input type="text" class="form-control" name="name" id="name" aria-describedby="helpId" placeholder="" value="<?= $row['name'] ?>" readonly>
                        <div class="btn btn-primary ms-1" onclick="enableEdit('name')">Edit</div>
                    </div>
                    <!-- Add similar HTML structure for other fields (Email, Image) -->

                    <div class="form-group d-flex justify-content-center align-items-center m-3">
                        <label for="email" class="me-2">Email</label>
                        <input type="email" class="form-control" name="email" id="email" aria-describedby="helpId" placeholder="" value="<?= $row['email'] ?>" readonly>
                        <div class="btn btn-primary ms-1" onclick="enableEdit('email')">Edit</div>
                    </div>

                    <div class="form-group d-flex justify-content-center align-items-center m-3">
                        <label for="image" class="me-2">Image</label>
                        <input type="file" class="form-control" name="image" id="image" aria-describedby="helpId" placeholder="">
                        <div class="btn btn-primary ms-1" onclick="enableEdit('image')">Edit</div>
                    </div>

                </form>

            </div>
        </div>
    </div>
    <script src="js/bootstrap.bundle.js"></script>
    <script>
        function enableEdit(fieldName) {
            var inputField = document.getElementById(fieldName);
            inputField.removeAttribute('readonly');
            inputField.focus();

            // Add a Save button dynamically
            var saveButton = document.createElement('div');
            saveButton.className = 'btn btn-success ms-1';
            saveButton.innerHTML = 'Save';
            saveButton.onclick = function () {
                saveChanges(fieldName);
            };

            // Replace the Edit button with Save button
            var editButton = inputField.nextElementSibling;
            editButton.parentNode.replaceChild(saveButton, editButton);
        }

        function saveChanges(fieldName) {
            var inputValue = document.getElementById(fieldName).value;

            // Make an AJAX request to update the name in the database
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'update_profile.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Handle the response, you may update UI or show a message
                    console.log(xhr.responseText);
                }
            };
            xhr.send('field=' + fieldName + '&value=' + inputValue);
        }
    </script>
</body>

</html>