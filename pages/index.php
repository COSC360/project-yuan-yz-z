<?php

session_start();

if (isset($_SESSION["user_id"])) {
    
    $mysqli = require __DIR__ . "/../mysql/connection.php";
    
    // $sql = "SELECT * FROM users
    //         WHERE id = {$_SESSION["user_id"]}";
    $sql = "SELECT *, HEX(profileImage) as profileImage FROM users
    WHERE id = {$_SESSION["user_id"]}";

            
    $result = mysqli_query($mysqli,$sql);
    
    $user = $result->fetch_assoc();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/index.css" type="text/css">
    <style>
        a:hover {
<<<<<<< Updated upstream
        background-color: green;
=======
        background-color: yellow;
>>>>>>> Stashed changes
        }
        .title{
            padding:5px;
        }
</style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>
<body>

    <div class="top-bar">
        <h1 class="nav">
            Forum/Threads
        </h1>
        <?php if (isset($user)): ?>
            <p class="nav">Hello <?= htmlspecialchars($user["name"]) ?></p>
            <div class="nav">
                <img src="data:image/jpeg;base64,<?= base64_encode(hex2bin($user['profileImage'])) ?>" alt="Profile Image"  width="30">
            </div>

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
                
                $result = mysqli_query($mysqli,$sql);
                $threadCount=0;
                $admin=0;
                if (isset($user)){
                    $admin= $user["admin"];
                }
                echo "<ol>";
                if (isset($_POST["q"])){
                    while ($row = mysqli_fetch_assoc($result)) {
                        // add list item to doc
                        if ($row["title"]!=$_POST["q"]){
                            continue;
                        }
                        echo "<li class='row'>";
                        echo "<a class='title' href='thread.php?thread=".$row["id"]."'>" .$row["title"]."</a>";
                        echo "<div class='comment'> <p> created at:".$row["createAt"]."</p></div>";
                        echo "</li>";
                        $threadCount++;
                    }
                }
                else{
                    while ($row = mysqli_fetch_assoc($result)) {
                        // add list item to doc
                        echo "<li class='row, title'>";
                        echo "<a class='title' href='thread.php?thread=".$row["id"]."'> ".$row["title"]."</a>";
                        if ($admin==1){
                            echo "<button id='btn' value=".$user["id"]."> Delete </button>";
                        }
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
            let btn = document.getElementById("btn");
 
            // Adding event listener to button
            btn.addEventListener("click", () => {
            
                // Fetching Button value
                let btnValue = btn.value;
                
                // jQuery Ajax Post Request
                $.post('../mysql/delete.php', {
                    btnValue: btnValue
                }, (response) => {
<<<<<<< Updated upstream
                    alert("Thread deleted");
=======
                    // response from PHP back-end
                    console.log(response);
>>>>>>> Stashed changes
                });
            });
        </script>
</body>
</html>