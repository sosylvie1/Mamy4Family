
// validation inscription mamie

document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('inscription_mamie');

    // Validation dynamique lors de la saisie
    form.addEventListener('input', (e) => {
        const target = e.target;

        switch (target.id) {
            case 'prenom':
                validateNameField(target, 'prenomError', 'Le prénom doit commencer par une majuscule.');
                break;
            case 'nom':
                validateNameField(target, 'nomError', 'Le nom doit commencer par une majuscule.');
                break;
            case 'age':
                validateAgeField(target, 'ageError');
                break;
            case 'adresse':
                validateAddressField(target, 'adresseError');
                break;
            case 'ville':
                validateCityField(target, 'villeError');
                break;
            case 'telephone':
                validatePhoneField(target, 'telephoneError');
                break;
            case 'email':
                validateEmailField(target, 'emailError');
                break;
            case 'password':
                validatePasswordField(target, 'passwordError');
                break;
            case 'confirm_password':
                validateConfirmPassword(document.getElementById('password'), target, 'confirmPasswordError');
                break;
            case 'tarif_horaire':
                validateHourlyRateField(target, 'tarifHoraireError');
                break;
            default:
                break;
        }
    });

    // Validation complète avant soumission
    form.addEventListener('submit', (e) => {
        let valid = true;

        if (!validateNameField(form.querySelector('#prenom'), 'prenomError', 'Le prénom doit commencer par une majuscule.')) valid = false;
        if (!validateNameField(form.querySelector('#nom'), 'nomError', 'Le nom doit commencer par une majuscule.')) valid = false;
        if (!validateAgeField(form.querySelector('#age'), 'ageError')) valid = false;
        if (!validateAddressField(form.querySelector('#adresse'), 'adresseError')) valid = false;
        if (!validateCityField(form.querySelector('#ville'), 'villeError')) valid = false;
        if (!validatePhoneField(form.querySelector('#telephone'), 'telephoneError')) valid = false;
        if (!validateEmailField(form.querySelector('#email'), 'emailError')) valid = false;
        if (!validatePasswordField(form.querySelector('#password'), 'passwordError')) valid = false;
        if (!validateConfirmPassword(form.querySelector('#password'), form.querySelector('#confirm_password'), 'confirmPasswordError')) valid = false;
        if (!validateHourlyRateField(form.querySelector('#tarif_horaire'), 'tarifHoraireError')) valid = false;

        if (!valid) {
            e.preventDefault(); // Bloque la soumission si une validation échoue
        }
    });

    // Fonctions de validation

    // Validation des champs de texte (nom, prénom)
    function validateNameField(field, errorId, errorMessage) {
        const regex = /^[A-ZÀ-Ÿ]/; // Vérifie que la première lettre est une majuscule
        const error = document.getElementById(errorId);
        if (!regex.test(field.value.trim())) {
            error.textContent = errorMessage;
            field.classList.add('error-input');
            return false;
        } else {
            error.textContent = '';
            field.classList.remove('error-input');
            return true;
        }
    }

    // Validation de l'âge
    function validateAgeField(field, errorId) {
        const error = document.getElementById(errorId);
        const age = parseInt(field.value, 10);
        if (isNaN(age) || age < 50 || age > 100) {
            error.textContent = "L'âge doit être compris entre 50 et 100 ans.";
            field.classList.add('error-input');
            return false;
        } else {
            error.textContent = '';
            field.classList.remove('error-input');
            return true;
        }
    }

    // Validation de l'adresse
    function validateAddressField(field, errorId) {
        const error = document.getElementById(errorId);
        if (field.value.trim() === '') {
            error.textContent = "L'adresse est obligatoire.";
            field.classList.add('error-input');
            return false;
        } else {
            error.textContent = '';
            field.classList.remove('error-input');
            return true;
        }
    }

    // Validation de la ville
    function validateCityField(field, errorId) {
        const regex = /^[A-Za-zÀ-Ÿ\- ]+$/; // Lettres, espaces, et tirets autorisés
        const error = document.getElementById(errorId);
        if (!regex.test(field.value.trim())) {
            error.textContent = "La ville est invalide. Elle doit contenir uniquement des lettres.";
            field.classList.add('error-input');
            return false;
        } else {
            error.textContent = '';
            field.classList.remove('error-input');
            return true;
        }
    }

    // Validation du téléphone
    function validatePhoneField(field, errorId) {
        const regex = /^\d{10}$/; // 10 chiffres
        const error = document.getElementById(errorId);
        if (!regex.test(field.value.trim())) {
            error.textContent = "Le numéro de téléphone doit comporter exactement 10 chiffres.";
            field.classList.add('error-input');
            return false;
        } else {
            error.textContent = '';
            field.classList.remove('error-input');
            return true;
        }
    }

    // Validation de l'email
    function validateEmailField(field, errorId) {
        const regex = /^[^@\s]+@[^@\s]+\.[^@\s]+$/; // Format simple d'email
        const error = document.getElementById(errorId);
        if (!regex.test(field.value.trim()) || field.value.trim().length < 8) {
            error.textContent = "L'email est invalide ou trop court (minimum 8 caractères).";
            field.classList.add('error-input');
            return false;
        } else {
            error.textContent = '';
            field.classList.remove('error-input');
            return true;
        }
    }

    // Validation du mot de passe
    function validatePasswordField(field, errorId) {
        const error = document.getElementById(errorId);
        if (field.value.trim().length < 8) {
            error.textContent = "Le mot de passe doit comporter au moins 8 caractères.";
            field.classList.add('error-input');
            return false;
        } else {
            error.textContent = '';
            field.classList.remove('error-input');
            return true;
        }
    }

    // Validation de la confirmation du mot de passe
    function validateConfirmPassword(passwordField, confirmField, errorId) {
        const error = document.getElementById(errorId);
        if (passwordField.value.trim() !== confirmField.value.trim()) {
            error.textContent = "Les mots de passe ne correspondent pas.";
            confirmField.classList.add('error-input');
            return false;
        } else {
            error.textContent = '';
            confirmField.classList.remove('error-input');
            return true;
        }
    }

    // Validation du tarif horaire
    function validateHourlyRateField(field, errorId) {
        const error = document.getElementById(errorId);
        const hourlyRate = parseFloat(field.value);
        if (isNaN(hourlyRate) || hourlyRate <= 0) {
            error.textContent = "Le tarif horaire doit être un nombre supérieur à zéro.";
            field.classList.add('error-input');
            return false;
        } else {
            error.textContent = '';
            field.classList.remove('error-input');
            return true;
        }
    }
});
