var indexDreams = {

    yearClicking: function () {
        $(".indexDreams-3title").click(function (e) {
            $(this).nextUntil(".indexDreams-3title").not("[class^=indexDreams-dateTime]").toggle(200);
            $(this).nextUntil(".indexDreams-3title").not(".indexDreams-4title").css("display", "none");
        });
    },

    monthClicking: function () {
        $(".indexDreams-4title").click(function () {
            $(this).nextUntil(".indexDreams-4title").not(".indexDreams-3title").toggle(200);
        });
    },

    hClicking: function () {
        var nbClick = 0;
        $("#indexDreamsTitle").click(function () {
            if (nbClick % 2 === 0) {
                $("[class^=indexDreams-dateTime], .indexDreams-4title").hide(200);
                nbClick++;
            }
            else {
                $("[class^=indexDreams-dateTime], .indexDreams-4title").show(200);
                nbClick++;
            }
        });
    }
}