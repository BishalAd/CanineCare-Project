function nextStep(step) {
    var currentStep = document.querySelector('.step-content.active');
    currentStep.classList.remove('active');
    currentStep.style.display = 'none';

    var nextStep = document.getElementById('step-' + step);
    nextStep.classList.add('active');
    nextStep.style.display = 'block';

    var steps = document.querySelectorAll('.progress-bar .step');
    steps.forEach(function(element, index) {
        if (index < step - 1) {
            element.classList.add('active');
        } else {
            element.classList.remove('active');
        }
    });
}

function prevStep(step) {
    var currentStep = document.querySelector('.step-content.active');
    currentStep.classList.remove('active');
    currentStep.style.display = 'none';

    var prevStep = document.getElementById('step-' + step);
    prevStep.classList.add('active');
    prevStep.style.display = 'block';

    var steps = document.querySelectorAll('.progress-bar .step');
    steps.forEach(function(element, index) {
        if (index < step - 1) {
            element.classList.add('active');
        } else {
            element.classList.remove('active');
        }
    });
}

function generateReport() {
    var form = document.getElementById('symptomCheckerForm');
    var formData = new FormData(form);
    fetch('process.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.report) {
            document.getElementById('reportContent').innerText = data.report;
            nextStep(4);
        } else {
            console.error('Error: No report content received');
        }
    })
    .catch(error => console.error('Error:', error));
}

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('step-1').classList.add('active');
    document.getElementById('step-1').style.display = 'block';
});
