
(function ($) {
    
    "use strict";   // use strict
    $(document).ready(function ($) {    //    started ready function

        // collaps button
        $(".collaps-button").on('click', function () {
            if ($(".collaps-button").hasClass("bar-Collepsed") === false) {
               $(".collaps-button").addClass("bar-Collepsed");
               $(".main-body").css({"margin-left" : "55px"});
               $(".main-menu-area").addClass("menu-collepsed").css({"width" : "55px"});
            } else {
               $(".collaps-button").removeClass("bar-Collepsed");
               $(".main-body").css({"margin-left" : "205px"});
               $(".main-body").css({"margin-left" : "205px"});
               $(".main-menu-area").removeClass("menu-collepsed").css({"width" : "205px"});
            };
        });

        // custom dropdown menu
        $("#custom-dropdown").on('click', function () {
            if ($(".custom-drop-list").hasClass("show") === false) {
               $(".custom-drop-list").addClass("show");
            } else {
               $(".custom-drop-list").removeClass("show");
            };
        });

        // custom checkbox
        $(".checkbox i").on('click', function () {
            if ($(this).hasClass("checked") === false) {
               $(this).addClass("checked");
               $(this).addClass("fa-check-square");
               $(this).removeClass("fa-square-o");
            } else {
               $(this).removeClass("checked");
               $(this).addClass("fa-square-o");
               $(this).removeClass("fa-check-square");
            };
        });

        // upload cover photo
        document.getElementById('buttonid').addEventListener('click', openDialog);
        function openDialog() {
            document.getElementById('fileid').click();
        }
        var loadFile = function(event) {
          var output = document.getElementById('output');
          output.src = URL.createObjectURL(event.target.files[0]);
        };

        // custom editor
        $('.text-editor').froalaEditor();

        // date picker
        $('#datepicker').datepicker({
            uiLibrary: 'bootstrap4'
        });

    });    //   ended ready function

}(jQuery));