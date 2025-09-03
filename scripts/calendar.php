<?php

include "connection.php";

$visit_count = 0;
$events_added = 0;
$events_edited = 0;
$events_deleted = 0;
$downloads = 0;

$today = date('Y-m-d');
$stats_query = "INSERT INTO visitor_stats (visit_date, visit_count) 
                VALUES ('$today', 1) 
                ON DUPLICATE KEY UPDATE visit_count = visit_count + 1";
$conn->query($stats_query);

$stats_result = $conn->query("SELECT * FROM visitor_stats WHERE visit_date = '$today'");
if ($stats_result && $stats_result->num_rows > 0) {
    $stats = $stats_result->fetch_assoc();
    $visit_count = $stats['visit_count'];
    $events_added = $stats['events_added'];
    $events_edited = $stats['events_edited'];
    $events_deleted = $stats['events_deleted'];
    $downloads = $stats['downloads'];
}

$successMsg = '';
$errorMsg = '';
$eventsFromDB = [];

if ($_SERVER["REQUEST_METHOD"] === "POST" && ($_POST['action'] ?? '') === "add") {
    $eventName = trim($_POST["event_name"] ?? '');
    $eventDesc = trim($_POST["event_description"] ?? '');
    $start = $_POST["start_date"] ?? '';
    $end = $_POST["end_date"] ?? '';
    $startTime = $_POST["start_time"] ?? '';
    $endTime = $_POST["end_time"] ?? '';

    if ($eventName && $eventDesc && $start && $end) {
        $stmt = $conn->prepare(
            "INSERT INTO appointments (event_name, event_description, start_date, end_date, start_time, end_time) VALUES (?, ?, ?, ?, ?, ?)"
        );

        $stmt->bind_param("ssssss", $eventName, $eventDesc, $start, $end, $startTime, $endTime);

        if ($stmt->execute()) {
            $conn->query("UPDATE visitor_stats SET events_added = events_added + 1 WHERE visit_date = '$today'");

            $stmt->close();
            header("Location: " . $_SERVER['PHP_SELF'] . "?success=1");
            exit;
        }
    } else {
        header("Location: " . $_SERVER['PHP_SELF'] . "?error=1");
        exit;
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && ($_POST["action"] ?? '') === "edit") {
    $id = $_POST["event_id"] ?? null;
    $eventName = trim($_POST["event_name"] ?? '');
    $eventDesc = trim($_POST["event_description"] ?? '');
    $start = $_POST["start_date"] ?? '';
    $end = $_POST["end_date"] ?? '';
    $startTime = $_POST["start_time"] ?? '';
    $endTime = $_POST["end_time"] ?? '';

    if ($id && $eventName && $eventDesc && $start && $end) {
        $stmt = $conn->prepare(
            "UPDATE appointments SET event_name = ?, event_description = ?, start_date = ?, end_date = ?, start_time = ?, end_time = ? WHERE id = ?"
        );

        $stmt->bind_param("ssssssi", $eventName, $eventDesc, $start, $end, $startTime, $endTime, $id);

        if ($stmt->execute()) {
            $conn->query("UPDATE visitor_stats SET events_edited = events_edited + 1 WHERE visit_date = '$today'");

            $stmt->close();
            header("Location: " . $_SERVER['PHP_SELF'] . "?success=2");
            exit;
        }
    } else {
        header("Location: " . $_SERVER['PHP_SELF'] . "?error=2");
        exit;
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && ($_POST["action"] ?? '') === "delete") {
    $id = $_POST["event_id"] ?? null;

    if ($id) {
        $stmt = $conn->prepare("DELETE FROM appointments WHERE id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $conn->query("UPDATE visitor_stats SET events_deleted = events_deleted + 1 WHERE visit_date = '$today'");

            $stmt->close();
            header("Location: " . $_SERVER['PHP_SELF'] . "?success=3");
            exit;
        }
    }
}

if (isset($_GET["success"])) {
    $successMsg = match ($_GET["success"]) {
        '1' => "Appointment added successfully",
        '2' => "Appointment updated successfully",
        '3' => "Appointment deleted successfully",
        default => ""
    };
}

if (isset($_GET["error"])) {
    $errorMsg = "Error occured. Please check your input.";
}

$result = $conn->query("SELECT * FROM appointments");

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $start = new DateTime($row["start_date"]);
        $end = new DateTime($row["end_date"]);

        while ($start <= $end) {

            $eventsFromDB[] = [
                "id" => $row["id"],
                "title" => $row["event_name"],
                "date" => $start->format("d-m-Y"),
                "start" => $row["start_date"],
                "end" => $row["end_date"],
                "start_time" => $row["start_time"],
                "end_time" => $row["end_time"],
                "description" => $row["event_description"]
            ];

            $start->modify("+1 day");
        }
    }
}

if (isset($_GET['export']) && $_GET['export'] == 'csv') {
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=calendar_events.csv');

    $output = fopen('php://output', 'w');
    fputcsv($output, array('Title', 'Description', 'Start Date', 'End Date', 'Start Time', 'End Time'));

    $export_result = $conn->query("SELECT * FROM appointments");
    if ($export_result && $export_result->num_rows > 0) {
        while ($row = $export_result->fetch_assoc()) {
            fputcsv($output, array(
                $row['event_name'],
                $row['event_description'],
                $row['start_date'],
                $row['end_date'],
                $row['start_time'],
                $row['end_time']
            ));
        }
    }

    $conn->query("UPDATE visitor_stats SET downloads = downloads + 1 WHERE visit_date = '$today'");

    fclose($output);
    exit();
}

$conn->close();

?>