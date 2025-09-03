const calendarEl = document.getElementById("calendar");
const monthYearEl = document.getElementById("monthYear");
const modalEl = document.getElementById("eventModal");
let currDate = new Date();

document.addEventListener('DOMContentLoaded', function () {
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'dark') {
        document.body.setAttribute('data-theme', 'dark');
    }
});

function renderCalendar(date = new Date()) {
    calendarEl.innerHTML = '';

    const month = date.getMonth();
    const year = date.getFullYear();

    const totalDays = new Date(year, month + 1, 0).getDate();
    const firstDayOfMonth = (new Date(year, month, 1).getDay() + 6) % 7;

    monthYearEl.textContent = date.toLocaleDateString("en-US", { month: 'long', year: 'numeric' });

    const weekDays = ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"];

    weekDays.forEach(day => {
        const dayEl = document.createElement("div");
        dayEl.className = "day-name";
        dayEl.textContent = day;
        calendarEl.appendChild(dayEl);
    });

    for (let i = 0; i < firstDayOfMonth; i++) {
        calendarEl.appendChild(document.createElement("div"));
    }

    for (let day = 0; day < totalDays; day++) {
        const dateStr = `${String(day + 1).padStart(2, '0')}-${String(month + 1).padStart(2, '0')}-${year}`;


        const cell = document.createElement("div");
        cell.className = "day";

        const today = new Date();

        if (
            day + 1 === today.getDate() &&
            month === today.getMonth() &&
            year === today.getFullYear()
        ) { cell.classList.add("today"); }

        const dateEl = document.createElement("div");

        dateEl.className = "date-number";
        dateEl.textContent = day + 1;
        cell.appendChild(dateEl);

        const eventToday = events.filter(e => e.date === dateStr);
        const eventBox = document.createElement("div");
        eventBox.className = "events";

        eventToday.forEach(event => {
            const ev = document.createElement("div");
            ev.className = "event";

            const eventNameEl = document.createElement("div");
            eventNameEl.className = "eventName";
            eventNameEl.textContent = event.title.split(" - ")[0];

            const eventDescEl = document.createElement("div");

            eventDescEl.className = "eventDescription";
            eventDescEl.textContent = event.title.split(" - ")[1];

            const timeEl = document.createElement("div");
            timeEl.className = "time";
            timeEl.textContent = event.start_time + " - " + event.end_time;

            ev.appendChild(eventNameEl);
            ev.appendChild(eventDescEl);
            ev.appendChild(timeEl);
            eventBox.appendChild(ev);
        });

        const overlay = document.createElement("div");
        overlay.className = "day-overlay";

        const addBtn = document.createElement("button");

        addBtn.className = "overlay-btn";

        addBtn.textContent = "Add";

        addBtn.onclick = e => {
            e.stopPropagation();
            openModalForAdd(dateStr);
        };

        overlay.appendChild(addBtn);

        if (eventToday.length > 0) {
            const editBtn = document.createElement("button");
            editBtn.className = "overlay-btn";
            editBtn.textContent = "Edit";
            editBtn.onclick = e => {
                e.stopPropagation();
                openModalForEdit(eventToday);
            }
            overlay.appendChild(editBtn);
        }

        cell.appendChild(overlay);
        cell.appendChild(eventBox);
        calendarEl.appendChild(cell);
    }
}

function openModalForAdd(dateStr) {
    document.getElementById("formAction").value = "add";
    document.getElementById("eventId").value = "";
    document.getElementById("deleteEventId").value = "";
    document.getElementById("eventName").value = "";
    document.getElementById("eventDescription").value = "";

    const [day, month, year] = dateStr.split("-");
    const isoDate = `${year}-${month}-${day}`;

    document.getElementById("startDate").value = isoDate;
    document.getElementById("endDate").value = isoDate;
    document.getElementById("startTime").value = "09:00";
    document.getElementById("endTime").value = "10:00";

    const selector = document.getElementById("eventSelector");
    const wrapper = document.getElementById("eventSelectorWrapper");

    if (selector && wrapper) {
        selector.innerHTML = "";
        wrapper.style.display = "none";
    }

    modalEl.style.display = "flex";
}

