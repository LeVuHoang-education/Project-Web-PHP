document.addEventListener('DOMContentLoaded', function () {
    function openModal(modalId) {
        document.getElementById(modalId).style.display = "block";
    }

    function closeModal(modalId) {
        document.getElementById(modalId).style.display = "none";
    }

    // Event listeners for opening modals
    document.querySelectorAll('[data-modal]').forEach(function (button) {
        button.addEventListener('click', function () {
            var modalId = this.getAttribute('data-modal');
            openModal(modalId);
        });
    });

    // Event listeners for closing modals
    document.querySelectorAll('.close').forEach(function (button) {
        button.addEventListener('click', function () {
            var modalId = this.getAttribute('data-modal');
            closeModal(modalId);
        });
    });

    // Close modal when clicking outside of modal content
    window.addEventListener('click', function (event) {
        if (event.target.classList.contains('modal')) {
            closeModal(event.target.id);
        }
    });
});
