<?php
// Клас для зберігання та редагування колекції об'єктів, виводу даних на сторінку,
use Model\Car;
use Model\Car\Collection;
use Model\Car\Repository;

$dbh = new PDO('mysql:host=127.0.0.1;dbname=cars_db', 'root', '');
$sql = "SELECT * FROM cars;";
$myarray = $dbh->query($sql)->fetchAll();
function myAutoloader($class_name)
{
    if (!class_exists($class_name)) {
        include $class_name . '.php';
    }
}

spl_autoload_register('myAutoloader');

$car1 = new Car( 1,'Бартків Олександр Михайлович',"Audi","BB2588BA","red");
$car2 = new Car( 2,'Кучер Іван Андрійович',"BMW","AA6126ME","black");
$car3 = new Car( 3,'Візничук Андрій Андрійович',"Lexus","AK9265AK","blue");

$carCollections = new Collection([$car1,$car2,$car3]);

$saveCarCollection = new Repository($dbh);
//$saveCarCollection->createNewFile('cars');
//$saveCarCollection->storeDataToFile($carCollections, 'cars');
//insertInDb($carCollections,$dbh);

var_dump($saveCarCollection->readCars());
//$saveCarCollection->addCarDB("Коваль Сергій Сергійович","Cadillac","AK1565AK","orange");
//$saveCarCollection->addCarDB("Мирний Олексій Михайловч","Bentley","AA9165ME","grey");
$saveCarCollection->updateCarDB(2,"Шевченко Ольга Олександрівна","Lexus","BB2918BA","grey");
$saveCarCollection->deleteCars(3);
var_dump($carCollections);
echo '<br> ------------------ <br>';

$carCollections->removeCarByCode(1);

var_dump($carCollections);
// database
