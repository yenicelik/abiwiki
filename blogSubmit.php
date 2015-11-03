<?php

	require_once('startup.php');

	$cat = $_SESSION['category'];
	$content = $_POST['editor1'];


	$query = "
            INSERT INTO
            	blog_entries (content, category)
            VALUES (:content, :category)
            ON DUPLICATE KEY UPDATE
            	content = :content, category = :category
        ";
        
        $query_params = array(
        	':content' => $content,
            ':category' => $cat,
            ':content' => $content,
            ':category' => $cat,
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


//Fix logical error


	header("Location: " . $_SESSION['lastVisited']);
