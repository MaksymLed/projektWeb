<?php
session_start();
$connect = mysqli_connect("localhost", "root", "", "projektdb");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Creative - Start Bootstrap Theme</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap Icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
    <!-- SimpleLightbox plugin CSS-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <link href="css/box.css" rel="stylesheet" />
</head>
<body id="page-top">
    <?php
    if(isset($_SESSION['username']) && $_SESSION['username']=="admin") {
    ?>
    <p class="nav-item"><a class="nav-link" >Welcome <?php echo $_SESSION['username'] ?> !</p>
    <!-- Navigation bar-->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="#page-top">Filmownia</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <div>
                    <input type="text" id="searchInput" onkeyup="searchBar()" placeholder="Search for title/catergory...">
                </div>
                <ul class="navbar-nav ms-auto my-2 my-lg-0">
                    <li class="nav-item"><a class="nav-link" href="#portfolio">Movies</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Masthead-->
    <header style="background-image:url('photos/tlo.jpg') ;" class="masthead">
        <div class="container px-4 px-lg-5 h-100">
            <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
                <div class="col-lg-8 align-self-end">
                    <h1 class="text-white font-weight-bold">Your Favorite Place for Movies</h1>
                    <hr class="divider" />
                </div>
                <div class="col-lg-8 align-self-baseline">
                    <p class="text-white-75 mb-5">Filmownia is the world's most popular and authoritative source for movies with multiple categories. Find ratings and reviews for the newest movie here!</p>
                    <a class="btn btn-primary btn-xl" href="#portfolio">Show Movies!</a>
                </div>
            </div>
        </div>
    </header>

    <section class="page-section portfolio" id="portfolio">
        <div id="container" class="container">
            <form style="margin-left: 1000px;" action="indexAdmin.php" method="post">
                <label style="color:white" for="sorter">Sort by:</label>
                <select name="sortBy">
                    <option value="release_date">Release Date</option>
                    <option value="rating">Rating</option>
                </select>
                <button type="submit" class="btn btn-primary">Sort</button>
            </form>
            <!-- Portfolio Section Heading-->
            <h1 class="page-section-heading text-center text-uppercase text-secondary mb-0">Movies</h1><br>
            <!-- Icon Divider-->
            <div class="divider-custom">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                <div class="divider-custom-line"></div>
            </div>
            <!-- Portfolio Grid Items-->

            <div class="row justify-content-center">

                <!-- Portfolio Item 1-->
                <?php
                $query = "SELECT * FROM movies ORDER BY id ASC";
                if(isset($_POST['sortBy'])){
                    if ($_POST['sortBy']=="rating") {
                        $query = "SELECT * FROM movies ORDER BY rating DESC";
                    }else if ($_POST['sortBy']=="release_date"){
                        $query = "SELECT * FROM movies ORDER BY release_date DESC";
                    }else{

                    }
                }
                $result = mysqli_query($connect, $query);
                if(mysqli_num_rows($result)>0){
                    while($row = mysqli_fetch_array($result)){

                        ?>

                        <div class="col-md-6 col-lg-4 mb-5">
                            <div class="portfolio-item mx-auto" data-bs-toggle="modal" data-bs-target="#<?php echo str_replace(' ', '', $row['title']); ?>">
                                <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                                    <h2 class="portfolio-item-caption-content text-center text-white"><?php echo $row['title']; ?><i class="fas fa-plus fa-3x"></i></h2>
                                </div>
                                <img style="float:left; width:auto; height:700px; object-fit:cover;" class="img-fluid" src="photos/<?php echo $row['image']?>" alt="..." />

                            </div>
                            <h4 style="background-color: #330000" class="portfolio-item-caption-content cat text-center text-white"><?php echo $row['category']; ?> </h4>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>
        <div style="text-align: center;  ">
        <button  class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMovie">Add Movie</button><br><br>
        <button  class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#statisticsM">View Statistics</button>
        </div>
    </section>





    <section class="page-section" id="contact">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8 col-xl-6 text-center">
                    <h2 style="color:white" class="mt-0">Leave a review!</h2>
                    <hr class="divider" />

                </div>
            </div>
            <div class="row gx-4 gx-lg-5 justify-content-center mb-5">
                <div class="col-lg-6">
                    <form action="addReview.php" method="post" id="contactForm" data-sb-form-api-token="API_TOKEN">


                            <label style="color:white" for="sorter">Pick a movie:</label>
                            <select name="forReview">

                                <?php
                                $query = "SELECT * FROM movies ORDER BY id ASC";
                                $result = mysqli_query($connect, $query);
                                if(mysqli_num_rows($result)>0){
                                    while($row = mysqli_fetch_array($result)){

                                        ?>

                                        <option value="<?php echo $row['title'];?>"><?php echo $row['title'];?></option>

                                        <?php
                                    }
                                }

                                ?>
                            </select><br><br>


                        <!-- Message input-->
                        <div class="form-floating mb-3">
                            <textarea name="newReview" class="form-control" id="message" type="text" placeholder="Enter your message here..." style="height: 10rem" data-sb-validations="required"></textarea>
                            <label for="message">Review</label>
                            <div class="invalid-feedback" data-sb-feedback="message:required">A message is required.</div>
                        </div>

                        <!-- Submit Button-->
                        <div class="d-grid"><button class="btn btn-primary" id="submitButton" type="submit">Comment</button></div>
                    </form>
                </div>
            </div>

    </section>

    <!-- Contact-->
    <section class="page-section" id="contact">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8 col-xl-6 text-center">
                    <h2 style="color:white" class="mt-0">Contact us!</h2>
                    <hr class="divider" />

                </div>
            </div>
            <div class="row gx-4 gx-lg-5 justify-content-center mb-5">
                <div class="col-lg-6">
                    <form id="contactForm" data-sb-form-api-token="API_TOKEN">
                        <!-- Name input-->
                        <div class="form-floating mb-3">
                            <input class="form-control" id="name" type="text" placeholder="Enter your name..." data-sb-validations="required" />
                            <label for="name">Full name</label>
                            <div class="invalid-feedback" data-sb-feedback="name:required">A name is required.</div>
                        </div>
                        <!-- Email address input-->
                        <div class="form-floating mb-3">
                            <input class="form-control" id="email" type="email" placeholder="name@example.com" data-sb-validations="required,email" />
                            <label for="email">Email address</label>
                            <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.</div>
                            <div class="invalid-feedback" data-sb-feedback="email:email">Email is not valid.</div>
                        </div>
                        <!-- Phone number input-->
                        <div class="form-floating mb-3">
                            <input class="form-control" id="phone" type="tel" placeholder="(123) 456-7890" data-sb-validations="required" />
                            <label for="phone">Phone number</label>
                            <div class="invalid-feedback" data-sb-feedback="phone:required">A phone number is required.</div>
                        </div>
                        <!-- Message input-->
                        <div class="form-floating mb-3">
                            <textarea class="form-control" id="message" type="text" placeholder="Enter your message here..." style="height: 10rem" data-sb-validations="required"></textarea>
                            <label for="message">Message</label>
                            <div class="invalid-feedback" data-sb-feedback="message:required">A message is required.</div>
                        </div>

                        <div class="d-none" id="submitErrorMessage"><div class="text-center text-danger mb-3">Error sending message!</div></div>
                        <!-- Submit Button-->
                        <div class="d-grid"><button class="btn btn-primary btn-xl disabled" id="submitButton" type="submit">Send Message</button></div>
                    </form>
                </div>
            </div>

    </section>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SimpleLightbox plugin JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>



    <?php
    $query = "SELECT * FROM movies ORDER BY id ASC";
    $result = mysqli_query($connect, $query);
    if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_array($result)){

    ?>


    <script src="js/functions.js"> </script>

    <!-- Movie Modal -->
    <div class="portfolio-modal modal fade" id="<?php echo str_replace(' ', '', $row['title']); ?>" tabindex="-1" aria-labelledby="portfolioModal1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header border-0"><button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button></div>
                <div class="modal-body text-center pb-5">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <form action="edit.php" method="post">


                                <input type="hidden" name="toEdit" value="<?php echo $row['title']?>">

                                <h2 id="txt<?php echo $row['title']?>" onclick="editEl(this.id)" class="portfolio-modal-title text-secondary text-uppercase mb-0"><?php echo $row['title']?></h2>
                                <input id="hid<?php echo $row['title']?>" type="hidden" name="newTitle" value="<?php echo $row['title']?>">

                                <img id="imj<?php echo $row['image']?>" onclick="editEl(this.id)" class="img-fluid rounded mb-5"   alt="..." />
                                <br>
                                    <h3 class="portfolio-modal-title text-secondary mb-0">Trailer</h3>
                                    <iframe width="560" height="315" src="<?php echo $row['trailer']?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                <br>
                                <h5>Description:</h5><h5 id="txt<?php echo $row['description']?>" onclick="editEl(this.id)"> <?php echo $row['description'] ?></h5>
                                <input id="hid<?php echo $row['description']?>" type="hidden" name="newDesc" value="<?php echo $row['description']?>">

                                Release date:<p id="txt<?php echo $row['release_date']?>" onclick="editEl(this.id)" class="mb-4"> <?php echo $row['release_date'] ?></p>
                                <input id="hid<?php echo $row['release_date']?>" type="hidden" name="newRD" value="<?php echo $row['release_date']?>">

                                Director:<p id="txt<?php echo $row['director']?>" onclick="editEl(this.id)" class="mb-4"> <?php echo $row['director'] ?></p>
                                <input id="hid<?php echo $row['director']?>" type="hidden" name="newDirector" value="<?php echo $row['director'] ?>">

                                Major actors:<p id="txt<?php echo $row['major_actors']?>" onclick="editEl(this.id)" class="mb-4"> <?php echo $row['major_actors'] ?></p>
                                <input id="hid<?php echo $row['major_actors']?>" type="hidden" name="newMA" value="<?php echo $row['major_actors']?>">

                                <h6 id="txt<?php echo $row['link']?>" onclick="editEl(this.id)"><a href="<?php echo $row['link'] ?>">TMDB link</a></h6>
                                <input id="hid<?php echo $row['link']?>" type="hidden" name="newLink" value="<?php echo $row['link']?>">

                                Rating:<p id="txt<?php echo $row['rating']?>" onclick="editEl(this.id)" class="mb-4"> <?php echo $row['rating'] ?>/100.00</p> <br>


                                <a style="color:burlywood; text-decoration: underline" data-bs-toggle="modal" data-bs-target="#<?php echo str_replace(' ', '', $row['title'])."r"; ?>">Reviews</a><br><br>
                                <button style="background-color: #0f5132" class="btn btn-primary" type="submit">Save changes</button><br><br>

                                </form>
                                <form action="delete.php" method="post"" >
                                <input name="deleteMovieId" type="hidden" value="<?php echo $row['title'] ?>">
                                <button style="background-color: #bb2d3b" type="submit" onclick="return verDelete()" class="btn btn-primary">Delete</button><br><br>
                                </form>
                                <button class="btn btn-primary" data-bs-dismiss="modal"><i class="fas fa-xmark fa-fw"></i>Close Window</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
    }
    ?>

    <?php
    $query = "SELECT * FROM movies ORDER BY id ASC";
    $result = mysqli_query($connect, $query);
    if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_array($result)){
    $revs = explode(',',  $row['review']);
    $length = count($revs);

    ?>


    <!--Reviews MODAL-->
    <div class="modal" id="<?php echo str_replace(' ', '', $row['title'])."r"; ?>" tabindex="-1" role="dialog" aria-labelledby="rew" aria-hidden= "true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header border-0"><button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button></div>
                    <div class="modal-body text-center pb-5">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <!-- Portfolio Modal - Title-->
                                    <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0">Reviews by users</h2>
                                    <!-- Icon Divider-->
                                    <div class="divider-custom">
                                        <div class="divider-custom-line"></div>
                                        <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                        <div class="divider-custom-line"></div>
                                    </div>
                                    <?php
                                    for ($i = 0; $i < $length; $i++) {
                                       ?>
                                    <div class='card card-white post'>
                                        <div class='post-heading'>
                                            <div class='float-left image'>
                                                <img src='http://bootdey.com/img/Content/user_1.jpg' class='img-circle avatar' alt='user profile image'>
                                            </div>
                                            <div class='float-left meta'>
                                                <div class='title h5'>
                                                    <a href='#'><b>Ryan Haywood</b></a>
                                                    made a post.
                                                </div>
                                                <h6 class='text-muted time'>Yesterday</h6>
                                            </div>
                                        </div>
            
                                             <div class='post-description'>
                     
                                            <p><?php echo $revs[$i]; ?></p>
                                            
                                        </div>

                                    </div>
                                        <form action="deleteReview.php" method="post"" >
                                        <input name="deleteReviewId" type="hidden" value="<?php echo $revs[$i] ?>">
                                        <button style="background-color: #bb2d3b" type="submit" onclick="return verDelete()" class="btn btn-primary">Delete</button><br><br>
                                        </form>
                                     <?php }?>
                                    <br>
                                    <button class="btn btn-primary" data-bs-dismiss="modal">
                                        <i class="fas fa-xmark fa-fw"></i>
                                        Close Window
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php

    }
    }
    ?>

    <!--STATISTICS MODAL-->
    <div class="modal" id="statisticsM" tabindex="-1" role="dialog" aria-labelledby="statisticsM" aria-hidden= "true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header border-0"><button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button></div>
                <div class="modal-body text-center pb-5">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <!-- Portfolio Modal - Title-->
                                <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0">Statistics</h2>
                                <!-- Icon Divider-->
                                <div class="divider-custom">
                                    <div class="divider-custom-line"></div>
                                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                    <div class="divider-custom-line"></div>
                                </div>
                                <?php
                                $query = "SELECT * FROM movies ORDER BY rating DESC";
                                $result = mysqli_query($connect, $query);
                                if(mysqli_num_rows($result)>0){
                                    while($row = mysqli_fetch_array($result)){

                                        ?>
                                        Top Movie: <?php echo $row['title']?><br>
                                        Best Actor: <?php $myArray = explode(',',  $row['major_actors']); echo $myArray[0]?>

                                        <?php
                                        break;
                                    }
                                }
                                ?>
                                <br>
                                <button class="btn btn-primary" data-bs-dismiss="modal">
                                    <i class="fas fa-xmark fa-fw"></i>
                                    Close Window
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--ADD MOVIE MODAL-->
    <div class="modal" id="addMovie" tabindex="-1" role="dialog" aria-labelledby="addMovie" aria-hidden= "true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div   class="modal-header border-0"><button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button></div>
                <div class="login-box">
                    <h2>Add Movie</h2>
                    <form action="insert.php" method="post">
                        <div class="user-box">
                            <input name="title" type="text" placeholder="E.g. Dr. House">
                            <label>Title</label>
                        </div>
                        <div class="user-box">
                            <input name="description" type="text" placeholder="E.g. Thor meets...">
                            <label>Description</label>
                        </div>
                        <div class="user-box">
                            <input name="image" type="file" placeholder="image">
                            <label>Image</label>
                        </div>
                        <div class="user-box">
                            <input name="category" type="text" placeholder="E.g. Action/Comedy">
                            <label>Category</label>
                        </div>
                        <div class="user-box">
                            <input name="review" type="text" placeholder="E.g. A fantastic movie...">
                            <label>Review</label>
                        </div>
                        <div class="user-box">
                            <input name="release_date" type="text" placeholder="E.g. 01-03-2009">
                            <label>Release Date</label>
                        </div>
                        <div class="user-box">
                            <input name="director" type="text" placeholder="E.g. Taika Waititi">
                            <label>Director</label>
                        </div>
                        <div class="user-box">
                            <input name="major_actors" type="text" placeholder="E.g. Brad Pitt, Chris Hemsworth">
                            <label>Major Actors</label>
                        </div>
                        <div class="user-box">
                            <input name="link" type="text" placeholder="E.g. https://www.imdb.com/title/tt0800369/">
                            <label>Link</label>
                        </div>
                        <div class="user-box">
                            <input name="trailerAdd" type="text" placeholder="E.g. https://www.youtube.com/embed/JVuq8BHIlbQ">
                            <label>Trailer</label>
                        </div>
                        <div class="user-box">
                            <input name="ratingAdd" type="text" placeholder="E.g. 5">
                            <label>Rating</label>
                        </div>
                        <button class="btn btn-primary" type="submit">Add New Movie</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
<?php
}else{
    echo "<h1>Nothing to show here</h1>";
}?>
</html>
