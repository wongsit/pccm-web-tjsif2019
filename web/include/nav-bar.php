<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">TJSIF-2019</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li><a href="homeuser.php">Home</a></li>
                <li><a href="http://tjsif2019.pccpl.ac.th/new/#/" target="_blank">New Page</a></li>
                <li><a href="user_view.php?id=<?=$user['id']?>">Profile</a></li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Informations<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="project.php">Projects</a></li>
                        <li><a href="user.php">Members</a></li>
                        <li><a href="org.php">Organization</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="logout.php?logout=true"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Log Out</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
