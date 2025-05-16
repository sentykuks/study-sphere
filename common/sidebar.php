<?php include __DIR__ . "/../configs/path.php" ?>
<!-- <?php include __DIR__ . "/../conn/check_session.php" ?> -->
<style>
    .actives {
        color: #6e707e;
        background-color: #eee;
        font-weight: 600;
    }
</style>

<?php
$page_name = basename($_SERVER['PHP_SELF']);
$page_list_class = "";
$videos_class = "";
$subscriber_class = "";
$album_class = "";
$front_page = "";
$enquiry_class = "";
$document_class = "";
$result_class = "";
$staff_class = "";
$infra_class = "";
$page_class = "";

switch ($page_name) {
    case "dashboard.php":
        $page_class .= "actives";
        break;
    case "enquiry_list.php":
        $page_list_class .= "actives";
        break;
    case "category_list.php":
        $course_list = "actives";
        $course_section = "show";
        break;

    case "add_category.php":
        $course_form = "actives";
        $course_section = "show";

        break;
    case "category_edit.php":
        $course_list = "actives";
        $course_section = "show";

        break;
    case "subcategory_edit.php":
        $subject_list = "actives";
        $subject_section = "show";
        break;

    case "sub_category_list.php":
        $subject_list = "actives";
        $subject_section = "show";
        break;

    case "Sub_category_form.php":
        $subject_form = "actives";
        $subject_section = "show";
        break;


    case "student_registration.php":
        $student_registration = "actives";
        break;
    case "teacher_registration.php":
        $teacher_registration = "actives";
        break;
    case "add_blogs.php": {
            $add_blogs = "actives";
            $blogs_section = "show";
            break;
        }
    case "blog_list.php":
        $blog_list = "actives";
        $blogs_section = "show";
        break;

    case "blog_edit.php":
        $blog_list = "actives";
        $blogs_section = "show";
        break;

    case "document":
        $document_class = "actives";
        break;

    case "result":
        $result_class = "actives";
        break;

    case "staff":
        $staff_class = "actives";
        break;

    case "infra":
        $infra_class = "actives";
        break;

    default:
        $front_page = "actives";
}

?>

<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= $base_url ?>admin/admin.php">
        <div class="sidebar-brand-icon">
            <!-- <img src="./asset//img/logo/logo-white.png"> -->
            <h2>Dashboard </h2>
        </div>
        <!-- <div class="sidebar-brand-text mx-3">RuangAdmin</div> -->
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item <?= $page_class ?>">
        <a class="nav-link" href="<?= $base_url ?>admin/admin.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Admin Dashboard</span></a>
    </li>



    <li class="nav-item ">
        <a class="nav-link active" href="<?= $base_url ?>admin/user_info.php" data-target="#Course">
            <i class="fas fa-file-alt"></i>
            <span>User Information</span>
        </a>

    </li>
    <li class="nav-item ">
        <a class="nav-link active" href="<?= $base_url ?>admin/paper_upload.php" data-target="#Course">
            <i class="fas fa-file-alt"></i>
            <span>university paper upload</span>
        </a>

    </li>

    <!-- <li class="nav-item ">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Subject" aria-expanded="true"
            aria-controls="Subject">
            <i class="fas fa-book"></i>
            <span>Manage Products</span>
        </a>
    </li> -->
    <!-- <li class="nav-item <?= $page_list_class ?>">
        <a class="nav-link" href="<?= $base_url ?>enquiry_list.php">
            <i class="fas  fa-comments"></i>
            <span>Enquiries</span>
        </a>
    </li>  -->

    

</ul>

<!-- Sidebar -->