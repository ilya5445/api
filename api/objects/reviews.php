<?
class Reviews {

    private $db;
    private $table_name = "reviews";

    public $id;
    public $user;
    public $rating;
    public $description;

    public $photo;

    public $field = 'id';
    public $sort = 'ASC';

    public function __construct($db){
        $this->db = $db;
    }

    public function readPaging($from_record_num, $records_per_page){

        $query = "SELECT
                    `id`, `user`, `rating`, `description`, `create`
                FROM
                    " . $this->table_name . "
                ORDER BY `" . $this->field . "` " . $this->sort . "
                LIMIT ?, ?";

        $stmt = $this->db->prepare( $query );

        $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
        $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt;
    }

    public function getPhoto($reviews, $count = 3) {

        $query = "SELECT 
                    `id`, `link`, `create`
            FROM
                `photo`
            WHERE `reviews` = '" . $reviews ."'
            ORDER BY `create` ASC
            LIMIT $count
            ";

        $stmt = $this->db->prepare($query);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function count() {
        $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name . "";

        $stmt = $this->db->prepare( $query );
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row['total_rows'];
    }

    public function search($keywords) {

        $query = "SELECT
                    `id`, `user`, `rating`, `description`
                FROM
                    " . $this->table_name . "
                WHERE
                    `user` LIKE ? OR `id` LIKE ?
                LIMIT 1
        ";

        $stmt = $this->db->prepare($query);

        $keywords = htmlspecialchars(strip_tags($keywords));
        $keywords = "%{$keywords}%";

        $stmt->bindParam(1, $keywords);
        $stmt->bindParam(2, $keywords);

        $stmt->execute();

        return $stmt;
    }

    public function create(){

        $query = "
            INSERT INTO " . $this->table_name . " SET user=:user, rating=:rating, description=:description
        ";

        $stmt = $this->db->prepare($query);

        $this->user = htmlspecialchars(strip_tags($this->user));
        $this->rating = htmlspecialchars(strip_tags($this->rating));
        $this->description = htmlspecialchars(strip_tags($this->description));

        $stmt->bindParam(":user", $this->user);
        $stmt->bindParam(":rating", $this->rating);
        $stmt->bindParam(":description", $this->description);

        if ($stmt->execute()) {
            $id = $this->db->lastInsertId();
            $this->createPhoto($id);

            return $id;
        }

        return false;
    }

    public function createPhoto($reviews) {

        $query = "";

        for ($i = 0; $i < count($this->photo); $i++) { 
            $query .= "INSERT INTO `photo` SET `reviews` = '" . $reviews . "', `link` = '" . $this->photo[$i] . "';";
        }

        $stmt = $this->db->prepare($query);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

}
?>