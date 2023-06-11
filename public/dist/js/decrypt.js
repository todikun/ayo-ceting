function decryptFirebaseConfig(encryptedFirebaseConfig, key) {
    var decryptedFirebaseConfig = {};
    var secretKey = decryptTextChiper(key);

    try {
        var decrypted = CryptoJS.AES.decrypt(encryptedFirebaseConfig, secretKey).toString(CryptoJS.enc.Utf8);
        decryptedFirebaseConfig = JSON.parse(decrypted);
    } catch (error) {
        console.error('Gagal mendekripsi konfigurasi Firebase:', error);
    }

    return decryptedFirebaseConfig;
}

function decryptTextChiper(text) {
    let shift = 5;
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
