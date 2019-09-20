<?php
require APPROOT . '/views/inc/header.php';
//call dao
require DAO . '/../db/include.DAO.php';

?>

 <div class="container bg-gradient shadow-sm pt-4" style="max-width: 425px !important;">
     <!-- reserved for links -->
     <div class="row justify-content-center">
         <div class="col-sm-6">
             <a href="<?php echo URLROOT; ?>/pages/about">About</a>
         </div>
         <div class="col-sm-6">
             <input type="search" class="form-control-sm small form-control rounded" id="a" placeholder="search">
             <label for="a"></label>
         </div>
     </div>
     <!-- reserved for links -->
     <div class="row justify-content-center">
         <h3 class="h5 py-2">Welcome <?php

             $dao = new UsersDao();
             $user = $dao->find("", null);
                foreach ($user as $users){
              printf("<b> %s %s </b>", $users->getFirstName(), $users->getLastName());
                }

             ?></h3>

         <div class="col-12">
             <div class="bd-example shadow rounded-sm">
                 <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                     <ol class="carousel-indicators">
                         <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                         <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                         <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
                     </ol>
                     <div class="carousel-inner">
                         <div class="carousel-item active">
                             <img src="<?php echo URLROOT; ?>/public/pictures/01021105.jpg" class="d-block w-100" alt="...">
                             <div class="carousel-caption  d-md-block">
                                 <h5>First slide label</h5>
                                 <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                             </div>
                         </div>
                         <div class="carousel-item">
                             <img src="<?php echo URLROOT; ?>/public/pictures/01040372.jpg" class="d-block w-100" alt="...">
                             <div class="carousel-caption  d-md-block">
                                 <h5><?php echo ads;?></h5>
                                 <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                             </div>
                         </div>
                         <div class="carousel-item">
                             <img src="<?php echo URLROOT; ?>/public/pictures/01040373.jpg" class="d-block w-100" alt="...">
                             <div class="carousel-caption  d-md-block">
                                 <h5>Third slide label</h5>
                                 <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
                             </div>
                         </div>
                     </div>
                     <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                         <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                         <span class="sr-only">Previous</span>
                     </a>
                     <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                         <span class="carousel-control-next-icon" aria-hidden="true"></span>
                         <span class="sr-only">Next</span>
                     </a>
                 </div>
             </div>
             <!-- product display -->
         </div>
         <div class="col-12 my-4">
             <div class="card card-contact mt-3">
                     <div class="header header-raised header-primary text-center hh">
                         <h5 class="card-title">Product Category</h5>
                     </div>
                     <div class="card-content ">
                         <hr class="mt-3">
                             <p class="pt-1">
                                 Lorem ipsum dolor sit.
                             </p>

                     </div>
             </div>
         </div>
     </div>
 </div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
