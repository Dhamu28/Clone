<?php 
require_once('include/db.php');
require_once('config.php');
require_once('top.php');

try {
// Student table 
    $db->Q("CREATE TABLE IF NOT EXISTS student(
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT NOT NULL DEFAULT '',
        phone TEXT NOT NULL,
        pass TEXT NOT NULL,
        email TEXT NOT NULL DEFAULT '',
        active INTEGER NOT NULL DEFAULT 0,
        seat_num TEXT NOT NULL DEFAULT 0,
        img TEXT NOT NULL DEFAULT '',
        rate INTEGER NOT NULL DEFAULT 0,
        payment_in INTEGER NOT NULL,
        toj TIMESTAMP,
        tol TIMESTAMP,
        dom TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );");


    } catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
