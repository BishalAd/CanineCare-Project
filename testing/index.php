<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dog Symptom Checker</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="Symptoms-Container">
        <div class="progress-bar">
            <div class="step active">User Details</div>
            <div class="step">Pet Details</div>
            <div class="step">Main Symptom</div>
            <div class="step">Symptom Details</div>
            <div class="step">Report</div>
        </div>
        <form id="symptomCheckerForm">
            <div class="step-content active" id="step-1">
                <h1>Your Details</h1>
                <label for="fullName">Full Name</label>
                <input type="text" id="fullName" name="fullName" required><br><br>
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" pattern="[0-9]{10}" required><br><br>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required><br><br>
                <button type="button" class="btn" onclick="nextStep(2)">Next</button>
            </div>
            <div class="step-content" id="step-2">
                <h1>Pet Details</h1>
                <h2>What's their sex?</h2>
                <div>
                    <input type="radio" id="male" name="sex" value="male" required>
                    <label for="male">Male</label>
                </div>
                <div>
                    <input type="radio" id="female" name="sex" value="female" required>
                    <label for="female">Female</label>
                </div>
                <h2>What's their Age?</h2>
                <input type="number" name="age" required><br>
                <button type="button" class="btn" onclick="prevStep(1)">Back</button>
                <button type="button" class="btn" onclick="nextStep(3)">Next</button>
            </div>
            <div class="step-content" id="step-3">
                <h2>Main Symptom</h2>
                <label for="mainSymptom">Select the main symptom</label>
                <select name="mainSymptom" id="mainSymptom" required>
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
                <button type="button" class="btn" onclick="prevStep(2)">Back</button>
                <button type="button" class="btn" onclick="nextStep(4)">Next</button>
            </div>
            <div class="step-content" id="step-4">
                <h2>Symptom Details</h2>
                <label for="symptomDetails">Describe the symptom in more detail</label>
                <textarea name="symptomDetails" id="symptomDetails" rows="4" cols="50" required></textarea>
                <button type="button" class="btn" onclick="prevStep(3)">Back</button>
                <button type="button" class="btn" onclick="generateReport()">Generate Report</button>
            </div>
            <div class="step-content" id="step-5">
                <h2>Report</h2>
                <p id="reportContent"></p>
                <button type="button" class="btn" onclick="prevStep(4)">Back</button>
                <button type="button" class="btn" onclick="window.print()">Print Report</button>
            </div>
        </form>
    </div>
    <script>
        function nextStep(step) {
            var currentStep = document.querySelector('.step-content.active');
            currentStep.classList.remove('active');

            var nextStep = document.getElementById('step-' + step);
            nextStep.classList.add('active');

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

            var prevStep = document.getElementById('step-' + step);
            prevStep.classList.add('active');

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
            const fullName = document.getElementById('fullName').value;
            const phone = document.getElementById('phone').value;
            const email = document.getElementById('email').value;
            const sex = document.querySelector('input[name="sex"]:checked').value;
            const age = document.querySelector('input[name="age"]').value;
            const mainSymptom = document.getElementById('mainSymptom').value;
            const symptomDetails = document.getElementById('symptomDetails').value;

            function generateDiagnosis(symptom) {
                const diagnoses = {
                    'coughing': 'Your dog might be experiencing respiratory issues. Consider visiting a vet for a thorough examination.',
                    'vomiting': 'Vomiting can be caused by various issues such as dietary indiscretion, infections, or more serious conditions. Monitor your dog and consult a vet if it persists.',
                    'diarrhea': 'Diarrhea can result from dietary changes, infections, or other health issues. Ensure your dog stays hydrated and consult a vet if the condition does not improve.',
                    'lethargy': 'Lethargy can be a sign of various health problems including infections, metabolic diseases, or more severe conditions. A vet consultation is recommended.',
                    'itching': 'Itching might indicate allergies, skin infections, or parasites. Try to observe the pattern and consult a vet for proper treatment.',
                    'loss of appetite': 'Loss of appetite can be due to numerous reasons, including gastrointestinal issues, dental problems, or more serious health concerns. Monitor and consult a vet if it continues.',
                    'excessive thirst': 'Excessive thirst can be a symptom of diabetes, kidney disease, or other metabolic disorders. A veterinary checkup is advised.',
                    'difficulty breathing': 'Breathing difficulties are serious and could indicate respiratory infections, heart problems, or other critical issues. Immediate veterinary attention is necessary.',
                    'limping': 'Limping can result from injuries, arthritis, or other orthopedic issues. Limit activity and seek veterinary advice.',
                    'ear discharge': 'Ear discharge could be due to ear infections, mites, or allergies. Clean the ears and consult a vet for treatment.',
                    'sneezing': 'Sneezing might be caused by respiratory infections, allergies, or irritants. Observe for additional symptoms and consult a vet if needed.',
                    'hair loss': 'Hair loss can indicate skin infections, parasites, or hormonal imbalances. Monitor and consult a vet for a proper diagnosis.',
                    'eye discharge': 'Eye discharge may be due to infections, allergies, or foreign bodies. Clean the eyes and seek veterinary advice if it persists.',
                    'weight loss': 'Unexplained weight loss can be a sign of underlying health issues such as metabolic disorders, infections, or more serious conditions. A vet consultation is important.'
                };

                return diagnoses[symptom] ?? 'Please consult a veterinarian for an accurate diagnosis.';
            }

            const diagnosis = generateDiagnosis(mainSymptom);

            const reportContent = `
                <strong>User Details:</strong><br>
                Full Name: ${fullName}<br>
                Phone: ${phone}<br>
                Email: ${email}<br><br>
                <strong>Pet Details:</strong><br>
                Sex: ${sex}<br>
                Age: ${age}<br><br>
                <strong>Symptom Details:</strong><br>
                Main Symptom: ${mainSymptom}<br>
                Symptom Details: ${symptomDetails}<br><br>
                <strong>Diagnosis:</strong><br>
                ${diagnosis}
            `;

            document.getElementById('reportContent').innerHTML = reportContent;

            nextStep(5);
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('step-1').classList.add('active');
        });
    </script>
</body>
</html>
