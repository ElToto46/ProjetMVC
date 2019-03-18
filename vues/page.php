<?php
        include PATHVIEWS.'header.php';
        
        if(!empty($_SESSION['msgTxt'])) {
            include PATHVIEWS.'flash.php';
            $_SESSION['msgTxt']='';
        }
        include PATHVIEWS.$page.'.php';
        
                include PATHVIEWS.'footer.php';
                