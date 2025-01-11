class Validator {
    isNumberAndLetter(input) {
        return /^[a-zA-Z0-9\s]+$/.test(input);
    }
    isNumber(input) {
        return !isNaN(input) && input.trim() !== "";
    }

    isLetter(input) {
        return /^[a-zA-Z\s]+$/.test(input);
    }

    isEmail(input) {
        const emailRogex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRogex.test(input);
    }
    hasSpecialCharacters(input) {
        return /[!@#$%^&*(),.?":{}|<>]/.test(input);
    }
    isCellPhone(input) {
        if (this.isNumber(input)) {
            if (
                input.length == 8 &&
                parseInt(input) >= 60000000 &&
                parseInt(input) <= 79999999
            )
                return true;
        }
        return false;
    }
    isDniNit(input) {
        if (this.isNumber(input)) {
            if (input.length >= 7) return true;
        }
        return false;
    }
    isMinLen(input) {
        return input.length >= 8;
    }
}
