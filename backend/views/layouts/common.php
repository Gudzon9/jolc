<?php
/**
 * @var $this yii\web\View
 */
use backend\assets\BackendAsset;
use backend\models\SystemLog;
use backend\widgets\Menu;
use common\models\TimelineEvent;
use common\models\User;
use common\models\Branch;
use common\models\Division;
use yii\bootstrap\Alert;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\log\Logger;
use yii\widgets\Breadcrumbs;

$bundle = BackendAsset::register($this);
$cansuperadm = Yii::$app->user->can('superadm')
/*
                            <!-- User image -->
                            <li class="user-header light-blue">
                                <img src="<?php echo Yii::$app->user->identity->userProfile->getAvatar($this->assetManager->getAssetUrl($bundle, 'img/anonymous.jpg')) ?>"
                                     class="img-circle" alt="User Image"/>
                                <p>
                                    <?php echo Yii::$app->user->identity->username ?>
                                    <small>
                                        <?php echo Yii::t('backend', 'Member since {0, date, short}', Yii::$app->user->identity->created_at) ?>
                                    </small>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <?php echo Html::a(Yii::t('backend', 'Profile'), ['/sign-in/profile'], ['class' => 'btn btn-default btn-flat']) ?>
                                </div>
                                <div class="pull-left">
                                    <?php echo Html::a(Yii::t('backend', 'Account'), ['/sign-in/account'], ['class' => 'btn btn-default btn-flat']) ?>
                                </div>
                                <div class="pull-right">
                                    <?php echo Html::a(Yii::t('backend', 'Logout'), ['/sign-in/logout'], ['class' => 'btn btn-default btn-flat', 'data-method' => 'post']) ?>
                                </div>
                            </li>
 
 */
                            /*
                    [
                        'label' => Yii::t('backend', 'Division'),
                        'icon' => '<i class="fa fa-users"></i>',
                        'url' => ['/district/index'],
                        'visible' => Yii::$app->user->can('administrator')
                    ],


                            ['label' => Yii::t('backend', 'Text Widgets'), 'url' => ['/widget-text/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
                            ['label' => Yii::t('backend', 'Menu Widgets'), 'url' => ['/widget-menu/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
                            ['label' => Yii::t('backend', 'Carousel Widgets'), 'url' => ['/widget-carousel/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
                             
                <div class="pull-left image">
                    <img src="<?php echo Yii::$app->user->identity->userProfile->getAvatar($this->assetManager->getAssetUrl($bundle, 'img/anonymous.jpg')) ?>" class="img-circle"/>
                </div>   
                             * 
                             */

