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
        <button  class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMovie">Add Movie</button>
        </div>
    </section>
    <script>



    </script>


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
                        <!-- Submit success message-->
                        <!---->
                        <!-- This is what your users will see when the form-->
                        <!-- has successfully submitted-->
                        <div class="d-none" id="submitSuccessMessage">
                            <div class="text-center mb-3">
                                <div class="fw-bolder">Form submission successful!</div>
                                To activate this form, sign up at
                                <br />
                                <a href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
                            </div>
                        </div>
                        <!-- Submit error message-->
                        <!---->
                        <!-- This is what your users will see when there is-->
                        <!-- an error submitting the form-->
                        <div class="d-none" id="submitErrorMessage"><div class="text-center text-danger mb-3">Error sending message!</div></div>
                        <!-- Submit Button-->
                        <div class="d-grid"><button class="btn btn-primary btn-xl disabled" id="submitButton" type="submit">Submit</button></div>
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

                                <img id="img<?php echo $row['image']?>" onclick="editEl(this.id)" class="img-fluid rounded mb-5" src="photos/<?php echo $row['image']?>" alt="..." />
                                <img id="slide" width="520" height="515">
                                <iframe width="420" height="315"
                                    src="https://www.youtube.com/embed/tgbNymZ7vqY">
                                </iframe>
                                <br>
                                Description:<p id="txt<?php echo $row['description']?>" onclick="editEl(this.id)" class="mb-4"> <?php echo $row['description'] ?></p>
                                <input id="hid<?php echo $row['description']?>" type="hidden" name="newDesc" value="<?php echo $row['description']?>">

                                Release date:<p id="txt<?php echo $row['release_date']?>" onclick="editEl(this.id)" class="mb-4"> <?php echo $row['release_date'] ?></p>
                                <input id="hid<?php echo $row['release_date']?>" type="hidden" name="newRD" value="<?php echo $row['release_date']?>">

                                Director:<p id="txt<?php echo $row['director']?>" onclick="editEl(this.id)" class="mb-4"> <?php echo $row['director'] ?></p>
                                <input id="hid<?php echo $row['director']?>" type="hidden" name="newDirector" value="<?php echo $row['director'] ?>">

                                Major actors:<p id="txt<?php echo $row['major_actors']?>" onclick="editEl(this.id)" class="mb-4"> <?php echo $row['major_actors'] ?></p>
                                <input id="hid<?php echo $row['major_actors']?>" type="hidden" name="newMA" value="<?php echo $row['major_actors']?>">

                                <h1 id="txt<?php echo $row['link']?>" onclick="editEl(this.id)"><a href="<?php echo $row['link'] ?>">TMDB link</a></h1>
                                <input id="hid<?php echo $row['link']?>" type="hidden" name="newLink" value="<?php echo $row['link']?>">

                                <button class="btn btn-primary" type="submit">Save changes</button>

                                </form>
                                <form action="delete.php" method="post"" >
                                <input name="deleteMovieId" type="hidden" value="<?php echo $row['title'] ?>">
                                <button type="submit" onclick="return verDelete()" class="btn btn-primary">Delete</button>
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

    <!--ADD MOVIE MODAL-->
    <div class="modal" id="addMovie" tabindex="-1" role="dialog" aria-labelledby="addMovie" aria-hidden= "true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div   class="modal-header border-0"><button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button></div>
                <div class="login-box">
                    <h2>Add Movie</h2>
                    <form action="insert.php" method="post">
                        <div class="user-box">
                            <input name="title" type="text" placeholder="title">
                            <label>Title</label>
                        </div>
                        <div class="user-box">
                            <input name="description" type="text" placeholder="description">
                            <label>Description</label>
                        </div>
                        <div class="user-box">
                            <input name="image" type="file" placeholder="image">
                            <label>Image</label>
                        </div>
                        <div class="user-box">
                            <input name="category" type="text" placeholder="category">
                            <label>Category</label>
                        </div>
                        <div class="user-box">
                            <input name="review" type="text" placeholder="review">
                            <label>Review</label>
                        </div>
                        <div class="user-box">
                            <input name="release_date" type="text" placeholder="release_date">
                            <label>Release Date</label>
                        </div>
                        <div class="user-box">
                            <input name="director" type="text" placeholder="director">
                            <label>Director</label>
                        </div>
                        <div class="user-box">
                            <input name="major_actors" type="text" placeholder="major_actors">
                            <label>Major Actors</label>
                        </div>
                        <div class="user-box">
                            <input name="link" type="text" placeholder="link">
                            <label>Link</label>
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
