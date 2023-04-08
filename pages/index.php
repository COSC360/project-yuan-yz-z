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
        background-color: yellow;
        }
        .title{
            padding:5px;
        }
        .button {
            background-color: #CA472B; /* Green */
            border: none;
            color: white;
            padding: 10px 10px;
            text-align: center;
            text-decoration: none;
            display: block;
            font-size: 16px;
            border-radius: 5px;
            }
        textarea {
            margin-top: 20px;
            width: 100%;
            height: 70px;
            border-radius: 3px;
            border: 3px solid #11122b;
            font-family: inherit;
            color: inherit;
            transition: all 0.3s;
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
                <div style="float: right; background-color: #F06446; border-radius: 10px; padding:10px 20px;">
                    <!-- change the form to invisible, only display when user clicks new thread. -->
                    <form action="../mysql/newThread.php" method="POST">
                        <h5>New Post</h5>
                        <p>title</p>
                        <input type="text" name="title">
                        <p>content</p>
                        <textarea name="content" id="" cols="30" rows="10"></textarea>
                        <button class="button" for="submit"> Submit </button>
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
                echo "<ol class='content'>";
                if (isset($_POST["q"])){
                    while ($row = mysqli_fetch_assoc($result)) {
                        // add list item to doc
                        if ($row["title"]!=$_POST["q"]){
                            continue;
                        }
                        // $sqlComment="SELECT count(threadId) FROM comment where threadId='".$row["id"]."' group by threadId";
                        // $result = mysqli_query($mysqli,$sql);
                        // print_r( $result);
                        $sqlComment="SELECT count(threadId) as num  FROM comment where threadId='".$row["id"]."'";
                        $rs = mysqli_query($mysqli,$sqlComment);
                        $yeah= mysqli_fetch_assoc($rs)['num'];
                        echo "<li class='row'>";
                        echo "<a class='title' href='thread.php?thread=".$row["id"]."'> ".$row["title"]."</a>";
                        if ($yeah>2){
                            echo "<img src='../trending.png'>";
                        }
                        if ($admin==1){
                            echo "<button class='delete' value=".$row["id"]."> Delete </button>";
                        }
                        echo "<div class='top-comment'> <p>".$row["createdAt"]."</p></div>";
                        echo "</li>";
                        $threadCount++;
                    }
                }
                else{
                    while ($row = mysqli_fetch_assoc($result)) {
                        // add list item to doc
                        //determine whether to 
                        $sqlComment="SELECT count(threadId) as num  FROM comment where threadId='".$row["id"]."'";
                        $rs = mysqli_query($mysqli,$sqlComment);
                        $yeah= mysqli_fetch_assoc($rs)['num'];
                        echo "<li class='row'>";
                        echo "<a class='title' href='thread.php?thread=".$row["id"]."'> ".$row["title"]."</a>";
                        if ($yeah>2){
                            echo "<img src='../trending.png'>";
                        }
                        if ($admin==1){
                            echo "<button class='delete' value=".$row["id"]."> Delete </button>";
                        }
                        echo "<div class='top-comment'> <p>".$row["createdAt"]."</p></div>";
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
            // setInterval(function() {
            //     console.log("refreshing");
            //     $("#threadDiv").load(location.href + " #threadDiv");
            //     addListener();
            // }, 10000);
            
            // Adding event listener to button
            addListener();
            function addListener(){
                let btn = document.querySelectorAll(".delete");
                console.log(btn);
                for (let i = 0; i < btn.length; i++) {
                    btn[i].addEventListener("click", function(){
                        let btnValue = btn[i].value;
                        console.log(btnValue);
                        // jQuery Ajax Post Request
                        $.post('../mysql/delete.php', {
                            btnValue: btnValue
                        }, (response) => {
                            alert("Thread deleted");
                            location.reload();
                        });
                    })
                    }
                // Fetching Button value
            }
            // addFire();
            function addFire(){
                $(".title").each(function(i,obj){
                    console.log(<?php echo $threadCount; ?>)
                    if(<?php echo $threadCount; ?> >=3){
                        console.log("fire")
                        $(this).append($("<img src='../trending.png'>"));
                    }
                })
                //$(".title").append($("<img src='../trending.png'>"));
            }
        </script>
</body>
</html>