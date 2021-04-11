<?php

use Model\Tweet;

require_once "./bootstrap.php";

$roodDir = '/sprint3.v2';

// Login
session_start();
if (
    isset($_POST['login'])
    && !empty($_POST['username'])
    && !empty($_POST['password'])
) {
    if (
        $_POST['username'] === 'admin' &&
        $_POST['password'] === '1234'
    ) {
        $_SESSION['logged_in'] = true;
        $_SESSION['timeout'] = time();
        $_SESSION['username'] = $_POST['username'];
    } else {
        print('<script type="text/javascript">alert("Wrong username or password.");</script>');
    }
}

// Logout
if (isset($_GET['action']) == 'logout') {
    session_start();
    unset($_SESSION['username']);
    unset($_SESSION['password']);
    unset($_SESSION['logged_in']);
    session_destroy();
    print('<script type="text/javascript">alert("You have been logged out successfully.");</script>');
    header('Location:' . $roodDir . '/admin');
}

// Delete tweet logic
if (isset($_POST['delete'])) {
    $id = $_POST['delete'];
    $update = $entityManager->find('Model\Tweet', $id);
    $entityManager->remove($update);
    $entityManager->flush();
    header('Location:' . $roodDir . '/admin');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin page</title>
    <link rel="stylesheet" href="./src/style.css">
</head>

<body>
    <div class="container">
        <?php

        if (!$_SESSION['logged_in']) {
            print('<div align="center"><h4>Enter your login information</h4>
                   <form class="loginform" action="" method="post">
                        <input type="text" name="username" placeholder="username = admin" required><br>
                        <input type="password" name="password" placeholder="password = 1234" required><br>
                        <button class="login-btn" type="submit" name="login">Login</button>
                   </form></div>');
        } else {
            print('<header class=adminNav><nav>
                <ul> | <a href="./admin">Admin</a> || <a href="./">View Page</a></li> || <a href=?action=logout>Logout</a> |
                </ul>
            </nav></header>');
            print('<table class=tableelement>
            <tr>
                <th class=tableelement>Page</th>
                <th class=tableelement>Actions</th>
            </tr>');

            $tweets = $entityManager->getRepository("Model\Tweet")->findAll();

            foreach ($tweets as $tweet) {

                print('<tr>
                       <td class=tableelement>' . $tweet->getUserName() . '</td>');

                $tweet->getId() === 1 ?
                    print('<td class=tableelement>
                        <form action="" method="POST">
                            <input type="hidden" name="currentUsername" value="' . $tweet->getUserName() . '" />
                            <input type="hidden" name="currentContent" value="' . $tweet->getContent() . '" />
                            <input type="hidden" name="currentId" value="' . $tweet->getId() . '" />
                            <button type="submit" name="editTweet" value="">Edit</button>
                        </form>
                        </td>
                    </tr>') :
                    print('<td class=tableelement>
                            <form action="" method="POST">
                                <input type="hidden" name="currentUsername" value="' . $tweet->getUserName() . '" />
                                <input type="hidden" name="currentContent" value="' . $tweet->getContent() . '" />
                                <input type="hidden" name="currentId" value="' . $tweet->getId() . '" />
                                <button type="submit" name="editTweet" value="">Edit</button>
                            </form>        
                            <form action="" method="POST">
                                <button type="submit" name="delete" value="' . $tweet->getId() . '" onclick="return confirm(\'Are you sure?\')">Delete</button>
                            </form>
                       </td>
                </tr>');
            }
            print('</table>');

            print('<form class="new-tweet" action="" method="POST">
                    <button type="submit" name="addTweet">Add new tweet</button>
                </form>');

            //Add new tweet

            if (isset($_POST['addTweet'])) {
                print('<form class="page_mod" action="" method="POST">
                        <label for="userName">Username</label><br>
                        <input type="text" name="newUsername"><br>
                        <label for="content">New Content</label><br>
                        <textarea name="newContent" cols="50" rows="10"></textarea><br>
                        <button type="submit" name="addContent">Create Tweet</button>
                   </form>');
            }
            if (isset($_POST['addContent'])) {
                $newName = $_POST['newUsername'];
                $content = $_POST['newContent'];
                if (!empty($newName)) {
                    $newTweet = new Tweet();
                    $newTweet->setUserName($newName);
                    $newTweet->setContent($content);
                    $entityManager->persist($newLink);
                    $entityManager->flush();
                    header('Location:' . $roodDir . '/admin');
                }
            }

            // Update tweet

            if (isset($_POST['editTweet'])) {
                print('<form class="TweetUpdate" action="" method="POST">
                        <input type="hidden" name="currentId" value="' . $_POST['currentId'] . '">
                        <label for="Username">Username</label><br>
                        <input type="text" name="EditUsername" value="' . $_POST['currentUsername'] . '"><br>
                        <label for="content">Tweet Content</label><br>
                        <textarea name="EditContent" cols="50" rows="10">' . $_POST['currentContent'] . '</textarea><br>
                        <button type="submit" name="updateTweet">Update Tweet</button>
                   </form>');
            }
            if (isset($_POST['updateTweet'])) {
                $id = $_POST['currentId'];
                $UpUsername = $_POST['EditUsername'];
                $UpContent = $_POST['EditContent'];
                if (!empty($title)) {
                    $update = $entityManager->find('Model\Tweet', $id);
                    $update->setLinkName($UpUsername);
                    $update->setLinkContent($UpContent);
                    $entityManager->persist($update);
                    $entityManager->flush();
                    header('Location:' . $roodDir . '/admin');
                }
            }
        }

        ?>
    </div>
</body>

</html>