function openModalForEdit(eventsOnDate) {
    document.getElementById("formAction").value = "edit";
    modalEl.style.display = "flex";

    const selector = document.getElementById("eventSelector");
    const wrapper = document.getElementById("eventSelectorWrapper");
    selector.innerHTML = "<option disabled selected>Choose event...</option>";

    eventsOnDate.forEach(e => {
        const option = document.createElement("option");
        option.value = JSON.stringify(e);
        option.textContent = `${e.title} (${e.start} => ${e.end})`;
        selector.appendChild(option);
    });

    if (eventsOnDate.length > 1) {
        wrapper.style.display = "block";
    } else {
        wrapper.style.display = "none";
    }

    handleEventSelection(JSON.stringify(eventsOnDate[0]));
}

function handleEventSelection(eventJSON) {
    const event = JSON.parse(eventJSON);
    document.getElementById("eventId").value = event.id;
    document.getElementById("deleteEventId").value = event.id;

    const [eventName, eventDesc] = event.title.split(" - ").map(e => e.trim());
    document.getElementById("eventName").value = eventName || "";
    document.getElementById("eventDescription").value = eventDesc || "";
    document.getElementById("startDate").value = event.start || "";
    document.getElementById("endDate").value = event.end || "";
    document.getElementById("startTime").value = event.start_time || "";
    document.getElementById("endTime").value = event.end_time || "";
}

function closeModal() {
    modalEl.style.display = "none";
}

function changeMonth(offset) {
    currDate.setMonth(currDate.getMonth() + offset);
    renderCalendar(currDate);
}

function goToToday() {
    currDate = new Date();
    renderCalendar(currDate);
}

function updateClock() {
    const now = new Date();
    const clock = document.getElementById("clock");
    clock.textContent = [
        String(now.getHours()).padStart(2, "0"),
        String(now.getMinutes()).padStart(2, "0"),
        String(now.getSeconds()).padStart(2, "0"),
    ].join(":");
}

function quickSelect() {
    const modal = document.getElementById('quickSelectModal');
    const monthSelect = document.getElementById('qs-month');
    const yearSelect = document.getElementById('qs-year');

    if (monthSelect.children.length === 0) {
        const monthNames = [
            "January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"
        ];
        monthNames.forEach((month, index) => {
            const option = document.createElement("option");
            option.value = index;
            option.textContent = month;
            monthSelect.appendChild(option);
        });
    }

    if (yearSelect.children.length === 0) {
        for (let y = 2000; y <= 2050; y++) {
            const option = document.createElement("option");
            option.value = y;
            option.textContent = y;
            yearSelect.appendChild(option);
        }
    }

    const now = new Date();
    monthSelect.value = now.getMonth();
    yearSelect.value = now.getFullYear();

    modal.style.display = 'flex';
}

function submitQuickSelect() {
    const selectedMonth = parseInt(document.getElementById("qs-month").value);
    const selectedYear = parseInt(document.getElementById("qs-year").value);

    currDate = new Date(selectedYear, selectedMonth, 1);
    renderCalendar(currDate);
    document.getElementById("quickSelectModal").style.display = "none";
}

function closeQuickSelectModal() {
    document.getElementById("quickSelectModal").style.display = "none";
}

function modeToggle() {
    const currentTheme = document.body.getAttribute('data-theme');
    if (currentTheme === 'dark') {
        document.body.removeAttribute('data-theme');
        localStorage.setItem('theme', 'light');
    } else {
        document.body.setAttribute('data-theme', 'dark');
        localStorage.setItem('theme', 'dark');
    }
}

document.addEventListener("DOMContentLoaded", () => {
    const alert = document.querySelector(".alert");
    if (alert) {
        setTimeout(() => {
            alert.style.opacity = "0";
            alert.style.transition = "opacity 0.5s ease";
            setTimeout(() => alert.remove(), 500);
        }, 4000);
    }
});

