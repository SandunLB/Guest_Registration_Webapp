<?php

include 'phpqrcode/qrlib.php';

session_start();

include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $nic = $_POST['nic'];
    $phoneNumber = isset($_POST['phoneNumber']) ? $_POST['phoneNumber'] : null;
    $contactPerson = $_POST['contactPerson'];
    $arrivalDate = $_POST['arrivalDate'];
    $arrivalTime = $_POST['arrivalTime'];
    $vehicleNumber = $_POST['vehicleNumber'];
    $purposeOfVisit = isset($_POST['purposeOfVisit']) ? $_POST['purposeOfVisit'] : null;

    // Handle image upload
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if image file is a valid image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false) {
        die("Error uploading image.");
    }

    // Check if file size
    if ($_FILES["image"]["size"] > 50000) {
        // Reduce image size by 90%
        compressImage($_FILES["image"]["tmp_name"], $targetFile, 20);

        // Optionally, you may want to handle the compressed image differently.
    }

    // Continue with the rest of the code for image upload

    // Insert data into GuestDetails table
    $sqlGuest = "INSERT INTO guestdetails (Name, NIC, PhoneNumber, Image) VALUES ('$name', '$nic', '$phoneNumber', '$targetFile')";
    $resultGuest = $conn->query($sqlGuest);

    if (!$resultGuest) {
        die("Error in GuestDetails: " . $conn->error);
    }

    $guestID = $conn->insert_id;

    // Insert data into Purpose table
    $sqlPurpose = "INSERT INTO purpose (GuestID, ContactPerson, Purpose) VALUES ('$guestID', '$contactPerson', '$purposeOfVisit')";
    $resultPurpose = $conn->query($sqlPurpose);

    if (!$resultPurpose) {
        die("Error in Purpose: " . $conn->error);
    }

    // Insert data into VehicleDate table
    $sqlVehicleDate = "INSERT INTO vehicledate (Date, VehicleNumber, GuestID) VALUES ('$arrivalDate', '$vehicleNumber', '$guestID')";
    $resultVehicleDate = $conn->query($sqlVehicleDate);

    if (!$resultVehicleDate) {
        die("Error in VehicleDate: " . $conn->error);
    }

    // Insert data into Visits table
    $sqlVisits = "INSERT INTO visits (GuestID, Date, Time) VALUES ('$guestID', '$arrivalDate', '$arrivalTime')";
    $resultVisits = $conn->query($sqlVisits);

    if (!$resultVisits) {
        die("Error in Visits: " . $conn->error);
    }

    // Generate QR code data
    $qrCodeData = "Guest ID: $guestID\nName: $name\nNIC: $nic\nPhone: $phoneNumber\nContact Person: $contactPerson\nArrival Date: $arrivalDate\nArrival Time: $arrivalTime\nVehicle Number: $vehicleNumber\nPurpose: $purposeOfVisit";

    // Output the QR code to a file
    $qrCodePath = "qrcodes/qrcode_$guestID.png";
    QRcode::png($qrCodeData, $qrCodePath);

    // Update the guest record with the QR code path
    $updateQRCodePath = "UPDATE guestdetails SET QRCodePath = '$qrCodePath' WHERE GuestID = $guestID";
    $conn->query($updateQRCodePath);

    // Redirect to success.php with parameters
    header("Location: display_qr.php?qrCodePath=$qrCodePath&name=$name&guestID=$guestID");
    exit;

}

$conn->close();

function compressImage($sourcePath, $outputPath, $quality) {
    // Get original image dimensions
    list($width, $height) = getimagesize($sourcePath);

    // Create a new image from the original
    $sourceImage = imagecreatefromstring(file_get_contents($sourcePath));

    // Calculate new dimensions
    $newWidth = $width * ($quality / 100);
    $newHeight = $height * ($quality / 100);

    // Create a new true color image with reduced dimensions
    $newImage = imagecreatetruecolor($newWidth, $newHeight);

    // Copy and resize the original image to the new image
    imagecopyresampled($newImage, $sourceImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

    // Save the compressed image
    imagejpeg($newImage, $outputPath, $quality);

    // Free up memory
    imagedestroy($sourceImage);
    imagedestroy($newImage);
}
?>
