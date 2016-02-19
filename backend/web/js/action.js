/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(
    function()
    {
        function getCookie(name)
        {
          var re = new RegExp(name + "=([^;]+)");
          var value = re.exec(document.cookie);
          return (value !== null) ? unescape(value[1]) : null;
        }
        var i;
        var lastChildID =  $('.all').children().first().attr('id');
        for (i=1; i<=lastChildID; i++)
        {   
            var cookieId = 'more_'+i;
            var x = getCookie(cookieId);

            element = '.more_' + i;
            if (x === 'YES')
            {

                $(element).show();
            }
        }   
        $(".less").click(
            function() {
                var ID = ($(this).attr('id'));
                var postId = 'more_' + ID;
                element = '.more_' + ID;
                $(element).toggle();
                if ($(element).is(':visible') === true )
                {
                    document.cookie=""+postId+"=YES; expires=Thu, 01 Jan 2222 00:00:00 UTC";
                }
                if ($(element).is(':hidden') === true )
                {
                    document.cookie=""+postId+"=YES; expires=Thu, 01 Jan 1901 00:00:00 UTC";
                }
            });
        $('.status_icon').on('click', function(e) {

            var iId = ($(this).attr('rel'));
            var sActive = ($(this).attr('rel2')); 
            $.ajax({
                url: 'activeunactive',
                data: {id: iId, p_sSctive: sActive},
                success: function(data) {
                    location.reload();
                }
             });
        });
});

