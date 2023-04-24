$('#datepicker').datepicker({
    formatDate:'yy-mm-dd'
});

/*$(function () {
    $('.txthour').timepicker({
        showMeridian: false,
        defaultTime: false,
    }).on('change', function () {
         gettime();
    });
});*/

function toSeconds(time) {
    var parts = time.split(':');
    return (+parts[0]) * 60 * 60 + (+parts[1]) * 60 + (+parts[2]);
}

function toHHMMSS(sec) {
    var sec_num = parseInt(sec, 10); // don't forget the second parm
    var hours = Math.floor(sec_num / 3600);
    var minutes = Math.floor((sec_num - (hours * 3600)) / 60);
    var seconds = sec_num - (hours * 3600) - (minutes * 60);

    if (hours < 10) {
        hours = "0" + hours;
    }
    if (minutes < 10) {
        minutes = "0" + minutes;
    }
    if (seconds < 10) {
        seconds = "0" + seconds;
    }
    var time = hours + ':' + minutes;
    return time;
}

function gettime() {
    var total = 0;
    $('.txthour').each(function () {
        if ($(this).val() != '') {
            total += toSeconds($(this).val() + ':00');
        }
    });
    if (total != 0) {
        $('.txttotal').val(toHHMMSS(total));
    }
}