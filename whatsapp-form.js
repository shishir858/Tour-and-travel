<script>
function sendToWhatsApp() {
    const name = document.getElementById("fname").value;
    const email = document.getElementById("email").value;
    const phone = document.getElementById("phone").value;
    const subject = document.getElementById("subject").value;
    const message = document.getElementById("msg").value;

    const whatsappMessage = `*Enquiry Details*%0A` +
                            `Name: ${name}%0A` +
                            `Email: ${email}%0A` +
                            `Phone: ${phone}%0A` +
                            `Subject: ${subject}%0A` +
                            `Message: ${message}`;

    const whatsappNumber = "918800608559"; // 🔁 Replace with your WhatsApp number (no + sign)
    const url = `https://wa.me/${whatsappNumber}?text=${encodeURI(whatsappMessage)}`;

    window.open(url, '_blank');
}
</script>
