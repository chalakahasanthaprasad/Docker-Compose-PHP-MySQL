<script>
    // Function to update current time
    function updateTime() {
        var currentTimeElement = document.getElementById('currentTime');
        var now = new Date();
        var hours = now.getHours().toString().padStart(2, '0');
        var minutes = now.getMinutes().toString().padStart(2, '0');
        var seconds = now.getSeconds().toString().padStart(2, '0');
        currentTimeElement.textContent = 'Time: ' + hours + ':' + minutes + ':' + seconds;
    }

    // Update time initially and then every second
    updateTime();
    setInterval(updateTime, 1000); // Update time every second
</script>