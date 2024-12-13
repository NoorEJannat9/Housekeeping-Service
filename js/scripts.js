
document.addEventListener("DOMContentLoaded", function () {
    const serviceRequestForm = document.getElementById("serviceRequestForm");
    if (serviceRequestForm) {
        serviceRequestForm.addEventListener("submit", function (event) {
            let userId = document.querySelector("[name='user_id']").value;
            let serviceId = document.querySelector("[name='service_id']").value;

            
            if (userId === "" || serviceId === "") {
                alert("User ID and Service ID are required!");
                event.preventDefault(); 
        });
    }
});


document.addEventListener("DOMContentLoaded", function () {
    const urlParams = new URLSearchParams(window.location.search);
    const page = urlParams.get("page") || 1;

    const paginationLinks = document.querySelectorAll(".pagination a");
    paginationLinks.forEach(link => {
        if (link.textContent === page) {
            link.classList.add("active");
        }
    });
});



document.addEventListener('DOMContentLoaded', () => {
    console.log("Housekeeping Services page loaded successfully.");


    let index = 0;
    const items = document.querySelectorAll('.carousel-item');
    const totalItems = items.length;

    function showSlide() {
        items.forEach(item => item.style.transform = `translateX(-${index * 100}%)`);
    }

    setInterval(() => {
        index = (index + 1) % totalItems;
        showSlide();
    }, 3000); 
});

