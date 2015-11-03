<?php

    // First we execute our common code to connection to the database and start the session
    require_once("startup.php");
    $_SESSION['confMess'] = "";
	$_SESSION['loggedin'] = FALSE;
    
    // This variable will be used to re-display the user's username to them in the
    // login form if they fail to enter the correct password.  It is initialized here
    // to an empty value, which will be shown if the user has not submitted the form.
    $submitted_username = '';
    
    // This if statement checks to determine whether the login form has been submitted
    // If it has, then the login code is run, otherwise the form is displayed
    if(!empty($_POST))
    {
        // This query retreives the user's information from the database using
        // their username.
        $query = "
            SELECT
            	user_id
             	user_name,
                user_password,
                salt,
                user_mail
            FROM blog_users
            WHERE
                user_mail = :user_mail
        ";
        
        // The parameter values
        $query_params = array(
            ':user_mail' => $_POST['logmail']
        );
        
        try
        {
            // Execute the query against the database
            $stmt = $db->prepare($query);
            $result = $stmt->execute($query_params);
        }
        catch(PDOException $ex)
        {
            // Note: On a production website, you should not output $ex->getMessage().
            // It may provide an attacker with helpful information about your code. 
            $_SESSION['confMess'] = "Something went wrong! Please contact us by e-mailing contact@abiwiki.com";
            header("Location: " . $_SESSION['lastVisited']);
            exit();
        }
        
        // This variable tells us whether the user has successfully logged in or not.
        // We initialize it to false, assuming they have not.
        // If we determine that they have entered the right details, then we switch it to true.
       	$_SESSION['loggedin'] = FALSE;
        
        // Retrieve the user data from the database.  If $row is false, then the username
        // they entered is not registered.
        $row = $stmt->fetch();
        if($row)
        {
            // Using the password submitted by the user and the salt stored in the database,
            // we now check to see whether the passwords match by hashing the submitted password
            // and comparing it to the hashed version already stored in the database.
            $check_password = hash('sha256', $_POST['logpassword'] . $row['salt']);
            for($round = 0; $round < 65536; $round++)
            {
                $check_password = hash('sha256', $check_password . $row['salt']);
            }
            
            if($check_password === $row['user_password'])
            {
                // If they do, then we flip this to true
                $_SESSION['loggedin'] = TRUE;
            }
        }
        
        // If the user logged in successfully, then we send them to the private members-only page
        // Otherwise, we display a login failed message and show the login form again
        if($_SESSION['loggedin'])
        {
            // Here I am preparing to store the $row array into the $_SESSION by
            // removing the salt and password values from it.  Although $_SESSION is
            // stored on the server-side, there is no reason to store sensitive values
            // in it unless you have to.  Thus, it is best practice to remove these
            // sensitive values first.
            unset($row['salt']);
            unset($row['user_password']);
            
            // This stores the user's data into the session at the index 'user'.
            // We will check this index on the private members-only page to determine whether
            // or not the user is logged in.  We can also use it to retrieve
            // the user's details.
            $_SESSION['user'] = $row;
            
            // Redirect the user to the private members-only page.
            header("Location: " . $_SESSION['lastVisited']);
            die("Redirecting to landing Page");
        }
        else
        {
            // Tell the user they failed
            $_SESSION['confMess'] = "Something went wrong! Please contact us by e-mailing contact@abiwiki.com";
            header("Location: " . $_SESSION['lastVisited']);
            exit();
            // Show them their username again so all they have to do is enter a new
            // password.  The use of htmlentities prevents XSS attacks.  You should
            // always use htmlentities on user submitted values before displaying them
            // to any users (including the user that submitted them).  For more information:
            // http://en.wikipedia.org/wiki/XSS_attack
            $submitted_username = htmlentities($_POST['logmail'], ENT_QUOTES, 'UTF-8');
        }
    }
