<?php
    require_once 'config.php';

    session_start();
    $displayUsername = getUsername($_SESSION['accountID']);
    
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Compulink Technologies</title>
        <!--Title icon link-->
        <link rel="shortcut icon" href="favicon.ico" />
        <!--CSS links-->
        <link href="CSS/style.css" rel="stylesheet" type="text/css"/>
        <link href="CSS/dashboard.css" rel="stylesheet" type="text/css"/>
        <link href="CSS/jquery.toast.min.css" rel="stylesheet" type="text/css"/>
        <!--JS Links-->
        <script src="Script/jquery-3.5.0.js" type="text/javascript"></script>
        <script src="Script/jquery.toast.min.js" type="text/javascript"></script>
        <script src="Script/dashboard.js" type="text/javascript"></script>
    </head>
    <body>
                
        <script>
            var username = "<?php echo $displayUsername?>";
            <?php
                if(!$_SESSION['welcome'])
                {
                    ?>
                    $.toast({
                        heading: "WELCOME",
                        text: "Welcome, " + username,
                        bgColor: "#373741",
                        textColor: "F3F3F3",
                        showHideTransition: "slide",
                        allowToastClose: false,
                        position: "bottom-center",
                        icon: "success",
                        loaderBg: "#03AAFB",
                        hideAfter: 3000
                    });
                    <?php
                    unset($_SESSION['welcome']);
                }
            ?>
                
            function info()
            {
                $.toast({
                    heading: "Information",
                    text: "This is your personalised dashboard where you can navigate to and perform specific tasks",
                    bgColor: "#03AAFB",
                    textColor: "F3F3F3",
                    showHideTransition: "slide",
                    allowToastClose: false,
                    position: {
                        bottom: 10,
                        right: 90
                    },
                    icon: "info",
                    loaderBg: "#373741",
                    hideAfter: 5000,
                    stack: false
                });
            }
        </script>
        
        <!--Checks if the postLoginWarning variable is set, indicating 
        that a non critical database error occurred during an otherwise 
        successful registration. Will only display if this is the main contact 
        for the client it is associated with-->
        <?php
            $displayToast = false;
            /*Check if the postLoginWarning session variable is set*/
            if(isset($_SESSION['postLoginWarning'])){
                /*Check if the clientID session variable is set*/
                if(isset($_SESSION['clientID'])){
                    /*Check if the clientID the warning is intended for is the 
                     * same as the one associated with the logged in contact*/
                    if($_SESSION['clientID']==$_SESSION['postLoginWarning'][0]){
                        /*Check if the logged in contact is a main contact*/
                        if(isMainContact($_SESSION['accountID'])){
                            /*The toast message should be displayed if all 
                             * the above conditions are met*/
                            $displayToast = true;
                        }                            
                    }
                }
            }
            
            /*Display the toast message if it has been determined that it should 
             * be displayed*/
            if($displayToast){?>
                <script>
                    $.toast({
                        heading: "Registration error occurred",
                        text: <?php$_SESSION['postLoginWarning'][1]?>,
                        bgColor: "#FFB347",
                        textColor: "F3F3F3",
                        showHideTransition: "slide",
                        allowToastClose: false,
                        position: "bottom-center",
                        icon: "warning",
                        loaderBg: "#414137",
                        hideAfter: 3000
                    });
                </script> <?php                    
                /*Clears the poatLoginWarning variable so that it does not 
                 * trigger a warning message without another 
                 * registration attempt*/
                unset($_SESSION['postLoginWarning']);                            
            }?>
        
        <div id="main" class="mainPage">                        
            
            <div class="dashContent">
                <?php                    
                    if(isset($_SESSION['contactID'])){
                        include './clientDash.php';
                    } else {
                        if(isset($_SESSION['technicianID'])){
                            session_abort();
                            include './jobManagement.php';
                        }
                    }
                ?>
            </div>
            
        </div>
    </body>
</html>
