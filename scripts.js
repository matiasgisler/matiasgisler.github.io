
let currentStep = 1;
        const totalSteps = 4;

        function showStep(step) {
            document.querySelectorAll('.step').forEach((el) => {
                el.classList.remove('active');
            });
            document.getElementById(`step${step}`).classList.add('active');
            updateProgress(step);
        }

        function updateProgress(step) {
            const progress = ((step - 1) / (totalSteps - 1)) * 100;
            document.getElementById('progress').style.width = `${progress}%`;
            document.getElementById('progress-label').textContent = `Etapa ${step} de ${totalSteps}`;
        }

        function nextStep() {
            const currentStepElement = document.getElementById(`step${currentStep}`);
            // Get all input elements in the current step
            const inputs = currentStepElement.querySelectorAll('input[required], select[required]');
            // Check if all inputs are valid
            let isValid = true;
            inputs.forEach(input => {
                if (!input.checkValidity()) {
                    isValid = false;
                    input.reportValidity(); // Show validation error for invalid input
                }
            });

            if (isValid) {
                currentStep++;
                if (currentStep > totalSteps) currentStep = totalSteps;
                showStep(currentStep);
            }
        }

        function prevStep() {
            currentStep--;
            if (currentStep < 1) currentStep = 1;
            showStep(currentStep);
        }

        function resetForm() {
            document.getElementById('formulario').reset();
            currentStep = 1;
            showStep(currentStep);
        }

        showStep(currentStep);
function updateProgress(step) {
    const progress = ((step - 1) / (totalSteps - 1)) * 100;
    document.getElementById('progress').style.width = `${progress}%`;
    document.getElementById('progress-label').textContent = `Etapa ${step} de ${totalSteps}`;
}

function validateCurrentStep() {
    const inputs = document.querySelectorAll(`#step${currentStep} input[required], #step${currentStep} select[required]`);
    return Array.from(inputs).every(input => input.value.trim() !== '');
}

function nextStep() {
    if (validateCurrentStep()) {
        if (currentStep < totalSteps) {
            currentStep++;
            showStep(currentStep);
        }
    } else {
        alert('Por favor, complete todos los campos requeridos.');
    }
}

function prevStep() {
    if (currentStep > 1) {
        currentStep--;
        showStep(currentStep);
    }
}

function resetForm() {
    if (confirm('¿Está seguro de que desea borrar el formulario?')) {
        document.getElementById('formulario').reset();
        currentStep = 1;
        showStep(currentStep);
    }
}

showStep(currentStep); // Initialize the form to show the first step
