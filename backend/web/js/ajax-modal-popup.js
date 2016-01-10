$(function(){
      $(document).on('click', '.showModalButton', function(){
        if ($('#modal').data('bs.modal').isShown) {
            $('#modal').find('#modalContent')
                    .load($(this).attr('value'));
            document.getElementById('modalHeaderTitle').innerHTML = '<h4>' + $(this).attr('title') + '</h4>';
        } else {

            $('#modal').modal('show')
                    .find('#modalContent')
                    .load($(this).attr('value'));

            document.getElementById('modalHeaderTitle').innerHTML = '<h4>' + $(this).attr('title') + '</h4>';
        }
    });
});




$(function(){
      $(document).on('click', '.addPostImages', function(){
        if ($('#modal2').data('bs.modal').isShown) {
            $('#modal2').find('#modal2Content')
                    .load($(this).attr('value'));
            document.getElementById('modal2HeaderTitle').innerHTML = '<h4>' + $(this).attr('title') + '</h4>';
        } else {

            $('#modal2').modal('show')
                    .find('#modal2Content')
                    .load($(this).attr('value'));

            document.getElementById('modal2HeaderTitle').innerHTML = '<h4>' + $(this).attr('title') + '</h4>';
        }
    });
});