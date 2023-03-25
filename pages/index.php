<?php

session_start();

if (isset($_SESSION["user_id"])) {
    
    $mysqli = require __DIR__ . "/../mysql/connection.php";
    
    $sql = "SELECT * FROM users
            WHERE id = {$_SESSION["user_id"]}";
            
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/index.css" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>
<body>

    <div class="top-bar">
        <h1 class="nav">
            Forum
        </h1>
        <?php if (isset($user)): ?>
            <p class="nav">Hello <?= htmlspecialchars($user["name"]) ?></p>
            <a href="profile.php" class="button-login"> profile</a>
            <a href="../mysql/logout.php" class="nav, button-login"> logout</a>
            </div>
                <div style="float: right; background-color: #4f4f25; padding:10px 20px;">
                    <!-- change the form to invisible, only display when user clicks new thread. -->
                    <form action="../mysql/newThread.php" method="POST">
                        <h5>New Post</h5>
                        <p>title</p>
                        <input type="text" name="title">
                        <p>content</p>
                        <textarea name="content" id="" cols="30" rows="10"></textarea>
                        <button for="submit"> Submit </button>
                    </form>
                </div>
            <?php else: ?>
            <a href="login.php" class="nav, button-login"> login</a>
            </div>
        <?php endif; ?>
            <div class="main">
            <form id="form" action="?" method="post"> 
                <input type="search" id="query" name="q" placeholder="Search...">
            <button>Search</button>
            </form>
            <div id="threadDiv">
                <?php
                $mysqli = require __DIR__ . "/../mysql/connection.php";
                
                $sql = "SELECT * FROM thread";
                
                $result = $mysqli->query($sql);
                $threadCount=0;
                echo "<ol>";
                if (isset($_POST["q"])){
                    while ($row = mysqli_fetch_assoc($result)) {
                        // add list item to doc
                        if ($row["title"]!=$_POST["q"]){
                            continue;
                        }
                        echo "<li class='row'>";
                        echo "<a class='title' href='thread.php?thread=".$row["id"]."'> <h4>".$row["title"]."</h4></a>";
                        echo "</li>";
                        $threadCount++;
                    }
                }
                else{
                    while ($row = mysqli_fetch_assoc($result)) {
                        // add list item to doc
                        echo "<li class='row'>";
                        echo "<a class='title' href='thread.php?thread=".$row["id"]."'> <h4>".$row["title"]."</h4></a>";
                        echo "</li>";
                        $threadCount++;
                    }
                }
                if ($threadCount==0){
                    echo "<h3> No threads related to the search found </h3>";
                }
                echo "</ol>";
                ?>
            </div>
        </div>
        <script>
            setInterval(function() {
                console.log("refreshing");
                $("#threadDiv").load(location.href + " #threadDiv");
            }, 5000);
            
        </script>
</body>
</html>