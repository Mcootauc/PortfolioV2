document.addEventListener('DOMContentLoaded', function () {
    const contactForm = document.getElementById('contactForm')
    contactForm.addEventListener('submit', function (e) {
        e.preventDefault()

        const formData = new FormData(contactForm)

        // You can use Fetch API to send the form data to the server
        fetch('sendEmail.php', {
            method: 'POST',
            body: formData
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    alert('Email sent successfully!')
                    contactForm.reset()
                } else {
                    alert('Email sending failed. Please try again later.')
                }
            })
            .catch((error) => {
                console.error('Error:', error)
                alert('An error occurred. Please try again later.')
            })
    })
})
