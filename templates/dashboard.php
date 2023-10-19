<?php 
    session_start();
    require("../config/connection.php");
    if(isset($_SESSION['delete-success'])){
        ?>
        <div class="alert alert-danger">
    <strong><?php echo $_SESSION['delete-success']; ?></strong>
</div>
        <?php

    unset($_SESSION['delete-success']);}
?>

<style>
    @import url(https://unpkg.com/@webpixels/css@1.1.5/dist/index.css);

/* Bootstrap Icons */
@import url("https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.4.0/font/bootstrap-icons.min.css");
</style>
                                    <!-- Modal for confirmation -->
<div class="modal" id="confirmationModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete User</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this user?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="cancelDelete" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
            </div>
        </div>
    </div>
</div>


<!-- Dashboard -->
<div class="d-flex flex-column flex-lg-row h-lg-full bg-surface-secondary">
    <!-- Vertical Navbar -->
    <nav class="navbar show navbar-vertical h-lg-screen navbar-expand-lg px-0 py-3 navbar-light bg-white border-bottom border-bottom-lg-0 border-end-lg" id="navbarVertical">
        <div class="container-fluid">
            <!-- Toggler -->
            <button class="navbar-toggler ms-n2" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarCollapse" aria-controls="sidebarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Brand -->
            <a class="navbar-brand py-lg-9 mb-lg-5 px-lg-6 me-0" href="#">
                <img width="200px" style="height: 80px !important;" height="4vh" src="../assets/images/1j+ojFVDOMkX9Wytexe43D6kh...OJqhNPmBbFwXs1M3EMoAJtlikqgPtq9vk+" alt="...">
            </a>
            <!-- User menu (mobile) -->
            <div class="navbar-user d-lg-none">
                <!-- Dropdown -->
                <div class="dropdown">
                    <!-- Toggle -->
                    <a href="#" id="sidebarAvatar" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="avatar-parent-child">
                            <img alt="Image Placeholder" src="https://images.unsplash.com/photo-1548142813-c348350df52b?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=3&w=256&h=256&q=80" class="avatar avatar- rounded-circle">
                            <span class="avatar-child avatar-badge bg-success"></span>
                        </div>
                    </a>
                    <!-- Menu -->
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="sidebarAvatar">
                        <a href="#" class="dropdown-item">Profile</a>
                        <a href="#" class="dropdown-item">Settings</a>
                        <a href="#" class="dropdown-item">Billing</a>
                        <hr class="dropdown-divider">
                        <a href="#" class="dropdown-item">Logout</a>
                    </div>
                </div>
            </div>
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidebarCollapse">
                <!-- Navigation -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="bi bi-house"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="bi bi-bar-chart"></i> Analitycs
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="bi bi-chat"></i> Messages
                            <span class="badge bg-soft-primary text-primary rounded-pill d-inline-flex align-items-center ms-auto">6</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="bi bi-bookmarks"></i> Collections
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="bi bi-people"></i> Users
                        </a>
                    </li>
                </ul>
                <!-- Divider -->
                <hr class="navbar-divider my-5 opacity-20">
                <!-- Navigation -->
                <ul class="navbar-nav mb-md-4">
                    <li>
                        <div class="nav-link text-xs font-semibold text-uppercase text-muted ls-wide" href="#">
                            Contacts
                            <span class="badge bg-soft-primary text-primary rounded-pill d-inline-flex align-items-center ms-4">13</span>
                        </div>
                    </li>
                    <li>
                        <a href="#" class="nav-link d-flex align-items-center">
                            <div class="me-4">
                                <div class="position-relative d-inline-block text-white">
                                    <img alt="Image Placeholder" src="https://images.unsplash.com/photo-1548142813-c348350df52b?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=3&w=256&h=256&q=80" class="avatar rounded-circle">
                                    <span class="position-absolute bottom-2 end-2 transform translate-x-1/2 translate-y-1/2 border-2 border-solid border-current w-3 h-3 bg-success rounded-circle"></span>
                                </div>
                            </div>
                            <div>
                                <span class="d-block text-sm font-semibold">
                                    Marie Claire
                                </span>
                                <span class="d-block text-xs text-muted font-regular">
                                    Paris, FR
                                </span>
                            </div>
                            <div class="ms-auto">
                                <i class="bi bi-chat"></i>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link d-flex align-items-center">
                            <div class="me-4">
                                <div class="position-relative d-inline-block text-white">
                                    <span class="avatar bg-soft-warning text-warning rounded-circle">JW</span>
                                    <span class="position-absolute bottom-2 end-2 transform translate-x-1/2 translate-y-1/2 border-2 border-solid border-current w-3 h-3 bg-success rounded-circle"></span>
                                </div>
                            </div>
                            <div>
                                <span class="d-block text-sm font-semibold">
                                    Michael Jordan
                                </span>
                                <span class="d-block text-xs text-muted font-regular">
                                    Bucharest, RO
                                </span>
                            </div>
                            <div class="ms-auto">
                                <i class="bi bi-chat"></i>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link d-flex align-items-center">
                            <div class="me-4">
                                <div class="position-relative d-inline-block text-white">
                                    <img alt="..." src="https://images.unsplash.com/photo-1610899922902-c471ae684eff?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=3&w=256&h=256&q=80" class="avatar rounded-circle">
                                    <span class="position-absolute bottom-2 end-2 transform translate-x-1/2 translate-y-1/2 border-2 border-solid border-current w-3 h-3 bg-danger rounded-circle"></span>
                                </div>
                            </div>
                            <div>
                                <span class="d-block text-sm font-semibold">
                                    Heather Wright
                                </span>
                                <span class="d-block text-xs text-muted font-regular">
                                    London, UK
                                </span>
                            </div>
                            <div class="ms-auto">
                                <i class="bi bi-chat"></i>
                            </div>
                        </a>
                    </li>
                </ul>
                <!-- Push content down -->
                <div class="mt-auto"></div>
                <!-- User (md) -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="bi bi-person-square"></i> Account
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="bi bi-box-arrow-left"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Main content -->
    <div class="h-screen flex-grow-1 overflow-y-lg-auto">
        <!-- Header -->
        <header class="bg-surface-primary border-bottom pt-6">
            <div class="container-fluid">
                <div class="mb-npx">
                    <div class="row align-items-center">
                        <div class="col-sm-6 col-12 mb-4 mb-sm-0">
                            <!-- Title -->
                            <h1 class="h2 mb-0 ls-tight">Application</h1>
                        </div>
                        <!-- Actions -->
                        <div class="col-sm-6 col-12 text-sm-end">
                            <div class="mx-n1">
                                <a href="#" class="btn d-inline-flex btn-sm btn-neutral border-base mx-1">
                                    <span class=" pe-2">
                                        <i class="bi bi-pencil"></i>
                                    </span>
                                    <span>Edit</span>
                                </a>
                                <a href="#" class="btn d-inline-flex btn-sm btn-primary mx-1">
                                    <span class=" pe-2">
                                        <i class="bi bi-plus"></i>
                                    </span>
                                    <span>Create</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Nav -->
                    <ul class="nav nav-tabs mt-4 overflow-x border-0">
                        <li class="nav-item ">
                            <a href="#" class="nav-link active">All files</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link font-regular">Shared</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link font-regular">File requests</a>
                        </li>
                    </ul>
                </div>
            </div>
        </header>
        <!-- Main -->
        <main class="py-6 bg-surface-secondary">
            <div class="container-fluid">
                <!-- Card stats -->
                <div class="row g-6 mb-6">
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card shadow border-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <span class="h6 font-semibold text-muted text-sm d-block mb-2">Budget</span>
                                        <span class="h3 font-bold mb-0">$750.90</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-tertiary text-white text-lg rounded-circle">
                                            <i class="bi bi-credit-card"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-2 mb-0 text-sm">
                                    <span class="badge badge-pill bg-soft-success text-success me-2">
                                        <i class="bi bi-arrow-up me-1"></i>13%
                                    </span>
                                    <span class="text-nowrap text-xs text-muted">Since last month</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card shadow border-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <span class="h6 font-semibold text-muted text-sm d-block mb-2">New projects</span>
                                        <span class="h3 font-bold mb-0">215</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-primary text-white text-lg rounded-circle">
                                            <i class="bi bi-people"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-2 mb-0 text-sm">
                                    <span class="badge badge-pill bg-soft-success text-success me-2">
                                        <i class="bi bi-arrow-up me-1"></i>30%
                                    </span>
                                    <span class="text-nowrap text-xs text-muted">Since last month</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card shadow border-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <span class="h6 font-semibold text-muted text-sm d-block mb-2">Total hours</span>
                                        <span class="h3 font-bold mb-0">1.400</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-info text-white text-lg rounded-circle">
                                            <i class="bi bi-clock-history"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-2 mb-0 text-sm">
                                    <span class="badge badge-pill bg-soft-danger text-danger me-2">
                                        <i class="bi bi-arrow-down me-1"></i>-5%
                                    </span>
                                    <span class="text-nowrap text-xs text-muted">Since last month</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card shadow border-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <span class="h6 font-semibold text-muted text-sm d-block mb-2">Work load</span>
                                        <span class="h3 font-bold mb-0">95%</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-warning text-white text-lg rounded-circle">
                                            <i class="bi bi-minecart-loaded"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-2 mb-0 text-sm">
                                    <span class="badge badge-pill bg-soft-success text-success me-2">
                                        <i class="bi bi-arrow-up me-1"></i>10%
                                    </span>
                                    <span class="text-nowrap text-xs text-muted">Since last month</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- User Management -->
                <?php 
                $itemsPerPage = 10;
                $page = isset($_GET['page']) ? $_GET['page'] : 1;
                $offset = ($page - 1) * $itemsPerPage;
                

                $query = "SELECT * FROM user LIMIT $itemsPerPage OFFSET $offset";
                $result = $conn->query($query);

                ?>


                <div class="card shadow border-0 mb-7">
                    <div class="card-header">
                        <h5 class="mb-0">User Management</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-nowrap">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Change Status</th>
                                    <th scope="col">Assign Roles</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($result->num_rows > 0) {
                                     while ($row = $result->fetch_assoc()) {
                                        $name = $row["name"];
                                        $email = $row["email"];
                                        $date = $row['created_at'];
                                        $phone = $row['phone'];
                                        $id = $row['id'];
                                        $status = $row['status'];
                                        $res = $conn->query("SELECT `image` FROM `profile` WHERE user_id = '$id'");
                                        while($img  = $res->fetch_assoc()){
                                            $image = $img['image'];
                                        }
                                    
                                        ?>
                                <tr>
                                    <td>
                                        <img alt="..." src="<?php if( $image == null || strlen($image)==0 ){ ?>https://cdn.pixabay.com/photo/2014/04/02/10/25/man-303792_1280.png<?php }else{ ?>../assets/images/uploads/<?php echo $id ;?>/<?php echo $image; ?>.<?php echo explode('.',$image)[1]; }?>" class="avatar avatar-sm rounded-circle me-2">
                                        <a class="text-heading font-semibold" href="#">
                                            <?php echo $name; ?>
                                        </a>
                                    </td>
                                    <td>
                                        <?php echo $date; ?>
                                    </td>
                                    <td>
                                        <img alt="..." src="https://cdn.pixabay.com/photo/2017/10/29/01/23/icon-e-mail-2898669_1280.png" class="avatar avatar-xs rounded-circle me-2">
                                        <a class="text-heading font-semibold" href="mailto:<?php echo $email; ?>">
                                            <?php echo $email; ?>
                                        </a>
                                    </td>
                                    <td>
                                        <?php echo $phone; ?>
                                    </td>
                                    <td>
                                        <span class="badge badge-lg badge-dot">
                                            <?php if($status == 0){ ?>
                                                <i class="bg-success"></i>Active
                                            <?php }else if($status == 1){?>
                                                <i class="bg-danger"></i>User Delete
                                            <?php } else if($status == 2) { ?>
                                                <i class="bg-dark"></i>Admin Delete
                                            <?php }else if($status == 3) {?>
                                                <i class="bg-warning"></i>Banned
                                            <?php } ?>
                                        </span>
                                    </td>
                                    <td>
                                    <form action="http://localhost:8000/src/controller/admin_controll.php" class="mx-1 my-1" method="post">
                                        <input type="hidden" name="user_id" value="<?php echo $id; ?>">
                                        <select name="new_status" class="badge badge-lg badge-dot">
                                            <option value="0" <?php if ($status == 0) echo "selected"; ?>>Active</option>
                                            <option value="1" <?php if ($status == 1) echo "selected"; ?>>User Delete</option>
                                            <option value="2" <?php if ($status == 2) echo "selected"; ?>>Admin Delete</option>
                                            <option value="3" <?php if ($status == 3) echo "selected"; ?>>Banned</option>
                                        </select>
                                        <button type="submit" style="color: black;" class="badge badge-pill badge-dark ">Update</button>
                                    </form>
                                    </td>
                                    <td>
                                        <form action="http://localhost:8000/src/controller/admin_controll.php" class="mx-1 my-1" method="post">
                                        <input type="hidden" name="user_id" value="<?php echo $id; ?>">
                                        <select name="new_role" class="badge badge-lg badge-dot" class="form-select">
                                        <?php

                                            $query = "SELECT role_id FROM user_role WHERE user_id = ?";
                                            $stmt = $conn->prepare($query);
                                            $stmt->bind_param("i", $id);
                                            $stmt->execute();
                                            $stmt->bind_result($current_role_id);
                                            $stmt->fetch();
                                            $stmt->close();

                                            $roles = array(
                                                1 => "super_user",
                                                2 => "admin",
                                                3 => "manager",
                                                4 => "seller",
                                                5 => "user"
                                            );  

                                            foreach ($roles as $role_id => $role_name) {
                                                $selected = ($role_id == $current_role_id) ? 'selected' : '';
                                                $disabled = ($role_id == 1) ? 'disabled' : '';

                                                echo "<option value='$role_id' $selected $disabled>$role_name</option>";
                                            }
                                        ?>
                                        </select>
                                        <button type="submit" style="color: black;" class="badge badge-pill badge-dark ">Assign</button>
                                        </form>
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-neutral">View</a>
                                        <button type="button" class="btn btn-sm btn-square btn-neutral text-danger-hover delete-user" data-userid="<?php echo $id; ?>">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                    


                                </tr>
                                <?php }}?>
                                
                            </tbody>
                        </table>
                    </div>
                    <?php
                        $countQuery = "SELECT COUNT(*) as total FROM user";
                        $countResult = $conn->query($countQuery);

                        if ($countResult && $countResult->num_rows > 0) {
                            $countRow = $countResult->fetch_assoc();
                            $totalItems = $countRow['total'];
                            } else {
                                $totalItems = 0;
                            }
                   
                    $totalPages = ceil($totalItems / $itemsPerPage);
                    
                    // Define the number of pagination links to display at a time
                    $linksPerPage = 3;
                    
                    // Calculate the current range of pagination links
                    $startRange = max(1, $page - floor($linksPerPage / 2));
                    $endRange = min($totalPages, $startRange + $linksPerPage - 1);
                    
                    echo '<ul class="pagination">';
                    
                    // Create a "Previous" link
                    if ($page > 1) {
                        echo '<li class="page-item"><a class="page-link" href="?page=' . ($page - 1) . '">Previous</a></li>';
                    }
                    
                    // Generate the pagination links within the current range
                    for ($i = $startRange; $i <= $endRange; $i++) {
                        echo '<li class="page-item' . ($page == $i ? 'active ' : '') . '">';
                        echo '<a class="page-link" href="?page=' . $i . '">' . $i . '</a>';
                        echo '</li>';
                    }
                    
                    // Create a "Next" link
                    if ($page < $totalPages) {
                        echo '<li class="page-item"><a class="page-link" href="?page=' . ($page + 1) . '">Next</a></li>';
                    }
                    
                    echo '</ul>';
                    ?>
                    <div class="card-footer border-0 py-5">
                        <span class="text-muted text-sm">Showing 10 items out of <?php echo $totalItems; ?> results found</span>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const deleteButtons = document.querySelectorAll(".delete-user");
        const confirmationModal = document.getElementById("confirmationModal");
        const confirmDeleteButton = document.getElementById("confirmDelete");
        const cancelDeleteButton = document.getElementById("cancelDelete");


        let userIdToDelete;

        deleteButtons.forEach(button => {
            button.addEventListener("click", function() {
                userIdToDelete = this.getAttribute("data-userid");
                confirmationModal.style.display = "block";
            });
        });

        confirmDeleteButton.addEventListener("click", function() {
            if (userIdToDelete) {
                window.location.href = "http://localhost:8000/src/controller/admin_controll.php?id=" + userIdToDelete;
            }
        });

        cancelDeleteButton.addEventListener("click", function() {
            userIdToDelete = null; 
            confirmationModal.style.display = "none";
        });

        confirmationModal.addEventListener("click", function(event) {
            if (event.target === confirmationModal) {
                confirmationModal.style.display = "none";
            }
        });
    });
</script>