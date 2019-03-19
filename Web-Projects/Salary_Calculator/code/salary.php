<!DOCTYPE html>
<html>
<head>
	<title>Salary Calculator</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
<h1>Salary Calculator Form</h1>
<form method="post" action="calculated_salary.php">
<br>
<!-- we give a width to heading row,furture we give the invidual class name to all label.as the label are laid in line the width given maitains the distance between the label. 
-->
<div class="head-row">
	<label class="lday">DAY</label><label class="lstime">START-TIME</label><label class="ph">PUBLIC HOLIDAY</label><label class="letime">END-TIME</label>
</div>
<br>
<br>
<?php
$days=array("monday","tuesday","wednesday","thursday","friday","saturday","sunday");

for ($a=0;$a<7;$a++)
{
echo"<label class=\"day\">".strtoupper($days[$a])."</label>";
echo "<select class=\"day-hrs\" "."name=\"".substr($days[$a],0,3)."-s-hrs"."\" >";
echo "<option value=\"--\">--</option>";
for($b=0;$b<24;$b++)
{
echo "<option value=\"".$b."\">".$b."</option>";	
}	

echo"</select>";

echo "<select class=\"day-min\" "."name=\"".substr($days[$a],0,3)."-s-min"."\" >";
echo "<option value=\"--\">--</option>";
for($c=0;$c<4;$c++)
{
echo "<option value=\"".($c*15)."\">".($c*15)."</option>";	
}




echo"</select>";

echo "<input type=\"checkbox\" class=\"phbox\""."name=\"".substr($days[$a],0,3)."-ph"."\">";  

echo "<select class=\"day-hrs\" "."name=\"".substr($days[$a],0,3)."-e-hrs"."\" >";
echo "<option value=\"--\">--</option>";
for($b=0;$b<24;$b++)
{
echo "<option value=\"".$b."\">".$b."</option>";	
}

echo"</select>";

echo "<select class=\"day-min\" "."name=\"".substr($days[$a],0,3)."-e-min"."\" >";
echo "<option value=\"--\">--</option>";
for($c=0;$c<4;$c++)
{
echo "<option value=\"".($c*15)."\">".($c*15)."</option>";	
}

echo"</select>";
echo"<br>";
echo"<br>";
}
?>


<br>
<br>
<button class="button">Calculate Wages</button>
	
</form>

</body>
</html>





