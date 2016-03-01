/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

alert (baseUrl);
$(document).ready(
    function()
    {
        $(".less").click(
            function() {
                
                var ID = ($(this).attr('rel'));
                var postId = 'more_' + ID;
                element = '.more_' + ID;
                $(element).toggle();
            });
               
        $('.status_icon').on('click', function(e) {
            
            
            var iId = ($(this).attr('rel'));
            var sActive = ($(this).attr('rel2')); 
            $.ajax({
                url: '/post/activeunactive',
                data: {id: iId, p_sActive: sActive}
             });
        });
        $(".messages").stop(true, true).delay(1500).animate(
                {
                    top: '-50px',
                    opacity: '0'
                }, 500);
                
        

});