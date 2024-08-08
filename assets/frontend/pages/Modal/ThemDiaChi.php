<?php
include __DIR__ .  "../../../../fontend/pages/Function.php";
$apiUrl = 'https://esgoo.net/api-tinhthanh/1/0.htm';
$dataTP = fetchDataFromAPi($apiUrl);
?>
<div id="modal_themdc" class="modal">
    <div class="modal-content">
        <span class="close" data-modal="modal2">&times;</span>
        <h2>Thêm địa chỉ</h2>
        <form action="fontend/pages/Themdc.php" method="post">
            <div class="form-groupAD">
                <label for="tinh">Tỉnh/Thành phố</label>
                <select name="tinh" id="tinh">
                    <option value="">Chọn tỉnh/thành phố</option>
                    <?php foreach ($dataTP['data'] as $tp) : ?>
                        <option value="<?php echo $tp['name']; ?>"><?php echo $tp['name']; ?></option>
                    <?php endforeach;
                    ?>

                </select>
            </div>
            <div class="form-groupAD">
                <label for="diachi">Địa chỉ</label>
                <input type="text" name="diachi" id="diachi">
            </div>
            <div class="form-groupAD">
                <button type="submit" value="ThemDC">Thêm</button>
            </div>
        </form>
    </div>
</div>