<?php

use yii\helpers\Url;
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= Yii::$app->homeUrl; ?>" class="brand-link">
        <img src="<?=$assetDir?>/img/AdminLTELogo.png" alt="<?= Yii::$app->name; ?>" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">
            <?= Yii::$app->name; ?>
        </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?=$assetDir?>/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="<?= Url::to(['/profile']); ?>" class="d-block">
                    <?= Yii::$app->user->identity->fullName; ?>
                </a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <!-- href be escaped -->
        <!-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php

                    use common\models\User;

            echo \hail812\adminlte\widgets\Menu::widget([
                'items' => [

                    ['label' => Yii::t('app', 'MODULES_BLOCK'), 'header' => true, 'visible' => Yii::$app->user->can(User::ROLE_ADMIN) ? true : false],
                    ['label' => Yii::t('app', 'MANAGEMENT_MODULE'), 'url' => ['/management/default/index'], 'iconStyle' => 'far', 'iconClassAdded' => 'text-danger', 'visible' => Yii::$app->user->can(User::ROLE_ADMIN) ? true : false,],
                    ['label' => Yii::t('app', 'CONTENT_MODULE'), 'url' => ['/content/default/index'], 'iconStyle' => 'far', 'iconClassAdded' => 'text-warning', 'visible' => Yii::$app->user->can(User::ROLE_ADMIN) ? true : false,],
                    ['label' => Yii::t('app', 'CATALOG_MODULE'), 'url' => ['/catalog/default/index'], 'iconStyle' => 'far', 'iconClassAdded' => 'text-warning', 'visible' => Yii::$app->user->can(User::ROLE_ADMIN) ? true : false,],
                    ['label' => Yii::t('app', 'SEO_MODULE'), 'url' => ['/seo'], 'iconStyle' => 'far', 'iconClassAdded' => 'text-info', 'visible' => Yii::$app->user->can(User::ROLE_ADMIN) ? true : false,],

                    ['label' => Yii::t('app', 'DEV_BLOCK'), 'header' => true, 'visible' => Yii::$app->user->can(User::ROLE_DEV) ? true : false],
                    ['label' => 'Gii',  'icon' => 'file-code', 'url' => ['/gii'], 'target' => '_blank', 'visible' => Yii::$app->user->can(User::ROLE_DEV) ? true : false],
                    ['label' => 'Debug', 'icon' => 'bug', 'url' => ['/debug'], 'target' => '_blank', 'visible' => Yii::$app->user->can(User::ROLE_DEV) ? true : false],
                    // [
                    //     'label' => 'Starter Pages',
                    //     'icon' => 'tachometer-alt',
                    //     'badge' => '<span class="right badge badge-info">2</span>',
                    //     'items' => [
                    //         ['label' => 'Active Page', 'url' => ['site/index'], 'iconStyle' => 'far'],
                    //         ['label' => 'Inactive Page', 'iconStyle' => 'far'],
                    //     ]
                    // ],
                    // ['label' => 'Simple Link', 'icon' => 'th', 'badge' => '<span class="right badge badge-danger">New</span>'],
                    // ['label' => 'Login', 'url' => ['site/login'], 'icon' => 'sign-in-alt', 'visible' => Yii::$app->user->isGuest],
                    // ['label' => 'MULTI LEVEL EXAMPLE', 'header' => true],
                    // ['label' => 'Level1'],
                    // [
                    //     'label' => 'Level1',
                    //     'items' => [
                    //         ['label' => 'Level2', 'iconStyle' => 'far'],
                    //         [
                    //             'label' => 'Level2',
                    //             'iconStyle' => 'far',
                    //             'items' => [
                    //                 ['label' => 'Level3', 'iconStyle' => 'far', 'icon' => 'dot-circle'],
                    //                 ['label' => 'Level3', 'iconStyle' => 'far', 'icon' => 'dot-circle'],
                    //                 ['label' => 'Level3', 'iconStyle' => 'far', 'icon' => 'dot-circle']
                    //             ]
                    //         ],
                    //         ['label' => 'Level2', 'iconStyle' => 'far']
                    //     ]
                    // ],
                    // ['label' => 'Level1'],
                ],
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>