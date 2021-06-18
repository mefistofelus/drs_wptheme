<?
// Соединямся с БД
$link=mysqli_connect("localhost", "root", "root", "vids-login");

// Страница регистрации нового пользователя
if(isset($_GET['register']) && $_GET['register']=='yes')
{
echo <<<register
<div class="modal-content" style="max-width: 65%; margin: 0 auto;">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="exampleModalLabel">Реєстрація в системі</h5>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form method="POST" class="row g-3 needs-validation" novalidate>
                        <div class="col-12">
                            <div class="form-outline">
							<input name="login" type="text" class="form-control" required>
                                
                                <label for="validationCustom01" class="form-label">Ваш логін</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-outline">
							<input name="password" type="password" class="form-control" required>

                                <label for="validationCustom02" class="form-label">Пароль для входу</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-group form-outline">
							<input name="otdel" type="text" class="form-control" required>
                                
                                <label for="validationCustomUsername" class="form-label">Структурний підрозділ</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-outline">
                                <input name="kerivnik" type="text" class="form-control" required>
                                <label for="validationCustom05" class="form-label">Прізвище та ініціали керівника</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
					<button name="submit" type="submit" class="btn btn-info">
                        <i class="fas fa-user-plus mr-1"></i>
                    Зареєструватися</button>
					
                    
                </div>
            </form>
        </div>
register;



if($_GET['register']=='yes' && isset($_POST['submit']))

{
    $err = [];



    // проверяем, не сущестует ли пользователя с таким именем
    $query = mysqli_query($link, "SELECT user_id FROM users WHERE user_login='".mysqli_real_escape_string($link, $_POST['login'])."'");
    if(mysqli_num_rows($query) > 0)
    {
        $err[] = "Пользователь с таким логином уже существует в базе данных";
    }

    // Если нет ошибок, то добавляем в БД нового пользователя
    if(count($err) == 0)
    {

        $login = $_POST['login'];
		$otdel = $_POST['otdel'];
		$kerivnik = $_POST['kerivnik'];
		$kadry = 0;
		

        // Убераем лишние пробелы и делаем двойное хеширование
        $password = md5(md5(trim($_POST['password'])));

        mysqli_query($link,"INSERT INTO users SET user_login='".$login."', user_otdel='".$otdel."', user_kerivnik='".$kerivnik."', kadry='".$kadry."', user_password='".$password."'");
		echo <<<GO
<script type="text/javascript">
location="?login";
</script>
GO;

    }
    else
    {
        print "<b>При регистрации произошли следующие ошибки:</b><br>";
        foreach($err AS $error)
        {
            print $error."<br>";
        }
    }
	
}

}
else if(isset($_GET['login']))
{
	echo <<<login
<div class="modal-content" style="max-width: 65%; margin: 0 auto;">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="exampleModalLabel">Авторизація в системі</h5>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form method="POST" class="row g-3 needs-validation" novalidate>
                        <div class="col-12">
                            <div class="form-outline">
							<input name="login" type="text" class="form-control" required>
                                
                                <label for="validationCustom01" class="form-label">Логін для входу на латиниці (наприклад "kadry")</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-outline">
							<input name="password" type="password" class="form-control" required>

                                <label for="validationCustom02" class="form-label">Пароль для входу</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
					<button name="submit" type="submit" class="btn btn-info">
                        <i class="fas fa-key mr-1"></i>
                    Увійти</button>
					
                    
                </div>
            </form>
        </div>
login;

if(isset($_POST['submit']))
{
	// Страница авторизации

// Функция для генерации случайной строки
function generateCode($length=6) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
    $code = "";
    $clen = strlen($chars) - 1;
    while (strlen($code) < $length) {
            $code .= $chars[mt_rand(0,$clen)];
    }
    return $code;
}

// Соединямся с БД

if(isset($_POST['submit']))
{
    // Вытаскиваем из БД запись, у которой логин равняеться введенному
    $query = mysqli_query($link,"SELECT user_id, user_password, user_otdel, user_kerivnik  FROM users WHERE user_login='".mysqli_real_escape_string($link,$_POST['login'])."' LIMIT 1");
    $data = mysqli_fetch_assoc($query);

    // Сравниваем пароли
    if($data['user_password'] === md5(md5($_POST['password'])))
    {
        // Генерируем случайное число и шифруем его
        $hash = md5(generateCode(10));

        
            $insip = ", user_ip=INET_ATON('".$_SERVER['REMOTE_ADDR']."')";
        

        // Записываем в БД новый хеш авторизации и IP
        mysqli_query($link, "UPDATE users SET user_hash='".$hash."' ".$insip." WHERE user_id='".$data['user_id']."'");

        
        // Переадресовываем браузер на страницу проверки нашего скрипта
		$kerivnik = $data['user_kerivnik'];
		$otdel = $data['user_otdel'];
		$data = date("d.m.Y");
		echo <<<GO
<script type="text/javascript">
location="?kerivnik=$kerivnik&otdel=$otdel&data=$data";
</script>
GO;
    }
    else
    {
        print "Вы ввели неправильный логин/пароль";
    }
}
	
}
}



