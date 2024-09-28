let slideIndex = 0;

function showSlides() {
    let i;
    let slides = document.getElementsByClassName("mySlides");
    
    // Hide all slides
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    
    // Increment slideIndex and reset to 1 if it exceeds the number of slides
    slideIndex++;
    if (slideIndex > slides.length) { 
        slideIndex = 1;
    }
    
    // Show the current slide
    slides[slideIndex - 1].style.display = "block";
    
    // Call showSlides() again after 2 seconds
    setTimeout(showSlides, 2000);
}

// Initial call to showSlides() once the document is fully loaded
document.addEventListener("DOMContentLoaded", function() {
    showSlides();
});
