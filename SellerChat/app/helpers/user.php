<?php

function getUser($username, $pdo)
{
        $sql = "SELECT * FROM users WHERE name=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username]);

        if ($stmt->rowCount() === 1) {
                $user = $stmt->fetch();
                return $user;
        } else {
                $user = [];
                return $user;
        }
}