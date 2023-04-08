<?php
    // echo getType($_GET["thread"]);
    session_start();
    // get the thread information
    $threadId= (int) $_GET["thread"];
    $mysqli = require __DIR__ . "/../mysql/connection.php";
    $sqlThread= "SELECT * FROM thread WHERE id={$threadId}";
    $resultThread = mysqli_query($mysqli,$sqlThread);
    $thread= $resultThread->fetch_assoc();
    if (isset($_SESSION["user_id"])) {
        
        $sql = "SELECT * FROM users
                WHERE id = {$_SESSION["user_id"]}";
                
        $result = $mysqli->query($sql);
        
        $user = $result->fetch_assoc();

        $profileImage = imagecreatefromstring($user['profileImage']);

        // Get the MIME type of the profileImage
        $profileImageInfo = getimagesizefromstring($user['profileImage']);
        $profileImageType = $profileImageInfo['mime'];
    }

    $sqlComments= "SELECT * FROM comment WHERE threadId={$threadId}";
    $resultComments = mysqli_query($mysqli,$sqlComments);
    // while ($row = mysqli_fetch_assoc($result)) {
    //     // add list item to doc
    //     echo "<li class='row'>";
    //     echo "<a class='title' href='thread.php?thread=".$row["id"]."'> <h4>".$row["title"]."</h4></a>";
    //     echo "</li>";
    // }
?>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/thread.css">
    <style>
        a:hover {
        background-color: yellow;
        }
        .title{
            padding:5px;
            font-weight: bold;
        }
        .threadContent{
            padding: 5px;
        }
        .comment{
            margin: 0px 0px 0px;
        }
        .collapsible {
            background-color: #a6a69d;
            color: #444;
            cursor: pointer;
            padding:10px 0;
            width: 25%;
            border: 1px solid black;
            border-radius: 5px;
            text-align:  center;
            outline: none;
            font-size: 15px;
            }
        .active, .collapsible:hover {
            background-color: #ccc;
            }

            /* Style the collapsible content. Note: hidden by default */
        .content {
            padding: 0 18px;
            display: none;
            overflow: hidden;
            background-color: #a6a69d;
            }
        .button {
            background-color: grey; /* Green */
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 5px;
            }
        textarea {
                margin-top: 20px;
                width: 100%;
                height: 100px;
                border-radius: 3px;
                border: 3px solid #11122b;
                font-size: 1.5rem;
                font-family: inherit;
                color: inherit;
                padding: 1.5rem 2rem;
                transition: all 0.3s;
            }
    </style>
</head>
<body>
    <div class="top-bar">
        <h1 class="nav">
            Forum/Threads/<?php if (!$thread){
                    die("<h1> Error retrieving thread information</h1>");
                } echo $thread["title"]; ?>
        </h1>
    <?php if (isset($user)): ?>
        <p class="nav">Hello <?= htmlspecialchars($user["name"]) ?></p>
        <div class="nav">
            <?php
                // Output the profile image next to the username
                if (isset($profileImage)) {
                    echo '<img src="data:'.$profileImageType.';base64,'.base64_encode($user['profileImage']).'" alt="Profile Image" width="30">';
                }
                ?>
                <!-- <?= htmlspecialchars($user["name"]) ?> -->
            </p>
        </div>
        <a href="profile.php" class="nav , button-login"> profile</a>
        <a href="../mysql/logout.php" class="nav, button-login"> logout</a>
    </div>
    <?php else: ?>
        <a href="login.php" class="nav, button-login"> login</a>
    </div>
    <?php endif; ?>
        <div class="main">
            <div class="header">
            
            <?php 
                if (!$thread){
                    die("<h1> Error retrieving thread information</h1>");
                }
                echo "<h2 class='title'>".$thread["title"]."</h2>";
                echo "<p class='threadContent'>".$thread["content"]."</p>";
                echo "<button type='button' class='collapsible'>Open Comments <img class='comment' src='../comment.png'></button>";
                
                echo "<div class='content'>";
            
                // echo "<div class='bottom'> by ".$thread["authorName"] ."</div>";
                while ($row = mysqli_fetch_assoc($resultComments)) {
                    // add list item to doc
                    echo "<div class='comment'> <div class='top-comment'>";
                    echo "<p class='user'> by ".$row["authorName"]."</p></div>";
                    echo "<div class='comment-content'>".$row["content"]."</div></div>";
                }
                echo "</div>";
            ?>
            </div>
                <?php if (isset($user)): ?>
                    <form action="../mysql/newComment.php?threadId=<?php echo $threadId?>" method="POST">
                        <textarea name="comment" required></textarea>
                        <button class="button" for="submit">add comment</button>
                    </form>
                    
                <?php endif; ?>
                <div class="comments">
                </div>
            </div>
    <script>
        var coll = document.getElementsByClassName("collapsible");
        var i;

        for (i = 0; i < coll.length; i++) {
        coll[i].addEventListener("click", function() {
            this.classList.toggle("active");
            if (this.classList[1]){
                this.innerHTML= 'Close Comments';
            }
            else{
                this.innerHTML= 'Open Comments ';
                $(this).append("<img class='comment' src='../comment.png'>")
            }
            var content = this.nextElementSibling;
            if (content.style.display === "block") {
            content.style.display = "none";
            } else {
            content.style.display = "block";
            }
        });
        }
    </script>
</body>