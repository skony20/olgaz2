/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(
	function()
	{
          var i;
          var lastChildID =  $('.all').children().last().attr('id');
          for (i=1; i<=lastChildID; i++)
          {
              
          }   
        $(".less").click(
			function() {
                        
				var ID = ($(this).attr('id'));
                        var postId = 'more_' + ID;
                        element = '.more_' + ID;
                        $(element).slideToggle('slow');
                        document.cookie=""+postId+"=YES; expires=Thu, 18 Dec 2013 12:00:00 UTC";
			}
		);
});