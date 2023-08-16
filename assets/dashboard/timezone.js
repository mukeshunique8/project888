// timezone.js

// Function to update the time in a specific time zone
function updateTime(timeZone) {
    const now = new Date();
    const options = {
        timeZone: timeZone,
        hour12: false,
        hour: "numeric",
        minute: "numeric",
        second: "numeric"
    };
    const formatter = new Intl.DateTimeFormat("en-IN", options);
    const timeString = formatter.format(now);
    return timeString;
}

// Function to update the clocks for both IST and ET
function updateClocks() {
    const timeElementIST = document.getElementById("time-ist");
    const timeElementET = document.getElementById("time-et");

    const timeZoneIST = "Asia/Kolkata"; // IST time zone
    const timeZoneET = "America/New_York"; // ET time zone

    const currentTimeIST = updateTime(timeZoneIST);
    const currentTimeET = updateTime(timeZoneET);

    timeElementIST.textContent =    currentTimeIST +" ~IST";
    timeElementET.textContent = "EST~ "+currentTimeET;
}

// Update the clocks initially and set up an interval to update every second
updateClocks();
setInterval(updateClocks, 1000);
