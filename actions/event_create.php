<?php
session_start();
require_once '../config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../pages/login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $conn->real_escape_string($_POST['title']);
    $description = $conn->real_escape_string($_POST['description']);
    $event_date = $conn->real_escape_string($_POST['event_date']);

    $sql = "INSERT INTO events (title, description, event_date) VALUES ('$title', '$description', '$event_date')";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['success'] = "Event created successfully.";
        header("Location: ../admin/index.php");
        exit();
    } else {
        $_SESSION['error'] = "Error: " . $conn->error;
        header("Location: ../admin/index.php");
        exit();
    }
} else {
    // Show event creation form
    include '../includes/header.php';
    include '../includes/navbar.php';
    ?>

    <div class="container">
        <h2>Create New Event</h2>
        <form action="event_create.php" method="POST">
            <label for="title">Title:</label><br />
            <input type="text" name="title" id="title" required /><br />
            <label for="description">Description:</label><br />
            <textarea name="description" id="description" rows="4"></textarea><br />
            <label for="event_date">Event Date:</label><br />
            <input type="date" name="event_date" id="event_date" required /><br /><br />
            <button type="submit">Create Event</button>
        </form>
    </div>

    <?php
    include '../includes/footer.php';
}
?>
