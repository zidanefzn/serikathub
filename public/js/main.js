(function ($) {
    "use strict";

    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 1);
    };
    spinner();

    // Sidebar Toggler
    $('.sidebar-toggler').click(function () {
        $('.sidebar, .content').toggleClass("open");
        return false;
    });

    // Chart
    var ctx1 = $("#worldwide-sales").get(0).getContext("2d");
    var myChart1 = new Chart(ctx1, {
        type: "bar",
        data: {
            labels: ["2024"],
            datasets: [{
                    label: "KONFED",
                    data: [52],
                    backgroundColor: "rgba(0, 156, 255, .7)"
                },
                {
                    label: "FED",
                    data: [72],
                    backgroundColor: "rgba(0, 156, 255, .5)"
                },
                {
                    label: "SP/SB",
                    data: [122],
                    backgroundColor: "rgba(0, 156, 255, .3)"
                }
            ]
            },
        options: {
            responsive: true
        }
    });
    
})(jQuery);

