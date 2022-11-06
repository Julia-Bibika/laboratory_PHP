<?php
namespace Model\Car;

use Interface\CarCollectionInterface;
use Model\Car;

class Repository
{
    public $dbh;
    public function __construct($dbh){
        $this->dbh = $dbh;
    }
    public function addCarDB(string $otherPIB, string $otherMark, string $otherNumber_car, string $otherColor){
        $this->dbh->query('INSERT INTO cars(PIB,mark,number_car,color) VALUES (' .
            "'" . $otherPIB . "', " .
            "'" . $otherMark . "', " .
            "'" . $otherNumber_car . "', " .
            "'" . $otherColor . "')"
        );
    }
    public function readCars()
    {
        return $this->dbh->query('SELECT * FROM cars')->fetchAll();
    }
    public function updateCarDB(int $otherId,string $otherPIB, string $otherMark, string $otherNumber_car, string $otherColor){
        $this->dbh->query('UPDATE cars SET ' .
            'PIB = ' . $otherPIB . ', ' .
            'mark = ' . $otherMark . ', ' .
            'number_car = ' . $otherNumber_car . ', ' .
            'color = ' . $otherColor . ' , ' .
            'WHERE id = ' . $otherId);
    }

    public function deleteXa($id){
        return $this->dbh->query("DELETE FROM cars WHERE id = " . $id);
    }
//    public function createNewFile(string $fileName){
//        $file = fopen("./$fileName.txt",'w+');
//        fclose($file);
//    }
//    public function loadDataFromFile(string $fileName): CarCollectionInterface
//    {
//        $lines = file("./$fileName.txt", FILE_SKIP_EMPTY_LINES);
//        $dict = new Collection([]);
//        foreach ($lines as $line) {
//            $lineArr = explode(' ', $line);
//
//            $dict->addCar(new Car((int)$lineArr[0], $lineArr[1], (int)$lineArr[2], $lineArr[3], $lineArr[4]));
//        }
//        return $dict;
//    }
//
//    public function storeDataToFile(CarCollectionInterface $carCollection, string $fileName)
//    {
//        $dataStr = '';
//        for($i = 0; $i < count($carCollection->getCarArr()); $i++){
//            $dataStr .= $carCollection->getCarArr()[$i]->getId() . ' ' .
//                $carCollection->getCarArr()[$i]->getPIB() . ' ' .
//                $carCollection->getCarArr()[$i]->getMark() . ' ' .
//                $carCollection->getCarArr()[$i]->getNumber_car() . ' ' .
//                $carCollection->getCarArr()[$i]->getColor() . "\n";
//        }
//        file_put_contents("./$fileName.txt", "$dataStr", FILE_APPEND);
//    }
}
