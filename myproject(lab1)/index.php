<?php
/*
1. Описати літерал нумерованого масиву із 5 -7 масивів з текстовими ключами, що містять дані про об'єкти згідно із варіантом .
2. Вивести дані про об'єкти в таблицю.
3. Підготувати функцію для вибору всіх елементів масиву, що відповідають запиту. Вивести їх в таблицю.
4. Передбачити можливість передачі параметрів запиту через рядок стану
5. Створити форму для додавання нового об'єкту до масиву.
6. Створити форму редагування даних про об'єкт.
7. Перед редагуванням здійснити валідацію даних (ПІБ не може бути порожнім рядком, заробітна плата повинна бути невід'ємним числом, тощо).
Об’єкт “ДАІ” (Код, ПІБ власника машини; марка, номер машини; колір).
 Запит автомобілів марки Х, номери яких починаються із вказаного шаблону. */

session_start();
$_SESSION['$DAI'] = null;

$request = $_GET["request"];
if (isset($_SESSION["DAI"])){
    $DAI = $_SESSION["DAI"];
}else{
    $DAI = [
        [
            "id" => 1,
            "PIB"=>"Бартків Олександр Михайлович",
            "mark" =>"Audi",
            "number_car" =>"BB2588BA",
            "color"=>"red",
        ],
        [
            "id"=> 2,
            "PIB"=>"Кучер Іван Андрійович",
            "mark" =>"BMW",
            "number_car" =>"AA6126ME",
            "color"=>"black",
        ],
        [
            "id"=> 3,
            "PIB"=>"Візничук Андрій Андрійович",
            "mark" =>"Lexus",
            "number_car" =>"AK9265AK",
            "color"=>"blue",
        ],
        [
            "id"=> 4,
            "PIB"=>"Ткаченко Ірина Михайлівна",
            "mark" =>"Tesla",
            "number_car" =>"AK2452HH",
            "color"=>"black",
        ]
    ];
}
function getId($DAI){
    for ($i = 0;$i < count($DAI);$i++){
        if ($_GET["id"] == $DAI[$i]["id"]){
            $max = $DAI[0]["id"];
            for ($j = 0; $j < count($DAI);$j++){
                if ($DAI[$j]["id"] > $max){
                    $max = $DAI[$j]["id"];
                }
            }
            $max++;
            return $max;
        }
    }
    return $_GET["id"];
}

if ($_GET["edit"] != null){
    for ($i = 0; $i < count($DAI);$i++){
        if ($_GET["edit"] == $DAI[$i]["id"]){
            $DAI[$i] = ["id" => getId($DAI),
                "PIB"=>$_GET["PIB"],
                "mark" =>$_GET["mark"],
                "number_car" =>$_GET["number_car"],
                "color"=>$_GET["color"]];
            $_SESSION["DAI"] = $DAI;
            break;
        }
    }
}else{
    if($_GET["id"] == null){
        $_GET["id"] = 1;
    }
    if($_GET["PIB"] == null){
        $_GET["PIB"] = "ПІБ";
    }
    if($_GET["mark"] == null){
        $_GET["mark"] ="відсутня марка";
    }
    if($_GET["number_car"] == null){
        $_GET["number_car"] = "Номер відсутній";
    }
    if($_GET["color"] == null){
        $_GET["color"] = "Невідомий колір";
    }

    $DAI[] = ["id" => getId($DAI),
        "PIB" => $_GET["PIB"],
        "mark" => $_GET["mark"],
        "number_car" => $_GET["number_car"],
        "color" => $_GET["color"]];
    $_SESSION["DAI"] = $DAI;
}
function MySample($arr,$request){
    $newArray = [];
    $k = strlen($request);
    for($i = 0; $i < count($arr); $i++){
        if (substr($arr[$i]['number_car'],1,$k) == $request){
            array_push($newArray,$arr[$i]);
    }
}
    return $newArray;
}
?>
<table>
    <tr>
        <?php foreach (array_keys($DAI[0]) as $key):?>
            <th> <?= $key ?></th>
        <?php endforeach;?>
    </tr>
    <?php foreach ($DAI as $car):?>
        <tr>
            <?php foreach ($car as $key=>$value):?>
                <td> <?= $value ?></td>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
</table>
<?php
$arr = MySample($DAI,"AK2452");
echo "<h2> Таблиця після запиту</h2>";
echo "Запит: $request <br>";
echo "<table>";
echo "<tr> <th>Id</th> <th>PIB</th> <th>mark</th> <th>Number_car</th> <th>Color</th> </tr>";
for ($i = 0; $i < count($arr); $i++) {
    echo "<tr>";
    foreach ($arr[$i] as $key => $value) {
        echo "<td>$value</td>";
    }
    echo "</tr>";
}
echo "</table>";

;?>
<style>
    table,td {
        border: 1px solid black;
        border-collapse: collapse;
    }
    th{
        border: 1px solid black;
    }
    .form_add{
        margin-top: 5px;
    }
</style>
<form method="GET" action="">
    <div class="form_add">
        <label>
            <input type="number" name="edit" placeholder="Type id for edit"><br>
            Код:<input type="text" name="id"> <br>
            ПІБ:<input type="text" name="PIB"> <br>
            Марка автомобіля:<input type="text" name="mark"> <br>
            Номер:<input type="text" name="number_car"> <br>
            Колір:<input type="text" name="color"> <br>
            <input type="submit" name="btn-add" value="ADD"><br>

            Запит:<input type="hidden" name="request" value="">
        </label>
    </div>
</form>