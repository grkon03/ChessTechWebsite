<?php
    $dsn = 'mysql:dbname=db_chesstech;host=mysql;port=3306;charset=utf8';
    $user = 'user';
    $password = 'password';

    try {
        $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        echo "接続成功<br />";
        /*
        $tables = $pdo->query("SHOW TABLES");
        while($re = $tables->fetch(PDO::FETCH_ASSOC)){
            var_dump($re);
        }
        */
        /*
        $new_member = "INSERT INTO Members (id, pass, name, handle_name, grade, authority, position)";
        $new_member .= " VALUES (:id, :pass, :name, :handle_name, :grade, :authority, :position);";

        $id = "grkon";
        $pass = "yasu0u327";
        $name = "安田桜輔";
        $handle_name = "grkon";
        $grade = "21B";
        $authority = "1";
        $position = "部長";

        $pdo->beginTransaction();

        $stmt = $pdo->prepare($new_member);
        $stmt->bindValue(":id", $id, PDO::PARAM_STR);
        $stmt->bindValue(":pass", $pass, PDO::PARAM_STR);
        $stmt->bindValue(":name", $name, PDO::PARAM_STR);
        $stmt->bindValue(":handle_name", $handle_name, PDO::PARAM_STR);
        $stmt->bindValue(":grade", $grade, PDO::PARAM_STR);
        $stmt->bindValue(":authority", $authority, PDO::PARAM_INT);
        $stmt->bindValue(":position", $position, PDO::PARAM_STR);

        $stmt->execute();

        $pdo->commit();
        */

        $id = "grkon";
        $pass = "yasu0u327";

        $sql = "SELECT * FROM Members WHERE id = :id AND pass= :pass";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_STR);
        $stmt->bindValue(":pass", $pass, PDO::PARAM_STR);

        $res = $stmt->execute();

        if ($res) {
            $data = $stmt->fetch();
            if ($data == false) {
                echo "データなし<br />";
            }
            var_dump($data);
        }

        echo "正常に完了";
    } catch (PDOException $e) {
        echo "接続失敗: " . $e->getMessage() . "\n";
        exit();
    } catch (ErrorException $e) {
        echo "クエリ失敗:" . $e->getMessage() . "\n";
    }
?>