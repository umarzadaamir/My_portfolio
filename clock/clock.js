function updateClock() {
    const now = new Date();
    const timeElement = document.getElementById('time');
    const weekdays = document.querySelectorAll('.weekdays span');

    // Format time as HH:MM:SS:MS with blinking colons
    let hours = now.getHours();
    let minutes = now.getMinutes();
    let seconds = now.getSeconds();
    let milliseconds = now.getMilliseconds();

    // Pad with leading zeros
    hours = hours < 10 ? '0' + hours : hours;
    minutes = minutes < 10 ? '0' + minutes : minutes;
    seconds = seconds < 10 ? '0' + seconds : seconds;
    milliseconds = milliseconds < 100 ? (milliseconds < 10 ? '00' + milliseconds : '0' + milliseconds) : milliseconds;

    // Create blinking colon spans
    const colon = '<span class="colon">:</span>';

    timeElement.innerHTML = hours + colon + minutes + colon + seconds + colon + milliseconds;

    
    const dayIndex = now.getDay(); // 0=Sun, 1=Mon, ...
    weekdays.forEach((day, index) => {
        if (index === dayIndex) {
            day.classList.add('active');
        } else {
            day.classList.remove('active');
        }
    });
}


setInterval(updateClock, 100);


updateClock();
