<?
    /* MySQL用のAPI */
    
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
    }
?>