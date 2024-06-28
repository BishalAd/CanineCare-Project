<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dog Symptom Checker</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <div class="progress-bar">
            <div class="step active">Pet Details</div>
            <div class="step">Main Symptom</div>
            <div class="step">Symptom Details</div>
            <div class="step">Report</div>
        </div>
        <form id="symptomCheckerForm" onsubmit="return false;">
            <div class="step-content" id="step-1">
                <h2>Tell us about your dog</h2>
                <label>What's their sex?</label>
                <div>
                    <input type="radio" id="male" name="sex" value="male">
                    <label for="male">Male</label>
                </div>
                <div>
                    <input type="radio" id="female" name="sex" value="female">
                    <label for="female">Female</label>
                </div>
                <button type="button" onclick="nextStep(2)">Next</button>
            </div>
            <div class="step-content" id="step-2" style="display:none;">
                <h2>Main Symptom</h2>
                <label>Select the main symptom</label>
                <select name="mainSymptom" id="mainSymptom">
                    <option value="coughing">Coughing</option>
                    <option value="vomiting">Vomiting</option>
                    <option value="diarrhea">Diarrhea</option>
                    <option value="lethargy">Lethargy</option>
                    <option value="itching">Itching</option>
                    <option value="loss of appetite">Loss of appetite</option>
                    <option value="excessive thirst">Excessive thirst</option>
                    <option value="difficulty breathing">Difficulty breathing</option>
                    <option value="limping">Limping</option>
                    <option value="ear discharge">Ear discharge</option>
                    <option value="sneezing">Sneezing</option>
                    <option value="hair loss">Hair loss</option>
                    <option value="eye discharge">Eye discharge</option>
                    <option value="weight loss">Weight loss</option>
                </select>
                <button type="button" onclick="prevStep(1)">Back</button>
                <button type="button" onclick="nextStep(3)">Next</button>
            </div>
            <div class="step-content" id="step-3" style="display:none;">
                <h2>Symptom Details</h2>
                <label>Describe the symptom in more detail</label>
                <textarea name="symptomDetails" id="symptomDetails" rows="4" cols="50"></textarea>
                <button type="button" onclick="prevStep(2)">Back</button>
                <button type="button" onclick="generateReport()">Generate Report</button>
            </div>
            <div class="step-content" id="step-4" style="display:none;">
                <h2>Report</h2>
                <p id="reportContent"></p>
                <button type="button" onclick="prevStep(3)">Back</button>
            </div>
        </form>
    </div>
    <script>
        function nextStep(step) {
            var currentStep = document.querySelector('.step-content.active');
            currentStep.classList.remove('active');
            document.getElementById('step-' + step).classList.add('active');

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
            document.getElementById('step-' + step).classList.add('active');

            var steps = document.querySelectorAll('.progress-bar .step');
            steps.forEach(function(element, index) {
                if (index < step) {
                    element.classList.add('active');
                } else {
                    element.classList.remove('active');
                }
            });
        }

        function generateReport() {
            var form = document.getElementById('symptomCheckerForm');
            var formData = new FormData(form);
            fetch(window.location.href, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('reportContent').innerHTML = data.report;
                nextStep(4);
            })
            .catch(error => console.error('Error:', error));
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('.step-content').classList.add('active');
        });
    </script>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    header('Content-Type: application/json');
    
    $sex = $_POST['sex'];
    $mainSymptom = $_POST['mainSymptom'];
    $symptomDetails = $_POST['symptomDetails'];

    // Mock diagnosis logic
    $diagnosis = generateDiagnosis($mainSymptom);

    $report = "Sex: " . ucfirst($sex) . "\n";
    $report .= "Main Symptom: " . ucfirst($mainSymptom) . "\n";
    $report .= "Symptom Details: " . ucfirst($symptomDetails) . "\n";
    $report .= "Diagnosis: " . $diagnosis;

    echo json_encode(['report' => nl2br($report)]);
}

function generateDiagnosis($symptom) {
    $diagnoses = [
        'coughing' => 'Your dog might be experiencing respiratory issues. Consider visiting a vet for a thorough examination.',
        'vomiting' => 'Vomiting can be caused by various issues such as dietary indiscretion, infections, or more serious conditions. Monitor your dog and consult a vet if it persists.',
        'diarrhea' => 'Diarrhea can result from dietary changes, infections, or other health issues. Ensure your dog stays hydrated and consult a vet if the condition doesn’t improve.',
        'lethargy' => 'Lethargy can be a sign of various health problems including infections, metabolic diseases, or more severe conditions. A vet consultation is recommended.',
        'itching' => 'Itching might indicate allergies, skin infections, or parasites. Try to observe the pattern and consult a vet for proper treatment.',
        'loss of appetite' => 'Loss of appetite can be due to numerous reasons, including gastrointestinal issues, dental problems, or more serious health concerns. Monitor and consult a vet if it continues.',
        'excessive thirst' => 'Excessive thirst can be a symptom of diabetes, kidney disease, or other metabolic disorders. A veterinary checkup is advised.',
        'difficulty breathing' => 'Breathing difficulties are serious and could indicate respiratory infections, heart problems, or other critical issues. Immediate veterinary attention is necessary.',
        'limping' => 'Limping can result from injuries, arthritis, or other orthopedic issues. Limit activity and seek veterinary advice.',
        'ear discharge' => 'Ear discharge could be due to ear infections, mites, or allergies. Clean the ears and consult a vet for treatment.',
        'sneezing' => 'Sneezing might be caused by respiratory infections, allergies, or irritants. Observe for additional symptoms and consult a vet if needed.',
        'hair loss' => 'Hair loss can indicate skin infections, parasites, or hormonal imbalances. Monitor and consult a vet for a proper diagnosis.',
        'eye discharge' => 'Eye discharge may be due to infections, allergies, or foreign bodies. Clean the eyes and seek veterinary advice if it persists.',
        'weight loss' => 'Unexplained weight loss can be a sign of underlying health issues such as metabolic disorders, infections, or more serious conditions. A vet consultation is important.'
        // Add more symptoms and corresponding diagnoses as needed
    ];

    return $diagnoses[$symptom] ?? 'Please consult a veterinarian for an accurate diagnosis.';
}
?>
