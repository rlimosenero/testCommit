<!DOCTYPE html>

<html>
<head>
<title>Get All Cash Services</title>
<meta charset="utf-8" />
<style type="text/css">
#submit_service_code {
	visibility: hidden;
}
</style>

</head>

<body>
	<div class="container" id="container">

		<form action="cashtransaction.php" method="POST" id="myForm">
			<input type="text" id="service_code" name="service_code"
				class="input-control input-control-lg">

			<table class="gridtable" id="tableMain">
				<thead>
					<tr class="tableheader">
						<th>CASH SERVICES</th>
					</tr>
				</thead>
				<tbody>
    
                        <?php
                        include 'getcashservices.php';
                        foreach ($obj as $key => $value) {
                            echo '<tr class="datarow">
                                <td style="display:none">';
                            echo $value->Services;
                            echo '  </td>
                                <td>';
                            echo $value->Description;
                            echo ' </td>
                              </tr>';
                        }
                        ?>
                     
                   
                </tbody>
			</table>
			<input type="submit" id="submit_service_code">
		</form>

	</div>

	<!-- <button id="thebutton" type="button">Add row</button>     -->

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="choose.js" type="text/javascript"></script>


</body>
</html>