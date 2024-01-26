<div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 280px;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
        <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
        <span class="fs-4">Admin Panel</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="dashboard.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : ''; ?>" aria-current="page">
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#home"/></svg>
                Home
            </a>
        </li>
        <li>
            <a href="profile.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'profile.php' ? 'active' : ''; ?>">
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"/></svg>
                Profile
            </a>
        </li>
        <li>
            <a class="nav-link link-dark dropdown-toggle <?php echo basename($_SERVER['PHP_SELF']) == 'create_post.php' || basename($_SERVER['PHP_SELF']) == 'update_post.php' || basename($_SERVER['PHP_SELF']) == 'delete_post.php' ? 'active' : ''; ?>" href="#" id="navbarDropdownMenuLink" role="button"
                data-bs-toggle="dropdown" aria-expanded="false">
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#grid"/></svg>
                Posts
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <li><a class="dropdown-item" href="create_post.php">
                    <svg class="bi me-2" width="16" height="16"><use xlink:href="#grid"/></svg>
                        New Post
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="update_post.php">
                    <svg class="bi me-2" width="16" height="16"><use xlink:href="#grid"/></svg>
                        Edit Post
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="delete_post.php">
                        <svg class="bi me-2" width="16" height="16"><use xlink:href="#grid"/></svg>
                            Delete Post
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#" class="nav-link link-dark <?php echo basename($_SERVER['PHP_SELF']) == 'products.php' ? 'active' : ''; ?>">
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#grid"/></svg>
                Products
            </a>
        </li>
        <li>
            <a href="inbox.php" class="nav-link link-dark <?php echo basename($_SERVER['PHP_SELF']) == 'inbox.php' ? 'active' : ''; ?>">
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"/></svg>
                Inbox
            </a>
        </li>
        <li>
            <a href="logout.php" class="nav-link link-dark <?php echo basename($_SERVER['PHP_SELF']) == 'logout.php' ? 'active' : ''; ?>">
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"/></svg>
                Logout
            </a>
        </li>
    </ul>
    <hr>
</div>
