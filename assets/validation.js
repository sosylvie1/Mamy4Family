// validation login
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('login-form');

    form.addEventListener('input', (e) => {
        const target = e.target;

        switch (target.id) {
            case 'email':
                validateEmailField(target, 'emailError');
                break;
            case 'password':
                validatePasswordField(target, 'passwordError');
                break;
            default:
                break;
        }
    });

    form.addEventListener('submit', (e) => {
        let valid = true;

        if (!validateEmailField(form.querySelector('#email'), 'emailError')) valid = false;
        if (!validatePasswordField(form.querySelector('#password'), 'passwordError')) valid = false;

        if (!valid) {
            e.preventDefault();
        }
    });

    function validateEmailField(field, errorId) {
        const regex = /^[^@\s]+@[^@\s]+\.[^@\s]+$/;
        const error = document.getElementById(errorId);
        if (!regex.test(field.value.trim())) {
            error.textContent = "Veuillez entrer un email valide.";
            field.classList.add('error-input');
            return false;
        } else {
            error.textContent = '';
            field.classList.remove('error-input');
            return true;
        }
    }

    function validatePasswordField(field, errorId) {
        const error = document.getElementById(errorId);
        if (field.value.trim().length < 8) {
            error.textContent = "Le mot de passe doit contenir au moins 8 caractères.";
            field.classList.add('error-input');
            return false;
        } else {
            error.textContent = '';
            field.classList.remove('error-input');
            return true;
        }
    }
});


