window.addEventListener('beforeunload', function (e) {
    navigator.sendBeacon('./frontend/pages/Logout.php', 'action=logout');
});