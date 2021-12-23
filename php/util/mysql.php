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
    
    // MySQLにPDOでアクセス
    
    $l__dsn = 'mysql:dbname=db_chesstech;host=mysql;port=3306;charset=utf8';
    $l__user = 'user';
    $l__password = 'password';

    $MYPDO = new PDO($l__dsn, $l__user, $l__password);

    /* API集のクラス */

    class MYSQL_UTIL {
        // 変数群
        public $pdo; // PDO

        // コンストラクタ
        public function __construct() {
            global $MYPDO;
            $this->pdo = $MYPDO;
        }

        // 関数群

        //メンバーを新規登録(成功すればtrueを返す, そうでなければfalseを返す)
        public function CreateMember(Member $mem) {
            $id = $mem->id;
            $pass = $mem->pass;
            $name = $mem->name;
            $handle_name = $mem->handle_name;
            $grade = $mem->grade;
            $authority = $mem->authority;
            $position = $mem->position;

            $sql = "SELECT * FROM Members WHERE id = :id";
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(":id", $id, PDO::PARAM_STR);

            $res = $stmt->execute();
            if ($res) {
                if ($stmt->fetch() != false) {
                    return false;
                }
            }

            $sql = "INSERT INTO Members (id, pass, name, handle_name, grade, authority, position)";
            $sql .= " VALUES (:id, :pass, :name, :handle_name, :grade, :authority, :position);";

            $this->pdo->beginTransaction();

            $stmt = $this->pdo->prepare($sql);

            $stmt->bindValue(":id", $id, PDO::PARAM_STR);
            $stmt->bindValue(":pass", $pass, PDO::PARAM_STR);
            $stmt->bindValue(":name", $name, PDO::PARAM_STR);
            $stmt->bindValue(":handle_name", $handle_name, PDO::PARAM_STR);
            $stmt->bindValue(":grade", $grade, PDO::PARAM_STR);
            $stmt->bindValue(":authority", $authority, PDO::PARAM_INT);
            $stmt->bindValue(":position", $position, PDO::PARAM_STR);

            $stmt->execute();

            $this->pdo->commit();

            return true;
        }

        //メンバーの認証(idとpassが正しければtrue, そうでなければfalseを返す)
        public function AuthenticateMember(string $id, string $pass) {
            $sql = "SELECT * FROM Members WHERE id = :id AND pass = :pass";

            $stmt = $this->pdo->prepare($sql);

            $stmt->bindValue(":id", $id, PDO::PARAM_STR);
            $stmt->bindValue(":pass", $pass, PDO::PARAM_STR);

            $res = $stmt->execute();

            if ($res) {
                if ($stmt->fetch() != false) {
                    return true;
                }
            }
            return false;
        }

        //メンバーの情報取得(idが存在しなければnullを返す)
        public function GetMember(string $id) {
            $sql = "SELECT * FROM Members WHERE id = :id";

            $stmt = $this->pdo->prepare($sql);

            $stmt->bindValue(":id", $id, PDO::PARAM_STR);

            $res = $stmt->execute();

            if ($res) {
                $data = $stmt->fetch();

                if ($data == false) {
                    return null;
                }

                $mem = new Member();
                $mem->id = $data["id"];
                $mem->pass = $data["pass"];
                $mem->name = $data["name"];
                $mem->handle_name = $data["handle_name"];
                $mem->grade = $data["grade"];
                $mem->authority = $data["authority"];
                $mem->position = $data["position"];

                return $mem;
            }

            return null;
        }
    }
?>