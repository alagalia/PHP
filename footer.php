<?php
require_once "check_index_usage.php";
?>

 <!-- Footer 
    <!-- CATEGORY SELECTOR  -->
    <div class="float-right">
        <div>
            <?php
            $result = mysqli_query($conn, "SELECT * FROM category");
            if (mysqli_num_rows($result) > 0):
                ?>
                <select style="position: inherit; margin: 10px 40px 0px 0px" name="category" onchange="location = this.value;">
                    <option value="index.php?p=posts_by&category=">Select category</option><?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <option value="index.php?p=posts_by&category=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option><?php endwhile; ?>
                </select><?php endif; ?>
        </div>
    </div>            
    <!-- CATEGORY SELECTOR END  -->  
    
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <ul class="list-inline text-center">
              <li class="list-inline-item">
                <a href="#">
                  <span class="fa-stack fa-lg">
                    <i class="fas fa-circle fa-stack-2x"></i>
                    <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                  </span>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <span class="fa-stack fa-lg">
                    <i class="fas fa-circle fa-stack-2x"></i>
                    <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                  </span>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <span class="fa-stack fa-lg">
                    <i class="fas fa-circle fa-stack-2x"></i>
                    <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                  </span>
                </a>
              </li>
            </ul>
            <p class="copyright text-muted">Copyright &copy; Your Website 2018</p>
          </div>
        </div>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/clean-blog.min.js"></script>

  </body>

</html>