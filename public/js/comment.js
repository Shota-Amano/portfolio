$(function() {
    get_data();
});

function get_data() {
    $.ajax({
        url: "result/ajax/",
        dataType: "json",
        success: data => {
            console.log(data.comments);
            for (var i = 0; i < data.comments.length; i++) {
               console.log(data.comments[i].name);
                console.log(data.comments[i].comment);
            }
        },
        error: () => {
            alert("ajax Error");
        }
    });

    setTimeout("get_data()", 5000);
}