function toggleSidebar(side) {
    const sidebar = document.getElementById(side + "Sidebar");
    sidebar.classList.toggle("open");
}

document.querySelectorAll(".faq-question").forEach(button => {
    button.addEventListener("click", () => {
        const answer = button.nextElementSibling;
        answer.style.display =
            answer.style.display === "block" ? "none" : "block";
    });
});

const slides = document.querySelectorAll(".slide");
let currentSlide = 0;

function showSlide(index) {
    slides.forEach((s, i) => {
        s.classList.toggle("active", i === index);
    });
}

document.querySelector(".slider-prev").addEventListener("click", () => {
    currentSlide = (currentSlide - 1 + slides.length) % slides.length;
    showSlide(currentSlide);
});

document.querySelector(".slider-next").addEventListener("click", () => {
    currentSlide = (currentSlide + 1) % slides.length;
    showSlide(currentSlide);
});

function exportToCSV() {
    window.location.href = window.location.pathname + '?export=csv';
}

const searchInput = document.getElementById("searchInput");
const searchResults = document.getElementById("searchResults");
const eventDetails = document.getElementById("eventDetails");

searchInput.addEventListener("input", function () {
    const query = this.value.toLowerCase();
    searchResults.innerHTML = "";

    if (query.length === 0) return;

    const matches = events.filter(e =>
        e.title.toLowerCase().includes(query) ||
        e.description.toLowerCase().includes(query)
    );

    matches.forEach(event => {
        const btn = document.createElement("button");
        btn.textContent = event.title + " (" + event.date + ")";
        btn.onclick = () => {
            eventDetails.innerHTML = `
                <h4>${event.title}</h4>
                <p><strong>Date:</strong> ${event.date}</p>
                <p><strong>Time:</strong> ${event.start_time} - ${event.end_time}</p>
                <p>${event.description}</p>
            `;
        };
        searchResults.appendChild(btn);
    });
});

document.addEventListener('click', function (e) {
    if (e.target.closest('.event')) {
        const eventElement = e.target.closest('.event');
        const eventTitle = eventElement.querySelector('.eventName').textContent;

        const event = events.find(ev =>
            ev.title.split(" - ")[0] === eventTitle
        );

        if (event) {
            eventDetails.innerHTML = `
                <h4>${event.title}</h4>
                <p><strong>Date:</strong> ${event.date}</p>
                <p><strong>Time:</strong> ${event.start_time} - ${event.end_time}</p>
                <p>${event.description}</p>
            `;
        }
    }
});

function updateMarqueeWithUpcomingEvents() {
    const today = new Date();
    const sevenDaysLater = new Date();
    sevenDaysLater.setDate(today.getDate() + 7);

    const formatDateForComparison = (date) => {
        const d = new Date(date);
        return `${String(d.getDate()).padStart(2, '0')}-${String(d.getMonth() + 1).padStart(2, '0')}-${d.getFullYear()}`;
    };

    const todayFormatted = formatDateForComparison(today);
    const sevenDaysLaterFormatted = formatDateForComparison(sevenDaysLater);

    const upcomingEvents = events.filter(event => {
        const eventDate = event.date;
        return eventDate >= todayFormatted && eventDate <= sevenDaysLaterFormatted;
    });

    const marquee = document.querySelector('marquee');
    if (upcomingEvents.length > 0) {
        const eventText = upcomingEvents.map(event =>
            `${event.title.split(" - ")[0]} (${event.date})`
        ).join(' • ');
        marquee.textContent = 'Upcoming: ' + eventText;
    } else {
        marquee.textContent = 'No upcoming events in the next 7 days';
    }
}

document.addEventListener('DOMContentLoaded', function () {
    updateMarqueeWithUpcomingEvents();
});

renderCalendar(currDate);
updateClock();
setInterval(updateClock, 1000);