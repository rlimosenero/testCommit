<!DOCTYPE html>

<html>
    <head>
        <title>Get All Cash Services</title>
        <meta charset="utf-8" />
  <style type="text/css">
    body{
      font-size: 1.5rem;
    }
    #submit_search{
      visibility: hidden;
    }
    hr{
      margin-top: 0px;
      margin-bottom: 0px;
    }</style>
    </head>

    <body>
        <div class="container" id="container">
            <form action="cashtransaction.php" method="POST" id="myForm">
            <input type="text" id="service_code" name="service_code" class="input-control input-control-lg">
            <input type="submit" id="submit_service_code">
            <table class="table table-bordered" id="tableMain">
                <thead>
                    <tr class="tableheader">
                        <th>SERVICES</th>
                    </tr>
                </thead>
                <tbody>

                    <?php  
                    include 'getcashservices.php';
                  foreach($obj as $key => $value) {
                     echo '<tr class="datarow">
                            <td style="display:none">';
                                echo  $value->Services; 
                    echo '  </td>
                            <td>';
                                 echo  $value->Description; 
                     echo ' </td>
                          </tr>';

                  }?>
                     
                   
                </tbody>
            </table> 
            </form>

        </div>

		<!-- <button id="thebutton" type="button">Add row</button>		 -->
		
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		
		<script>		
            $(document).ready(function () {	
                //=================================================================
                //click on table body
				//$("#tableMain tbody tr").click(function () {
				$('#tableMain tbody').on('click', 'tr', function() {
					//get row contents into an array
                    var tableData = $(this).children("td").map(function() {
                        return $(this).text();
                    }).get();
                    var td=tableData[0];
                     $("input:text").val(td);
                    formSubmit();
                    //
				});
				
				$("#thebutton").click(function () {
					$('#tableMain > tbody').append('<tr class="datarow"><td>11111</td><td>22222</td><td>33333</td><td>44444</td><td>55555</td></tr>')
				})
			});	

             function formSubmit() {
                //alert(td);
           // document.getElementById("service_code").val = td;
            document.getElementById("myForm").submit();
          }
		</script>
		
	
    </body>
</html>


<!-- <!DOCTYPE html>

<html>
    <head>
        <title>Get table row data with jquery</title>
        <meta charset="utf-8" />
        <style>
            #container{
                margin:0 auto;
                width:80%;
                overflow:auto;
            }
            table.gridtable {
                margin:0 auto;
                width:95%;
                overflow:auto;
                font-family: helvetica,arial,sans-serif;
                font-size:14px;
                color:#333333;
                border-width: 1px;
                border-color: #666666;
                border-collapse: collapse;
                text-align: center;
            } 
            table.gridtable th {
                border-width: 1px;
                padding: 8px;
                border-style: solid;
                border-color: #666666;
                background-color: #F6B4A5;
            }
            table.gridtable td {
                border-width: 1px;
                padding: 8px;
                border-style: solid;
                border-color: #666666;
            }
            tr:hover {background-color: #D8DA5C}
        </style>
    </head>

    <body>
        <div class="container" id="container">
            <table class="gridtable" id="tableMain">
                <thead>
                    <tr class="tableheader">
                        <th>column1</th>
                        <th>column2</th>
                        <th>column3</th>
                        <th>column4</th>
                        <th>column5</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="datarow">
                        <td>Australia</td>
                        <td>USA</td>
                        <td>England</td>
                        <td>France</td>
                        <td>Spain</td>
                    </tr>
                    <tr class="datarow">
                        <td>Belgium</td>
                        <td>India</td>
                        <td>Switzerland</td>
                        <td>New Zealand</td>
                        <td>Brazil</td>
                    </tr>
                    <tr class="datarow">
                        <td>South Korea</td>
                        <td>South Africa</td>
                        <td>Poland</td>
                        <td>Canada</td>
                        <td>Mexico</td>
                    </tr>
                    <tr class="datarow">
                        <td>Russia</td>
                        <td>Senegal</td>
                        <td>Kenya</td>
                        <td>Argentina</td>
                        <td>Nigeria</td>
                    </tr>
                    <tr class="datarow">
                        <td>Portugal</td>
                        <td>Peru</td>
                        <td>Libya</td>
                        <td>China</td>
                        <td>Japan</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <button id="thebutton" type="button">Add row</button>       
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        
        <script>        
            $(document).ready(function () { 
                //=================================================================
                //click on table body
                //$("#tableMain tbody tr").click(function () {
                $('#tableMain tbody').on('click', 'tr', function() {
                    //get row contents into an array
                    var tableData = $(this).children("td").map(function() {
                        return $(this).text();
                    }).get();
                    var td=tableData[0] +  '*' +  tableData[1] + '*' + tableData[2] + '*' +  tableData[3] + '*' + tableData[4];
                    alert(td);
                });
                
                $("#thebutton").click(function () {
                    $('#tableMain > tbody').append('<tr class="datarow"><td>11111</td><td>22222</td><td>33333</td><td>44444</td><td>55555</td></tr>')
                })
            }); 
        </script>
        
    
    </body>
</html> -->

