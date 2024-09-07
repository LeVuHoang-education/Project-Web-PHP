function addNew(id) {
  const btn = document.getElementById("add-new-" + id);
  const svg = document.getElementById("love-btn-" + id);

  if (svg.style.fill != "red") {
    fetch("./assets/frontend/component/Item/handlingLoveList.php", {
      method: "POST",
      body: JSON.stringify({
        prodID: id,
      }),
    })
      .then((response) => response.text()) // Change to response.text()
      .then((text) => {
        try {
          const data = JSON.parse(text); // Attempt to parse as JSON
          console.log("Success");
          if (data == "success") {
            alert("Sản phẩm đã được thêm vào danh sách yêu thích của bạn");
            svg.style.fill = "red";
          } else if (data ==  "delete")
            alert("Sản phẩm sẽ được xóa khỏi danh sách yêu thích");
          else alert("Vui lòng đăng nhập để sử dụng tính năng này");
        } catch (error) {
          console.error("Error parsing response:", error);
          // Handle the case where the response is not valid JSON
          alert("There was an error adding the product to your wishlist.");
        }
      })
      .catch((e) => {
        console.error("Lỗi:", e);
      });
  } else {
    svg.style.fill = "black";
    fetch("./assets/frontend/component/Item/handlingLoveList.php", {
      method: "POST",
      body: JSON.stringify({
        prodID: id,
      }),
    })
      .then((response) => response.text()) // Change to response.text()
      .then((text) => {
        try {
          const data = JSON.parse(text);
          console.log("Success");
          alert("Sản phẩm đã được xóa khỏi danh sách yêu thích");
        } catch (error) {
          console.error("Error parsing response:", error);
          // Handle the case where the response is not valid JSON
          alert("There was an error removing the product from your wishlist.");
        }
      })
      .catch((e) => {
        console.error("Lỗi:", e);
      });
  }
}
