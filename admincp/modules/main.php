<div class="main">
    <?php
        if(isset($_GET['action'])){
            $tam = $_GET['action'];
        }else{
            $tam = '';
        }
        if($tam=='Quanlidanhmuc'){
            include('modules/quanlisanpham/main.php');
        }
    ?>
</div>