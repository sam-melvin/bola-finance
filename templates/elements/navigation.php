<?php
$navTrees = [
    
    [
        'title' => 'Finance',
        'link' => './',
        'page' => 'index',
        'icon' => 'fa-circle',
        'type' => USER_FINANCE
    ],
    [
        'title' => 'Pending Loader',
        'link' => 'applicants-finance.php',
        'page' => 'applicants-finance',
        'icon' => 'fa-circle',
        'type' => USER_FINANCE
    ],
    [
        'title' => 'Approved Loader',
        'link' => 'app-applicants-fin.php',
        'page' => 'app-applicants-fin',
        'icon' => 'fa-circle',
        'type' => USER_FINANCE
    ],
    [
        'title' => 'Withdraw',
        'link' => 'withdraw.php',
        'page' => 'withdraw',
        'icon' => 'fa-circle',
        'type' => USER_FINANCE
    ],
    [
        'title' => 'Admin User',
        'link' => 'admin_users.php',
        'page' => 'admin_users',
        'icon' => 'fa-circle',
        'type' => USER_ADMIN
    ],
    [
        'title' => 'Registered Bettors',
        'link' => 'bettors.php',
        'page' => 'bettors',
        'icon' => 'fa-circle',
        'type' => USER_ADMIN
    ],
    [
        'title' => 'Winning Numbers',
        'link' => 'winning_numbers.php',
        'page' => 'winning_numbers',
        'icon' => 'fa-circle',
        'type' => USER_FINANCE
    ],
    [
        'title' => 'Live Feed',
        'link' => 'live.php',
        'page' => 'live',
        'icon' => 'fa-circle',
        'type' => USER_STAFF
    ],
    [
        'title' => 'Add Winning',
        'link' => 'winning_number_form.php',
        'page' => 'addwinning',
        'icon' => 'fa-circle',
        'type' => USER_STAFF
    ],
    [
        'title' => 'Winning Numbers',
        'link' => 'winningnumbers.php',
        'page' => 'winningnumbers',
        'icon' => 'fa-circle',
        'type' => USER_STAFF
    ],
    [
        'title' => 'Loader Applicants',
        'link' => 'applicants.php',
        'page' => 'applicants',
        'icon' => 'fa-circle',
        'type' => USER_BPO
    ],
    [
        'title' => 'Monitoring',
        'link' => 'monitorprov.php',
        'page' => 'monitorprov',
        'icon' => 'fa-circle',
        'type' => USER_INVESTOR
    ],
    [
        'title' => 'Statistics',
        'link' => 'primary.php',
        'page' => 'statistics',
        'icon' => 'fa-circle',
        'type' => USER_SUPERADMIN
    ],
    [
        'title' => 'User Access Logs',
        'link' => 'useraccess-logs.php',
        'page' => 'userlogs',
        'icon' => 'fa-circle',
        'type' => USER_SUPERADMIN
    ]
   
];
?>
<!-- <style type="text/css">
      *{padding:0;margin:0;-webkit-box-sizing:border-box;box-sizing:border-box}a,dd,div,dl,dt,form,h1,h2,h3,h4,h5,h6,img,li,ol,p,span,table,td,th,ul{margin:0;border:0}img,input{border:none;vertical-align:middle}body{font-family:SF UI Text,Helvetica,Arial,"san-serif";background:#f6f7fb}
      .list{padding:50px 30px 80px}
      .list .list-item{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-orient:horizontal;-webkit-box-direction:normal;-ms-flex-direction:row;flex-direction:row;-ms-flex-wrap:wrap;flex-wrap:wrap;-webkit-box-pack:center;-ms-flex-pack:center;justify-content:center}
      .list .list-item .button{display:inline-block;padding:5px 15px;margin-bottom:10px;margin-left:16px;font-weight:400;text-align:center;vertical-align:middle;font-size:14px;line-height:1.5;color:#fff;border-radius:4px;background-color:#108ee9;cursor:pointer}
      .list .list-item .button:hover{color:#fff;background-color:#40a5ed}
      .list .list-item .button:active{color:#f2f2f2;background-color:#0f87dd}
    </style> -->


        <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="#" class="brand-link">
        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">BolaSwerte</span>
        </a>

            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="dist/img/nouser.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a class="d-block" data-toggle="modal" href="#accountsModal"><?php echo $_SESSION["fname"]; ?></a>
                        <p class="text-warning"><?php if($_SESSION[SESSION_TYPE] == 3) echo "Code: <strong>".ucwords($loggedUser->code)."</strong>"; ?></p>
                        <?php if($_SESSION[SESSION_TYPE] == 3)
                        echo '<button  type="button" class="btn btn-block btn-default btn-sm" data-toggle="modal" data-target="#modal-share">  Share Code <i class="fa-solid fa-share-from-square"></i></button>';
                        ?>

                        <!-- <div data-share="facebook" data-width="800" data-height="600" data-title="Bola Swerte" data-quote="Bola Swerte" data-description="Bola Swerte" data-hashtag="#bola" data-url="http://new.bolaswerte.com/" class="btn btn-block btn-primary btn-sm"><i class="fa-brands fa-facebook"></i></div>
                        <div data-share="messenger" data-width="800" data-height="600" data-title="Bola Swerte" data-quote="Bola Swerte" data-description="Bola Swerte" data-hashtag="#bola" data-url="http://new.bolaswerte.com/" data-redirect="http://new.bolaswerte.com/" class="btn btn-block btn-primary btn-sm"><i class="fa-brands fa-facebook-messenger"></i></div>
            
                             -->
                    </div>
                   
                </div>

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard 
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <?php
                                    foreach ($navTrees as $tree) {
                                        if($tree['type'] == $_SESSION[SESSION_TYPE]){
                                            $active = ($tree['page'] === $page) ? 'active' : '';

                                            echo '<li class="nav-item">';
                                            echo '<a href="', $tree['link'] ,'" class="nav-link ', $active, '">';
                                            echo '<i class="far ', $tree['icon'] ,' nav-icon"></i>';
                                            echo '<p>', $tree['title'], '</p>';
                                            echo '</a>';
                                            echo '</li>';
                                        }
                                        
                                    }
                                ?>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>