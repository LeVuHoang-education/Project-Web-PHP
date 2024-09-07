function revLoveProduct(id) {
  fetch("./assets/frontend/pages/LoveList/handlingRevLoveProdFunc.php", {
    method: "POST",
    body: JSON.stringify({
      prodID: id,
    }),
  })
    .then((response) => response.text())
    .then((text) => {
      try {
        console.log("Success");
        alert("Sản phẩm sẽ được xóa khỏi danh sách yêu thích");
        const data = JSON.parse(text);
        var trHide = document.getElementById("row-" + id);
        trHide.style.display = "none";
      } catch (e) {
        console.error("Error parsing response:", e);
        // Handle the case where the response is not valid JSON
        alert("There was an error removing the product from your wishlist.");
      }
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}
