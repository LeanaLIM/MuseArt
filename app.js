const heureVisiteInput = document.getElementById("heure_visite");

    heureVisiteInput.addEventListener("change", function() {
        const selectedTime = heureVisiteInput.value;
        const hourFormat24 = convertTo24Hour(selectedTime);

        if (!hourFormat24 || hourFormat24 < 10 || hourFormat24 >= 18) {
            heureVisiteInput.setCustomValidity("L'heure de visite doit être entre 10h et 18h.");
        } else {
            heureVisiteInput.setCustomValidity("");
        }
    });

    function convertTo24Hour(selectedTime) {
        const timeSplit = selectedTime.split(":");
        const hour = parseInt(timeSplit[0]);
        const minute = parseInt(timeSplit[1]);
        const amPmIndex = selectedTime.indexOf("M");

        if (amPmIndex !== -1) {
            // Convertir l'heure de 12h à 24h
            if (selectedTime.endsWith("PM") && hour < 12) {
                return hour + 12;
            } else if (selectedTime.endsWith("AM") && hour === 12) {
                return 0;
            }
        }

        return hour;
    }

// Code ajusté
const picker = document.getElementById('date_visite');
picker.addEventListener('change', function(e) {
    var day = new Date(this.value).getUTCDay();
    if ([6, 0].includes(day)) {
        this.value = '';
        alert('Weekends not allowed');
    }
});