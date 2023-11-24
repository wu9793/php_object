<?php
date_default_timezone_set("Asia/Taipei");
session_start();

class DB
{

    protected $dsn = "mysql:host=localhost;charset=utf8;dbname=school";
    protected $pdo;
    protected $table;

    // 建立建構式
    public function __construct($table)
    {
        $this->table = $table;
        // 指定物件裡面的某個變數使用 $this
        $this->pdo = new PDO($this->dsn, 'root', '');
    }

    function all($where = '', $other = '')
    {
        $sql = "select * from `$this->table` ";

        if (isset($this->table) && !empty($this->table)) {

            if (is_array($where)) {
                if (!empty($where)) {
                    foreach ($where as $col => $value) {
                        $tmp[] = "`$col`='$value'";
                    }
                    $sql .= " where " . join(" && ", $tmp);
                }
            } else {
                $sql .= " $where";
            }
            $sql .= $other;
            $rows = $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
            return $rows;
        } else {
            echo "錯誤:沒有指定的資料表名稱";
        }
    }

    function count($where = '', $other = '')
    {
        $sql = "select count(*) from `$this->table` ";

        if (isset($this->table) && !empty($this->table)) {

            if (is_array($where)) {
                if (!empty($where)) {
                    foreach ($where as $col => $value) {
                        $tmp[] = "`$col`='$value'";
                    }
                    $sql .= " where " . join(" && ", $tmp);
                }
            } else {
                $sql .= " $where";
            }
            $sql .= $other;
            $rows = $this->pdo->query($sql)->fetchColumn();
            return $rows;
        } else {
            echo "錯誤:沒有指定的資料表名稱";
        }
    }


    function find($id)
    {
        $sql = "select * from `$this->table` ";

        // 判斷是否為陣列
        if (is_array($id)) {
            foreach ($id as $col => $value) {
                $tmp[] = "`$col`='$value'";
            }
            $sql .= " where " . join(" && ", $tmp);
            // 判斷是否為數字
        } else if (is_numeric($id)) {
            $sql .= " where `id`='$id'";
        } else {
            echo "錯誤:參數的資料型態必須是數字或陣列";
        }
        // echo 'find=>' . $sql;
        $row = $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

    
    function save($array)
    {
        // 判斷 id 是否有數字
        if (isset($array['id'])) {
            $sql = "update `$this->table` set";

            if (!empty($cols)) {
                foreach ($cols as $col => $value) {
                    $tmp[] = "`$col`='$value'";
                }
            } else {
                echo "錯誤:缺少要編輯的欄位陣列";
            }
            $sql .= join(",", $tmp);
            $sql .= " where `id`='{$array['$id']}'";

        } else {
            $sql = "insert into `$this->table`";
            $cols = "(`" . join("`,`", array_keys($array)) . "`)";
            $vals = "('" . join("','", $array) . "')";

            $sql = $sql . $cols . " values " . $vals;

        }
        return $this->pdo->exec($sql);
    }


    // 加入到 function save 裡
    // protected function update($cols)
    // {

    //     $sql = "update `$this->table` set";

    //     if (!empty($cols)) {
    //         foreach ($cols as $col => $value) {
    //             $tmp[] = "`$col`='$value'";
    //         }
    //     } else {
    //         echo "錯誤:缺少要編輯的欄位陣列";
    //     }

    //     $sql .= join(",", $tmp);
    //     $sql .= " where `id`='{$cols['$id']}'";
        // $tmp=[];
        // if (is_array($id)) {
        //     foreach ($id as $col => $value) {
        //         $tmp[] = "`$col`='$value'";
        //     }
        //     $sql .= " where " . join(" && ", $tmp);
        // } else if (is_numeric($id)) {
        //     $sql .= " where `id`='$id'";
        // } else {
        //     echo "錯誤:參數的資料型態必須是數字或陣列";
        // }

        // echo $sql;
    //     return $this->pdo->exec($sql);
    // }



// 加入到 function save 裡
    // protected function insert($values)
    // {   
    //     $sql = "insert into `$this->table`";
    //     $cols = "(`" . join("`,`", array_keys($values)) . "`)";
    //     $vals = "('" . join("','", $values) . "')";

    //     $sql = $sql . $cols . " values " . $vals;

    //     return $this->pdo->exec($sql);
    // }


    function del($id)
    {
        $sql = "delete from `$this->table` where ";

        // 判斷是否為陣列
        if (is_array($id)) {
            foreach ($id as $col => $value) {
                $tmp[] = "`$col`='$value'";
            }
            $sql .= join(" && ", $tmp);
            // 判斷是否為數字
        } else if (is_numeric($id)) {
            $sql .= "`id`='$id'";
        } else {
            echo "錯誤:參數的資料型態必須是數字或陣列";
        }
        // echo $sql;

        return $this->pdo->exec($sql);
    }
    function q($sql){
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

    }
    
}


function dd($array)
{
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

$student = new DB('students');
$rows = $student->count();
dd($rows);
