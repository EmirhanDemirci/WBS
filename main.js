function schoonmaakPloeg(value){
    var schoneValue =  value.replace(/[.,|<>?;:'"\/#!$%\^&\*;:{}=\-_`~()]/g,"");
    if (schoneValue == ""){
        schoneValue = "UNKNOWN TXT";
    }
    return schoneValue;
}



$('#submit').click(function(){
    if ($('#firstname').val() == ""){
       alert("je firstname is leeg");
    }
    else
    {
        $.post("database.php", {ajax: 1, status: "verstuurProject", firstname: $('#firstname').val()});
        alert("Het verstuurde data = " + $('#firstname').val());
        $('#firstname').val("");
    }

});
$('#submit2').click(function(){
    if ($('#taskname').val() == ""){
        alert("je taskname is leeg ");
    }
    else
    {
        console.log($('#taskname').val() +  "  - -   " + $('#predecessor').val());
        $.post("database.php", {
            ajax: 1,
            status: "verstuurTask",
            taskname: $('#taskname').val(),
            predecessor: $('#predecessor').val(),
            plan: $('#plan').val(),
            project_id: $('#taskname').attr('data-project_id')
        }).done(function (chocolade) {
          console.dir(chocolade);
        });
            alert("Het verstuurde data = " + $('#taskname').val() );
        $('#taskname').val("");
    }

});

$('.deleteProject').click(function () {
    var project_id = $(this).attr('data-project_id');
    $('#row'+project_id).remove();
    console.log(project_id);
    $.post("database.php", {ajax: 1, status: "verwijderProject", project_id: project_id });

});





function HMSToSeconds(hms){
    var a = hms.split(':'); // split it at the colons
    var secondsDo = (+a[0]) * 60 * 60 + (+a[1]) * 60 + (+a[2]);
    return secondsDo;
}

function secondsToHMS(seconds){
    var time = new Date(1000 * seconds).toISOString().substr(11, 8);
    return time;
}

$('.timerIcon').click(function inklokken() {

    var sec = 0;
    var opdracht_id = $(this).attr('data-value');
    var klokToestaan = true;

    if($(this).attr('data-status') == 'uitgeklokt' && klokToestaan == true){
        var hms = $('.do'+opdracht_id).text();
        var a = hms.split(':'); // split it at the colons
        var secondsDo = (+a[0]) * 60 * 60 + (+a[1]) * 60 + (+a[2]);

        var hmsDo = $('.sumDo').text()
        var aDo = hmsDo.split(':'); // split it at the colons
        var secondsTotaalDo = (+aDo[0]) * 60 * 60 + (+aDo[1]) * 60 + (+aDo[2]);

        function tictac(){ // teller van tijd
            sec++;



/*
            var planned =  new Date(1000 * ($('.plan'+opdracht_id).text()) ).toISOString().substr(11, 8);


            if (secondsDo + sec > planned )
            {
                $('.do'+opdracht_id).css('color', 'red');
            }
            else
            {
                $('.do'+opdracht_id).css('color', 'green');
            }
*/

            //var bijelkaar =  new Date(1000 * (secondsDo + sec) ).toISOString().substr(11, 8);
            $('.do'+opdracht_id).html(secondsToHMS(secondsDo + sec)); // HH:MM:SS gaat in div #tijd

            //var seconden =  new Date(1000 * sec ).toISOString().substr(11, 8);
            $('.do'+opdracht_id).attr('data-dezeSessie', secondsToHMS(sec) );

            //var totaaldosec =  new Date(1000 * (secondsTotaalDo + sec) ).toISOString().substr(11, 8);

            $('.sumDo').html(secondsToHMS(secondsTotaalDo + sec));


            if (HMSToSeconds($('.sumDo').text()) >  HMSToSeconds($('.sumPlan').text())){
                $('.sumDo').css('color', 'red');
            }
        }

        timer = setInterval(tictac, 1000);

        $(this).attr('data-status', 'ingeklokt');
        $(this).text("timer_on");
        $('.row'+opdracht_id).addClass('active');


        klokToestaan = false;
    }

    if($(this).attr('data-status') == 'ingeklokt' && klokToestaan == true){
        sec = 0;
        clearInterval(timer);
        $.post( "database.php", { ajax: 1, status: "klokken", taak_id: opdracht_id, tijd:  $('.do'+opdracht_id).attr('data-dezeSessie') } );
        $(this).attr('data-status', 'uitgeklokt');
        $(this).text("timer_off");
        $('.row'+opdracht_id).removeClass('active');
        klokToestaan = false;
        var project_id = $(this).attr('data-project_id');
/*        $.post( "database.php, { ajax: 1, status: "showKlok", id: opdracht_id } ).done(function(data){
            $('.do'+opdracht_id).html(data);
        });*/
    }
})

/*
$(document).keydown(function (event) {
    if (event.keyCode == 123) { // Prevent F12
        return false;
    } else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) { // Prevent Ctrl+Shift+I
        return false;
    }
});

$(document).on("contextmenu", function (e) {
    e.preventDefault();
});*/
