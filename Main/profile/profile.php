<!DOCTYPE html>

<?php
    include '../connectionDB.php';
?>

<html>
    <head>
        <title>Profile</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- NAVBAR -->
        <link rel="stylesheet" href="../css/home_style.css">
        <!-- MODAL DIALOG -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <!-- PROFILE -->
        <link rel="stylesheet" href="profile.css">
        <!-- BOOTSTRAP -->
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.css"/>
        <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.css" />
        <script src="../bootstrap/js/bootstrap.bundle.js"></script>
        <!-- CARDS -->
        <link rel="stylesheet" href="../css/cards.css">
        <link rel="stylesheet" href="../css/recipestyle.css">
        <link rel="stylesheet" href="../css/pagefooter.css">
        <link rel="stylesheet" href="../css/rating.css">
        <link rel="stylesheet" href="../css/separator.css">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        
        
    </head>
    <body>

        <?php session_start(); 
        if($_SESSION['loggedIn'] == false) {
            header("Location: ../redirect.html");
            exit;
          }
            $query = "SELECT * FROM utenti WHERE username=$1";
            $result = pg_query_params($dbconn, $query, array($_SESSION['username']));
            while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
                $username = $line['username'];
                $email = $line['email'];
                $ricette = $line['ricette'];
                $recensioni = $line['recensioni'];
                $hasImage = $line['picture'];
                if($hasImage) {
                    $parsedUsername = str_replace(array(" ", "'"), "", $username);
                    $imagePath = "../users_pictures/" . $parsedUsername . ".jpeg";
                }
                else {
                    $imagePath = "../icons/generic_profile_picture.png";
                }
            }
        
        ?>

        <!-- MODAL DIALOG -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">About ForkMates.com</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <p>This website was created by Pietro Colaguori and Claudio Cambone for the course "Languages and Technologies for the Web" at 
                "La Sapienza" University of Rome. The purpose of the website is to enable its users to quickly and easily browse through
                various recipes, to add their own recipes and to get every day new suggestions about what to eat!
                If you want you can contact us to report a bug or make a donation!</p><br><hr>
                <label class="form-label" for="donation">Make a donation! (1$ minimum)</label>
                <input min="1" max="100" type="number" id="donation" class="form-control" /><br>
                <button type="button" class="btn btn-success">Make Donation</button><br><br>
                <label class="form-label" for="report">Report a bug!</label>
                <textarea class="form-control" id="report" rows="3"></textarea><br>
                <button type="button" class="btn btn-primary">Report</button>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
            </div>
        </div>
        <!-- END OF MODAL DIALOG SECTION -->

        <!-- NAVIGATION BAR -->
        <div class='topnav'>
            <img element id = 'logo' src='../icons/cooking.png'/> 
            <a class="active" href="../Homepage.php">ForkMates</a>
    
            <a href='../add_recipe/add_recipe.html'>Add a recipe</a>
            <a href='#'>Your Profile</a>
            <a href="#" data-toggle="modal" data-target="#myModal">Contact us</a>
            <a href='../logout.php'>Logout</a>
            <div class="search-container">
                <form action="/ricerca_ricetta.php">
                  <input type="text" placeholder="Search a Recipe!" name="search" size="50">
                  <button type="button" class='btn btn-light'>Search</button>
                </form>
              </div>
        </div>
        <!-- END OF NAVIGATION BAR SECTION -->

        <!-- PHP FUNCTIONS USED IN MODAL DIALOGS SECTION --> 
        <script>
            function changePicture() {
                alert("Hello");
            }
        </script>

        <!-- MODAL DIALOGS SECTION [AJAX IS USED CLIENT SIDE] --> 
        <div id="changePicModal" class="modal fade" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">Upload your new profile picture</div>
                    <div class="modal-body">
                        <input type="file" class="form-control" id="new_picture" name="new_picture">
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success">Change Picture</button>
                        <button class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="changeUsernameModal" class="modal fade" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">Change your Username</div>
                    <div class="modal-body">
                        <label for="new_username">New username</label>
                        <input type="text" class="form-control" id="new_username" name="new_username">
                        <label for="nnew_username">Confirm username</label>
                        <input type="text" class="form-control" id="nnew_username" name="nnew_username">
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success">Change Username</button>
                        <button class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="deleteModal" class="modal fade" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">Delete your Account</div>
                    <div class="modal-body">
                        We are sorry to see you go...
                        <label for="password">Password</label>
                        <input type="text" class="form-control" id="password" name="password">
                        <label for="nnew_username">Confirm Password</label>
                        <input type="text" class="form-control" id="ppassword" name="ppassword">
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger">Delete Account</button>
                        <button class="btn btn-info" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- END OF MODAL DIALOGS SECTION -->

        <!-- PROFILE -->
        <!-- PROFILE HEADER SECTION -->
    <div class = "row">
        <div class="profile">
            <div class="profile_image">
                <img src="<?php echo $imagePath; ?>" alt="">
            </div>
            <div class="profile_user_settings">
                <h1 class="profile_user_name"><?php echo $username ?></h1>
                <div class="dropdown btn-group" style="margin:200px" id="myMenu">
                    <button class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-bs-target="#myMenu"
                        data-bs-toggle="dropdown">Edit Profile</button>
                    <div class="dropdown-menu">
                        <button class="dropdown-item" data-bs-target="#changePicModal" data-bs-toggle="modal">
                            Change Profile Picture
                        </button>
                        <button class="dropdown-item" data-bs-target="#changeUsernameModal" data-bs-toggle="modal">
                            Change Username
                        </button>
                        <button class="dropdown-item" data-bs-target="#deleteModal" data-bs-toggle="modal">
                            Delete Account
                        </button>
                    </div>
                </div>
            </div>
            <div class="profile_stats">
                <ul>
                    <li><span class="public_email"> <?php echo $email; ?> </span></li>
                    <li><span class="n_published"><?php echo $ricette; ?> Recipes Published</span></li>
                    <li><span class="n_reviewed"><?php echo $recensioni; ?> Recipes Reviewed</span></li>
                </ul>
            </div>
        </div>
        </div>
        <!-- END OF PROFILE HEADER SECTION -->

        <!-- PROFILE BODY SECTION -->


        <!-- CARDS VISUALIZATION -->
        <div class="container">
        <div class="row">
        <?php
        $id = $_GET['param'];
        $query = "SELECT * FROM ricette WHERE utente='$id'";
        $result = pg_query_params($dbconn, $query, []);
        while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
            $title = $line["titolo"];
            $utente = $line['utente'];
            $difficulty = $line["difficulty"];
            $prep_time = $line["prep_time"];
            $people = $line["people"];
            $cooking = $line["cooking_time"];
            $hasImage = $line['image'];
            if($hasImage) {
              $parsedTitle = str_replace(array(" ", "'"), "", $title);
              $imagePath = './recipes_pictures/' . $parsedTitle . $utente . '.jpeg';
            }
            else {
              $imagePath = './icons/ricetta.jpeg';
            }
            // variabile hasImage per sapere a quale path fare riferimento TO-DO
        echo '
        <div class="col-sm-3">
            <div id="card-container">
                <div id="card-title">'.$title.'</div>
                <a href="../recipe.php?param='.$title.'">
                    <img element id ="recipe-image" src=../'.$imagePath.'>
                </a>
                <div id="details">
                    <span class="detail-value">
                        <img element id = "icon" src="../icons/chef.png"/> 
                        Difficulty: '.$difficulty.'
                    </span>
                    <span class="detail-value">
                        <img element id = "icon" src="../icons/rolling-pin.png"/> 
                        Prep Time: '.$prep_time.'
                    </span>
                    <span class="detail-value"> 
                        <img element id = "icon" src="../icons/cooking.png"/> 
                        Cooking: '.$cooking.'
                    </span>
                    <span class="detail-value">
                        <img element id = "icon" src="../icons/plate.png"/> 
                        Recipe for: '.$people.'
                    </span>
                    <span class="detail-value">
                        <div class="separator">
                            <div class="separator__content">
                            </div>
                            <div class="separator__separator">
                            </div>
                            <div class="rating">
                                <button class="rating__star">☆</button>
                                <button class="rating__star">☆</button>
                                <button class="rating__star">☆</button>
                                <button class="rating__star">☆</button>
                                <button class="rating__star">★</button>
                            </div>
                        </div>
                    </span>
                </div>  
            </div>
        </div>';
    }
    ?>
