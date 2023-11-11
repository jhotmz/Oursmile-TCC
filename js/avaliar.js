document.addEventListener("DOMContentLoaded", function (){
    const starsContainer = document.querySelector(".stars");
    const ratingValue = document.getElementById("rating-value");

    starsContainer.addEventListener("click", function (e){
        if (e.target.classList.contains("star")){
            const rating = e.target.getAttribute("data-value");
            starsContainer.setAttribute("data-rating", rating);
            updateStars(rating);
            sendRatingToServer(rating);
        }
    });
    
    function updateStars(rating){
        const stars = starsContainer.querySelectorAll(".star");
        stars.forEach((star) => {
            const value = star.getAttribute("data-value");
            star.classList.toggle("active", value <= rating);
        });

        ratingValue.textContent = `Avaliação: ${rating}`;
    }

    function sendRatingToServer(rating) {
        // Aqui você deve fazer uma requisição AJAX para enviar o valor da avaliação para o servidor PHP
        // Exemplo usando Fetch API:
        fetch("../php/avaliarClinica.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            body: `rating=${rating}`,
        })
        .then(response => response.json())
        .then(data => console.log(data))
        .catch(error => console.error("Error:", error));
    }
});