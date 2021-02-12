$(document).ready(function() {	
	//click on table body

	$('#tableMain tbody').on('click', 'tr', function() {
		//get row contents into an array
		var tableData = $(this).children("td").map(function() {
			return $(this).text();
		}).get();
		var td = tableData[0];
		
		$("input:text").val(td);//set service_code before submit
		formSubmit();
		
	});

	$("#thebutton").click(function() {
		$('#tableMain > tbody').append('<tr class="datarow"><td>11111</td><td>22222</td><td>33333</td><td>44444</td><td>55555</td></tr>')
	})
});

function formSubmit() {
	//alert(td);
	document.getElementById("myForm").submit();
	
}    

    		var t;
    		window.onload = resetTimer;
    		document.onkeypress = resetTimer;
    		window.onmousemove = resetTimer;
    
    		function logout() {
    			alert("Session Timeout!")
    			var url = 'logout.php';
    			location.href = url;
    		}
    
    		function resetTimer() {
    			clearTimeout(t);
    			t = setTimeout(logout, 600000)
    		}
    
    		function quit() {
    			event.returnValue = "Are you sure you have finished?"
    		}    //$("#tableMain tbody tr").click(function () {