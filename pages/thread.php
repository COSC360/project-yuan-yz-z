<?php
    // echo getType($_GET["thread"]);
    session_start();
    // get the thread information
    $threadId= (int) $_GET["thread"];
    $mysqli = require __DIR__ . "/../mysql/connection.php";
    $sqlThread= "SELECT * FROM thread WHERE id={$threadId}";
    $resultThread = $mysqli->query($sqlThread);
    $thread= $resultThread->fetch_assoc();
    if (isset($_SESSION["user_id"])) {
        
        $sql = "SELECT * FROM users
                WHERE id = {$_SESSION["user_id"]}";
                
        $result = $mysqli->query($sql);
        
        $user = $result->fetch_assoc();
    }

?>
<head>
    <link rel="stylesheet" href="../css/thread.css">
</head>
<body>
    <div class="top-bar">
        <h1 class="nav">
            Forum
        </h1>
    <?php if (isset($user)): ?>
        <p class="nav">Hello <?= htmlspecialchars($user["name"]) ?></p>
        <a href="profile.php" class="nav"> profile</a>
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
                echo "<p>".$thread["content"]."</p>";
                echo "<div class='bottom'> by ".$thread["authorName"] ."</div>";
                ?>
            </div>
                <?php if (isset($user)): ?>
                        <textarea></textarea>
                        <button>add comment</button>
                    
                <?php endif; ?>
                <div class="comments">
            </div>
        </div>
    <script>
        // var id = window.location.search.slice(1);
        // var thread = threads.find(t => t.id == id);
        // var header = document.querySelector('.header');
        // var headerHtml = `
        //     <h4 class="title">
        //         ${thread.title}
        //     </h4>
        //     <div class="bottom">
        //         <p class="timestamp">
        //             ${new Date(thread.date).toLocaleString()}
        //         </p>
        //         <p class="comment-count">
        //             ${thread.comments.length} comments
        //         </p>
        //     </div>
        // `
        // header.insertAdjacentHTML('beforeend', headerHtml)

        // function addComment(comment) {
        //     var commentHtml = `
        //         <div class="comment">
        //             <div class="top-comment">
        //                 <p class="user">
        //                     ${comment.author}
        //                 </p>
        //                 <p class="comment-ts">
        //                     ${new Date(comment.date).toLocaleString()}
        //                 </p>
        //             </div>
        //             <div class="comment-content">
        //                 ${comment.content}
        //             </div>
        //         </div>
        //     `
        //     comments.insertAdjacentHTML('beforeend', commentHtml);
        // }

        // var comments = document.querySelector('.comments');
        // for (let comment of thread.comments) {
        //     addComment(comment);
        // }

        // var btn = document.querySelector('button');
        // btn.addEventListener('click', function() {
        //     var txt = document.querySelector('textarea');
        //     var comment = {
        //         content: txt.value,
        //         date: Date.now(),
        //         author: 'Aaron'
        //     }
        //     addComment(comment);
        //     txt.value = '';
        //     thread.comments.push(comment);
        //     localStorage.setItem('threads', JSON.stringify(threads));
        // })
    </script>
</body>