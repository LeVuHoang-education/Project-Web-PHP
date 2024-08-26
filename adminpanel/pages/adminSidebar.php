<?php 
require __DIR__ . '../../../db/connect.php';
function getName ($id) {
    global $conn;
    $sql = "SELECT * FROM account WHERE userid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}
$adminName = getName($_SESSION['admin_id']);
$data = $adminName->fetch_assoc()['username'];
?>
<div class="sidebar" id="adminSidebar">
    <div class="side-header">
        <img src="../../assets/frontend/img/logo/logo.png" width="120" height="120" alt="">
        <h5>Hello, <?php echo $data?></h5>
    </div>
    <hr>
    <a href="index.php">Dash board</a>
    <a href="index.php?act=SanPham&catid=0&page=1">Product</a>
    <a href="index.php?act=DanhMuc">Category</a>
    <a href="index.php?act=DonHang">Order</a>
    <a href="index.php?act=TaiKhoan">User</a>
</div>
