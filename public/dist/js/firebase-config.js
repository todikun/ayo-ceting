function firebaseConfig() {
    var encryptedFirebaseConfig = 'U2FsdGVkX1+6TB9rxkqp0Ou8HKP5GUQ46eVRYx82LjUZ+qR5xm6JfKMwmystw42bkOQriLwIKFIfJtNvEVyJSfigBByRROi0jf9vfeX7Sca6ET2GNgfDfOdEQhWVCMgr8BM6YI5HdkBQ5LFmdDbj/KGke13Db2XV5czVBoUX0Gl6UuWjuIjrZ1yOIqvr0ZTJN4A0NzMUaZt0J6a3/PHcvMxr6S/FaTNAS5mqZgh0qhS7w1WrIWTLGgYEUiabNYYsfi0bDGNthUoY7bHUbW+u5g==';
    var decryptedFirebaseConfig = {};
    var secretKey = decryptTextChiper();

    try {
        var decrypted = CryptoJS.AES.decrypt(encryptedFirebaseConfig, secretKey).toString(CryptoJS.enc.Utf8);
        decryptedFirebaseConfig = JSON.parse(decrypted);
    } catch (error) {
        console.error('Gagal mendekripsi konfigurasi Firebase:', error);
    }

    return decryptedFirebaseConfig;
}

function decryptTextChiper() {
    let shift = 5;
    var text = 'M7foRuDppJSlwGrb0chcowaIVKdm0etgVHHPb4YeFbc5svASlM.jlta4321';
    var decryptedText = "";
    for (var i = 0; i < text.length; i++) {
        var char = text[i];
        if (char.match(/[a-z]/i)) {
        var code = text.charCodeAt(i);
            if (char === char.toUpperCase()) {
                char = String.fromCharCode(((code - 65 - shift + 26) % 26) + 65);
            } else {
                char = String.fromCharCode(((code - 97 - shift + 26) % 26) + 97);
            }
        }
        decryptedText += char;
    }
    return decryptedText;
}
