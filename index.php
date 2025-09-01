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

    <div class="sidebar-toggle left-toggle">
        <button onclick="toggleSidebar('left')">
            <img src="./media/menu.png" alt="Menu" />
        </button>
    </div>


    <div id="leftSidebar" class="sidebar left">
        <div class="sidebar-content">
            <div id="left-faq" class="sidebar-section active">
                <h2>FAQ</h2>
                <p>FAQ content goes here.</p>
            </div>
            <div id="left-gallery" class="sidebar-section">
                <h2>Gallery</h2>
                <p>Gallery content here.</p>
            </div>
            <div id="left-video" class="sidebar-section">
                <h2>Video</h2>
                <video controls width="100%">
                    <source src="sample.mp4" type="video/mp4">
                </video>
            </div>
            <div id="left-gif" class="sidebar-section">
                <h2>GIF</h2>
                <img src="sample.gif" alt="GIF demo" style="max-width:100%;">
            </div>
            <div id="left-slider" class="sidebar-section">
                <h2>Slider</h2>
                <div class="slider">Slider content here.</div>
            </div>
            <div id="left-marquee" class="sidebar-section">
                <h2>Marquee</h2>
                <marquee>Scrolling text example</marquee>
            </div>
            <div id="left-forum" class="sidebar-section">
                <h2>Forum</h2>
                <p>Forum/discussion placeholder.</p>
            </div>
            <div id="left-chat" class="sidebar-section">
                <h2>Chat</h2>
                <p>Chat placeholder.</p>
            </div>
            <div id="left-mailing" class="sidebar-section">
                <h2>Mailing List</h2>
                <form>
                    <input type="email" placeholder="Enter your email">
                    <button type="submit">Subscribe</button>
                </form>
            </div>
            <div id="left-downloads" class="sidebar-section">
                <h2>Downloads</h2>
                <a href="file.pdf" download>Download Sample File</a>
            </div>
        </div>

        <div class="sidebar-tabs">
            <button onclick="toggleSidebar('left','left-faq')">FAQ</button>
            <button onclick="toggleSidebar('left','left-gallery')">Gallery</button>
            <button onclick="toggleSidebar('left','left-video')">Video</button>
            <button onclick="toggleSidebar('left','left-gif')">GIF</button>
            <button onclick="toggleSidebar('left','left-slider')">Slider</button>
            <button onclick="toggleSidebar('left','left-marquee')">Marquee</button>
            <button onclick="toggleSidebar('left','left-forum')">Forum</button>
            <button onclick="toggleSidebar('left','left-chat')">Chat</button>
            <button onclick="toggleSidebar('left','left-mailing')">Mail</button>
            <button onclick="toggleSidebar('left','left-downloads')">Download</button>
        </div>
    </div>

    <div class="sidebar-toggle">
        <button onclick="toggleSidebar('right')">
            <img src="./media/menu.png" alt="Menu" />
        </button>
    </div>

    <div id="rightSidebar" class="sidebar right">
        <div class="sidebar-content">
            <div id="right-eventDetails" class="sidebar-section active">
                <h2>Event Details</h2>
                <p>Select an event to view details here.</p>
            </div>
            <div id="right-search" class="sidebar-section">
                <h2>Search Events</h2>
                <input type="text" id="eventSearch" placeholder="Search by title">
                <div id="searchResults"></div>
            </div>
            <div id="right-export" class="sidebar-section">
                <h2>Export</h2>
                <button onclick="exportEventsCSV()">Export Events to CSV</button>
            </div>
            <div id="right-stats" class="sidebar-section">
                <h2>Stats</h2>
                <ul>
                    <li>Views: <span id="statViews">0</span></li>
                    <li>Added: <span id="statAdded">0</span></li>
                    <li>Deleted: <span id="statDeleted">0</span></li>
                    <li>Downloads: <span id="statDownloads">0</span></li>
                </ul>
            </div>
            <div id="right-settings" class="sidebar-section">
                <h2>Settings</h2>
                <p>Settings placeholder.</p>
            </div>
        </div>

        <div class="sidebar-tabs">
            <button onclick="toggleSidebar('right','right-eventDetails')">Event</button>
            <button onclick="toggleSidebar('right','right-search')">Search</button>
            <button onclick="toggleSidebar('right','right-export')">Export</button>
            <button onclick="toggleSidebar('right','right-stats')">Stats</button>
            <button onclick="toggleSidebar('right','right-settings')">Settings</button>
        </div>
    </div>

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

        <a href="https://github.com/Gloomcaller" class="nav-btn header-btn" target="_blank" rel="noopener">
            <img src="./media/github.png" alt="GitHub">
        </a>

        <div class="clock-container">
            <div id="clock"></div>
        </div>


        <button class="nav-btn header-btn" id="darkModeToggle" onclick="modeToggle()">
            <img src="./media/dark-mode.png" alt="Dark/Light Mode">
        </button>

    </header>

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