<?

$link=mysqli_connect("localhost", "root", "root", "vids-login")
or die("Ошибка подключения к базе" . mysqli_error($link));

$query1 ="SELECT * FROM users";
$result1 = mysqli_query($link, $query1) or die("Ошибка " . mysqli_error($link)); 
if($result1)
{
    $rows1 = mysqli_num_rows($result1); // количество полученных строк
}

$data = date("d.m.Y");
$query ="SELECT user_login FROM zapis where user_data='".$data."'";
 
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
if($result)
{
    $rows = mysqli_num_rows($result); // количество полученных строк
    $num=1; 
    echo "Інформація за $data подана $rows підрозділами з $rows1-ти: <br>";
    for ($i = 0 ; $i < $rows ; ++$i)
    {
        $row = mysqli_fetch_row($result);
        echo "<tr>";
            for ($j = 0 ; $j < 1 ; ++$j) echo "$num. $row[$j]<br>";
			$num=$num+1; 
    }
    // очищаем результат
    mysqli_free_result($result);
}
 
mysqli_close($link);


?>




<form method="post" action="">

    <table class="table caption-top">

        <caption>






        </caption>

      <thead>
        <tr>
		  <th scope="col">Дата подання інформації</th>
	<!-- 	  <th scope="col">Відсутні з</th>
          <th scope="col">Відсутні по дату</th>  -->
          <th scope="col">Причина відсутності</th>
		  <th scope="col">Назва підрозділу</th>

        </tr>
      </thead>
          <tbody id="vidsutni">
            <tr>
			    
			    <td>
                    <input type="date" class="form-control" style="max-width: 100%;"  id="nadate" name="nadate">
                </td>
            <!--    <td>
                    <input type="date" class="form-control" style="max-width: 100%;"  id="zpodate" name="zpodate">
                </td> 
				<td> 
                    <input type="date" class="form-control" style="max-width: 100%;"  id="popodate" name="popodate">
                </td> -->
				<td>
                    <label>
                        <select name="prichina" style="max-width: 70%;">
						    <option value="">всі</option>
                            <option value="Щорічна відпустка (основна, додаткова)">Щорічна відпустка (основна, додаткова)</option>
							<option value="Дистанційна робота">Дистанційна робота</option>
                            <option value="Відпустка у зв'язку з навчанням">Відпустка у зв'язку з навчанням</option>
                            <option value="Відпустка без збереження заробітньої плати">Відпустка без збереження заробітньої плати</option>
							<option value="Тимчасова непрацездатність">Тимчасова непрацездатність</option>
							<option value="У відрядженні">У відрядженні</option>
							<option value="Інша причина">Інша причина</option>
                        </select>
                    </label>
                </td>
				<td>
                    <label>
                        <select name="otdel" style="max-width: 50%;">
						<option value="">всі</option>
<?
$link=mysqli_connect("localhost", "root", "root", "vids-login")
or die("Ошибка подключения к базе" . mysqli_error($link));
$query ="SELECT * FROM users";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
if($result)
{
    $rows = mysqli_num_rows($result); // количество полученных строк

    for ($i = 0 ; $i < $rows ; ++$i)
    {
        $row = mysqli_fetch_row($result);
        
            for ($j = 2 ; $j < 3 ; ++$j) echo "<option name=\"otdel\" value=\"$row[$j]\">$row[$j]</option>";
       
    }
     
    // очищаем результат
    mysqli_free_result($result);
}
mysqli_close($link);
?>
                        </select>
                    </label>
                </td>

            </tr>
          </tbody>
    </table>

     <input name="sub" type="submit" class="btn btn-primary ml-5" value="Отримати інформацію" style="margin: 10px">

</form>





<?




if (!empty($_POST))
  {

$nadate =$_POST["nadate"];
$zpodate =$_POST["zpodate"];
$popodate =$_POST["popodate"];
$prichina =$_POST["prichina"];
$otdel =$_POST["otdel"];


if (!empty($nadate))
  {	  
$par0 = "data='".date("d.m.Y", strtotime($nadate))."'";
  }
  else
  {
$data = date("d.m.Y");  
$par0 = "data='".$data."'";
	
  }
  /*	
if (!empty($zpodate))
  {	  
$par[] = "zpodate='".date("Y-m-d", strtotime($zpodate))."'";
  }  
if (!empty($popodate))
  {	  
$par[] = "podate='".date("Y-m-d", strtotime($popodate))."'";
  }  
  */
 if (!empty($prichina))
  {	  
$par1 = "AND prichina='".$prichina."'";
  }  
 if (!empty($otdel))
  {	  
$par2 = "AND otdel='".$otdel."'";
  }
 /* 
if (!empty($par))
{
$sql0 =	"where";
$parsql2 ="";
foreach ($par as $parsql) {
	$parsql=trim($parsql);
   $parsql2 = "$parsql2, $parsql";
}
$parsql2 = trim($parsql2, ",");
$parsql2 = trim($parsql2, " ");
$sql0 = "$sql0 $parsql2";
}  */
  
$sql0 = "where $par0 $par1 $par2";
$sql0 = trim($sql0);
  
$link=mysqli_connect("localhost", "root", "root", "vids-login")
or die("Ошибка подключения к базе" . mysqli_error($link));



$query ="SELECT * FROM vidsutni $sql0";
 
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
if($result)
{
    $rows = mysqli_num_rows($result); // количество полученных строк
     
    echo "<table id=\"myTable2\"><tr><th onclick=\"sortTable(0)\">Хто відсутній</th><th onclick=\"sortTable(1)\">Відсутній з</th><th onclick=\"sortTable(2)\">Відсутній по дату</th><th onclick=\"sortTable(3)\">Причина відсутності</th><th onclick=\"sortTable(4)\">Примітка (за наявності)</th><th onclick=\"sortTable(5)\">Назва структурного підрозділу</th><th onclick=\"sortTable(6)\">Дата подання інформації</th><th onclick=\"sortTable(7)\">ПІБ керівника підрозділу</th></tr>";
    for ($i = 0 ; $i < $rows ; ++$i)
    {
        $row = mysqli_fetch_row($result);
        echo "<tr>";
            for ($j = 1 ; $j < 9 ; ++$j) echo "<td>$row[$j]</td>";
        echo "</tr>";
    }
    echo "</table>";
     
    // очищаем результат
    mysqli_free_result($result);
}
 
mysqli_close($link);


	}


?>






<script>
function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("myTable2");
  switching = true;
  // Set the sorting direction to ascending:
  dir = "asc";
  /* Make a loop that will continue until
  no switching has been done: */
  while (switching) {
    // Start by saying: no switching is done:
    switching = false;
    rows = table.getElementsByTagName("TR");
    /* Loop through all table rows (except the
    first, which contains table headers): */
    for (i = 1; i < (rows.length - 1); i++) {
      // Start by saying there should be no switching:
      shouldSwitch = false;
      /* Get the two elements you want to compare,
      one from current row and one from the next: */
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /* Check if the two rows should switch place,
      based on the direction, asc or desc: */
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          // If so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          // If so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /* If a switch has been marked, make the switch
      and mark that a switch has been done: */
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      // Each time a switch is done, increase this count by 1:
      switchcount ++;
    } else {
      /* If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again. */
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}
</script>












