<?php
    require_once(dirname(__FILE__) . "/util.php");

    /* MySQL用のAPI */

    /* 型としてのクラス */
    class Member {
        public $id = null;
        public $pass = null;
        public $name = null;
        public $handle_name = null;
        public $grade = null;
        public $authority = null;
        public $position = null;
        public $joinable_dayofweek = null;
    }

    class Schedule {
        public $id = null;
        public $name = null;
        public $date_start = null;
        public $date_end = null;
        public $detail = null;
        public $members_join = null;
        public $members_notjoin = null;
    }

    class JoinableDay {
        public $date = null;
        public $joinable = null;
        public $maybe_joinable = null;
        public $notjoinable = null;
    }

    class Menu {
        public $filepath = null;
        public $dirname = null;
        public $rank_allowed = null;
        public $name = null;
    }
    
    // MySQLにPDOでアクセス

    $l__dsn = 'mysql:dbname=db_chesstech;host=mysql;port=3306;charset=utf8';
    $l__user = 'user';
    $l__password = 'password';

    if (file_exists(dirname(__FILE__) . "/../../setting/mysql.php")) {
        require_once(dirname(__FILE__) . "/../../setting/mysql.php");

        $l__dsn = mysql_dsn();
        $l__user = mysql_user();
        $l__password = mysql_password();
    }

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

        // メンバーを新規登録(成功すればtrueを返す, そうでなければfalseを返す)
        public function CreateMember(Member $mem) {
            $id = $mem->id;
            $pass = $mem->pass;
            $name = $mem->name;
            $handle_name = $mem->handle_name;
            $grade = $mem->grade;
            $authority = $mem->authority;
            $position = $mem->position;
            $joinable_dayofweek = $mem->joinable_dayofweek;

            $sql = "SELECT * FROM Members WHERE id = :id";
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(":id", $id, PDO::PARAM_STR);

            $res = $stmt->execute();
            if ($res) {
                if ($stmt->fetch() != false) {
                    return false;
                }
            }

            $sql = "INSERT INTO Members (id, pass, name, handle_name, grade, authority, position, joinable_dayofweek)";
            $sql .= " VALUES (:id, :pass, :name, :handle_name, :grade, :authority, :position, :joinable_dayofweek);";

            $this->pdo->beginTransaction();

            $stmt = $this->pdo->prepare($sql);

            $stmt->bindValue(":id", $id, PDO::PARAM_STR);
            $stmt->bindValue(":pass", $pass, PDO::PARAM_STR);
            $stmt->bindValue(":name", $name, PDO::PARAM_STR);
            $stmt->bindValue(":handle_name", $handle_name, PDO::PARAM_STR);
            $stmt->bindValue(":grade", $grade, PDO::PARAM_STR);
            $stmt->bindValue(":authority", $authority, PDO::PARAM_INT);
            $stmt->bindValue(":position", $position, PDO::PARAM_STR);
            $stmt->bindValue(":joinable_dayofweek", $joinable_dayofweek, PDO::PARAM_STR);

            $stmt->execute();

            $this->pdo->commit();

            return true;
        }

        // メンバーの修正(成功すればtrue, そうでなければfalseを返す)
        public function UpdateMember(Member $mem) {
            $exist = $this->GetMember($mem->id);
            if ($exist == null) {
                return false;
            }

            $sql = "UPDATE Members SET ";
            
            $comma = false;
            $b_pass = false;
            $b_name = false;
            $b_handle_name = false;
            $b_grade = false;
            $b_authority = false;
            $b_position = false;
            $b_joinable_dayofweek = false;

            if ($mem->pass !== null) {
                $sql .= "pass = :pass";
                $b_pass = true;
                $comma = true;
            }
            if ($mem->name !== null) {
                if ($comma) {
                    $sql .= ", ";
                }
                $sql .= "name = :name";
                $b_name = true;
                $comma = true;
            }
            if ($mem->handle_name !== null) {
                if ($comma) {
                    $sql .= ", ";
                }
                $sql .= "handle_name = :handle_name";
                $b_handle_name = true;
                $comma = true;
            }
            if ($mem->grade !== null) {
                if ($comma) {
                    $sql .= ", ";
                }
                $sql .= "grade = :grade";
                $b_grade = true;
                $comma = true;
            }
            if ($mem->authority !== null) {
                if ($comma) {
                    $sql .= ", ";
                }
                $sql .= "authority = :authority";
                $b_authority = true;
                $comma = true;
            }
            if ($mem->position !== null) {
                if ($comma) {
                    $sql .= ", ";
                }
                $sql .= "position = :position";
                $b_position = true;
            }
            if($mem->joinable_dayofweek !== null) {
                if ($comma) {
                    $sql .= ", ";
                }
                $sql .= "joinable_dayofweek = :joinable_dayofweek";
                $b_joinable_dayofweek = true;
            }
            $sql .= " WHERE id = :id";

            $stmt = $this->pdo->prepare($sql);

            $stmt->bindValue(":id", $mem->id, PDO::PARAM_STR);

            if ($b_pass) {
                $stmt->bindValue(":pass", $mem->pass, PDO::PARAM_STR);
            }
            if ($b_name) {
                $stmt->bindValue(":name", $mem->name, PDO::PARAM_STR);
            }
            if ($b_handle_name) {
                $stmt->bindValue(":handle_name", $mem->handle_name, PDO::PARAM_STR);
            }
            if ($b_grade) {
                $stmt->bindValue(":grade", $mem->grade, PDO::PARAM_STR);
            }
            if ($b_authority) {
                $stmt->bindValue(":authority", $mem->authority, PDO::PARAM_INT);
            }
            if ($b_position) {
                $stmt->bindValue(":position", $mem->position, PDO::PARAM_STR);
            }
            if ($b_joinable_dayofweek) {
                $stmt->bindValue(":joinable_dayofweek", $mem->joinable_dayofweek, PDO::PARAM_STR);
            }
            
            $stmt->execute();

            return true;
        }

        // メンバーの認証(idとpassが正しければtrue, そうでなければfalseを返す)
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
                $mem->joinable_dayofweek = $data["joinable_dayofweek"];

                return $mem;
            }

            return null;
        }

        // メンバーの全情報取得(何もなければ null を返す)
        public function GetAllMembers() {
            $sql = "SELECT * FROM Members";

            $res = $this->pdo->query($sql);

            $data = $res->fetchAll();
            if ($data != false) {
                $members = array();

                foreach ($data as $e) {
                    $mem = new Member();
                    $mem->id = $e["id"];
                    $mem->pass = $e["pass"];
                    $mem->name = $e["name"];
                    $mem->handle_name = $e["handle_name"];
                    $mem->grade = $e["grade"];
                    $mem->authority = $e["authority"];
                    $mem->position = $e["position"];
                    $mem->joinable_dayofweek = $e["joinable_dayofweek"];
                    array_push($members, $mem);
                }

                return $members;
            }
            
            return null;
        }

        // admin以外のメンバーの全情報取得(何もなければ null を返す)
        public function GetAllMembersExceptAdmin() {
            $mems = $this->GetAllMembers();
            $ret = array();
            for ($i = 0; $i < count($mems); $i++) {
                if ($mems[$i]->id != "admin") {
                    array_push($ret, $mems[$i]);
                }
            }

            return $ret;
        }

        // メンバーの消去(成功したらtrue, 失敗したらfalseを返す)
        public function DeleteMember(string $id) {
            $exist = $this->GetMember($id);
            if ($exist == null) {
                return false;
            }

            $sql = "DELETE FROM Members WHERE id = :id";

            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(":id", $id, PDO::PARAM_STR);
            $stmt->execute();

            return true;
        }

        // スケジュールを新規登録(成功すればtrue, そうでなければfalseを返す. id はなしで良い)
        public function CreateSchedule(Schedule $sch) {
            // idの発行をする
            $date_start = $sch->date_start;
            $sql = "SELECT * FROM Schedules WHERE id = :id";

            for ($i = 1;; $i++) {
                $id = intval($date_start->format("ymd")) * 100 + $i;
                $stmt = $this->pdo->prepare($sql);
                $stmt->bindValue(":id", $id, PDO::PARAM_INT);
                $res = $stmt->execute();
                if ($res) {
                    $data = $stmt->fetch();
                    if ($data == false) {
                        break;
                    }
                } else {
                    break;
                }
            }

            $sch->id = $id;

            $id = $sch->id;
            $name = $sch->name;
            $date_start = $sch->date_start->format("Y-m-d H:i:s");
            $date_end = $sch->date_end->format("Y-m-d H:i:s");
            $detail = $sch->detail;
            $members_join = $sch->members_join;
            $members_notjoin = $sch->members_notjoin;

            $sql = "INSERT INTO Schedules (id, name, date_start, date_end, detail, members_join, members_notjoin)";
            $sql .= "VALUES (:id, :name, :date_start, :date_end, :detail, :members_join, :members_notjoin)";

            $this->pdo->beginTransaction();

            $stmt = $this->pdo->prepare($sql);

            $stmt->bindValue(":id", $id, PDO::PARAM_INT);
            $stmt->bindValue(":name", $name, PDO::PARAM_STR);
            $stmt->bindValue(":date_start", $date_start, PDO::PARAM_STR);
            $stmt->bindValue(":date_end", $date_end, PDO::PARAM_STR);
            $stmt->bindValue(":detail", $detail, PDO::PARAM_STR);
            $stmt->bindValue(":members_join", $members_join, PDO::PARAM_STR);
            $stmt->bindValue(":members_notjoin", $members_notjoin, PDO::PARAM_STR);

            $stmt->execute();

            $this->pdo->commit();

            return true;
        }

        // スケジュールの情報修正(成功したらこのid, 失敗したらfalseを返す)
        public function UpdateSchedule(Schedule $sch) {
            $exist = $this->GetSchedule($sch->id);
            if ($exist == null) {
                return false;
            }

            $sql = "UPDATE Schedules SET  ";

            $comma = false;
            $b_id = false;
            $b_name = false;
            $b_date_start = false;
            $b_date_end = false;
            $b_detail = false;
            $b_members_join = false;
            $b_members_notjoin = false;

            $id_num = 1;

            if ($sch->name !== null) {
                $sql .= "name = :name";
                $b_name = true;
                $comma = true;
            }
            if ($sch->date_start !== null) {
                if ($comma) {
                    $sql .= ", ";
                }
                $sql .= "date_start = :date_start";
                $b_date_start = true;
                $comma = true;

                // idの発行をする
                if ($sch->date_start->format("Ymd") !== $exist->date_start->format("Ymd")) {
                    $sql .= ", id = :id";
                    $b_id = true;
                    $date_start = $sch->date_start;
                    $sql_t = "SELECT * FROM Schedules WHERE id = :id";
        
                    for ($i = 1;; $i++) {
                        $id_t = intval($date_start->format("ymd")) * 100 + $i;
                        $stmt_t = $this->pdo->prepare($sql_t);
                        $stmt_t->bindValue(":id", $id_t, PDO::PARAM_INT);
                        $res = $stmt_t->execute();
                        if ($res) {
                            $data = $stmt_t->fetch();
                            if ($data == false) {
                                $id_num = $i;
                                break;
                            }
                        } else {
                            break;
                        }
                    }
                }
            }
            if ($sch->date_end !== null) {
                if ($comma) {
                    $sql .= ", ";
                }
                $sql .= "date_end = :date_end";
                $b_date_end = true;
                $comma = true;
            }
            if ($sch->detail !== null) {
                if ($comma) {
                    $sql .= ", ";
                }
                $sql .= "detail = :detail";
                $b_detail = true;
                $comma = true;
            }
            if ($sch->members_join !== null) {
                if ($comma) {
                    $sql .= ", ";
                }
                $sql .= "members_join = :members_join";
                $b_members_join = true;
                $comma = true;
            }
            if ($sch->members_notjoin !== null) {
                if ($comma) {
                    $sql .= ", ";
                }
                $sql .= "members_notjoin = :members_notjoin";
                $b_members_notjoin = true;
            }
            $sql .= " WHERE id = :id_old";

            $stmt = $this->pdo->prepare($sql);
            
            $id_old = $sch->id;

            $stmt->bindParam(":id_old", $id_old, PDO::PARAM_INT);
            if ($b_name) {
                $stmt->bindValue(":name", $sch->name, PDO::PARAM_STR);
            }
            if ($b_date_start) {
                $stmt->bindValue(":date_start", $sch->date_start->format("Y-m-d H:i:s"), PDO::PARAM_STR);
                // id を改める
                if ($b_id) {
                    $id = intval($sch->date_start->format("ymd")) * 100 + $id_num;
                    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                }
            }
            if ($b_date_end) {
                $stmt->bindValue(":date_end", $sch->date_end->format("Y-m-d H:i:s"), PDO::PARAM_STR);
            }
            if ($b_detail) {
                $stmt->bindValue(":detail", $sch->detail, PDO::PARAM_STR);
            }
            if ($b_members_join) {
                $stmt->bindValue(":members_join", $sch->members_join, PDO::PARAM_STR);
            }
            if ($b_members_notjoin) {
                $stmt->bindValue(":members_notjoin", $sch->members_notjoin, PDO::PARAM_STR);
            }

            $stmt->execute();

            return $id;
        }

        // スケジュールにメンバーを登録(成功したらtrue, そうでなければfalseを返す)
        public function RegistMemberSchedule(int $id, string $user_id, bool $joinable) {
            $sch = $this->GetSchedule($id);
            
            if ($sch == null) {
                return false;
            }

            if ($this->GetMember($user_id) == null) {
                return false;
            }

            $arr_join = explode(",", $sch->members_join);
            $arr_notjoin = explode(",", $sch->members_notjoin);
            $arr_join = array_diff($arr_join, [$user_id]);
            $arr_notjoin = array_diff($arr_notjoin, [$user_id]);

            if ($joinable) {
                array_push($arr_join, $user_id);
            } else {
                array_push($arr_notjoin, $user_id);
            }

            $sch->members_join = arrayToString($arr_join);
            $sch->members_notjoin = arrayToString($arr_notjoin);

            if ($this->UpdateSchedule($sch) !== false) {
                return true;
            }

            return false;
        }

        // スケジュールの情報取得(idが存在しなければnullを返す)
        public function GetSchedule(int $id) {
            $sql = "SELECT * FROM Schedules WHERE id = :id";
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(":id", $id, PDO::PARAM_INT);
            
            $res = $stmt->execute();
            if ($res) {
                $data = $stmt->fetch();
                if ($data == false) {
                    return null;
                }
            } else {
                return null;
            }

            $sch = new Schedule();

            $sch->id = $data["id"];
            $sch->name = $data["name"];
            $sch->date_start = new DateTime($data["date_start"]);
            $sch->date_end = new DateTime($data["date_end"]);
            $sch->detail = $data["detail"];
            $sch->members_join = $data["members_join"];
            $sch->members_notjoin = $data["members_notjoin"];

            return $sch;
        }

        // 期間内のスケジュールの情報取得(何もなければ null を返す), (日付の指定のみ、細かい時間は受け付けない)
        public function GetSchedulesBetween(DateTime $d_from, DateTime $d_to) {
            $sql = "SELECT * FROM Schedules WHERE (date_start <= :d_to) AND (date_end >= :d_from)";
            $sql .= " ORDER BY date_start";
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(":d_from", $d_from->format("Y-m-d 00:00:00"), PDO::PARAM_STR);
            $stmt->bindValue(":d_to", $d_to->format("Y-m-d 23:59:59"), PDO::PARAM_STR);
            $stmt->execute();
            
            $data = $stmt->fetchAll();
            if ($data == false) {
                return null;
            }

            $schedules = array();
            foreach ($data as $e) {
                $sch = new Schedule();
                $sch->id = $e["id"];
                $sch->name = $e["name"];
                $sch->date_start = new DateTime($e["date_start"]);
                $sch->date_end = new DateTime($e["date_end"]);
                $sch->detail = $e["detail"];
                $sch->members_join = $e["members_join"];
                $sch->members_notjoin = $e["members_notjoin"];
                array_push($schedules, $sch);
            }

            return $schedules;
        }

        // スケジュールの全情報取得(何もなければnullを返す)
        public function GetAllSchedules() {
            $sql = "SELECT * FROM Schedules";

            $res = $this->pdo->query($sql);

            $data = $res->fetchAll();
            if ($data != false) {
                $schedules = array();
                foreach ($data as $e) {
                    $sch = new Schedule();
                    $sch->id = $e["id"];
                    $sch->name = $e["name"];
                    $sch->date_start = new DateTime($e["date_start"]);
                    $sch->date_end = new DateTime($e["date_end"]);
                    $sch->detail = $e["detail"];
                    $sch->members_join = $e["members_join"];
                    $sch->members_notjoin = $e["members_notjoin"];
                    array_push($schedules, $sch);
                }
                return $schedules;
            }

            return null;
        }

        // スケジュールの消去(成功したら true, 失敗したら false を返す)
        public function DeleteSchedule(int $id) {
            $exist = $this->GetSchedule($id);
            if ($exist == null) {
                return false;
            }
            
            $sql = "DELETE FROM Schedules WHERE id = :id";
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(":id", $id, PDO::PARAM_INT);
            $stmt->execute();

            return true;
        }

        // 活動可能日を新規登録
        public function CreateJoinableDay(JoinableDay $joi) {
            $day_joi = new JoinableDay();
            $day_joi->date = $joi->date;
            $exist = $this->GetJoinableDays($day_joi);
            if ($exist != null) {
                return false;
            }

            $sql = "INSERT INTO JoinableDays (date, joinable, maybe_joinable, notjoinable)";
            $sql .= " VALUE (:date, :joinable, :maybe_joinable, :notjoinable)";

            $stmt = $this->pdo->prepare($sql);

            $stmt->bindValue(":date", $joi->date->format("Y-m-d 00:00:00"), PDO::PARAM_STR);
            $stmt->bindValue(":joinable", $joi->joinable, PDO::PARAM_STR);
            $stmt->bindValue(":maybe_joinable", $joi->maybe_joinable, PDO::PARAM_STR);
            $stmt->bindValue(":notjoinable", $joi->notjoinable, PDO::PARAM_STR);

            $stmt->execute();

            return true;
        }

        // 活動可能日の情報修正
        public function UpdateJoinableDay(JoinableDay $joi) {
            $day_joi = new JoinableDay();
            $day_joi->date = $joi->date;
            $exist = $this->GetJoinableDays($day_joi);
            if ($exist == null) {
                return false;
            }

            $sql = "UPDATE JoinableDays SET ";

            $b_joinable = false;
            $b_maybe_joinable = false;
            $b_notjoinable = false;

            $sql .= "date = :date";
            if ($joi->joinable !== null) {
                $sql .= ", joinable = :joinable";
                $b_joinable = true;
            }
            if ($joi->maybe_joinable !== null) {
                $sql .= ", maybe_joinable = :maybe_joinable";
                $b_maybe_joinable = true;
            }
            if ($joi->notjoinable !== null) {
                $sql .= ", notjoinable = :notjoinable";
                $b_notjoinable = true;
            }

            $sql .= " WHERE date = :date";

            $stmt = $this->pdo->prepare($sql);

            $stmt->bindValue(":date", $joi->date->format("Y-m-d 00:00:00"), PDO::PARAM_STR);

            if ($b_joinable) {
                $stmt->bindValue(":joinable", $joi->joinable, PDO::PARAM_STR);
            }
            if ($b_maybe_joinable) {
                $stmt->bindValue(":maybe_joinable", $joi->maybe_joinable, PDO::PARAM_STR);
            }
            if ($b_notjoinable) {
                $stmt->bindValue(":notjoinable", $joi->notjoinable, PDO::PARAM_STR);
            }

            $stmt->execute();

            return true;
        }

        // 活動可能日にメンバーを追加
        public function AddMemberJoinableDay(JoinableDay $add_joi) {
            $bind = new JoinableDay();
            $bind->date = $add_joi->date;
            $joi = $this->GetJoinableDays($bind);
            if ($joi === null) {
                return false;
            }

            if ($add_joi->joinable !== null) {
                if ($joi[0]->joinable === null) {
                    $joi[0]->joinable = "";
                }
                $new_joinable_arr = array_merge(explode(",", $joi[0]->joinable), explode(",", $add_joi->joinable));
                $new_joinable_arr = array_unique($new_joinable_arr);
                $joi[0]->joinable = arrayToString($new_joinable_arr);
            }

            if ($add_joi->maybe_joinable !== null) {
                if ($joi[0]->maybe_joinable === null) {
                    $joi[0]->maybe_joinable = "";
                }
                $new_maybe_joinable_arr = array_merge(explode(",", $joi[0]->maybe_joinable), explode(",", $add_joi->maybe_joinable));
                $new_maybe_joinable_arr = array_unique($new_maybe_joinable_arr);
                $joi[0]->maybe_joinable = arrayToString($new_maybe_joinable_arr);
            }

            if ($add_joi->notjoinable !== null) {
                if ($joi[0]->notjoinable === null) {
                    $joi[0]->notjoinable = "";
                }
                $new_notjoinable_arr = array_merge(explode(",", $joi[0]->notjoinable), explode(",", $add_joi->notjoinable));
                $new_notjoinable_arr = array_unique($new_notjoinable_arr);
                $joi[0]->notjoinable = arrayToString($new_notjoinable_arr);
            }

            $this->UpdateJoinableDay($joi[0]);

            return true;
        }

        // 活動可能日を登録またはuserのidを追加 ($state = 0: 消去, 1: joinable, 2: maybe_joinable, 3: notjoinable)
        public function RegistMemberJoinableDay(DateTime $date, string $user_id, int $state) {
            $add_joi = new JoinableDay();
            $add_joi->date = $date;
            $add_joi->joinable = "";
            $add_joi->maybe_joinable = "";
            $add_joi->notjoinable = "";

            $exist = $this->GetJoinableDays($add_joi);

            switch ($state) {
                case 0:
                    // 消去
                    $ret = $this->DeleteMemberJoinableDay($date, $user_id);

                    if (!$ret) {
                        return false;
                    }

                    $res = $exist;
                    
                    if (
                        ($res[0]->joinable === null || $res[0]->joinable === "") &&
                        ($res[0]->maybe_joinable === null || $res[0]->maybe_joinable === "") &&
                        ($res[0]->notjoinable === null || $res[0]->notjoinable === "")
                    ) {
                        $this->DeleteJoinableDay($date);
                    }

                    return $ret;
                case 1:
                    $add_joi->joinable = $user_id;
                    break;
                case 2:
                    $add_joi->maybe_joinable = $user_id;
                    break;
                case 3:
                    $add_joi->notjoinable = $user_id;
                    break;
                default:
                    return false;
            }

            // user id が存在するかの確認
            $mem = $this->GetMember($user_id);
            if ($mem == null) {
                return false;
            }

            if ($exist == null) {
                return $this->CreateJoinableDay($add_joi);
            }

            // 一旦データからメンバーを消去してから再追加
            $this->DeleteMemberJoinableDay($date, $user_id);

            $bind = new JoinableDay();
            $bind->date = $date;

            $exist = $this->GetJoinableDays($bind);
            if ($exist == null) {
                return $this->CreateJoinableDay($add_joi);
            }

            return $this->AddMemberJoinableDay($add_joi);
        }

        // 活動可能日を日付・メンバーなどを指定して取得
        public function GetJoinableDays(JoinableDay $bind) {
            $sql = "SELECT * FROM JoinableDays WHERE";

            $and = false;
            $b_date = false;
            $b_joinable = false;
            $b_maybe_joinable = false;
            $b_notjoinable = false;

            // joinable などは配列となる変数なので、要素を取り出しておく
            $joinable_array = explode(",", $bind->joinable);
            $maybe_joinable_array = explode(",", $bind->maybe_joinable);
            $notjoinable_array = explode(",", $bind->notjoinable);

            $l_ja = count($joinable_array);
            $l_mja = count($maybe_joinable_array);
            $l_nja = count($notjoinable_array);

            if ($bind->date != null) {
                $sql .= " date=:date";
                $and = true;
                $b_date = true;
            }
            if ($bind->joinable != null) {
                for ($i = 0; $i < $l_ja; $i++) {
                    if ($and) {
                        $sql .= " AND";
                    }
                    $sql .= " joinable LIKE :joinable" . $i;
                    $and = true;
                    $b_joinable = true;
                }
            }
            if ($bind->maybe_joinable != null) {
                for ($i = 0; $i < $l_mja; $i++) {
                    if ($and) {
                        $sql .= " AND";
                    }
                    $sql .= " maybe_joinable LIKE :maybe_joinable" . $i;
                    $and = true;
                    $b_maybe_joinable = true;
                }
            }
            if ($bind->notjoinable != null) {
                for ($i = 0; $i < $l_nja; $i++) {
                    if ($and) {
                        $sql .= " AND";
                    }
                    $sql .= " notjoinable LIKE :notjoinable" . $i;
                    $and = true;
                    $b_notjoinable = true;
                }
            }

            $stmt = $this->pdo->prepare($sql);

            if ($b_date) {
                $stmt->bindValue(":date", $bind->date->format("Y-m-d 00:00:00"), PDO::PARAM_STR);
            }
            if ($b_joinable) {
                for ($i = 0; $i < $l_ja; $i++) {
                    $stmt->bindValue(":joinable" . $i, "%" . $joinable_array[$i] . "%", PDO::PARAM_STR);
                }
            }
            if ($b_maybe_joinable) {
                for ($i = 0; $i < $l_mja; $i++) {
                    $stmt->bindValue(":maybe_joinable" . $i, "%" . $maybe_joinable_array[$i] . "%", PDO::PARAM_STR);
                }
            }
            if ($b_notjoinable) {
                for ($i = 0; $i < $l_nja; $i++) {
                    $stmt->bindValue(":notjoinable" . $i, "%" . $notjoinable_array[$i] . "%", PDO::PARAM_STR);
                }
            }

            $stmt->execute();
            $data = $stmt->fetchAll();

            if ($data != false) {
                $joinabledays = array();
                foreach($data as $e) {
                    $joinableday = new JoinableDay();
                    $joinableday->date = new DateTime($e["date"]);
                    $joinableday->joinable = $e["joinable"];
                    $joinableday->maybe_joinable = $e["maybe_joinable"];
                    $joinableday->notjoinable = $e["notjoinable"];
                    array_push($joinabledays, $joinableday);
                }

                $jois_comp = array();
                foreach($joinabledays as $e) {
                    $id_comp_match = true;
                    
                    if ($bind->joinable != null) {
                        $joinable_arr = explode(",", $e->joinable);
                        $bind_joinable_arr = explode(",", $bind->joinable);

                        foreach ($bind_joinable_arr as $b) {
                            if(!in_array($b, $joinable_arr)) {
                                $id_comp_match = false;
                            }
                        }

                        if (!$id_comp_match) {
                            continue;
                        }
                    }
                    
                    if ($bind->maybe_joinable != null) {
                        $maybe_joinable_arr = explode(",", $e->maybe_joinable);
                        $bind_maybe_joinable_arr = explode(",", $bind->maybe_joinable);

                        foreach ($bind_maybe_joinable_arr as $b) {
                            if (!in_array($b, $maybe_joinable_arr)) {
                                $id_comp_match = false;
                            }
                        }

                        if (!$id_comp_match) {
                            continue;
                        }
                    }

                    if ($bind->notjoinable != null) {
                        $notjoinable_arr = explode(",", $e->notjoinable);
                        $bind_notjoinable_arr = explode(",", $bind->notjoinable);

                        foreach ($bind_notjoinable_arr as $b) {
                            if (!in_array($b, $notjoinable_arr)) {
                                $id_comp_match = false;
                            }
                        }

                        if (!$id_comp_match) {
                            continue;
                        }
                    }
                    
                    array_push($jois_comp, $e);
                }

                return $jois_comp;
            }

            return null;
        }

        // 特定のメンバーの活動可能日の情報を取得
        public function GetJoinableDays_byID(string $user_id) {
            $bind = new JoinableDay();
            $jois = array();

            $bind->joinable = $user_id;
            $jois_temp = $this->GetJoinableDays($bind);
            if ($jois_temp != null) {
                $jois = array_merge($jois, $jois_temp);
            }

            $bind->joinable = null;
            $bind->maybe_joinable = $user_id;
            $jois_temp = $this->GetJoinableDays($bind);
            if ($jois_temp != null) {
                $jois = array_merge($jois, $jois_temp);
            }

            $bind->maybe_joinable = null;
            $bind->notjoinable = $user_id;
            $jois_temp = $this->GetJoinableDays($bind);
            if ($jois_temp != null) {
                $jois = array_merge($jois, $jois_temp);
            }

            if (empty($jois)) {
                return null;
            }

            return $jois;
        }

        // 活動可能日の全情報取得(何もなければnullを返す)
        public function GetAllJoinableDays() {
            $sql = "SELECT * FROM JoinableDays";

            $res = $this->pdo->query($sql);

            $data = $res->fetchAll();

            if ($data != false) {
                $joinabledays = array();
                foreach ($data as $e) {
                    $joinableday = new JoinableDay();
                    $joinableday->date = new DateTime($e["date"]);
                    $joinableday->joinable = $e["joinable"];
                    $joinableday->maybe_joinable = $e["maybe_joinable"];
                    $joinableday->notjoinable = $e["notjoinble"];
                }
                array_push($joinabledays, $joinableday);
                return $joinabledays;
            }

            return null;
        }

        // 活動可能日を消去
        public function DeleteJoinableDay(DateTime $date) {
            $sql = "DELETE FROM JoinableDays WHERE date = :date";

            $stmt = $this->pdo->prepare($sql);

            $stmt->bindValue(":date", $date->format("Y-m-d 00:00:00"), PDO::PARAM_STR);

            $stmt->execute();

            return true;
        }

        // 活動可能日から人物を消去
        public function DeleteMemberJoinableDay(DateTime $date, string $user_id) {
            $bind = new JoinableDay();
            $bind->date = $date;
            $bind->joinable = $user_id;

            $joi_joinable = $this->GetJoinableDays($bind);

            if ($joi_joinable !== null) {
                $joinable_arr = explode(",", $joi_joinable[0]->joinable);
                $new_joinable_arr = array();

                foreach ($joinable_arr as $e) {
                    if ($e != $user_id) {
                        array_push($new_joinable_arr, $e);
                    }
                }

                $joi_joinable[0]->joinable = arrayToString($new_joinable_arr);
                $this->UpdateJoinableDay($joi_joinable[0]);
                return true;
            }

            $bind->joinable = null;
            $bind->maybe_joinable = $user_id;

            $joi_maybe_joinable =  $this->GetJoinableDays($bind);

            if ($joi_maybe_joinable != null) {
                $maybe_joinable_arr = explode(",", $joi_maybe_joinable[0]->maybe_joinable);
                $new_maybe_joinable_arr = array();
                
                foreach ($maybe_joinable_arr as $e) {
                    if ($e != $user_id) {
                        array_push($new_maybe_joinable_arr, $e);
                    }
                }

                $joi_maybe_joinable[0]->maybe_joinable = arrayToString($new_maybe_joinable_arr);
                $this->UpdateJoinableDay($joi_maybe_joinable[0]);

                return true;
            }

            $bind->maybe_joinable = null;
            $bind->notjoinable = $user_id;

            $joi_notjoinable = $this->GetJoinableDays($bind);

            if ($joi_notjoinable != null) {
                $notjoinable_arr = explode(",", $joi_notjoinable[0]->notjoinable);
                $new_notjoinable_arr = array();

                foreach ($notjoinable_arr as $e) {
                    if ($e != $user_id) {
                        array_push($new_notjoinable_arr, $e);
                    }
                }
                
                $joi_notjoinable[0]->notjoinable = arrayToString($new_notjoinable_arr);
                $this->UpdateJoinableDay($joi_notjoinable[0]);

                return true;
            }

            return false;
        }

        // メニューを取得する
        public function GetMenu(string $filepath) {
            $sql = "SELECT * FROM Menu WHERE filepath = :filepath";

            $stmt = $this->pdo->prepare($sql);

            $stmt->bindValue(":filepath", $filepath, PDO::PARAM_STR);
            $stmt->execute();

            $data = $stmt->fetch();

            if ($data == false) {
                return null;
            }

            $menu = new Menu();

            $menu->filepath = $data["filepath"];
            $menu->dirname = $data["dirname"];
            $menu->rank_allowed = $data["rank_allowed"];
            $menu->name = $data["name"];

            return $menu;
        }

        // メニューを検索する
        public function GetMenu_byCondition(Menu $m) {
            $sql = "SELECT * FROM Menu WHERE";

            $and = false;
            $b_filepath = false;
            $b_dirname = false;
            $b_rank_allowed = false;

            if ($m->filepath !== null) {
                $sql .= " filepath = :filepath";

                $and = true;
                $b_filepath = true;
            }
            if ($m->dirname !== null) {
                if ($and) {
                    $sql .= " AND";
                }
                $sql .= " dirname = :dirname";

                $and = true;
                $b_dirname = true;
            }
            if ($m->rank_allowed !== null) {
                if ($and) {
                    $sql .= " AND";
                }
                $sql .= " rank_allowed = :rank_allowed";

                $b_rank_allowed = true;
            }

            $stmt = $this->pdo->prepare($sql);

            if ($b_filepath) {
                $stmt->bindValue(":filepath", $m->filepath, PDO::PARAM_STR);
            }
            if ($b_dirname) {
                $stmt->bindValue(":dirname", $m->dirname, PDO::PARAM_STR);
            }
            if ($b_rank_allowed) {
                $stmt->bindValue(":rank_allowed", $m->rank_allowed, PDO::PARAM_INT);
            }

            $stmt->execute();

            $data = $stmt->fetchAll();

            if ($data === false) {
                return null;
            }

            $menu = array();
            foreach ($data as $e) {
                $me = new Menu();

                $me->filepath = $e["filepath"];
                $me->dirname = $e["dirname"];
                $me->rank_allowed = $e["rank_allowed"];

                array_push($menu, $me);
            }

            return $menu;
        }

        // あるランク以上のメニューを取得
        public function GetMenu_byRank(int $morethan_or_eq) {
            $sql = "SELECT * FROM Menu WHERE rank_allowed >= :morethan_or_eq";

            $stmt = $this->pdo->prepare($sql);
            
            $stmt->bindValue(":morethan_or_eq", $morethan_or_eq, PDO::PARAM_INT);

            $stmt->execute();

            $data = $stmt->fetchAll();

            if ($data == false) {
                return null;
            }

            $menu = array();
            foreach ($data as $m) {
                $me = new Menu();

                $me->filepath = $m["filepath"];
                $me->dirname = $m["dirname"];
                $me->rank_allowed = $m["rank_allowed"];
                $me->name = $m["name"];

                array_push($menu, $me);
            }

            return $menu;
        }

        // 全メニューを取得する
        public function GetAllMenu() {
            $sql = "SELECT * FROM Menu";
            
            $stmt = $this->pdo->query($sql);

            $data = $stmt->fetchAll();

            if ($data == false) {
                return null;
            }

            $menu = array();
            foreach ($data as $m) {
                $me = new Menu();

                $me->filepath = $m["filepath"];
                $me->dirname = $m["dirname"];
                $me->rank_allowed = $m["rank_allowed"];
                $me->name = $m["name"];

                array_push($menu, $me);
            }

            return $menu;
        }

        // メニューを作成する
        public function CreateMenu(Menu $m) {
            if (
                ($m->filepath == null) ||
                ($m->dirname == null) ||
                ($m->rank_allowed == null)
                ) {
                return false;
            }

            if ($this->GetMenu($m->filepath) != null) {
                return false;
            }

            $sql = "INSERT INTO Menu VALUES (:filepath, :dirname, :rank_allowed, :name)";

            $stmt = $this->pdo->prepare($sql);

            $stmt->bindValue(":filepath", $m->filepath, PDO::PARAM_STR);
            $stmt->bindValue(":dirname", $m->dirname, PDO::PARAM_STR);
            $stmt->bindValue(":ranke_allowed", $m->rank_allowed, PDO::PARAM_INT);
            $stmt->bindValue(":name", $m->name, PDO::PARAM_STR);

            $stmt->execute();

            return true;
        }

        // メニューを更新する
        public function UpdateMenu(string $filepath, Menu $m) {
            if ($this->GetMenu($filepath) == null) {
                return false;
            }

            $sql = "UPDATE Menu SET ";

            $comma = false;
            $b_filepath = false;
            $b_dirname = false;
            $b_rank_allowed = false;
            $b_name = false;

            if ($m->filepath != null) {
                $sql .= "filepath = :filepath";

                $comma = true;
                $b_filepath = true;
            }

            if ($m->dirname != null) {
                if ($comma) {
                    $sql .= ", ";
                }

                $sql .= "dirname = :dirname";

                $comma = true;
                $b_dirname = true;
            }

            if ($m->name != null) {
                if ($comma) {
                    $sql .= ", ";
                }

                $sql .= "name = :name";

                $comma = true;
                $b_name = true;
            }

            if ($m->rank_allowed != null) {
                if ($comma) {
                    $sql .= ", ";
                }

                $sql .= "rank_allowed = :rank_allowed";

                $comma = true;
                $b_rank_allowed = true;
            }

            if (!$comma) {
                return false;
            }

            $sql .= " WHERE filepath = :old_filepath";

            $stmt = $this->pdo->prepare($sql);

            $stmt->bindValue(":old_filepath", $filepath, PDO::PARAM_STR);
            if ($b_filepath) {
                $stmt->bindValue(":filepath", $m->filepath, PDO::PARAM_STR);
            }
            if ($b_dirname) {
                $stmt->bindValue(":dirname", $m->dirname, PDO::PARAM_STR);
            }
            if ($b_rank_allowed) {
                $stmt->bindValue(":rank_allowed", $m->rank_allowed, PDO::PARAM_INT);
            }
            if ($b_name) {
                $stmt->bindValue(":name", $m->name, PDO::PARAM_STR);
            }

            $stmt->execute();

            return true;
        }

        // ランクが一定以上のメニューのランクを $increment 分だけ増加させる(負だったら減少)
        public function ChangeRankMenu(int $morethan_or_eq, int $increment) {
            $menu_moe = $this->GetMenu_ByRank($morethan_or_eq);
            if ($menu_moe == null) {
                return false;
            }

            foreach ($menu_moe as $m) {
                $m->rank_allowed += $increment;
                if ($m->rank_allowed <= 0) {
                    $m->rank_allowed = 0;
                }
                $this->UpdateMenu($m->filepath, $m);
            }

            return true;
        }
    }
?>