<!-- ***** Footer Start ***** -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="first-item">
                    <div class="logo">
                        <img src="<?= base_url('uploads/logo/' . ($title['image2'] ?? 'default-logo.png')) ?>"
                            alt="hexashop ecommerce templatemo" class="footer-logo">
                    </div>
                    <p style="color: rgb(255, 255, 255)">308 ABSLT UNSCRD adalah brand fashion modern dengan gaya urban
                        dan
                        streetwear.</p>
                    <!-- <ul>
                        <li><a href="#">16501 Collins Ave, Sunny Isles Beach, FL 33160, United States</a></li>
                        <li><a href="#">hexashop@company.com</a></li>
                        <li><a href="#">010-020-0340</a></li>
                    </ul> -->
                </div>
            </div>
            <div class="col-lg-4">
                <h4>Useful Links</h4>
                <ul>
                    <li><a href="<?= base_url('/') ?>">Homepage</a></li>
                    <li><a href="<?= base_url('products') ?>">Product</a></li>
                    <!-- <li><a href="#">Help</a></li>
                    <li><a href="#">Contact Us</a></li> -->
                </ul>
            </div>
            <div class="col-lg-4">
                <h4>Shopping &amp; Categories</h4>
                <ul>
                    <?= view_cell('App\Controllers\ComponentController::categoriesMenu') ?>
                </ul>
            </div>

            <!-- <div class="col-lg-3">
                <h4>Help &amp; Information</h4>
                <ul>
                    <li><a href="#">Help</a></li>
                    <li><a href="#">FAQ's</a></li>
                    <li><a href="#">Shipping</a></li>
                    <li><a href="#">Tracking ID</a></li>
                </ul>
            </div> -->
            <div class="col-lg-12">
                <div class="under-footer">
                    <p>&copy; 2025 308 ABSLT UNSCRD. All rights reserved.
                    </p>
                    <!-- <ul>
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="#"><i class="fa fa-behance"></i></a></li>
                    </ul> -->
                </div>
            </div>
        </div>
    </div>
</footer>