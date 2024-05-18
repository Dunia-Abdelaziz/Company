<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<?php require('inc/head.php');
require('admin/handel/connection.php'); ?>

<body>

  <!-- ======= Header ======= -->
  <?php require('inc/header.php'); ?>
  <!-- End Header -->

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Blog</h2>
          <ol>
            <li><a href="index.php">Home</a></li>
            <li>Blog</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog">
      <div class="container">

        <div class="row">

          <div class="col-lg-8 entries">
          <?php
              $id= $_GET['id'];
              $sql = "SELECT blogs.id,blogs.title,blogs.short_description,blogs.long_description,blogs.image,admins.name 
              FROM `blogs` join `admins` on admins.id= blogs.admin_id where blogs.id=$id";
              $query = mysqli_query($conn,$sql);
              $blogs = mysqli_fetch_assoc($query);
?>
            <article class="entry entry-single" data-aos="fade-up">

              <div class="entry-img">
                <img src="admin/uploud/blogs/<?=$blogs['image'] ?>" alt="" class="img-fluid">
              </div>

              <h2 class="entry-title">
                <a href="blog-single.php?id=<?=$blogs['id']?>"><?=$blogs['title'] ?></a>
              </h2>

              <div class="entry-meta">
                <ul>
                  <li class="d-flex align-items-center"><i class="icofont-user"></i> <a href="blog-single.php?id=<?=$blogs['id']?>"><?=$blogs['name'] ?></a></li>
                  <li class="d-flex align-items-center"><i class="icofont-wall-clock"></i> <a href="blog-single.php?id=<?=$blogs['id']?>"><time datetime="2020-01-01">Jan 1, 2020</time></a></li>
                  <li class="d-flex align-items-center"><i class="icofont-comment"></i> <a href="blog-single.php?id=<?=$blogs['id']?>">12 Comments</a></li>
                </ul>
              </div>

              <div class="entry-content">
              <?=$blogs['long_description'] ?>
              </div>


            </article><!-- End blog entry -->

            <div class="blog-comments" data-aos="fade-up">
            <?php
            $sql= "SELECT comments.content, comments.created_at,comments.blog_id,users.name 
            from users JOIN comments on users.id = comments.user_id WHERE blog_id=$id";
            $query = mysqli_query($conn,$sql);
            $comments = mysqli_fetch_all($query,MYSQLI_ASSOC);
            $sqlCount="SELECT count(blog_id)  from comments WHERE blog_id=$id";
            $queryCount = mysqli_query($conn,$sqlCount);
            $commentCount = mysqli_fetch_assoc($queryCount)['count(blog_id)'];
            

            ?>
              <h4 class="comments-count"><?php if(isset($commentCount)){echo $commentCount; }else{echo'0';} 
               ?> Comments</h4>
              <?php foreach($comments as $comment): ?>

              <div id="comment-1" class="comment clearfix">
                <img src="assets/img/default.jpg" class="comment-img  float-left" alt="">
                <h5><a href=""><?= $comment['name'] ?></a> <a href="#" class="reply"><i class="icofont-reply"></i> Reply</a></h5>
                <time datetime="2020-01-01"><?= $comment['created_at'] ?></time>
                <p>
                <?= $comment['content'] ?>
                </p>

              </div><!-- End comment -->
              <?php endforeach ?>


              <div class="reply-form">
                <?php if(isset($_SESSION['userId'])){ 
                  $userId = $_SESSION['userId'];
                  $sql = "SELECT * FROM users where id = $userId";
                  $query = mysqli_query($conn,$sql);
                  $data = mysqli_fetch_assoc($query)['status'];
                  
                  if($data == "active"){
                  ?>
                <h4>Leave a Reply</h4>
                <p>Your email address will not be published. Required fields are marked * </p>
                <form action="handel/add-comment.php" method= "POST">
                 <input type="hidden" value="<?= $id ?> " name="blog_id" />
                  <div class="row">
                    <div class="col form-group">
                      <textarea name="comment" class="form-control" placeholder="Your Comment*"></textarea>
                    </div>
                  </div>
                  <button type="submit" name= "insComment" class="btn btn-primary">Post Comment</button>

                </form>
<?php }
}?>
              </div>

            </div><!-- End blog comments -->

          </div><!-- End blog entries list -->

          <div class="col-lg-4">

            <div class="sidebar" data-aos="fade-left">

              <h3 class="sidebar-title">Search</h3>
              <div class="sidebar-item search-form">
                <form action="">
                  <input type="text">
                  <button type="submit"><i class="icofont-search"></i></button>
                </form>

              </div><!-- End sidebar search formn-->

              <h3 class="sidebar-title">Categories</h3>
              <div class="sidebar-item categories">
                <ul>
                  <li><a href="#">General <span>(25)</span></a></li>
                  <li><a href="#">Lifestyle <span>(12)</span></a></li>
                  <li><a href="#">Travel <span>(5)</span></a></li>
                  <li><a href="#">Design <span>(22)</span></a></li>
                  <li><a href="#">Creative <span>(8)</span></a></li>
                  <li><a href="#">Educaion <span>(14)</span></a></li>
                </ul>

              </div><!-- End sidebar categories-->

              <h3 class="sidebar-title">Recent Posts</h3>
              <div class="sidebar-item recent-posts">
                <div class="post-item clearfix">
                  <img src="assets/img/blog-recent-posts-1.jpg" alt="">
                  <h4><a href="blog-single.php?id=<?=$blog['id']?>">Nihil blanditiis at in nihil autem</a></h4>
                  <time datetime="2020-01-01">Jan 1, 2020</time>
                </div>

                <div class="post-item clearfix">
                  <img src="assets/img/blog-recent-posts-2.jpg" alt="">
                  <h4><a href="blog-single.php?id=<?=$blog['id']?>">Quidem autem et impedit</a></h4>
                  <time datetime="2020-01-01">Jan 1, 2020</time>
                </div>

                <div class="post-item clearfix">
                  <img src="assets/img/blog-recent-posts-3.jpg" alt="">
                  <h4><a href="blog-single.php?id=<?=$blog['id']?>">Id quia et et ut maxime similique occaecati ut</a></h4>
                  <time datetime="2020-01-01">Jan 1, 2020</time>
                </div>

                <div class="post-item clearfix">
                  <img src="assets/img/blog-recent-posts-4.jpg" alt="">
                  <h4><a href="blog-single.php?id=<?=$blog['id']?>">Laborum corporis quo dara net para</a></h4>
                  <time datetime="2020-01-01">Jan 1, 2020</time>
                </div>

                <div class="post-item clearfix">
                  <img src="assets/img/blog-recent-posts-5.jpg" alt="">
                  <h4><a href="blog-single.php?id=<?=$blog['id']?>">Et dolores corrupti quae illo quod dolor</a></h4>
                  <time datetime="2020-01-01">Jan 1, 2020</time>
                </div>

              </div><!-- End sidebar recent posts-->

              <h3 class="sidebar-title">Tags</h3>
              <div class="sidebar-item tags">
                <ul>
                  <li><a href="#">App</a></li>
                  <li><a href="#">IT</a></li>
                  <li><a href="#">Business</a></li>
                  <li><a href="#">Business</a></li>
                  <li><a href="#">Mac</a></li>
                  <li><a href="#">Design</a></li>
                  <li><a href="#">Office</a></li>
                  <li><a href="#">Creative</a></li>
                  <li><a href="#">Studio</a></li>
                  <li><a href="#">Smart</a></li>
                  <li><a href="#">Tips</a></li>
                  <li><a href="#">Marketing</a></li>
                </ul>

              </div><!-- End sidebar tags-->

            </div><!-- End sidebar -->

          </div><!-- End blog sidebar -->

        </div>

      </div>
    </section><!-- End Blog Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php require('inc/footer.php');?>
  <!-- End Footer -->


  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <?php require('inc/scripts.php');?>

</body>

</html>