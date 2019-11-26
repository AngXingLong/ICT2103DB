setInterval(function () {


    loginissue(function (output) {
        console.log(output[2]);
        console.log(sessionid);
        if (output[2] !== sessionid) {

            alert("Your account is logged in from a different device!   ");
            window.location.href = "dbfunction/logout.php";
        }
    }, ip, time, id);


}, 6000);

function loginissue(handleData, ip2, time2, id2) {


    $.ajax({
        url: "dbfunction/checkloginAddress.php",
        type: 'post',
        data: {
            postip: ip2,
            posttime: time2,
            id: id2,

        },
        dataType: 'json',
        success: function (data) {
            console.log(data);
            handleData(data);
        }
    });



}
