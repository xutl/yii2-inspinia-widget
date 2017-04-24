<?php
use xutl\inspinia\Nav;
use xutl\inspinia\SideBar;
use yuncms\admin\helpers\MenuHelper;
$menus = MenuHelper::getAssignedMenu(Yii::$app->user->getId());
?>
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <?= Nav::widget([
            'top' => $this->render(
                '_navigation_header.php'
            ),
            'items' => $menus
        ]) ?>
    </div>
</nav>