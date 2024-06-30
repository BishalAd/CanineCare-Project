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

function printReport() {
    const reportContent = document.getElementById('reportContent').innerHTML;
    const printWindow = window.open('', '', 'height=600,width=800');
    printWindow.document.write('<html><head><title>Symptom Report</title>');
    printWindow.document.write('</head><body >');
    printWindow.document.write(reportContent);
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    printWindow.print();
}



var config = {
    publicKey: "test_public_key_d7636da7c54a41e0af3f6f1689e2d85e",
    productIdentity: "1234567890",
    productName: "Canine Care Service",
    productUrl: "http://bishaladhikari7.com.np",
    eventHandler: {
        onSuccess(payload) {
            var form = document.createElement('form');
            form.method = 'POST';
            form.action = 'payment_success.php';
            form.innerHTML = '<input type="hidden" name="payment_token" value="' + payload.token + '">' +
                '<input type="hidden" name="amount" value="' + payload.amount + '">' +
                '<input type="hidden" name="payment_method" value="khalti">';
            document.body.appendChild(form);
            form.submit();
        },
        onError(error) {
            console.log(error);
        },
        onClose() {
            console.log('Widget is closing');
        }
    }
};
var checkout = new KhaltiCheckout(config);
var btn = document.getElementById("khalti-payment-button");
btn.onclick = function() {
    checkout.show({
        amount: 19900
    });
}

function showPaymentPopup() {
    document.getElementById("paymentPopupForm").style.display = "block";
}

function closePaymentPopup() {
    document.getElementById("paymentPopupForm").style.display = "none";
}

function openPopup() {
    document.getElementById("popupForm").style.display = "block";
}

function closePopup() {
    document.getElementById("popupForm").style.display = "none";
}

function showPaymentPopup() {
    document.getElementById("paymentPopupForm").style.display = "block";
}

function closePaymentPopup() {
    document.getElementById("paymentPopupForm").style.display = "none";
}
