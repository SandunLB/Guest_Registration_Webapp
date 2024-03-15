<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['guestID'])) {
    $guestID = $_GET['guestID'];

    // Fetch guest name based on the guestID
    $fetchGuestNameQuery = "SELECT Name FROM guestdetails WHERE GuestID = $guestID";
    $result = $conn->query($fetchGuestNameQuery);

    if ($result->num_rows > 0) {
        // Guest exists, return the guest name
        $row = $result->fetch_assoc();
        echo $row['Name'];
    } else {
        // Guest not found
        echo "Guest Not Found";
    }
} else {
    // Invalid request
    echo "Invalid Request";
}

// Close the database connection
$conn->close();
?>
