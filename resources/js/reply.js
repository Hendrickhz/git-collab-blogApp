const replyBtns = document.querySelectorAll(".reply-btn");

replyBtns.forEach((btn) =>
    btn.addEventListener("click", function () {
        btn.nextElementSibling.classList.toggle("d-none");
    })
);
