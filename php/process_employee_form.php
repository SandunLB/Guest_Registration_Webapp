<?php

include 'phpqrcode/qrlib.php';

session_start();

include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetch data from the form
    $name = $_POST['name'];
    $position = $_POST['position'];
    $employeeID = $_POST['employeeID'];
    $guestName = $_POST['guestName'];
    $nic = $_POST['nic'];
    $phoneNumber = isset($_POST['phoneNumber']) ? $_POST['phoneNumber'] : null;
    $arrivalDate = $_POST['arrivalDate'];
    $arrivalTime = $_POST['arrivalTime'];
    $vehicleNumber = $_POST['vehicleNumber'];
    $purposeOfVisit = isset($_POST['purposeOfVisit']) ? $_POST['purposeOfVisit'] : null;

    // Handle image upload
    //$targetDir = "uploads/";
   // $targetFile = $targetDir . basename($_FILES["image"]["name"]);

    // Rest of your image upload code...

    // Insert data into Staff table
    $insertQuery = "INSERT INTO staff (Name, Position, Employee_ID, Guest_name, NIC, Phone_number, Arrival_Date, Arrival_Time, Vehicle_Number, Purpose_of_visit, QRCodePath, Out_Time) VALUES ('$name', '$position', '$employeeID', '$guestName', '$nic', '$phoneNumber', '$arrivalDate', '$arrivalTime', '$vehicleNumber', '$purposeOfVisit', '', '')";
    $result = $conn->query($insertQuery);

    if (!$result) {
        die("Error in Staff: " . $conn->error);
    }

    // Generate QR code data
    $qrCodeData = "Guest Name: $guestName\nEmployee Name: $name\nEmployee ID: $employeeID\nEmployee Position: $position\nNIC: $nic\nPhone: $phoneNumber\nArrival Date: $arrivalDate\nArrival Time: $arrivalTime\nVehicle Number: $vehicleNumber\nPurpose: $purposeOfVisit";

    // Output the QR code to a file
    $qrCodePath = "qrcodes/qrcode_employee_$employeeID.png";
    QRcode::png($qrCodeData, $qrCodePath);

    // Update the Staff record with the QR code path
    $updateQRCodePath = "UPDATE staff SET QRCodePath = '$qrCodePath' WHERE Employee_ID = '$employeeID'";
    $conn->query($updateQRCodePath);

    // Redirect to success.php with parameters
    header("Location: display_qr.php?qrCodePath=$qrCodePath&name=$name&guestID=$employeeID");
    exit;

} else {
    die("Error uploading image.");
}

$conn->close();

?>
