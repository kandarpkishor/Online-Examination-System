$(document).ready(function()
{
$("#usernm").keyup(function()
	{
		var id=$("#usernm").val();
		var dataString = 'id='+ id;
		$.ajax
		({
			type: "POST",
			url: "cheakuser.php",
			data: dataString,
			cache: false,
			success: function (response) {
				$( '#p1' ).html(response);
				   if(response=="OK")	
				   {
					return true;	
				   }
				   else
				   {
					return false;	
				   }
			  }
			//(html)
			//{
				//$("p").html(html);
				//$("#usernm").val("");
				
			//} 
		});
	});
	
});


function showHint(str) {
  if (str.length == 0) {
    document.getElementById("txtHint").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("txtHint").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET", "gethint.php?q=" + str, true);
    xmlhttp.send();
  }
}