// validation inscription mamie
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('inscription_famille');

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
            case 'adresse':
                validateAddressField(target, 'adresseError');
                break;
            case 'ville':
                validateCityField(target, 'villeError');
                break;
            case 'telephone':
                validateTelephoneField(target, 'telephoneError');
                break;
            case 'email':
                validateEmailField(target, 'emailError');
                break;
            case 'password':
                validatePasswordField(target, 'passwordError');
                break;
            case 'confirm_password':
                validateConfirmPassword(form.querySelector('#password'), target, 'confirmPasswordError');
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
        if (!validateAddressField(form.querySelector('#adresse'), 'adresseError')) valid = false;
        if (!validateCityField(form.querySelector('#ville'), 'villeError')) valid = false;
        if (!validateTelephoneField(form.querySelector('#telephone'), 'telephoneError')) valid = false;
        if (!validateEmailField(form.querySelector('#email'), 'emailError')) valid = false;
        if (!validatePasswordField(form.querySelector('#password'), 'passwordError')) valid = false;
        if (!validateConfirmPassword(form.querySelector('#password'), form.querySelector('#confirm_password'), 'confirmPasswordError')) valid = false;

        const childrenValid = validateChildren();
        if (!childrenValid) valid = false;

        if (!valid) {
            e.preventDefault(); // Bloque la soumission si des erreurs sont détectées
        }
    });

    // Ajout dynamique d'enfants
    document.getElementById('add-child-btn').addEventListener('click', () => {
        const childrenInfo = document.getElementById('children-info');
        const newChild = document.createElement('div');
        newChild.classList.add('child');
        newChild.innerHTML = `
            <label>Nom de l'enfant :</label>
            <input type="text" name="child_name[]" required>
            <span class="error childNameError"></span>
            <label>Âge :</label>
            <input type="number" name="child_age[]" min="0" required>
            <span class="error childAgeError"></span>
            <label>Genre :</label>
            <select name="child_gender[]" required>
                <option value="">Sélectionner</option>
                <option value="fille">Fille</option>
                <option value="garçon">Garçon</option>
            </select>
            <span class="error childGenderError"></span>
        `;
        childrenInfo.appendChild(newChild);
    });

    // Validation des enfants
    function validateChildren() {
        let valid = true;
        const children = document.querySelectorAll('.child');
        children.forEach((child, index) => {
            const nameField = child.querySelector('[name="child_name[]"]');
            const ageField = child.querySelector('[name="child_age[]"]');
            const genderField = child.querySelector('[name="child_gender[]"]');

            const nameError = child.querySelector('.childNameError');
            const ageError = child.querySelector('.childAgeError');
            const genderError = child.querySelector('.childGenderError');

            // Validation du nom
            if (!nameField.value.trim()) {
                nameError.textContent = `Le nom de l'enfant ${index + 1} est obligatoire.`;
                nameField.classList.add('error-input');
                valid = false;
            } else {
                nameError.textContent = '';
                nameField.classList.remove('error-input');
            }

            // Validation de l'âge
            if (!ageField.value.trim() || ageField.value <= 0) {
                ageError.textContent = `L'âge de l'enfant ${index + 1} doit être un nombre positif.`;
                ageField.classList.add('error-input');
                valid = false;
            } else {
                ageError.textContent = '';
                ageField.classList.remove('error-input');
            }

            // Validation du genre
            if (!genderField.value.trim()) {
                genderError.textContent = `Le genre de l'enfant ${index + 1} est obligatoire.`;
                genderField.classList.add('error-input');
                valid = false;
            } else {
                genderError.textContent = '';
                genderField.classList.remove('error-input');
            }
        });
        return valid;
    }

    // Validation des champs de texte pour vérifier qu'ils commencent par une majuscule
    function validateNameField(field, errorId, errorMessage) {
        const errorElement = document.getElementById(errorId);
        const regex = /^[A-ZÀ-Ÿ]/; // Vérifie que la première lettre est une majuscule
        if (!regex.test(field.value.trim())) {
            errorElement.textContent = errorMessage;
            field.classList.add('error-input');
            return false;
        } else {
            errorElement.textContent = '';
            field.classList.remove('error-input');
            return true;
        }
    }

    
    // Validation de la ville
    function validateCityField(field, errorId) {
        const errorElement = document.getElementById(errorId);
        const regex = /^[A-Za-zÀ-Ÿ\- ]+$/; // Lettres avec espaces et tirets autorisés
        if (!regex.test(field.value.trim())) {
            errorElement.textContent = "La ville est invalide. Elle doit contenir uniquement des lettres.";
            field.classList.add('error-input');
            return false;
        } else {
            errorElement.textContent = '';
            field.classList.remove('error-input');
            return true;
        }
    }

    // Validation de l'email
    function validateEmailField(field, errorId) {
        const errorElement = document.getElementById(errorId);
        const regex = /^[^\\s@]+@[^\\s@]+\\.[^\\s@]+$/;
        if (!regex.test(field.value.trim()) || field.value.trim().length < 8) {
            errorElement.textContent = "L'email est invalide ou trop court (minimum 8 caractères).";
            field.classList.add('error-input');
            return false;
        } else {
            errorElement.textContent = '';
            field.classList.remove('error-input');
            return true;
        }
    }

    // Validation du téléphone
    function validateTelephoneField(field, errorId) {
        const errorElement = document.getElementById(errorId);
        const regex = /^\d{10}$/; // 10 chiffres
        if (!regex.test(field.value.trim())) {
            errorElement.textContent = 'Le numéro de téléphone doit comporter exactement 10 chiffres.';
            field.classList.add('error-input');
            return false;
        } else {
            errorElement.textContent = '';
            field.classList.remove('error-input');
            return true;
        }
    }

    // Validation du mot de passe
    function validatePasswordField(field, errorId) {
        const errorElement = document.getElementById(errorId);
        if (field.value.length < 5) {
            errorElement.textContent = "Le mot de passe doit comporter au moins 5 caractères.";
            field.classList.add('error-input');
            return false;
        } else {
            errorElement.textContent = '';
            field.classList.remove('error-input');
            return true;
        }
    }

    // Validation de la confirmation du mot de passe
    function validateConfirmPassword(passwordField, confirmField, errorId) {
        const errorElement = document.getElementById(errorId);
        if (passwordField.value !== confirmField.value) {
            errorElement.textContent = "Les mots de passe ne correspondent pas.";
            confirmField.classList.add('error-input');
            return false;
        } else {
            errorElement.textContent = '';
            confirmField.classList.remove('error-input');
            return true;
        }
    }
});
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

