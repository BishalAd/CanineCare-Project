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


// --------------------------------- Adopt Section Js ----------------------------------
// JavaScript code to handle form display and dynamic district population

document.addEventListener('DOMContentLoaded', () => {
    const stateSelect = document.getElementById('dogState');
    const districtSelect = document.getElementById('dogDistrict');
    const filterStateSelect = document.getElementById('filterState');
    const filterDistrictSelect = document.getElementById('filterDistrict');

    stateSelect.addEventListener('change', () => {
        populateDistricts(stateSelect, districtSelect);
    });

    filterStateSelect.addEventListener('change', () => {
        populateDistricts(filterStateSelect, filterDistrictSelect);
    });
});

function populateDistricts(stateSelect, districtSelect) {
    const state = stateSelect.value;
    let districts = [];

    switch (state) {
        case 'Province 1':
            districts = ['District 1', 'District 2', 'District 3'];
            break;
        case 'Province 2':
            districts = ['District 4', 'District 5', 'District 6'];
            break;
        case 'Bagmati':
            districts = ['Kathmandu', 'Lalitpur', 'Bhaktapur'];
            break;
        case 'Gandaki':
            districts = ['District 10', 'District 11', 'District 12'];
            break;
        case 'Lumbini':
            districts = ['District 13', 'District 14', 'District 15'];
            break;
        case 'Karnali':
            districts = ['District 16', 'District 17', 'District 18'];
            break;
        case 'Sudurpashchim':
            districts = ['District 19', 'District 20', 'District 21'];
            break;
        default:
            districts = [];
    }

    districtSelect.innerHTML = '<option value="" disabled selected>Select District</option>';

    districts.forEach(district => {
        const option = document.createElement('option');
        option.value = district;
        option.textContent = district;
        districtSelect.appendChild(option);
    });
}

function showForm() {
    document.getElementById('trainerFormPopup').style.display = 'block';
}

function hideForm() {
    document.getElementById('trainerFormPopup').style.display = 'none';
}

