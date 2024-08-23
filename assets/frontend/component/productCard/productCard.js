function showMoreProducts() {
  // Gọi lại hàm show_more từ PHP
  fetch("your_url_to_fetch_more_products")
    .then((response) => response.json())
    .then((data) => {
      // Hiển thị thêm các sản phẩm
      show_more(data);
    })
    .catch((error) => {
      console.error("Error fetching more products:", error);
    });
}
