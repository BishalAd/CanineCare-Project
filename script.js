$(document).ready(function () {
    var typed = new Typed(".typing", {
        strings: ["Help You Adopt Dogs", "Provide Dog Accessories", "Assist with Dog Training", "Ensure Check-ups and Care", "Offer Dog Boarding Services", "Connect You with Vets"],
        typeSpeed: 100,
        backSpeed: 60,
        loop: true
    });
});

// Menu Bar

function showSidebar(){
    const sidebar = document.querySelector('.sidebar')
    sidebar.style.display = 'flex'
}

function hideSidebar(){
    const sidebar = document.querySelector('.sidebar')
    sidebar.style.display = 'none'
}
