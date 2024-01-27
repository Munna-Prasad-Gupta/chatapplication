<?php
    session_start();
    if(isset($_SESSION['unique_id'])){
        header("location: users.php");
    }

?>

<?php
     include_once "header.php";
     ?>
<body>
    <div class="main">
        <section class="form login">
            <header>Realtime Chat Application</header>
            <form action = '#'>
                <div class="error-text"></div>
                    <div class="field input">
                        <label>Email Address</label>
                        <input type="text" name="email" placeholder="Enter email id here">
                    </div>
                    <div class="field input">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="Enter your password here" minlength="7" >
                        <i class="fas fa-eye"></i>
                    </div>
                    
                    <div class="field submit button">
                        <input type="submit" value="Continue to Chat">
                    </div>
                
            </form>
            <div class="link">Not Yet Signed Up ? <a href="index.php">SignUp Now</a> </div>
        </section>
    </div>
    <script src="javascript\pass-show-hide.js"></script>
    <script src="javascript\login.js"></script>
</body>
</html>