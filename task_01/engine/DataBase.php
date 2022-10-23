<?php


class DataBase
{

    use Singleton;
    private $mysqli; // Идентификатор соединения

    /* private-конструктор, подключающийся к базе данных, устанавливающий локаль и кодировку соединения */
    private function __construct()
    {
        $this->mysqli = new mysqli(HOST, USER, PASS, DB);
        $this->mysqli->query("SET lc_time_names = 'ru_RU'");
        $this->mysqli->query("SET NAMES 'utf8'");
    }

    /* SELECT-метод, возвращающий таблицу результатов */
    public function select($query, $params = false)
    {
        $result_set = $this->mysqli->query($query, $params);
        if (!$result_set) return false;
        return $this->resultSetToArray($result_set);
    }

    /* SELECT-метод, возвращающий одну строку с результатом */

    private function resultSetToArray($result_set)
    {
        $array = array();
        while (($row = $result_set->fetch_assoc()) != false) {
            $array[] = $row;
        }
        return $array;
    }

    /* SELECT-метод, возвращающий значение из конкретной ячейки */

    public function selectRow($query, $params = false)
    {
        $result_set = $this->mysqli->query($query, $params);
        if ($result_set->num_rows != 1) return false;
        else return $result_set->fetch_assoc();
    }

    /* НЕ-SELECT методы (INSERT, UPDATE, DELETE). Если запрос INSERT, то возвращается id последней вставленной записи */

    public function selectCell($query, $params = false)
    {
        $result_set = $this->mysqli->query($query, $params);
        if ((!$result_set) || ($result_set->num_rows != 1)) return false;
        else {
            $arr = array_values($result_set->fetch_assoc());
            return $arr[0];
        }
    }

    /* Преобразование result_set в двумерный массив */

    public function query($query, $params = false)
    {
        $success = $this->mysqli->query($query, $params);
        if ($success) {
            if ($this->mysqli->insert_id === 0) return true;
            else return $this->mysqli->insert_id;
        } else return false;
    }

    /* При уничтожении объекта закрывается соединение с базой данных */

    public function __destruct()
    {
        if ($this->mysqli) $this->mysqli->close();
    }
}