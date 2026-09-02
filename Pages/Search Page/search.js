document.addEventListener("DOMContentLoaded", function () {
  const topImages = document.querySelectorAll(".popular-tops img");

  topImages.forEach((img) => {
    img.addEventListener("mouseover", () => {
      img.style.transform = "scale(1.05)";
      img.style.transition =
        "transform 0.3s ease, box-shadow 0.3s ease, border-radius 0.3s ease";
      img.style.boxShadow = "0 4px 20px rgba(0, 0, 0, 0.2)";
      img.style.borderRadius = "12px";
    });

    img.addEventListener("mouseout", () => {
      img.style.transform = "scale(1)";
      img.style.boxShadow = "none";
      img.style.borderRadius = "0";
    });
  });
});
