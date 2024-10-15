$(document).ready(function () {
    function sentMessage() {
        new Notify({
            status: "success",
            title: "Confirmation",
            text: "Message sent.",
            effect: "fade",
            speed: 100,
            customClass: "",
            customIcon: "",
            showIcon: true,
            showCloseButton: true,
            autoclose: true,
            autotimeout: 5000,
            notificationsGap: null,
            notificationsPadding: null,
            type: "outline",
            position: "right top",
            customWrapper: "",
        });
    }

    sentMessage();
});
