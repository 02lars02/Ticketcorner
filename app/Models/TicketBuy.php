<?php
  require 'app/Models/Bonus.php';
  require 'app/Models/Concert.php';
  /**
   *
   */
  class TicketBuy  {
    public $id;
    public $createDate;
    public $name;
    public $email;
    public $phone;
    public $bonus;
    public $concert;
    public $paid;

    function __construct(string $name = '', string $email = '', string $phone = null, Bonus $bonus = null, Concert $concert = null) {
      $this->name = $name;
      $this->email = $email;
      $this->phone = $phone;
      $this->bonus = $bonus;
      $this->concert = $concert;
    }

    private function constructSQL($sqlRow) {
      $this->id = $sqlRow['id'];
      $this->createDate = new DateTime($sqlRow['createDate']);
      $this->name = $sqlRow['name'];
      $this->email = $sqlRow['email'];
      $this->phone = $sqlRow['phone'];
      $this->bonus = new Bonus($sqlRow['fk_bonus'], $sqlRow['text'], $sqlRow['termReduction']);
      $this->concert = new Concert($sqlRow['fk_concert'], $sqlRow['artist']);
      $this->paid = $sqlRow['paid'];
    }

    function create() {
      $statement = connectToDatabase()->prepare('INSERT INTO ticketbuys (name, email, phone, fk_bonus, fk_concert) VALUES (:name, :email, :phone, :bonusID, :concertID);' .
      'SELECT t.id, t.createDate, t.name, t.email, t.phone, t.fk_bonus, t.fk_concert, t.paid, b.text, b.termReduction, c.artist FROM `ticketbuys` t INNER JOIN `bonus` b ON b.id = t.fk_bonus INNER JOIN `concerts` c ON c.id = t.fk_concert WHERE t.id = LAST_INSERT_ID()');
      $statement->bindParam(':name', $this->name, PDO::PARAM_STR);
      $statement->bindParam(':email', $this->email, PDO::PARAM_STR);
      $statement->bindParam(':phone', $this->phone, PDO::PARAM_STR);
      $statement->bindParam(':bonusID', $this->bonus->id, PDO::PARAM_INT);
      $statement->bindParam(':concertID', $this->concert->id, PDO::PARAM_INT);

      $statement->execute();
    }

    function update() {
      $statement = connectToDatabase()->prepare('UPDATE `ticketbuys` SET `name`=(:name),`email`=(:email),`phone`=(:phone),`fk_bonus`=(:bonusID),`fk_concert`=(:concertID),`paid`=(:paid) WHERE id = (:id)');

      $statement->bindParam(':id', $this->id, PDO::PARAM_INT);
      $statement->bindParam(':name', $this->name, PDO::PARAM_STR);
      $statement->bindParam(':email', $this->email, PDO::PARAM_STR);
      $statement->bindParam(':phone', $this->phone, PDO::PARAM_STR);
      $statement->bindParam(':bonusID', $this->bonus->id, PDO::PARAM_INT);
      $statement->bindParam(':concertID', $this->concert->id, PDO::PARAM_INT);
      $statement->bindParam(':paid', $this->paid, PDO::PARAM_INT);

      $statement->execute();

      $this->constructSQL($statement->fetch());
    }

    static function getByID(int $id) : TicketBuy{
      $statement = connectToDatabase()->prepare('SELECT t.id, t.createDate, t.name, t.email, t.phone, t.fk_bonus, t.fk_concert, t.paid, b.text, b.termReduction, c.artist FROM `ticketbuys` t INNER JOIN `bonus` b ON b.id = t.fk_bonus INNER JOIN `concerts` c ON c.id = t.fk_concert WHERE t.id = :id');
      $statement->bindParam('id', $id, PDO::PARAM_INT);

      $statement->execute();

      $ticketBuy = new TicketBuy();

      $ticketBuy->constructSQL($statement->fetch());

      return $ticketBuy;
    }

    static function getNotPaid() : array {
      $statement = connectToDatabase()->prepare('SELECT t.id, t.createDate, t.name, t.email, t.phone, t.fk_bonus, t.fk_concert, t.paid, b.text, b.termReduction, c.artist FROM `ticketbuys` t INNER JOIN `bonus` b ON b.id = t.fk_bonus INNER JOIN `concerts` c ON c.id = t.fk_concert WHERE t.paid = 0 ORDER BY (DATE_ADD(t.createDate, INTERVAL (30 - b.termReduction) DAY)) ASC');
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

    private function getTerm() : int {
      return 30 - $this->bonus->termReduction;
    }

    function getTermDate() : DateTime {
      $dateInterval = new DateInterval('P' . $this->getTerm() . 'D');
      return $this->createDate->add($dateInterval);
    }

    function isOverdue() : bool {
      $termDate = $this->getTermDate();

      $interval = $termDate->diff(new DateTime());

      return $interval->invert == 0;
    }
  }

 ?>
