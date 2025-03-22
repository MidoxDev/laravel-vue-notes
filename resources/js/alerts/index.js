import Swal from 'sweetalert2';



export function successAlert(message) {
    Swal.fire({
        title: 'Success!',
        text: message,
        icon: 'success',
        timer: 3000, // Auto-close after 3 seconds
        showConfirmButton: false, // Don't show the confirm button
        position: 'top-end', // Position the alert at the top-right
        toast: true, // Make it a toast notification
        timerProgressBar: true, // Show a progress bar for the timer
    });
}


export function errorAlert(message) {
    Swal.fire({
        title: 'Error!',
        text: message,
        icon: 'error',
        timer: 3000, // Auto-close after 3 seconds
        showConfirmButton: false, // Don't show the confirm button
        position: 'top-end', // Position the alert at the top-right
        toast: true, // Make it a toast notification
        timerProgressBar: true, // Show a progress bar for the timer
    });
}