?>
<?php $this->beginContent('@backend/views/layouts/base.php'); ?>
<div class="wrapper">
    <!-- header logo: style can be found in header.less -->
    <header class="main-header">
        <a href="<?php echo Yii::$app->urlManagerFrontend->createAbsoluteUrl('/') ?>" class="logo">
            <!-- Add the class icon to your logo image or logo icon to add the margining -->
            <?php echo Yii::$app->name ?>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only"><?php echo Yii::t('backend', 'Toggle navigation') ?></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <div class="navbar-custom-menu" style="float: left; padding-left: 50px">
               
               <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                           <span>Рівень доступу :
                               <b>
                               <?php 
                                switch(Yii::$app->user->identity->level_access) {
                                    case User::LEVEL_ACCESS_ALL :
                                       echo 'Всі відділення';
                                       break;
                                    case User::LEVEL_ACCESS_BRANCH :
                                       echo Branch::findOne(Yii::$app->user->identity->branch_id)->name ;
                                       break; 
                                    case User::LEVEL_ACCESS_DIVISION :
                                       echo Division::findOne(Yii::$app->user->identity->division_id)->name." / ". Branch::findOne(Yii::$app->user->identity->branch_id)->name ;
                                       break; 
                                }
                               ?>
                               </b>    
                           </span>
                        </a>
                    <!--      <ul class="dropdown-menu" style="width: 100px">
                            
                            <li>
                                    <?php //echo Html::a(Yii::t('backend', 'Profile'), ['/sign-in/profile'], []) ?>
                            </li>
                        </ul>-->
                    </li>
                </ul>
            </div>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li id="timeline-notifications" class="notifications-menu">
                        <a href="<?php echo Url::to(['/timeline-event/index']) ?>">
                            <i class="fa fa-bell"></i>
                            <span class="label label-success">
                                    <?php echo TimelineEvent::find()->today()->count() ?>
                                </span>
                        </a>
                    </li>
                    <!-- Notifications: style can be found in dropdown.less -->
                     <?php if($cansuperadm) { ?>
                    <li id="log-dropdown" class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-warning"></i>
                            <span class="label label-danger">
                                <?php echo SystemLog::find()->count() ?>
                            </span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header"><?php echo Yii::t('backend', 'You have {num} log items', ['num' => SystemLog::find()->count()]) ?></li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    <?php foreach (SystemLog::find()->orderBy(['log_time' => SORT_DESC])->limit(5)->all() as $logEntry): ?>
                                        <li>
                                            <a href="<?php echo Yii::$app->urlManager->createUrl(['/log/view', 'id' => $logEntry->id]) ?>">
                                                <i class="fa fa-warning <?php echo $logEntry->level === Logger::LEVEL_ERROR ? 'text-red' : 'text-yellow' ?>"></i>
                                                <?php echo $logEntry->category ?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </li>
                            <li class="footer">
                                <?php echo Html::a(Yii::t('backend', 'View all'), ['/log/index']) ?>
                            </li>
                        </ul>
                    </li>
                    <?php } ?>
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span><?php echo Yii::$app->user->identity->username ?> <i class="caret"></i></span>
                        </a>
                        <ul class="dropdown-menu"  style="width: 100px">
                            <!-- User image -->
                            <!-- Menu Footer-->
                            <li>
                                    <?php echo Html::a(Yii::t('backend', 'Profile'), ['/sign-in/profile'], []) ?>
                            </li>
                            <li>
                                    <?php echo Html::a(Yii::t('backend', 'Account'), ['/sign-in/account'], []) ?>
                            </li>
                            <li>
                                    <?php echo Html::a(Yii::t('backend', 'Logout'), ['/sign-in/logout'], ['data-method' => 'post']) ?>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <?php echo ($cansuperadm) ? Html::a('<i class="fa fa-cogs"></i>', ['/site/settings']) : '' ?>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel" style="height: 65px; ">
                <div class="pull-left info" style="left: 10px">
                    <p><?php echo Yii::t('backend', 'Hello, {username}', ['username' => Yii::$app->user->identity->getPublicIdentity()]) ?></p>
                    <a href="<?php echo Url::to(['/sign-in/profile']) ?>">
                        <i class="fa fa-circle text-success"></i>
                        <?php echo Yii::$app->formatter->asDatetime(time()) ?>
                    </a>
                </div>
            </div>
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <?php echo Menu::widget([
                'options' => ['class' => 'sidebar-menu'],
                'linkTemplate' => '<a href="{url}">{icon}<span>{label}</span>{right-icon}{badge}</a>',
                'submenuTemplate' => "\n<ul class=\"treeview-menu\">\n{items}\n</ul>\n",
                'activateParents' => true,
                'items' => [
                    [
                        'label' => 'Головне',
                        'options' => ['class' => 'header']
                    ],
                    [
                        'label' => Yii::t('backend', 'Timeline'),
                        'icon' => '<i class="fa fa-bar-chart-o"></i>',
                        'url' => ['/timeline-event/index'],
                        'badge' => TimelineEvent::find()->today()->count(),
                        'badgeBgClass' => 'label-success',
                    ],
                    [
                        'label' => Yii::t('backend', 'Content'),
                        'url' => '#',
                        'icon' => '<i class="fa fa-edit"></i>',
                        'options' => ['class' => 'treeview'],
                        'visible' => $cansuperadm,
                        'items' => [
                            ['label' => Yii::t('backend', 'Static pages'), 'url' => ['/page/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
                            ['label' => Yii::t('backend', 'Articles'), 'url' => ['/article/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
                            ['label' => Yii::t('backend', 'Article Categories'), 'url' => ['/article-category/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
                        ]
                    ],
                    [
                        'label' => 'Система',
                        'options' => ['class' => 'header']
                    ],
                    [
                        'label' => 'Довідники',
                        'url' => '#',
                        'icon' => '<i class="fa fa-edit"></i>',
                        'options' => ['class' => 'treeview'],
                        'items' => [
                            ['label' => 'Теріторії', 'url' => ['/district/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>', 'visible' => $cansuperadm,],
                            ['label' => 'Відділення', 'url' => ['/branch/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>', 'visible' => $cansuperadm,],
                            ['label' => 'Підрозділи', 'url' => ['/division/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
                            ['label' => 'Робочі місця', 'url' => ['/workplace/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
                            ['label' => 'Сценарії', 'url' => ['/scenario/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
                            ['label' => 'Напрямки', 'url' => ['/direction/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
                            ['label' => 'Матеріали', 'url' => ['/material/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
                            ['label' => 'Мета', 'url' => ['/mission/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
                            ['label' => 'Персонал', 'url' => ['/user/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>', 'visible' => $cansuperadm,],
                        ]
                    ],
                    [
                        'label' => 'Документи',
                        'url' => '#',
                        'icon' => '<i class="fa fa-edit"></i>',
                        'options' => ['class' => 'treeview'],
                        'items' => [
                            ['label' => 'Направлення', 'url' => ['a/a'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
                            ['label' => 'В роботі', 'url' => ['a/a'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
                            ['label' => 'Заключення', 'url' => ['a/a'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
                            ['label' => 'Статистика', 'url' => ['a/a'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
                        ]
                    ],
                    [
                        'label' => 'Додатково',
                        'url' => '#',
                        'icon' => '<i class="fa fa-cogs"></i>',
                        'options' => ['class' => 'treeview'],
                         'visible' => $cansuperadm,
                        'items' => [
                            //['label' => Yii::t('backend', 'File Storage'), 'url' => ['/file-storage/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
                            //['label' => Yii::t('backend', 'Cache'), 'url' => ['/cache/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
                            ['label' => Yii::t('backend', 'File Manager'), 'url' => ['/file-manager/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
                            ['label' => 'Резервування', 'url' => ['/db-manager/'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
                            [
                                'label' => Yii::t('backend', 'System Information'),
                                'url' => ['/system-information/index'],
                                'icon' => '<i class="fa fa-angle-double-right"></i>'
                            ],
                            [
                                'label' => Yii::t('backend', 'Logs'),
                                'url' => ['/log/index'],
                                'icon' => '<i class="fa fa-angle-double-right"></i>',
                                'badge' => SystemLog::find()->count(),
                                'badgeBgClass' => 'label-danger',
                            ],
                        ]
                    ]
                ]
            ]) ?>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Right side column. Contains the navbar and content of the page -->
    <aside class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <?php echo $this->title ?>
                <?php if (isset($this->params['subtitle'])): ?>
                    <small><?php echo $this->params['subtitle'] ?></small>
                <?php endif; ?>
            </h1>

            <?php echo Breadcrumbs::widget([
                'tag' => 'ol',
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
        </section>

        <!-- Main content -->
        <section class="content">
            <?php if (Yii::$app->session->hasFlash('alert')): ?>
                <?php echo Alert::widget([
                    'body' => ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'body'),
                    'options' => ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'options'),
                ]) ?>
            <?php endif; ?>
            <?php echo $content ?>
        </section><!-- /.content -->
    </aside><!-- /.right-side -->
</div><!-- ./wrapper -->

<?php $this->endContent(); ?>
