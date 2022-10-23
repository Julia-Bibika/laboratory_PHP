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

class DAI{
    public int $id;
    public string $PIB;
    public string $mark;
    public string $number_car;
    public string $color;
    public function __construct(int $id,array $array)
    {
        $this->id = $id;
        $this->PIB  = $array['PIB'];
        $this->mark = $array['mark'];
        $this->number_car = $array['number_car'];
        $this->color = $array['color'];
    }
    public static function validationDataCars($array)
    {
        return !(
            empty($array['PIB']) ||
            empty($array['mark']) ||
            empty($array['number_car']) ||
            empty($array['color']) ||
            !isset($array)
        );
    }
}