</div>
</div> 

        <!-- END OF CARDS VISUALIZATION -->
        <!-- END OF PROFILE BODY SECTION -->
        <!-- END OF PROFILE SECTION -->

    </body>

<!-- Site footer -->
<footer class="site-footer">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-6">
        <h6>About</h6>
        <p class="text-justify">ForkMates is a univeristy project were peapole can upload their own recipe, review and read other recipe. This is a FREE and NO PROFIT project, nobody earned money during the production</p>
      </div>

      <div class="col-xs-6 col-md-3">
        <h6>Used languages</h6>
        <ul class="footer-links">
          <li>HTML</li>
          <li>PHP</li>
          <li>JAVASCRIPT</li>
          <li>POSTGRESQL</li>
          <li>UX DESIGN</li>
        </ul>
      </div>

      <div class="col-xs-6 col-md-3">
        <h6>Quick links</h6>
        <ul class="footer-links">
          <li><a href="">About</a></li>
          <li><a href="">Contacts</a></li>
          <li><a href="">Contributes</a></li>
          <li><a href="">Privacy policy</a></li>
        </ul>
      </div>
    </div>
    <hr>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-sm-6 col-xs-12">
        <p class="copyright-text">Copyright &copy; 2023 All Rights Reserved by 
     <a href="#">CC</a> and <a href="#">PC </a>
        </p>
      </div>

      <div class="col-md-4 col-sm-6 col-xs-12">
        <ul class="social-icons">
          <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
          <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
          <li><a class="dribbble" href="#"><i class="fa fa-dribbble"></i></a></li>
          <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>   
        </ul>
      </div>
    </div>
  </div>
</footer>
</html>