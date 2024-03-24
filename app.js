const picker = document.getElementById('dateVisite');
picker.addEventListener('change', function (e) {
    var day = new Date(this.value).getUTCDay();
    if ([6, 0].includes(day)) {
        this.value = '';
        alert('Weekends not allowed');
    }

    console.log('OK');
});


