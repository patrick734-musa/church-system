// Show the loading spinner when the form is submitted
document.getElementById('eventForm').addEventListener('submit', function() {
    document.getElementById('loading').style.display = 'block';
});

// Handle the cancel button click
function cancelEvent() {
    if (confirm('Are you sure you want to cancel?')) {
        window.location.href = 'view_event.php'; // Redirect to the events page
    }
}

 // Show the loading spinner when the form is submitted
document.getElementById('eventForm').addEventListener('submit', function() {
    document.getElementById('loading').style.display = 'block';
});

// Handle the cancel button click
function cancelEvent() {
    if (confirm('Are you sure you want to cancel?')) {
        window.location.href = 'view_event.php'; // Redirect to the events page
    }
}
 // Show the loading spinner when the form is submitted
document.getElementById('eventForm').addEventListener('submit', function() {
    document.getElementById('loading').style.display = 'flex';
});

document.addEventListener('DOMContentLoaded', function() {
    const deleteModal = document.getElementById('deleteModal');
    const closeModalBtn = document.querySelector('.close');
    const cancelBtn = document.querySelector('.cancel-btn');
    const confirmDeleteBtn = document.getElementById('confirmDelete');
    const modalMessage = document.querySelector('.modal-message');
    let deleteId = null;

    // Open modal on delete button click
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            deleteId = this.getAttribute('data-id');
            deleteModal.style.display = 'flex';
        });
    });

    // Close modal functions
    function closeModal() {
        deleteModal.style.display = 'none';
        modalMessage.innerHTML = '';
    }

    closeModalBtn.addEventListener('click', closeModal);
    cancelBtn.addEventListener('click', closeModal);

    // Confirm delete action
    confirmDeleteBtn.addEventListener('click', () => {
        if (deleteId !== null) {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'delete_event.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                const response = JSON.parse(xhr.responseText);
                if (xhr.status === 200 && response.success) {
                    modalMessage.innerHTML = `<p class="success">Event deleted successfully.</p>`;
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                } else {
                    modalMessage.innerHTML = `<p class="error">Error: ${response.message}</p>`;
                }
            };
            xhr.send('id=' + deleteId);
        }
    });

    window.addEventListener('click', (event) => {
        if (event.target === deleteModal) {
            closeModal();
        }
    });
});
