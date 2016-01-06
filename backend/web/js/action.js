/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(
	function()
	{
        $(".less").click(
			function() {
                      
				var ID = ($(this).attr('id'));
                       
                        element = '.more_' + ID;
                         $(element).slideToggle('slow');
			}
		);
});