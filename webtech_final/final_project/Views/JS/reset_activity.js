function resetActivityTimer() {
    console.log("Activity timer reset.");
    document.cookie = "last_activity=" + Math.floor(Date.now() / 1000) + ";max-age=3600;path=/";
}

window.onload = resetActivityTimer;
document.onmousemove = resetActivityTimer;
document.onkeypress = resetActivityTimer;
document.onclick = resetActivityTimer;