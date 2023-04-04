var Post = document.getElementById("post");

Post.addEventListener("onmouseover", function () {
    Post.style.width = "250px";
    Post.style.height = "350px";
})

Post.addEventListener("onmouseout", function () {
    Post.style.width = "200px";
    Post.style.height = "300px";
})