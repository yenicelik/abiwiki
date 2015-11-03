<ul>
                <li class="headerInfo"> <a href="index.php">
                    <span style="color:#64B4C8;">#</span><span style="color:#bf7b2c; font-size: 1.1em;">45</span> </a>
                </li>
                    <!--
                    <li> <a href="#"> Group 1 </a>
                        <ul>
                            <li> <a href="#"> German A Lit </a> </li>
                            <li> <a href="#"> English A Lit </a> </li>
                            <li> <a href="#"> German A LangLit </a> </li>
                            <li> <a href="#"> English A LangLit </a> </li>
                        </ul>
                    </li>
                    <li> <a href="#"> Group 2 </a>
                        <ul>
                            <li> <a href="#"> German B </a> </li>
                            <li> <a href="#"> English B </a> </li>
                            <li> <a href="#"> Spanish B </a> </li>
                            <li> <a href="#"> French B </a> </li>
                        </ul>
                    </li>
                    <li> <a href="#"> Group 3 </a>
                        <ul>
                            <li> <a href="#"> Business and Management </a> </li>
                            <li> <a href="#"> Economics </a> </li>
                            <li> <a href="#"> Geography </a> </li>
                            <li> <a href="#"> History </a> </li>
                        </ul>
                    </li>
                    -->
                    <li> <a href="#"> Group 4 </a>
                        <ul>
                            <li> <a href="view.php?cat=BIOLO0101"> Biology </a> </li>
                            <!--
                                <li> <a href="#"> Chemistry </a> </li>
                                <li> <a href="#"> Design Technology </a> </li>
                                <li> <a href="#"> Physics </a> </li>
                                <li> <a href="#"> Computer Science </a> </li>
                                <li> <a href="#"> Sports, Exercise and Health Science </a> </li>
                                <li> <a href="#"> Environmental systems and societies </a> </li>
                                -->
                        </ul>
                    </li>
                    <!--
                    <li> <a href="#"> Group 5 </a>
                        <ul>
                            <li> <a href="#"> Mathematics SL </a> </li>
                            <li> <a href="#"> Mathematics HL </a> </li>
                            <li> <a href="#"> Mathematics Studies </a> </li>
                            <li> <a href="#"> Computer Science </a> </li>
                        </ul>
                    </li>
                    <li> <a href="#"> Group 6 </a>
                        <ul>
                            <li> <a href="#"> Visual Arts </a> </li>
                            <li> <a href="#"> Film </a> </li>
                            <li> <a href="#"> Music </a> </li>
                            <li> <a href="#"> Theatre </a> </li>
                        </ul>
                    </li>

                    <li class="headerInfo"> <a href="index.html"> Viewing: <?php //echo " $subject" . "  >  " . "$topic" . "  >  " . "$subtopic ";  ?> </a> </li>

                    -->

                    <!-- INCLUDE REGISTERING WHEN NECESSARY
                    <li class="headerMenu"> <a href="register.php"> Register </a> </li>
                    -->
                    <?php if(!$_SESSION['loggedin']) { ?>
                    <li id="loginButton"  class="headerMenu" > <a style="cursor: pointer;" onclick="showDialog()">
                        <!-- <button id="loginLink" onclick="showDialog()"> -->
                        Login as Editor
                        <!-- </button> --> </a>
                    </li>
                    <?php
                        }
                        else {
                            ?>
                    <li id="loginButton"  class="headerMenu" > <a href="logout.php" style="cursor: pointer;" onclick="showDialog()">
                        <!-- <button id="loginLink" onclick="showDialog()"> -->
                        Logout
                        <!-- </button> --> </a>
                    </li>
                        <?php if( (strpos($_SERVER[HTTP_HOST], "view")) || (strpos($_SERVER[REQUEST_URI], "view"))) { ?>
                        <li id="loginButton"  class="headerMenu" > <a href="edit.php<?php echo "?" . $tobeedited; ?>" style="cursor: pointer;" onclick="showDialog()">
                            <!-- <button id="loginLink" onclick="showDialog()"> -->
                            Edit this Article
                            <!-- </button> --> </a>
                        </li>
                        <?php }
                        }
                    ?>
                    <!--
                    <li class="headerMenu"> <a href="memberlist.php"> Member Account </a> </li>
                    -->
                </ul>