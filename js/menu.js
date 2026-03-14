// Update time every second
function updateTime() {
    const now = new Date();
    const time = now.toTimeString().slice(0, 5);
    const date = now.toISOString().slice(0, 10);
    document.getElementById('current-time').innerHTML = 
        '<i class="fas fa-clock me-1"></i>' + time + ' | ' + date;
}

// Update time immediately and then every second
updateTime();
setInterval(updateTime, 1000);