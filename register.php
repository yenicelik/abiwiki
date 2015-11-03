<?php

    // First we execute our common code to connection to the database and start the session
    require_once("startup.php");
    $_SESSION['confMess'] = "";
	$_SESSION['loggedin'] = FALSE;
    
    // This if statement checks to determine whether the registration form has been submitted
    // If it has, then the registration code is run, otherwise the form is displayed
    if(!empty($_POST))
    {
        // Ensure that the user has entered a non-empty username
        if(empty($_POST['username']))
        {
            // Note that die() is generally a terrible way of handling user errors
            // like this.  It is much better to display the error with the form
            // and allow the user to correct their mistake.  However, that is an
            // exercise for you to implement yourself.
            $_SESSION['confMess'] = "Please enter a username.";
            header("Location: " . $_SESSION['lastVisited']);
            exit();
        }
        // Ensure that the user has entered a non-empty password
        if(empty($_POST['password']))
        {
        	$_SESSION['confMess'] = "Please enter a password.";
            header("Location: " . $_SESSION['lastVisited']);
            exit();
        }

        
        // Make sure the user entered a valid E-Mail address
        // filter_var is a useful PHP function for validating form input, see:
        // http://us.php.net/manual/en/function.filter-var.php
        // http://us.php.net/manual/en/filter.filters.php
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
        {
        	$_SESSION['confMess'] = "Invalid E-Mail Adress.";
            header("Location: " . $_SESSION['lastVisited']);
            exit();
        }
       
        // Now we perform the same type of check for the email address, in order
        // to ensure that it is unique.
        $query = "
            SELECT
                1
            FROM blog_users
            WHERE
                user_mail = :email
        ";


        
        $query_params = array(
            ':email' => $_POST['email']
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


        
        
        $row = $stmt->fetch();


        
        if($row)
        {
            $_SESSION['confMess'] = "This E-Mail address is already registered";
            header("Location: " . $_SESSION['lastVisited']);
            exit();
        }


        
        // An INSERT query is used to add new rows to a database table.
        // Again, we are using special tokens (technically called parameters) to
        // protect against SQL injection attacks.
        $query = "
            INSERT INTO blog_users (
                user_name,
                user_password,
                salt,
                user_mail
            ) VALUES (
                :username,
                :password,
                :salt,
                :email
            )
        ";
        


        // A salt is randomly generated here to protect again brute force attacks
        // and rainbow table attacks.  The following statement generates a hex
        // representation of an 8 byte salt.  Representing this in hex provides
        // no additional security, but makes it easier for humans to read.
        // For more information:
        // http://en.wikipedia.org/wiki/Salt_%28cryptography%29
        // http://en.wikipedia.org/wiki/Brute-force_attack
        // http://en.wikipedia.org/wiki/Rainbow_table
        $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));
        


        // This hashes the password with the salt so that it can be stored securely
        // in your database.  The output of this next statement is a 64 byte hex
        // string representing the 32 byte sha256 hash of the password.  The original
        // password cannot be recovered from the hash.  For more information:
        // http://en.wikipedia.org/wiki/Cryptographic_hash_function
        $password = hash('sha256', $_POST['password'] . $salt);
        

        // Next we hash the hash value 65536 more times.  The purpose of this is to
        // protect against brute force attacks.  Now an attacker must compute the hash 65537
        // times for each guess they make against a password, whereas if the password
        // were hashed only once the attacker would have been able to make 65537 different 
        // guesses in the same amount of time instead of only one.
        for($round = 0; $round < 65536; $round++)
        {
            $password = hash('sha256', $password . $salt);
        }
        
        // Here we prepare our tokens for insertion into the SQL query.  We do not
        // store the original password; only the hashed version of it.  We do store
        // the salt (in its plaintext form; this is not a security risk).
        $query_params = array(
            ':username' => $_POST['username'],
            ':password' => $password,
            ':salt' => $salt,
            ':email' => $_POST['email']
        );
        
        try
        {
            // Execute the query to create the user
            $stmt = $db->prepare($query);
            $result = $stmt->execute($query_params);
        }
        catch(PDOException $ex)
        {
            // Note: On a production website, you should not output $ex->getMessage().
            // It may provide an attacker with helpful information about your code.
            echo $ex; 
            $_SESSION['confMess'] = "Something went wrong! Please contact us by e-mailing contact@abiwiki.com";
            header("Location: " . $_SESSION['lastVisited']);
            exit();
        }

        $_SESSION['confMess'] = "Successfully Registered! If any problems occur, email contact@abiwiki.com";
        
        // This redirects the user back to the login page after they register
         header("Location: " . $_SESSION['lastVisited']);

        // Calling die or exit after performing a redirect using the header function
        // is critical.  The rest of your PHP script will continue to execute and
        // will be sent to the user if you do not die or exit.
        exit("Redirecting to landing Page");
    }
    