else if ($_GET["data"]==date("d.m.Y") and $_GET["otdel"]!="")
{
$otdel = $_GET["otdel"];
$data = date("d.m.Y");





if ($otdel=="Департамент державної регуляторної політики")
{
$dekret = <<<dekret
<tr>
                <td>
                   Гребенюк <required id="fio" name="fio" value="Гребенюк">
                </td>
				<td>
                   2019-01-15<id="zpodate" name="zpodate">
                </td>
                <td>
                   2021-11-21<id="podate" name="podate">
                </td>
                <td>
                    Соціальна відпустка<id="inshe" name="prichina" value="Соціальна відпустка">
                </td>
</tr>
dekret;
$kerivnik = $_GET["kerivnik"];
$inshe = "";	
$dekret_insert[] = <<<DKR
fio='Гребенюк', zpodate='2019-01-15', podate='2021-11-21', prichina='Соціальна відпустка', inshe='$inshe', otdel='$otdel', kerivnik='$kerivnik', data='$data'
DKR;
}

else if ($otdel=="Управління інформаційно-організаційного забезпечення діяльності служби")
{
$dekret = <<<dekret
<tr>
                <td>
                   Скорик Ж.В. <required id="fio" name="fio" value="Скорик Ж.В.">
                </td>
				<td>
                   2021-04-07<id="zpodate" name="zpodate">
                </td>
                <td>
                   2024-02-05<id="podate" name="podate">
                </td>
                <td>
                    Соціальна відпустка<id="inshe" name="prichina" value="Соціальна відпустка">
                </td>
</tr>
dekret;
$kerivnik = $_GET["kerivnik"];
$inshe = "";	
$dekret_insert[] = <<<DKR
fio='Скорик Ж.В.', zpodate='2021-04-07', podate='2024-02-05', prichina='Соціальна відпустка', inshe='$inshe', otdel='$otdel', kerivnik='$kerivnik', data='$data'
DKR;
}
else if ($otdel=="Департамент ліцензування та дозвільної системи")
{
$dekret = <<<dekret
<tr>
                <td>
                   Різник Д.І. <required id="fio" name="fio" value="Різник Д.І.">
                </td>
				<td>
                   2019-06-10<id="zpodate" name="zpodate">
                </td>
                <td>
                   2022-04-05<id="podate" name="podate">
                </td>
                <td>
                    Соціальна відпустка<id="inshe" name="prichina" value="Соціальна відпустка">
                </td>
</tr>
<tr>
                <td>
                   Омельченко С.П. <required id="fio" name="fio" value="Омельченко С.П.">
                </td>
				<td>
                   2020-07-01<id="zpodate" name="zpodate">
                </td>
                <td>
                   2023-04-28<id="podate" name="podate">
                </td>
                <td>
                    Соціальна відпустка<id="inshe" name="prichina" value="Соціальна відпустка">
                </td>
</tr>
dekret;
$kerivnik = $_GET["kerivnik"];
$inshe = "";	
$dekret_insert[] = <<<DKR
fio='Різник Д.І.', zpodate='2019-06-10', podate='2022-04-05', prichina='Соціальна відпустка', inshe='$inshe', otdel='$otdel', kerivnik='$kerivnik', data='$data'
DKR;
$dekret_insert[] = <<<DKR
fio='Омельченко С.П.', zpodate='2020-07-01', podate='2023-04-28', prichina='Соціальна відпустка', inshe='$inshe', otdel='$otdel', kerivnik='$kerivnik', data='$data'
DKR;
}
else if ($otdel=="Відділ інформаційних технологій, захисту інформації та з питань цифрового розвитку")
{
$dekret = <<<dekret
<tr>
                <td>
                   Стучкова О.М. <required id="fio" name="fio" value="Стучкова О.М.">
                </td>
				<td>
                   2018-07-16<id="zpodate" name="zpodate">
                </td>
                <td>
                   2021-05-21<id="podate" name="podate">
                </td>
                <td>
                    Соціальна відпустка<id="inshe" name="prichina" value="Соціальна відпустка">
                </td>
</tr>
dekret;
$kerivnik = $_GET["kerivnik"];
$inshe = "";	
$dekret_insert[] = <<<DKR
fio='Стучкова О.М.', zpodate='2018-07-16', podate='2021-05-21', prichina='Соціальна відпустка', inshe='$inshe', otdel='$otdel', kerivnik='$kerivnik', data='$data'
DKR;
}




//$kadry = mysqli_query($link, "SELECT kadry FROM users WHERE user_otdel='".$otdel."'");


// Вытаскиваем из БД запись, проверяем кадры или нет
    $query = mysqli_query($link,"SELECT user_otdel FROM users WHERE user_otdel='".mysqli_real_escape_string($link,$otdel)."' LIMIT 1");
    $kadry = mysqli_fetch_assoc($query);
	


if ($kadry ==1)
{
	$ssilkaget =  "<input onclick=\"document.location='http://site/pereglyad-informaczi%D1%97-pro-vidsutnih/'\" class=\"btn btn-primary ml-5\" value=\"Перегляд інформації\" style=\"margin: 10px\">";
}
else
{
	$ssilkaget ="";
}
$ssilkaget =  "<input onclick=\"document.location='http://site/pereglyad-informaczi%D1%97-pro-vidsutnih/'\" class=\"btn btn-primary ml-5\" value=\"Перегляд інформації\" style=\"margin: 10px\">";
echo <<<vidsutni
<form method="post" action="">

    <table class="table caption-top">

        

      <thead>
        <tr>
          <th scope="col">ПІБ працівника</th>
		  <th scope="col">Період відсутності з</th>
          <th scope="col">Період відсутності по</th>
          <th scope="col">Причина відсутності</th>
          <th scope="col" class="td-inshe"><strong class="text-danger">*</strong>Примітка <small>(за необхідності)</small></th>
        </tr>
		$dekret
      </thead>
          <tbody id="vidsutni">
            <tr>
                <td>
                    <input type="text" class="form-control" placeholder="Іван Іванов" required id="fio" name="fio" value="">
                </td>
				<td>
                    <input type="date" class="form-control" style="max-width: 85%;" required id="zpodate" name="zpodate">
                </td>
                <td>
                    <input type="date" class="form-control" style="max-width: 85%;" required id="podate" name="podate">
                </td>
                <td>
                    <label for="otpusk">
                        <input type="radio" required id="otpusk" name="prichina" value="Щорічна відпустка (основна, додаткова)">
                    Щорічна відпустка (основна, додаткова)
                    </label>

                    <br>
					
					<label for="distance">
                        <input type="radio" required id="distance" name="prichina" value="Дистанційна робота">
                    Дистанційна робота
                    </label>

                    <br>

                    <label for="ekzamen">
                        <input type="radio" required id="ekzamen" name="prichina" value="Відпустка у зв'язку з навчанням">
                    Відпустка у зв'язку з навчанням
                    </label>

                    <br>

                    <label for="bezzp">
                        <input type="radio" required id="bezzp" name="prichina" value="Відпустка без збереження заробітньої плати">
                    Відпустка без збереження заробітньої плати
                    </label>

                    <br>

                    <label for="nepracezdatn">
                        <input type="radio" required id="nepracezdatn" name="prichina" value="Тимчасова непрацездатність">
                    Тимчасова непрацездатність
                    </label>

                    <br>

                    <label for="vidriadjenna">
                        <input type="radio" required id="vidriadjenna" name="prichina" value="У відрядженні">
                    У відрядженні
                    </label>

                    <br>

                    <label for="inshe">
                        <input type="radio" required id="inshe" name="prichina" value="Інша причина">
                    Інша причина (необхідно зазначити)
                    </label>

                </td>

                <td class="td-inshe">
                    <label>
                        <input type="text" class="form-control" name="inshe" value="">
                    </label>
                </td>
                <td>
                    <button type="button" class="add btn btn-success">+ <i class="fas fa-user" style="pointer-events: none;"></i></button>
                    <button type="button" class="del btn btn-danger">-  <i class="fas fa-user" style="pointer-events: none;"></i></button>
                </td>
            </tr>
          </tbody>
    </table>

     <input name="sub" type="submit" class="btn btn-primary ml-5" value="Записати інформацію про відсутніх" style="margin: 10px">
	 <input onclick="document.location='?otdel=$otdel&data=$data&prisutni=vsi'" class="btn btn-primary ml-5" value="Всі присутні" style="margin: 10px">
	 $ssilkaget

</form>

<hr/>




<script>
/**
 * Created by moskitos80 on 23.08.14.
 */
var DynamicTable = (function (GLOB) {
    var RID = 0;
    return function (tBody) {
        /* Если ф-цию вызвали не как конструктор фиксим этот момент: */
        if (!(this instanceof arguments.callee)) {
            return new arguments.callee.apply(arguments);
        }
        //Делегируем прослушку событий элементу tbody
        tBody.onclick = function(e) {
            var evt = e || GLOB.event,
                trg = evt.target || evt.srcElement;
            if (trg.className && trg.className.indexOf("add") !== -1) {
                _addRow(trg.parentNode.parentNode, tBody);
            } else if (trg.className && trg.className.indexOf("del") !== -1) {
                tBody.rows.length > 1 && _delRow(trg.parentNode.parentNode, tBody);
            }
        };
        var _rowTpl = tBody.rows[0].cloneNode(true);
        // Корректируем имена элементов формы
        var _correctNames = function (row) {
            var elements = row.getElementsByTagName("*");
            for (var i = 0; i < elements.length; i += 1) {
                if (elements.item(i).name) {
                    if (elements.item(i).type &&
                        elements.item(i).type === "radio" &&
                        elements.item(i).className &&
                        elements.item(i).className.indexOf("glob") !== -1)
                    {
                        elements.item(i).value = RID;
                    } else {
                        elements.item(i).name = RID + "["+ elements.item(i).name +"]";
                    }
                }
            }
            RID++;
            return row;
        };
        var _addRow = function (before, tBody) {
            var newNode = _correctNames(_rowTpl.cloneNode(true));
            tBody.insertBefore(newNode, before.nextSibling);
        };
        var _delRow = function (row, tBody) {
            tBody.removeChild(row);
        };
        _correctNames(tBody.rows[0]);
    };
})(this);
</script>
<script>
    new DynamicTable( document.getElementById("vidsutni") );
</script>

vidsutni;


if ($_GET["data"]=date("d.m.Y") and $_GET["otdel"]!="")
{


$otdel = $_GET["otdel"];
$data = date("d.m.Y");
$time = date("H:i", strtotime('+3 hour'));
$time0 = date("12:00");


if (strtotime($time)<strtotime($time0))
{

$podano=0;	
	$query1 ="SELECT * FROM zapis WHERE user_data='".$data."'";
 
$result = mysqli_query($link, $query1) or die("Ошибка " . mysqli_error($link)); 
if($result)
{
    $rows = mysqli_num_rows($result); // количество полученных строк
     
    for ($i = 0 ; $i < $rows ; ++$i)
    {
        $row = mysqli_fetch_row($result);
        
            for ($j = 1 ; $j < 2 ; ++$j) if($row[$j]==$otdel){$podano=1;}
        
    }
    
     
    // очищаем результат
    mysqli_free_result($result);
}
 
	

if($podano < 1)	 
{

    
 if ($_GET["prisutni"]=="vsi") 
 {

		   //Добавляем декретчиков
if (isset($dekret_insert))	{	   
foreach ($dekret_insert as $postdekret) {
	mysqli_query($link,"INSERT INTO vidsutni SET $postdekret");
}
}

//--------

mysqli_query($link,"INSERT INTO zapis SET user_login='".$otdel."', user_time='".$time."', user_data='".$data."'");
echo "Інформація успішно записана";
 }
 else

 {
  
if (!empty($_POST))
{

   

           foreach ($_POST as $key => $value) 
		   {
            if (gettype($key) === "integer") 
			{
 						

$kerivnik = $_GET["kerivnik"];
$fio = $value['fio']; 
$podate = $value['podate'];
$zpodate = $value['zpodate'];
$prichina = $value['prichina']; 
$inshe = $value['inshe'];


			
// Отправка информации о посещении

// Соединямся с БД

mysqli_query($link,"INSERT INTO vidsutni SET fio='".$fio."', zpodate='".$zpodate."', podate='".$podate."', prichina='".$prichina."', inshe='".$inshe."', otdel='".$otdel."', kerivnik='".$kerivnik."', data='".$data."'");



						
						
						
			}
                       
                    
            
		   }

		   //Добавляем декретчиков
if (isset($dekret_insert))	{	   
foreach ($dekret_insert as $postdekret) {
	mysqli_query($link,"INSERT INTO vidsutni SET $postdekret");
}
}

//--------

mysqli_query($link,"INSERT INTO zapis SET user_login='".$otdel."', user_time='".$time."', user_data='".$data."'");

//Сообщение о том что все успешно
echo "Інформація успішно записана";




}
}

}

 if($podano > 0)	 
{
echo "Інформація про відсутніх працівників вашого підрозділу вже була надана сьогодні";	
}

}
else
{

echo <<<redtext
<style>
   .colortext {
     color: red; /* Красный цвет выделения */
   }
  </style>
  
   <span class="colortext">Інформація про відсутніх працівників подається до 10:00 поточного робочого дня. Якщо ви не встигли подати довідку - негайно зверніться до Відділу управління персоналом!</span>
redtext;
 
}
	
}



}

else
{
	echo <<<GO
<script type="text/javascript">
location="?login";
</script>
GO;
}



	
?>