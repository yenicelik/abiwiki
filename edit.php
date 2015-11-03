<?php 

    require_once("startup.php");

    if(!$_SESSION[loggedin]) {
        header("Location: " . $_SESSION['lastVisited']);
    }
    if(empty($_SESSION['user']))
    {
        $_SESSION['confMess'] = "Something went wrong! Please contact us by e-mailing contact@abiwiki.com";
        header("Location: " . $_SESSION['lastVisited']);
        exit();
    } 

    $_SESSION['lastVisited'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";  
               
    // USE THIS IN SUBMITTED PHP FORM
    $cat = strip_tags($_GET['cat']);                 
    $_SESSION['category'] = strip_tags($_GET['cat']);
    

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
        <link rel="stylesheet" type="text/css" href="css/mainLayout.css">
        <link rel="stylesheet" type="text/css" href="css/mainContainer.css">
        <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed' rel='stylesheet' type='text/css'>

        <script type="text/javascript" src="_text_/ckeditor/ckeditor.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <!-- jQuery Libraries -->
        <script type="text/javascript">
            $(function() {
                $( ".accordion" ).accordion({
                    collapsible: true,
                    heightStyle: "content"
                });
            });
        </script>
        <script type="text/javascript">
            confirm("Imprtant Message: Remember to Save the Data frequenlty to prevent Data Loss\nFor This, Use the the 'SAVE' ICON in the Toolbar");
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
                        //PHP Chosing Navigation File
                        switch (substr($cat, 0, 5)) {
                            case BIOLO:
                                include_once("_nav_/nav_biology.php");
                                break;
                            case PHYSI:
                                include_once("_nav_/nav_physics.php");
                                break;
                        } 
                   ?>
                </div>
            </div>

		        <div id="textEditor">
           			<div>
            			<form action="blogSubmit.php" method="POST">
                            <textarea class="ckeditor" name="editor1" id="editor1" value="php echo $_POST['editor1']; ?>">
                           		<?php 
                                    if(!empty($content)) {
                                        echo $content['content'];
                                    }
                                    else {
                                        echo "There is no text included in this. Simply edit and Save text to publish";
                                    } 
                                ?>
            			    </textarea>
                		</form>
            		</div>
		        </div> <!-- DIVISION FOR MAIN ARTICLE SITE -->
    		</div>
	    </div>
	</body> 
</html>
