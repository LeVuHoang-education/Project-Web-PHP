    // Hàm mở modal
    function openModal(modalId) {
        var modal = document.getElementById(modalId);
        if (modal) {
            modal.style.display = "block";
        }
    }

    // Hàm đóng modal
    function closeModal(modalId) {
        var modal = document.getElementById(modalId);
        if (modal) {
            modal.style.display = "none";
        }
    }

    // Lấy tất cả các nút mở modal
    document.querySelectorAll('[data-open-modal]').forEach(function(btn) {
        btn.onclick = function() {
            var modalId = btn.getAttribute('data-open-modal');
            openModal(modalId);
        };
    });

    // Lấy tất cả các nút đóng modal
    document.querySelectorAll('.close').forEach(function(span) {
        span.onclick = function() {
            var modalId = span.getAttribute('data-modal');
            closeModal(modalId);
        };
    });

    // Đóng modal khi click ra ngoài modal
    window.onclick = function(event) {
        document.querySelectorAll('.modal').forEach(function(modal) {
            if (event.target == modal) {
                closeModal(modal.id);
            }
        });
    }