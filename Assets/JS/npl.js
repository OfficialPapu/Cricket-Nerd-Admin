document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('nplForm');
    const apiUrl = 'Assets/PHP/API/POST/npl.php';

    form.addEventListener('submit', (e) => {
        e.preventDefault();
        const formData = new FormData(form);
        const playerRole = formData.get('PlayerRole');
        if (!playerRole) {
            showToast('Please select a player role.', 'error');
            return;
        }

        fetch(apiUrl, {
            method: 'POST',
            body: formData,
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    form.reset();
                    showToast(data.message || 'Player profile successfully uploaded', 'success');
                } else {
                    showToast(data.message || 'Failed to upload player profile', 'error');
                }
            })
            .catch((error) => {
                console.error('Error:', error);
                showToast('Unexpected error occurred. Please try again later.', 'error');
            });
    });

    function showToast(message, type) {
        butterup.toast({
            message: message,
            type: type,
            dismissable: true,
            icon: true,
        });
    }
});
