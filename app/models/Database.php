<?php

namespace App\Models;

class Database
{
  protected $host = 'localhost';
  protected $dbname = 'php_personal_advisor';
  protected $username = 'root';
  protected $password = '';
  protected $db;

  public function connect()
  {
    try {
      $dsn = "mysql:host={$this->host};dbname={$this->dbname}";
      $options = [
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        \PDO::ATTR_EMULATE_PREPARES => false,
      ];

      $this->db = new \PDO($dsn, $this->username, $this->password, $options);
      return $this->db;
    } catch (\PDOException $e) {
      die('Connection failed: ' . $e->getMessage());
    }
  }

  public function execute($sql, $params = [])
  {
    try {
      $stmt = $this->db->prepare($sql);
      $stmt->execute($params);
      return $stmt;
    } catch (\PDOException $e) {
      die('Query failed: ' . $e->getMessage());
    }
  }

  public function createTables()
  {
    echo 'rodando o create tables';

    $usersTable = "
        CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            password VARCHAR(255) NOT NULL,
            hash VARCHAR(255) NOT NULL
        )
    ";

    $projectsTable = "
        CREATE TABLE IF NOT EXISTS projects (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT NOT NULL,
            name VARCHAR(255) NOT NULL,
            FOREIGN KEY (user_id) REFERENCES users(id)
        )
    ";

    $tasksTable = "
        CREATE TABLE IF NOT EXISTS tasks (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT NOT NULL,
            project_id INT NOT NULL,
            name VARCHAR(255) NOT NULL,
            description TEXT,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            due_date DATETIME,
            completion_date DATETIME,
            status TINYINT NOT NULL,
            elapsed_time INT DEFAULT 0,
            recurring TINYINT NOT NULL,
            recurring_times INT,
            FOREIGN KEY (user_id) REFERENCES users(id),
            FOREIGN KEY (project_id) REFERENCES projects(id)
        )
    ";

    $this->execute($usersTable);
    $this->execute($projectsTable);
    $this->execute($tasksTable);

  }


}