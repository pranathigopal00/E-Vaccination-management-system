<?php
$Server = "localhost";
$username = "root";
$password = "";
$db = "vcc";
$con = mysqli_connect($Server,$username,$password,$db);
if(!$con)
{
    die("connection failed : ".mysqli_connect_error());
}
$resultMessage = ""; // Initialize the variable to store the result message
if (isset($_POST['save'])) 
{
    $sql = "insert into form values('".$_POST['checkVaccine']."','".$_POST['FirstName']."','".$_POST['LastName']."','".$_POST['dob']."','".$_POST['Email']."','".$_POST['Mobile']."','".$_POST['Gender']."','".$_POST['Address']."','".$_POST['vaccineName']."','".$_POST['vaccineDate']."')";
    echo "<h2>Thank you, your information has been stored in our Database.</h2>";
}
elseif (isset($_POST['check'])) {
    // Check if the entered vaccine is present or not
    $checkVaccineName = mysqli_real_escape_string($con, $_POST['checkVaccine']);

    // Check if the vaccine exists in your database
    $sql = "SELECT * FROM vaccine_table WHERE vaccineName = '$checkVaccineName'";
    $result = mysqli_query($con, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $resultMessage = "Vaccine '$checkVaccineName' is present.";
    } else {
        $resultMessage = "Vaccine '$checkVaccineName' is not present.";
    }
}



mysqli_close($con);
?>

<!-- Display the result message within the HTML structure -->
<!DOCTYPE html>
<html>
<head>
    <title>Your Page Title</title>
</head>
<body>

<!-- Your existing HTML content goes here -->

<?php
// Display the result message
if (!empty($resultMessage)) {
    echo "<p>$resultMessage</p>";
}
?>

</body>
</html>