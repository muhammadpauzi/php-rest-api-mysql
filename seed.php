<?php

use App\Databases\Database;

require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// constants
require_once __DIR__ . '/app/Constants/database.php';
require_once __DIR__ . '/app/Constants/messages.php';

$db = Database::getDatabase();

try {
    $db::beginTransaction();
    $db->query("DELETE FROM users");
    $db->execute();
    generateUsers($db, 200);
    generatePosts($db, 200);
    $db::commitTransaction();
    echo "SUCCESS";
} catch (Exception $e) {
    $db::rollbackTransaction();
    die($e->getMessage());
}

function generateUsers($db, int $total = 20)
{
    $users_data = '';
    for ($i = 1; $i <= $total; $i++) {
        $users_data .= "('User $i', 'user$i', 'user$i@gmail.com')" . (($i == $total) ? "" : ",");
    }
    $query = "INSERT INTO users (name, username, email) VALUES $users_data;";
    $db->query($query);
    $db->execute();
}

function generatePosts($db, int $total = 20)
{
    $users = $db->query("SELECT * FROM users ORDER BY id ASC;")->resultArray();
    $posts_data = '';
    for ($i = 1; $i <= $total; $i++) {
        $id_user = random_int(intval($users[0]['id']), intval($users[count($users) - 1]['id']));
        $posts_data .= "('Post $i', 'Descrition of Post $i', 'Content of Post $i', $id_user)" . (($i == $total) ? "" : ",");
    }
    $query = "INSERT INTO posts (title, description, body, id_user) VALUES $posts_data;";
    $db->query($query);
    $db->execute();
}
