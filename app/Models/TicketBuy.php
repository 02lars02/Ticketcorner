<?php
  /**
   *
   */
  class TicketBuy  {
    private $db;
    public $id;
    public $createDate;
    public $name;
    public $email;
    public $phone;
    public $bonus;
    public $concert;
    public $paid;

    function __construct(string $name = '', string $email = '', string $phone = null, /*Bonus*/ $bonus = null, /*Concert*/ $concert = null) {
      $this->name = $name;
      $this->email = $email;
      $this->phone = $phone;
      $this->bonus = $bonus;
      $this->concert = $concert;
      $this->db = connectToDatabase();
    }

    private function constructSQL($sqlRow) {
      $this->id = $sqlRow['id'];
      $this->createDate = $sqlRow['createDate'];
      $this->name = $sqlRow['name'];
      $this->email = $sqlRow['email'];
      $this->phone = $sqlRow['phone'];
     // $this->bonus = new Bonus($sqlRow['fk_bonus'], $sqlRow['text'], $sqlRow['termReduction']);
      //$this->concert = new Concert($sqlRow['fk_concert'], $sqlRow['artist']);
      $this->paid = $sqlRow['paid'];
    }

    function create() {
      $statement = $this->db->prepare('INSERT INTO ticketbuys (name, email, phone, fk_bonus, fk_concert) VALUES (:name, :email, :phone, :bonusID, :concertID);' .
      'SELECT t.id, t.createDate, t.name, t.email, t.phone, t.fk_bonus, t.fk_concert, t.paid, b.text, b.termReduction, c.artist FROM `ticketbuys` t INNER JOIN `bonus` b ON b.id = t.fk_bonus INNER JOIN `concerts` c ON c.id = t.fk_concert WHERE t.id = LAST_INSERT_ID()');
      $statement->bindParam(':name', $this->name, PDO::PARAM_STR);
      $statement->bindParam(':email', $this->email, PDO::PARAM_STR);
      $statement->bindParam(':phone', $this->phone, PDO::PARAM_STR);
      $statement->bindParam(':bonusID', $this->bonus->id, PDO::PARAM_INT);
      $statement->bindParam(':concertID', $this->concert->id, PDO::PARAM_INT);

      $statement->execute();

      $this->constructSQL($statement->fetch());
    }

    function getByID(int $id) {
      $statement = $this->db->prepare('SELECT t.id, t.createDate, t.name, t.email, t.phone, t.fk_bonus, t.fk_concert, t.paid, b.text, b.termReduction, c.artist FROM `ticketbuys` t INNER JOIN `bonus` b ON b.id = t.fk_bonus INNER JOIN `concerts` c ON c.id = t.fk_concert WHERE t.id = :id');
      $statement->bindParam('id', $id, PDO::PARAM_INT);

      $statement->execute();

      $this->constructSQL($statement->fetch());
    }

    function getNotPaid() : array {
      $statement = $this->db->prepare('SELECT t.id, t.createDate, t.name, t.email, t.phone, t.fk_bonus, t.fk_concert, t.paid, b.text, b.termReduction, c.artist FROM `ticketbuys` t INNER JOIN `bonus` b ON b.id = t.fk_bonus INNER JOIN `concerts` c ON c.id = t.fk_concert WHERE t.paid = 0 ORDER BY t.createDate ASC');
      $statement->bindParam('id', $id, PDO::PARAM_INT);

      $statement->execute();

      $ticketBuys = array();

      $rows = $statement->fetchAll();
      foreach ($rows as $key => $row) {
        $ticketBuy = new TicketBuy();
        $ticketBuy->constructSQL($row);
        array_push($ticketBuys, $ticketBuy);
      }

      return $ticketBuys;
    }

    function getTerm() : int {
      return 30 - $this->bonus->termReduction;
    }

   /* function isOverdue() : boolean {
      $dateTime = new DateTime($this->createDate);
      $dateInterval = new DateInterval();
      $dateInterval->set
      return $dateTime->addD
    }*/
  }

 ?>
