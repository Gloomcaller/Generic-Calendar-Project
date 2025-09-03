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
        <div class="sidebar-content">

            <div class="sidebar-logo">
                <img src="./media/calendar.png" alt="Logo">
            </div>
            <p class="sidebar-heading">
                Calendar Project
            </p>
            <p class="sidebar-description">
                Responsive calendar app with event management (CRUD), built in PHP/MySQL + JS. Features live clock,
                modals, and user friendly UI.
            </p>

            <h3 class="sidebar-heading">Brief history of calendars</h3>
            <div class="sidebar-section">
                <div class="slider-box">
                    <div class="slide active">The earliest calendars were based on the cycles of the moon, moon phases
                        and also the
                        sun.</div>
                    <div class="slide">Ancient Egyptians developed a 365-day calendar over 4000 years ago in history.
                    </div>
                    <div class="slide">The Gregorian calendar, introduced in 1582, is the most widely used calendar in
                        the world today.</div>
                    <div class="slide">Before Julius Caesar's reform, the Roman calendar was a chaotic 355-day system
                        that required extra months.</div>
                    <div class="slide">When Britain switched calendars in 1752, people rioted demanding their "11 days"
                        back that were skipped.</div>
                    <div class="slide">After the Revolution, France introduced a decimal calendar with 10-day weeks that
                        was abandoned after 12 years.</div>
                    <div class="slide">The Gregorian calendar adds a Leap Day, but century years must be divisible by
                        400 to be leap years.</div>
                    <div class="slide">The proposed International Fixed Calendar had 13 months of 28 days each, plus a
                        single "Year Day".</div>
                    <div class="slide">The ancient Maya used a complex system of three interlocking calendars for
                        sacred, solar, and historical time.</div>
                    <div class="slide active">Ethiopia uses its own calendar, which is roughly 7 to 8 years behind the
                        more common Gregorian one.</div>
                </div>
                <div class="slider-controls">
                    <button class="btn slider-prev">
                        << Prev</button>
                            <button class="btn slider-next">Next >></button>
                </div>
            </div>

            <p class="sidebar-heading">
                Example of video game calendars
            </p>
            <div class="sidebar-gallery">
                <img src="./media/Calendar-Spring.png" alt="Gallery Image 1">
                <img src="./media/Calendar-Summer.png" alt="Gallery Image 2">
                <img src="./media/Calendar-Fall.png" alt="Gallery Image 3">
                <img src="./media/Calendar-Winter.png" alt="Gallery Image 3">
            </div>
        </div>
    </div>

    <div id="rightSidebar" class="sidebar right">
        <div class="sidebar-content">

            <div class="sidebar-counters">
                <p><strong>Visits:</strong> <span id="visitCount"><?php echo $visit_count; ?></span></p>
                <p><strong>Events Added:</strong> <span id="eventsAdded"><?php echo $events_added; ?></span></p>
                <p><strong>Events Edited:</strong> <span id="eventsEdited"><?php echo $events_edited; ?></span></p>
                <p><strong>Events Deleted:</strong> <span id="eventsDeleted"><?php echo $events_deleted; ?></span></p>
                <p><strong>Downloads:</strong> <span id="downloadsCount"><?php echo $downloads; ?></span></p>
            </div>

            <div class="sidebar-search">
                <input type="text" id="searchInput" placeholder="Search events...">
                <div id="searchResults"></div>
            </div>

            <div class="sidebar-export">
                <button id="exportCSV" onclick="exportToCSV()">Download CSV</button>
            </div>

            <div class="sidebar-details">
                <div id="eventDetails">Select an event to see details.</div>
            </div>

            <p class="sidebar-heading">
                FAQ
            </p>
            <div class="faq">
                <button class="btn faq-question">How do I add an event?</button>
                <div class="faq-answer">
                    <p>Click the "Add Event" button above the calendar, fill in the details, and save.</p>
                </div>

                <button class="btn faq-question">Can I edit or delete events?</button>
                <div class="faq-answer">
                    <p>Yes. Click an existing event on the calendar to edit or delete it.</p>
                </div>

                <button class="btn faq-question">How do I export my calendar?</button>
                <div class="faq-answer">
                    <p>Use the "Export CSV" option in the right sidebar to download your events.</p>
                </div>
            </div>
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