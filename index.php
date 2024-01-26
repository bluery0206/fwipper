<?php
include 'includes/isLoggedIn.inc.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <title>Twitter. It's what's happening / X</title>
</head>

<body>
    <main class="container-fluid">
        <div class="row" style="height: 100vh;">
            <div class="col d-flex justify-content-center align-items-center">
                <img src="Twitter-X-Logo-White.png" alt="" style="width: 250px;">
            </div>
            <div class="col d-flex flex-column justify-content-center align-items-center">
                <h1 class="lato_black">Happening now</h1>
                <div class="col-6 d-flex flex-column text-center gap">
                    <h3 class="lato_black">Join today</h3>
                    <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#signup">Create account</button>
                    <small class="text-muted text-decoration-none">By signing up, you agree to the <a class="text-decoration-none " href="">Terms of Services</a> and <a class="text-decoration-none" href="">Privacy</a>, including <a class="text-decoration-none" href="">Cookie Use</a>.</small>
                    <hr>
                    <h6>Already have an account?</h6>
                    <button class="btn btn-outline-light" type="button" data-bs-toggle="modal" data-bs-target="#signin">Sign In</button>

                    <!-- Signup Modal -->
                    <div class="modal fade" id="signup" tabindex="-1" aria-labelledby="signupLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body d-flex align-items-start p-2">
                                    <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"><span class="material-icons-outlined">close</span></button>
                                    <form class="d-flex flex-column gap-4 px-5 py-3" action="includes/signup.inc.php" method="post">
                                        <h2>Create you account</h2>
                                        <div class="form-floating">
                                            <input class="form-control border border-secondary bg-transparent text-white" type="text" name="name" id="name" placeholder="Name">
                                            <label class="form-label text-secondary" for="name">Name</label>
                                        </div>
                                        <?= (isset($_GET['nameError'])) ? "<small class='text-danger mt-0 mb-2'>{$_GET['nameError']}</small>" : null; ?>
                                        
                                        <div class="form-floating">
                                            <input class="form-control border border-secondary bg-transparent  text-white" type="text" name="uid" id="uid" placeholder="Username">
                                            <label class="form-label text-secondary" for="uid">Username <span class="text-muted">@example</span></label>
                                        </div>
                                        <?= (isset($_GET['uidError'])) ? "<small class='text-danger mt-0 mb-2'>{$_GET['uidError']}</small>" : null; ?>

                                        <div class="form-floating">
                                            <input class="form-control border border-secondary bg-transparent text-white" type="email" name="email" id="email" placeholder="Email">
                                            <label class="form-label text-secondary" for="email">Email</label>
                                        </div>
                                        <?= (isset($_GET['emailError'])) ? "<small class='text-danger mt-0 mb-2'>{$_GET['emailError']}</small>" : null; ?>

                                        <div class="text-start">
                                            <small class="d-block fw-bold">Date of birth</small>
                                            <small class="text-muted">This will not be shown publicly. Confirm your own age, even if this account is for a business, a pet, or something else.</small>
                                        </div>

                                        <div class="d-flex gap">
                                            <select class="form-control border border-secondary bg-dark text-white" name="month">
                                                <option value="01">Jan</option>
                                                <option value="02">Feb</option>
                                                <option value="03">Mar</option>
                                                <option value="04">Apr</option>
                                                <option value="05">May</option>
                                                <option value="06">Jun</option>
                                                <option value="07">Jul</option>
                                                <option value="08">Aug</option>
                                                <option value="09">Sep</option>
                                                <option value="10">Oct</option>
                                                <option value="11">Nov</option>
                                                <option value="12">Dec</option>
                                            </select>
                                            <select class="form-control border border-secondary bg-dark text-white" name="day">
                                                <option value="01">1</option>
                                                <option value="02">2</option>
                                                <option value="03">3</option>
                                                <option value="04">4</option>
                                                <option value="05">5</option>
                                                <option value="06">6</option>
                                                <option value="07">7</option>
                                                <option value="08">8</option>
                                                <option value="09">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                                <option value="13">13</option>
                                                <option value="14">14</option>
                                                <option value="15">15</option>
                                                <option value="16">16</option>
                                                <option value="17">17</option>
                                                <option value="18">18</option>
                                                <option value="19">19</option>
                                                <option value="20">20</option>
                                                <option value="21">21</option>
                                                <option value="22">22</option>
                                                <option value="23">23</option>
                                                <option value="24">24</option>
                                                <option value="25">25</option>
                                                <option value="26">26</option>
                                                <option value="27">27</option>
                                                <option value="28">28</option>
                                                <option value="29">29</option>
                                                <option value="30">30</option>
                                                <option value="31">31</option>
                                            </select>
                                            <select class="form-control border border-secondary bg-dark text-white" name="year">
                                                <?php
                                                $min_year = date('Y') - 90;
                                                $curr_year = date('Y');

                                                while ($curr_year > $min_year) {
                                                ?>
                                                    <option value="<?php echo $curr_year ?>"><?php echo $curr_year ?></option>
                                                <?php
                                                    $curr_year--;
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="form-floating">
                                            <input class="form-control border border-secondary bg-transparent text-white" type="password" name="pwd" id="pwd" placeholder="Password">
                                            <label class="form-label text-secondary" for="pwd">Password</label>
                                        </div>
                                        <?= (isset($_GET['pwdError'])) ? "<small class='text-danger mt-0 mb-2'>{$_GET['pwdError']}</small>" : null; ?>

                                        <input type="submit" class="btn btn-dark" name="signup" value="Sign Up">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Signin Modal -->
                    <div class="modal fade" id="signin" tabindex="-1" aria-labelledby="signinLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body d-flex align-items-start p-2">
                                    <button class="btn" type="button" data-bs-dismiss="modal" aria-label="Close"><span class="material-icons-outlined">close</span></button>
                                    <form class="col d-flex flex-column gap-4 px-5 py-3" action="includes/signin.inc.php" method="post">
                                        <h2>Sign in to X</h2>
                                        <div class="form-floating">
                                            <input class="form-control border border-secondary bg-transparent text-white" type="text" name="ui" placeholder="Username">
                                            <label class="form-label text-secondary" for="ui">Username</label>
                                        </div>
                                        <?= (isset($_GET['signinUiError'])) ? "<small class='text-danger mt-0 mb-2'>{$_GET['signinUiError']}</small>" : null; ?>

                                        <div class="form-floating">
                                            <input class="form-control border border-secondary bg-transparent text-white" type="password" name="pwd" placeholder="NamPassworde">
                                            <label class="form-label text-secondary" for="pwd">Password</label>
                                        </div>
                                        <?= (isset($_GET['signinPwdError'])) ? "<small class='text-danger mt-0 mb-2'>{$_GET['signinPwdError']}</small>" : null; ?>

                                        <input type="submit" class="btn btn-dark" name="signin" value="Sign In">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <div class=" d-flex gap flex-wrap justify-content-center">
            <a class="text-decoration-none text-muted small" href="">About</a>
            <a class="text-decoration-none text-muted small" href="">Help Center</a>
            <a class="text-decoration-none text-muted small" href="">Terms of Service</a>
            <a class="text-decoration-none text-muted small" href="">Privacy Policy</a>
            <a class="text-decoration-none text-muted small" href="">Cookie Policy</a>
            <a class="text-decoration-none text-muted small" href="">Accessibility</a>
            <a class="text-decoration-none text-muted small" href="">Ads info</a>
            <a class="text-decoration-none text-muted small" href="">Blog</a>
            <a class="text-decoration-none text-muted small" href="">Status</a>
            <a class="text-decoration-none text-muted small" href="">Careers</a>
            <a class="text-decoration-none text-muted small" href="">Brand Resources</a>
            <a class="text-decoration-none text-muted small" href="">Advertising</a>
            <a class="text-decoration-none text-muted small" href="">Marketing</a>
            <a class="text-decoration-none text-muted small" href="">X for Business</a>
            <a class="text-decoration-none text-muted small" href="">Developers</a>
            <a class="text-decoration-none text-muted small" href="">Directory</a>
            <a class="text-decoration-none text-muted small" href="">Settings</a>
            <p class="small text-muted">&copy; <?php echo date("Y") ?> X Corp.</p>
        </div>
    </footer>
</body>

</html>