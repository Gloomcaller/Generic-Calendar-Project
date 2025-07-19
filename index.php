<?php
include "./scripts/calendar.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar</title>
    <meta name="description" content="Portfolio Calendar Project">
    <link rel="stylesheet" href="./styles/styles.css">
    <!-- <link rel="icon" type="image/png" href="./favicon.png"> -->
    <!-- Temp for now -->
</head>

<body>
    <header>
        <h1>Calendar</h1>
        <div class="clock-container">
            <div id="clock"></div>
        </div>
    </header>


    <?php if ($successMsg): ?>
        <div class="alert success"><?= htmlspecialchars($successMsg) ?></div>
    <?php endif; ?>
    <?php if ($errorMsg): ?>
        <div class="alert error"><?= htmlspecialchars($errorMsg) ?></div>
    <?php endif; ?>

    <div class="calendar">
        <div class="nav-btn-container">
            <button class="nav-btn" onclick="changeMonth(-1)">⏮️</button>
            <h2 id="monthYear"></h2>
            <button class="nav-btn" onclick="goToToday()">Today</button>
            <button class="nav-btn" onclick="changeMonth(1)">⏭️</button>
        </div>

        <div class="calendar-grid" id="calendar"></div>
    </div>

    <div class="modal" id="eventModal">
        <div class="modal-content">


            <div id="eventSelectorWrapper">
                <label for="eventSelector">
                    <strong>Select Event:</strong>
                </label>
                <select id="eventSelector">
                    <option disabled selected>Choose Event...</option>
                </select>
            </div>

            <form id="eventForm" method="POST">
                <input id="formAction" type="hidden" name="action" value="add">
                <input type="hidden" name="event_id" id="eventId">

                <label for="courseName">Course Title:</label>
                <input type="text" name="course_name" id="courseName" required>

                <label for="instructorName">Instructor Name:</label>
                <input type="text" name="instructor_name" id="instructorName" required>

                <label for="startDate">Start Date:</label>
                <input type="date" name="start_date" id="startDate" required>

                <label for="endDate">End Date:</label>
                <input type="date" name="end_date" id="endDate" required>

                <label for="startTime">Start Time:</label>
                <input type="time" name="start_time" id="startTime" required>

                <label for="endTime">End Time:</label>
                <input type="time" name="end_time" id="endTime" required>

                <button type="submit">💾 Save</button>
            </form>

            <form action="" method="POST" onsubmit="return confirm('Are you sure you want to delete this event ?')">
                <input type="hidden" name="action" value="delete">
                <input type="hidden" name="event_id" id="deleteEventId">
                <button type="submit" class="submit-btn">🗑️ Delete</button>
            </form>

            <button type="button" class="submit-btn" onclick="closeModal()">❌ Cancel</button>
        </div>
    </div>

    <script>
        const events = <?= json_encode($eventsFromDB, JSON_UNESCAPED_UNICODE); ?>;
    </script>

    <script src="./scripts/script.js"></script>
</body>

</html>