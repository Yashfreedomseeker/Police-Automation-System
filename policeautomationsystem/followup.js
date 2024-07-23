document.addEventListener('DOMContentLoaded', function () {
    const followUpLink = document.getElementById('follow-up-link');
    const followUpContent = document.getElementById('follow-up-content');
    const dashboardContent = document.getElementById('dashboard-content');
    const followUpForm = document.getElementById('follow-up-form');

    followUpLink.addEventListener('click', function () {
        dashboardContent.classList.add('d-none');
        followUpContent.classList.remove('d-none');
    });

    followUpForm.addEventListener('submit', function (event) {
        event.preventDefault();

        const formData = new FormData(followUpForm);

        fetch('record_update.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Update recorded successfully!');
                followUpForm.reset();
                followUpContent.classList.add('d-none');
                dashboardContent.classList.remove('d-none');
            } else {
                alert('Failed to record update. Please try again.');
            }
        })
        .catch(error => console.error('Error:', error));
    });
});
