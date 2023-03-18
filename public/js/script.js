$(document).ready(function () {
    console.log("ready");
    $(".dropdown-button").on("click", function () {
        var button = $(this);
        var dropdownContent = button.parents().find(".dropdown-content");
        var arrow = $(this).find(".arrow");
        if (arrow.hasClass("rotate-180")) {
            arrow.removeClass("rotate-180");
        } else {
            arrow.addClass("rotate-180");
        }
        dropdownContent.animate(
            {
                height: "toggle",
            },
            300
        );
    });
    $("#tambah-pegawai").on("click", function () {
        var modal = $("#modal-tambah-pegawai");
        modal.show();
    });
    $("#close-tambah-pegawai-modal").on("click", function () {
        var modal = $("#modal-tambah-pegawai");
        modal.hide();
    });
    $("#edit-pegawai").on("click", function () {
        var modal = $("#modal-edit-pegawai");
        modal.show();
    });
    $("#close-edit-pegawai-modal").on("click", function () {
        var modal = $("#modal-edit-pegawai");
        modal.hide();
    });
    $("#absensi-button").on("click", function () {
        var modal = $("#modal-absensi");
        modal.show();
    });
    $("#close-absensi-modal").on("click", function () {
        var modal = $("#modal-absensi");
        modal.hide();
    });
});
