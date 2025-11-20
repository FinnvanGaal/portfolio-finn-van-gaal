<?php

class User
{
    private $dbh;

    public function __construct($dbh)
    {
        $this->dbh = $dbh;
    }

    public function login($username, $password)
    {

        $stmt = $this->dbh->prepare("SELECT id, username, password_hash FROM users WHERE username = ?");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && password_verify($password, $user['password_hash'])) {
            $_SESSION['user'] = [
                'id' => $user['id'],
                'username' => $user['username']
            ];
            return true;
        }
        return false;
    }

    public function logout()
    {
        session_destroy();
        header('Location: /rea-1/PHP/26-eindopdracht-php/mijn-blog/home');
        exit;
    }

    public function lastVisit()
    {
        // Controleer cookie
        $lastVisitMessage = '';

        if (isset($_COOKIE['last_visit'])) {
            $lastVisitMessage = "Je was hier voor het laatst op: " . $_COOKIE['last_visit'];
        } else {
            $lastVisitMessage = "Welkom op je eerste bezoek aan de blog!";
        }

        // Stel cookie opnieuw in (30 dagen geldig)
        $now = date('d-m-Y H:i:s');
        setcookie('last_visit', $now, time() + (60 * 60 * 24 * 30), "/");
        return $lastVisitMessage;
    }

    public function isLoggedIn()
    {
        return isset($_SESSION['user']);
    }

    public function checkGuest()
    {
        if (!isset($_SESSION['guest_username'])) {
            $_SESSION['guest_username'] = 'gebruiker_' . rand(1000, 9999);
            $_SESSION['guest_ip'] = $_SERVER['REMOTE_ADDR'] ?? '';

        }
        $guestName = $_SESSION['guest_username'];
        $guestIp   = $_SESSION['guest_ip'];

        $query = "SELECT id FROM guests WHERE name = ? AND ip = ? LIMIT 1";
        $stmt  = $this->dbh->prepare($query);
        $stmt->bind_param('ss', $guestName, $guestIp);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {

            $query = "INSERT INTO guests (name, ip, created_at) VALUES (?, ?, NOW())";
            $stmt  = $this->dbh->prepare($query);
            $stmt->bind_param('ss', $guestName, $guestIp);
            $stmt->execute();
        }

        $stmt = $this->dbh->prepare("SELECT id FROM guests WHERE ip = ? AND name = ?");
        $stmt->bind_param('ss', $_SESSION['guest_ip'], $_SESSION['guest_username']);
        $stmt->execute();
        $result = $stmt->get_result();
        $guest = $result->fetch_assoc();
        $_SESSION['guest_id'] = $guest['id'];
    }

    public function usernameExists(string $username): bool
    {
        $stmt = $this->dbh->prepare("SELECT 1 FROM users WHERE username = ? LIMIT 1");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        return (bool)$stmt->get_result()->fetch_row();
    }

    public function emailExists(string $email): bool
    {
        $stmt = $this->dbh->prepare("SELECT 1 FROM users WHERE email = ? LIMIT 1");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        return (bool)$stmt->get_result()->fetch_row();
    }

    public function register(string $username, string $email, string $password): bool
    {
        if ($this->usernameExists($username)) {
            return false;
        }
        if ($this->emailExists($email)) {
            return false;
        }

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->dbh->prepare(
            "INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)"
        );
        $stmt->bind_param('sss', $username, $email, $passwordHash);
        return $stmt->execute();
    }
}
