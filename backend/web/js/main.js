yii.allowAction = function ($e) {
    var message = $e.data('confirm');
    return message === undefined || yii.confirm(message, $e);
};
yii.confirm = function (message, ok, cancel) {
 
    bootbox.confirm(
        {
            message: message,
            buttons: {
                confirm: {
                    label: '<span class="glyphicon glyphicon-ok confirm-ok"></span>'
                },
                cancel: {
                    label: '<span class="glyphicon glyphicon-remove confirm-cancel"></span>'
                }
            },
            callback: function (confirmed) {
                if (confirmed) {
                    !ok || ok();
                } else {
                    !cancel || cancel();
                }
            }
        }
    );
    // confirm will always return false on the first call
    // to cancel click handler
    return false;
};
$('#input-id').on('fileimagesloaded', function(event) {
     console.log("fileimageloaded");
});