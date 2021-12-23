<?
    /* MySQL用のAPI */

    /* 型としてのクラス */
    class Member {
        public $id;
        public $pass;
        public $name;
        public $handle_name;
        public $grade;
        public $authority;
        public $position;
    }
    
    $l__dsn = 'mysql:dbname=db_chesstech;host=mysql;port=3306;charset=utf8';
    $l__user = 'user';
    $l__password = 'password';

    $MYPDO = new PDO($l__dsn, $l__user, $l__password);

    class MYSQL_UTIL {
        // 変数群
        public $pdo; // PDO

        // コンストラクタ
        public function __construct() {
            global $MYPDO;
            $this->pdo = $MYPDO;
        }

        // 関数群

        //メンバーを新規登録
        public function CreateMember(Member $mem) {
            $new_member = "INSERT INTO Members (id, pass, name, handle_name, grade, authority, position)";
            $new_member .= " VALUES (:id, :pass, :name, :handle_name, :grade, :authority, :position);";

            $id = $mem->id;
            $pass = $mem->pass;
            $name = $mem->name;
            $handle_name = $mem->handle_name;
            $grade = $mem->grade;
            $authority = $mem->authority;
            $position = $mem->position;

            $this->pdo->beginTransaction();

            $stmt = $this->pdo->prepare($new_member);

            $stmt->bindValue(":id", $id, PDO::PARAM_STR);
            $stmt->bindValue(":pass", $pass, PDO::PARAM_STR);
            $stmt->bindValue(":name", $name, PDO::PARAM_STR);
            $stmt->bindValue(":handle_name", $handle_name, PDO::PARAM_STR);
            $stmt->bindValue(":grade", $grade, PDO::PARAM_STR);
            $stmt->bindValue(":authority", $authority, PDO::PARAM_INT);
            $stmt->bindValue(":position", $position, PDO::PARAM_STR);

            $stmt->execute();

            $this->pdo->commit();
        }
    }
?>