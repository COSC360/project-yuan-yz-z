<head>
    <link rel="stylesheet" href="../css/index.css">
</head>
<body>
    
    <?php include '../mysql/connection.php'; ?>
    <div class="top-bar">
        <h1 class="nav">
            Forum
        </h1>
        <a href="login.html" class="nav, button-login"> login</a>
        <a href="profile.html" class="button-login"> profile</a>
    </div>
    <div class="main">
        <ol>
        </ol>
        <form action="../mysql/newThread.php" method="POST">
            <p>comment</p>
            <input type="text" name="title">
            <p>content</p>
            <textarea name="content" id="" cols="30" rows="10"></textarea>
            <button for="submit"> Submit </button>
        </form>

    </div>

    <script src="data.js"></script>
    <script>
        console.log(threads);
        var container = document.querySelector('ol');
        for (let thread of threads) {
            var html = `
            <li class="row">
                <a href="thread.html?${thread.id}">
                    <h4 class="title">
                        ${thread.title}
                    </h4>
                    <div class="bottom">
                        <p class="timestamp">
                            ${new Date(thread.date).toLocaleString()}
                        </p>
                        <p class="comment-count">
                            ${thread.comments.length} comments
                        </p>
                    </div>
                </a>
            </li>
            `
            container.insertAdjacentHTML('beforeend', html);
        }
    </script>
</body>