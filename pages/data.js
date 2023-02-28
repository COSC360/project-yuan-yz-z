var defaultThreads = [
    {
        id: 1,
        title: "Thread 1",
        author: "kevin",
        date: Date.now(),
        content: "Thread content",
        comments: [
            {
                author: "kevin",
                date: Date.now(),
                content: "Hello"
            },
            {
                author: "kevin",
                date: Date.now(),
                content: "Hey yuan"
            }
        ]
    },
    {
        id: 2,
        title: "Thread 2",
        author: "yuan",
        date: Date.now(),
        content: "Thread content 2",
        comments: [
            {
                author: "yuan",
                date: Date.now(),
                content: "Hello"
            },
            {
                author: "yuan",
                date: Date.now(),
                content: "Hello you"
            }
        ]
    }
]

var threads = defaultThreads
if (localStorage && localStorage.getItem('threads')) {
    threads = JSON.parse(localStorage.getItem('threads'));
} else {
    threads = defaultThreads;
    localStorage.setItem('threads', JSON.stringify(defaultThreads));
}