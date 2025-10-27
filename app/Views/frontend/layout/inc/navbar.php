<nav class="navbar navbar-expand-lg bg-primary navbar-dark shadow-sm py-3 py-lg-0 px-3 px-lg-5">
        <!-- <a href="index.html" class="navbar-brand d-flex d-lg-none">
            <h1 class="m-0 display-4 text-secondary"><span class="text-white">Farm</span>Fresh</h1>
        </a> -->
        <a href="/" class="navbar-brand d-flex d-lg-none">
                    <img src="frontend/images/fredian_farm_logo.png" 
                         width="180" 
                         height="60" 
                         alt="Fredian Farm Logo"
                         loading="lazy">
                </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav mx-auto py-0">
                <a href="/" class="nav-item nav-link <?= is_active_menu('/') ?>">Home</a>
                <a href="/about" class="nav-item nav-link <?= is_active_menu('/about') ?>">About</a>
                <a href="/blog" class="nav-item nav-link <?= is_active_menu('/blog') ?>">Blog</a>
                
                <!-- Dropdown Pages -->
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle <?= is_active_menu('/service') || is_active_menu('/product') || is_active_menu('/feature') || is_active_menu('/team') || is_active_menu('/testimonial') ? 'active' : '' ?>" data-bs-toggle="dropdown">Pages</a>
                    <div class="dropdown-menu m-0">
                        <a href="/service" class="dropdown-item <?= is_active_menu('/service') ?>">Service</a>
                        <a href="/product" class="dropdown-item <?= is_active_menu('/product') ?>">Product</a>
                        <a href="/feature" class="dropdown-item <?= is_active_menu('/feature') ?>">Features</a>
                        <a href="/team" class="dropdown-item <?= is_active_menu('/team') ?>">The Team</a>
                        <a href="/testimonial" class="dropdown-item <?= is_active_menu('/testimonial') ?>">Testimonial</a>
                    </div>
                </div>
                
                <a href="/contact" class="nav-item nav-link <?= is_active_menu('/contact') ?>">Contact</a>
            </div>
        </div>
    </nav>