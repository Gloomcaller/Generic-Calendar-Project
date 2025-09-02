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
    <link rel="icon" type="image/png" href="./media/calendar-favicon.png">
</head>

<body>
    <svg class="wobbly-line left" preserveAspectRatio="xMidYMid slice" viewBox="10 10 80 80">
        <path class="out-top"
            d="M37-5C25.1-14.7,5.7-19.1-9.2-10-28.5,1.8-32.7,31.1-19.8,49c15.5,21.5,52.6,22,67.2,2.3C59.4,35,53.7,8.5,37-5Z" />
        <path class="in-top"
            d="M20.6,4.1C11.6,1.5-1.9,2.5-8,11.2-16.3,23.1-8.2,45.6,7.4,50S42.1,38.9,41,24.5C40.2,14.1,29.4,6.6,20.6,4.1Z" />
    </svg>
    <svg class="wobbly-line right" preserveAspectRatio="xMidYMid slice" viewBox="10 10 80 80">
        <path class="out-bottom"
            d="M105.9,48.6c-12.4-8.2-29.3-4.8-39.4.8-23.4,12.8-37.7,51.9-19.1,74.1s63.9,15.3,76-5.6c7.6-13.3,1.8-31.1-2.3-43.8C117.6,63.3,114.7,54.3,105.9,48.6Z" />
        <path class="in-bottom"
            d="M102,67.1c-9.6-6.1-22-3.1-29.5,2-15.4,10.7-19.6,37.5-7.6,47.8s35.9,3.9,44.5-12.5C115.5,92.6,113.9,74.6,102,67.1Z" />
    </svg>

    <header>

        <div class="nav-btn header-btn">
            <button onclick="toggleSidebar('left')">
                <img src="./media/menu.png" alt="Left Sidebar">
            </button>
        </div>

        <a href="https://github.com/Gloomcaller" class="nav-btn header-btn" target="_blank" rel="noopener">
            <img src="./media/github.png" alt="GitHub">
        </a>

        <div class="clock-container">
            <div id="clock"></div>
        </div>

        <button class="nav-btn header-btn" id="darkModeToggle" onclick="modeToggle()">
            <img src="./media/dark-mode.png" alt="Dark/Light Mode">
        </button>

        <div class="nav-btn header-btn">
            <button onclick="toggleSidebar('right')">
                <img src="./media/menu.png" alt="Right Sidebar">
            </button>
        </div>

    </header>

    <div id="leftSidebar" class="sidebar left">
        <div class="sidebar-tabs left-tabs">
            <button><img src="./media/faq.png" alt="FAQ"></button>
            <button><img src="./media/gallery.png" alt="Gallery"></button>
            <button><img src="./media/settings.png" alt="Settings"></button>
        </div>
        <div class="sidebar-content">
            <h2>General</h2>
            <p>Content for FAQ, gallery, etc.</p>
        </div>
    </div>

    <div id="rightSidebar" class="sidebar right">
        <div class="sidebar-tabs right-tabs">
            <button><img src="./media/search.png" alt="Search"></button>
            <button><img src="./media/export.png" alt="Export CSV"></button>
            <button><img src="./media/stats.png" alt="Stats"></button>
        </div>
        <div class="sidebar-content">
            <h2>Calendar Tools</h2>
            <p>Search, export, stats here.</p>
        </div>
    </div>

    <?php if ($successMsg): ?>
        <div class="alert success"><?= htmlspecialchars($successMsg) ?></div>
    <?php endif; ?>
    <?php if ($errorMsg): ?>
        <div class="alert error"><?= htmlspecialchars($errorMsg) ?></div>
    <?php endif; ?>

    <div class="calendar">
        <div class="nav-btn-container">
            <button class="nav-btn" onclick="changeMonth(-1)">
                <img src="./media/arrow-left.png" alt="Previous">
            </button>

            <button class="nav-btn" onclick="quickSelect()">
                <img src="./media/selector.png" alt="Today">
            </button>

            <h2 id="monthYear"></h2>

            <button class="nav-btn" onclick="goToToday()">
                <img src="./media/today.png" alt="Today">
            </button>

            <button class="nav-btn" onclick="changeMonth(1)">
                <img src="./media/arrow-right.png" alt="Next">
            </button>
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

                <label for="eventName">Event Title:</label>
                <input type="text" name="event_name" id="eventName" required>

                <label for="eventDescription">Description:</label>
                <input type="text" name="event_description" id="eventDescription" required>

                <label for="startDate">Start Date:</label>
                <input type="date" name="start_date" id="startDate" required>

                <label for="endDate">End Date:</label>
                <input type="date" name="end_date" id="endDate" required>

                <label for="startTime">Start Time:</label>
                <input type="time" name="start_time" id="startTime" required>

                <label for="endTime">End Time:</label>
                <input type="time" name="end_time" id="endTime" required>

                <button type="submit"><img src="./media/save.png" alt="Save"> Save</button>
            </form>

            <form action="" method="POST" onsubmit="return confirm('Are you sure you want to delete this event ?')">
                <input type="hidden" name="action" value="delete">
                <input type="hidden" name="event_id" id="deleteEventId">
                <button type="submit" class="submit-btn"><img src="./media/delete.png" alt="Delete"> Delete</button>
            </form>

            <button type="button" class="submit-btn" onclick="closeModal()"><img src="./media/cancel.png" alt="Cancel">
                Cancel</button>
        </div>
    </div>

    <div class="modal" id="quickSelectModal">
        <div class="modal-content">
            <h2>Select Month & Year</h2>

            <label for="qs-month">Month:</label>
            <select id="qs-month"></select>
            <label for="qs-year">Year:</label>
            <select id="qs-year"></select>

            <button type="submit" onclick="submitQuickSelect()">
                <img src="./media/go.png" alt="Cancel"> Go
            </button>

            <button type="button" class="submit-btn" onclick="closeQuickSelectModal()">
                <img src="./media/cancel.png" alt="Cancel"> Cancel
            </button>
        </div>
    </div>

    <script>
        const events = <?= json_encode($eventsFromDB, JSON_UNESCAPED_UNICODE); ?>;
    </script>

    <script src="./scripts/script.js"></script>
</body>

</html>