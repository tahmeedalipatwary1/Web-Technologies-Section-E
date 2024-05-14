var dashboardLink = document.getElementById('dashboardLink');
    var dropdownMenu = document.getElementById('dropdownMenu');

    dashboardLink.addEventListener('mouseenter', function() {
        dropdownMenu.style.display = 'block';
    });

    dashboardLink.addEventListener('mouseleave', function() {
        setTimeout(function() {
            if (!dropdownMenu.matches(':hover')) {
                dropdownMenu.style.display = 'none';
            }
        }, 500); // Delay to allow moving to the menu
    });

    dropdownMenu.addEventListener('mouseenter', function() {
        this.style.display = 'block';
    });

    dropdownMenu.addEventListener('mouseleave', function() {
        this.style.display = 'none';
    });