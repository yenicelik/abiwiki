<?php
    require_once("startup.php");
    $_SESSION['lastVisited'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";  
                     
    $cat = strip_tags($_GET['cat']);
    $tobeedited = $_SERVER['QUERY_STRING'];


    $query = "
            SELECT
                content
            FROM blog_entries
            WHERE
                category = :category
        ";
        
        $query_params = array(
            ':category' => $cat
        );


        try
        {
            $stmt = $db->prepare($query);
            $result = $stmt->execute($query_params);
        }
        catch(PDOException $ex)
        {
            $_SESSION['confMess'] = "Something went wrong! Please contact us by e-mailing contact@abiwiki.com";
            header("Location: " . $_SESSION['lastVisited']);
            exit();
        }

        $content = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title> #45 </title>
        <link rel="stylesheet" type="text/css" href="css/header.css">
        <link rel="stylesheet" type="text/css" href="css/index.css">
        <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="css/mainContainer.css">

        <script type="text/javascript" src="_text_/ckeditor/ckeditor.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
        <!-- jQuery Libraries -->
        <script type="text/javascript">
            $(function() {
                $( ".accordion" ).accordion({
                    collapsible: true,
                    heightStyle: "content",
                });
            });
        </script>
        <!-- SCRIPT FOR POP UP LOGIN AND REGISTER BOXES -->
        <script  type="text/javascript">
            function dlgLogin() {
                var whitebg = document.getElementById('white-background');
                var dlg = document.getElementById('dlgbox');
                whitebg.style.display = "none";
                dlg.style.display = "none";
            }
            function showDialog() {
                var whitebg = document.getElementById('white-background');
                var dlg = document.getElementById('dlgbox');
                whitebg.style.display = "block";
                dlg.style.display = "block";
                var winWidth = window.innerWidth;
                var winHeight = window.innerHeight;
                dlg.style.left = (winWidth/2) - 480/2 +"px";
                dlg.style.top = "150px";
            }
        </script>

        <?php
            if($_SESSION['confMess'] != "") {
        ?>
                <script>
                    var confMess = "<?php 
                                        echo $_SESSION['confMess']; 
                                        $_SESSION['confMess'] = "";
                                        ?>";
                    confirm("Message: " + confMess);
                </script>
        <?php
            }
        ?>

        <script type="text/javascript">
        CKEDITOR.replace( 'editor1', {toolbarStartupExpanded : false} );
        </script>
            
    </head>
    <body>   
        <header id="nav">
            <nav id="nav_wrapper">
                <?php include_once("horheader.php"); ?>
            </nav>
        </header>
        <!-- MAIN CONTAINER BEGINS FROM HERE ON -->
        <div id="mainContainer">
            <div id="navigationBar">
            <!-- 
                <div class="navigationHeader"> <a> General Tips </a> </div>
                <div class="navigationComp">
                    <ul>
                        <li> <a href="#"> How to Learn the most in a given (chosen) timespan</a> </li>
                        <li> <a href="#"> About Us</a> </li>
                    </ul>
                </div>
            </div>
            <div></div>
            -->
                <div  class="accordion">
                    <?php
                        //include_once("_nav_/nav_biology.php");
                        //PHP Chosing Navigation File
                        switch(TRUE) {
                            case stristr($cat, 'BIOLO'):
                                include_once("_nav_/nav_biology.php");
                                break;
                            case stristr($cat, 'PHYSI'):
                                include_once("_nav_/nav_physics.php");
                                break;
                        } 
                   ?>
                </div>
            </div>
        
            <div id="textEditor"> 
                <div>
                      <textarea class="ckeditor" name="editor1" id="editor1">
                      		<?php 
                                
                                if(!empty($content)) {
                                    echo $content['content'];
                                }
                                else {
                                    echo "There is no text included in this. Simply edit and Save text to publish";
                                } 
                                
                            ?>
         			    </textarea>
                </div> <!-- DIVISION FOR MAIN ARTICLE SITE -->
            </div> 
        </div>

   <!-- ********** MAIN CONTAINER ENDS HERE ********* -->
    <!-- DIALOG BOX -->
        <?php if (!$_SESSION['loggedin']) { ?>
                <div id="white-background"> </div>
                <div id="dlgbox"> 
                    <div id="dlg-header"> Login to edit locked Articles </div>
                    <div id="dlg-body">
                        <div class="loginForm"> 
                            <span style="font-size: 1.4em;"> Login </span> 
                            <br />
                            <br />
                            <form action="login.php" method="post"> 
                                Registered E-Mail:
                                <br /> 
                                <input type="text" name="logmail" value="" /> 
                                <br />
                                <br /> 
                                Password:
                                <br /> 
                                <input type="password" name="logpassword" value="" /> 
                                <br />
                                <br /> 
                                <input type="submit" class="submitBut" value="Login" /> 
                            </form> 
                        </div>
                        <div class="loginForm"> 
                            <span style="font-size: 1.4em;"> Register </span> 
                            <br />
                            <br />
                            <form action="register.php" method="post"> 
                                Full Name:
                                <br /> 
                                <input type="text" name="username" value="" /> 
                                <br />
                                <br />
                                E-Mail:
                                <br /> 
                                <input type="text" name="email" value="" /> 
                                <br />
                                <br />
                                Password:
                                <br /> 
                                <input type="password" name="password" value="" /> 
                                <br />
                                <br />
                                <input type="submit" class="submitBut" value="Register" />
                            </form>
                        </div>
                    </div>
                    <div id="dlg-footer">
                        <button onclick="dlgLogin()"> Cancel </button>
                    </div>
                </div>
        <?php } ?>
        <!-- DIALOG BOX -->
    </body>
</html>