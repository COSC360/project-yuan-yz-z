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
<head>
    <link rel="stylesheet" href="../css/index.css">
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
                <div class="main">
                    <!-- change the form to invisible, only display when user clicks new thread. -->
                    <form action="../mysql/newThread.php" method="POST">
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
            <?php
            $mysqli = require __DIR__ . "/../mysql/connection.php";
            
            $sql = "SELECT * FROM thread";
                    
            $result = $mysqli->query($sql);

            echo "<ol>";
            while ($row = mysqli_fetch_assoc($result)) {
                // add list item to doc
                echo "<li class='row'>";
                echo "<a class='title' href='thread.php?thread=".$row["id"]."'> <h4>".$row["title"]."</h4></a>";
                echo "</li>";
            }
            echo "</ol>";
            ?>
            </div>
    <script>

        // var container = document.querySelector('ol');
        // for (let thread of threads) {
        //     var html = `
        //     <li class="row">
        //         <a href="thread.html?${thread.id}">
        //             <h4 class="title">
        //                 ${thread.title}
        //             </h4>
        //             <div class="bottom">
        //                 <p class="timestamp">
        //                     ${new Date(thread.date).toLocaleString()}
        //                 </p>
        //                 <p class="comment-count">
        //                     ${thread.comments.length} comments
        //                 </p>
        //             </div>
        //         </a>
        //     </li>
        //     `
        //     container.insertAdjacentHTML('beforeend', html);
        // }
    </script>
</body>