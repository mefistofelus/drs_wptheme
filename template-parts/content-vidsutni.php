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




if(isset($_POST['submit']))
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
		

        // Убераем лишние пробелы и делаем двойное хеширование
        $password = md5(md5(trim($_POST['password'])));

        mysqli_query($link,"INSERT INTO users SET user_login='".$login."', user_otdel='".$otdel."', user_kerivnik='".$kerivnik."', user_password='".$password."'");
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



else if ($_GET["data"]=date("d.m.Y") and $_GET["otdel"]!="")
{

echo <<<vidsutni
<form method="post" action="">

    <table class="table caption-top">

        <caption>
            Інформація про відсутніх працівників на робочому місці <? echo date("d.m.Y"); ?> року
        </caption>

      <thead>
        <tr>
          <th scope="col">ПІБ працівника</th>
          <th scope="col">Період відсутності</th>
          <th scope="col">Причина відсутності</th>
          <th scope="col" class="td-inshe"><strong class="text-danger">*</strong>Примітка <small>(за необхідності)</small></th>
        </tr>
      </thead>
          <tbody id="vidsutni">
            <tr>
                <td>
                    <input type="text" class="form-control" placeholder="Іван Іванов" required id="fio" name="fio" value="">
                </td>
                <td>
                    <input type="date" class="form-control" style="max-width: 85%;" required id="podate" name="podate">
                </td>
                <td>
                    <label for="otpusk">
                        <input type="radio" required id="otpusk" name="prichina" value="otpusk">
                    Щорічна відпустка (основна, додаткова)
                    </label>

                    <br>

                    <label for="ekzamen">
                        <input type="radio" required id="ekzamen" name="prichina" value="ekzamen">
                    Екзамени в учбових закладах
                    </label>

                    <br>

                    <label for="bezzp">
                        <input type="radio" required id="bezzp" name="prichina" value="bezzp">
                    Без збереження заробітньої плати
                    </label>

                    <br>

                    <label for="nepracezdatn">
                        <input type="radio" required id="nepracezdatn" name="prichina" value="nepracezdatn">
                    Тимчасова непрацездатність
                    </label>

                    <br>

                    <label for="vidriadjenna">
                        <input type="radio" required id="vidriadjenna" name="prichina" value="vidriadjenna">
                    У відрядженні
                    </label>

                    <br>

                    <label for="inshe">
                        <input type="radio" required id="inshe" name="prichina" value="inshe">
                    Інша причина (треба пояснити)
                    </label>

                </td>

                <td class="td-inshe">
                    <label>
                        <input type="text" class="form-control" name="inshe" value="">
                    </label>
                </td>
                <td>
                    <button type="button" class="add btn btn-success">+ <i class="fas fa-user" style="pointer-events: none;"></i></button>
                    <button type="button" class="del btn btn-danger">- <i class="fas fa-user" style="pointer-events: none;"></i></button>
                </td>
            </tr>
          </tbody>
    </table>

     <input name="sub" type="submit" class="btn btn-primary ml-5" value="Відсутніх немає" style="margin: 10px">

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