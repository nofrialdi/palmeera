<?php

session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../index.php");
    exit;
}
require '../config.php';

$id = $_GET['id'];
$sql = "SELECT * FROM news WHERE id = $id";

$result = mysqli_query($koneksi, $sql);

$data = mysqli_fetch_assoc($result);
$id = $data['id'];
$title = $data['title'];
$content = $data['content'];
$category = base64_decode($data['category']);


if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $category = $_POST['category'];
    $content = base64_encode($_POST['content']);

    $sql = "UPDATE news SET title = '$title', category = '$category', content = '$content' WHERE id = $id";

    mysqli_query($koneksi, $sql);

    if (mysqli_affected_rows($koneksi) > 0) {
        echo "<script>alert('Data updated successfully!')</script>";
        echo "<script>window.location.href = '../news.php'</script>";
    }
    else {
        echo "<script>alert('Data failed to update!')</script>";
        echo "<script>window.location.href = '../news.php'</script>";
        echo mysqli_error($koneksi);
    }





}

?>

<!DOCTYPE html>
<html lang="en">


<!-- datatables.html  21 Nov 2019 03:55:21 GMT -->
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Palmeera</title>
 <!-- General CSS Files -->
 <link rel="stylesheet" href="../assets/css/app.min.css">
  <link rel="stylesheet" href="../assets/bundles/summernote/summernote-bs4.css">
  <link rel="stylesheet" href="../assets/bundles/codemirror/lib/codemirror.css">
  <link rel="stylesheet" href="../assets/bundles/codemirror/theme/duotone-dark.css">
  <link rel="stylesheet" href="../assets/bundles/jquery-selectric/selectric.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/css/components.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="../assets/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href='../assets/img/favicon.ico' />
</head>

<body>
<div class="loader"></div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar sticky">
        <div class="form-inline mr-auto">
        
        </div>
        <ul class="navbar-nav navbar-right">
       
          <li class="dropdown"><a href="#" data-toggle="dropdown"
              class="nav-link dropdown-toggle nav-link-lg nav-link-user"> <img alt="image" src="../assets/img/user.png"
                class="user-img-radious-style"> <span class="d-sm-none d-lg-inline-block"></span></a>
            <div class="dropdown-menu dropdown-menu-right pullDown">
             
              <a href="../logout.php" class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i>
                Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="dashboard.php"> <img alt="image" src="../assets/img/logo.png" class="header-logo" /> <span
                class="logo-name">Palmeera Lounge</span>
            </a>
          </div>
          <ul class="sidebar-menu">
           
            <li >
              <a href="../dashboard.php" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
            </li>
            <li class="dropdown active">
              <a class="nav-link" href="../news.php"><i data-feather="file"></i><span>News</span></a>
            </li>
          </ul>
        </aside>
      </div>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
          <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Edit News</h4>
                  </div>
                  <form action="" method="POST" >
                  <div class="card-body"> 
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="title">Title</label>
                      <div class="col-sm-12 col-md-7">
                        <input type="text" class="form-control" name="title" id="title" value="<?= $data['title'] ?>" require>
                      </div>
                    </div>
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="category">Category</label>
                      <div class="col-sm-12 col-md-7">
                        
                        <select class="form-control selectric" name="category" id="category" require>
                        <option selected value="<?= $data['category'] ?>"><?= $data['category'] ?></option>
                          <option value="">--Select Category--</option>
                          <option value="Partnership">Partnership</option>
                          <option value="Operational">Operational</option>
                         
                        </select>
                      </div>
                    </div>
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="content">Content</label>
                      <div class="col-sm-12 col-md-7">
                        <textarea class="summernote" name="content" id="content" require><?= base64_decode($data['content']) ?></textarea>
                      </div>
                    </div>
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                      <div class="col-sm-12 col-md-7">
                        <button type="submit" name="submit" class="btn btn-primary">Publish</button>
                      </div>
                    </div>
                  </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </section>
        <div class="settingSidebar">
          <a href="javascript:void(0)" class="settingPanelToggle"> <i class="fa fa-spin fa-cog"></i>
          </a>
          <div class="settingSidebar-body ps-container ps-theme-default">
            <div class=" fade show active">
              <div class="setting-panel-header">Setting Panel
              </div>
              <div class="p-15 border-bottom">
                <h6 class="font-medium m-b-10">Select Layout</h6>
                <div class="selectgroup layout-color w-50">
                  <label class="selectgroup-item">
                    <input type="radio" name="value" value="1" class="selectgroup-input-radio select-layout" checked>
                    <span class="selectgroup-button">Light</span>
                  </label>
                  <label class="selectgroup-item">
                    <input type="radio" name="value" value="2" class="selectgroup-input-radio select-layout">
                    <span class="selectgroup-button">Dark</span>
                  </label>
                </div>
              </div>
              <div class="p-15 border-bottom">
                <h6 class="font-medium m-b-10">Sidebar Color</h6>
                <div class="selectgroup selectgroup-pills sidebar-color">
                  <label class="selectgroup-item">
                    <input type="radio" name="icon-input" value="1" class="selectgroup-input select-sidebar">
                    <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                      data-original-title="Light Sidebar"><i class="fas fa-sun"></i></span>
                  </label>
                  <label class="selectgroup-item">
                    <input type="radio" name="icon-input" value="2" class="selectgroup-input select-sidebar" checked>
                    <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                      data-original-title="Dark Sidebar"><i class="fas fa-moon"></i></span>
                  </label>
                </div>
              </div>
              <div class="p-15 border-bottom">
                <h6 class="font-medium m-b-10">Color Theme</h6>
                <div class="theme-setting-options">
                  <ul class="choose-theme list-unstyled mb-0">
                    <li title="white" class="active">
                      <div class="white"></div>
                    </li>
                    <li title="cyan">
                      <div class="cyan"></div>
                    </li>
                    <li title="black">
                      <div class="black"></div>
                    </li>
                    <li title="purple">
                      <div class="purple"></div>
                    </li>
                    <li title="orange">
                      <div class="orange"></div>
                    </li>
                    <li title="green">
                      <div class="green"></div>
                    </li>
                    <li title="red">
                      <div class="red"></div>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="p-15 border-bottom">
                <div class="theme-setting-options">
                  <label class="m-b-0">
                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                      id="mini_sidebar_setting">
                    <span class="custom-switch-indicator"></span>
                    <span class="control-label p-l-10">Mini Sidebar</span>
                  </label>
                </div>
              </div>
              <div class="p-15 border-bottom">
                <div class="theme-setting-options">
                  <label class="m-b-0">
                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                      id="sticky_header_setting">
                    <span class="custom-switch-indicator"></span>
                    <span class="control-label p-l-10">Sticky Header</span>
                  </label>
                </div>
              </div>
              <div class="mt-4 mb-4 p-3 align-center rt-sidebar-last-ele">
                <a href="#" class="btn btn-icon icon-left btn-primary btn-restore-theme">
                  <i class="fas fa-undo"></i> Restore Default
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <footer class="main-footer">
        <div class="footer-left">
          <a href="templateshub.net">Templateshub</a></a>
        </div>
        <div class="footer-right">
        </div>
      </footer>
    </div>
  </div>
    <!-- General JS Scripts -->
    <script src="../assets/js/app.min.js"></script>
  <!-- JS Libraies -->
  <script src="../assets/bundles/summernote/summernote-bs4.js"></script>
  <script src="../assets/bundles/codemirror/lib/codemirror.js"></script>
  <script src="../assets/bundles/codemirror/mode/javascript/javascript.js"></script>
  <script src="../assets/bundles/jquery-selectric/jquery.selectric.min.js"></script>
  <script src="../assets/bundles/ckeditor/ckeditor.js"></script>
  <!-- Page Specific JS File -->
  <script src="../assets/js/page/ckeditor.js"></script>
  <!-- Template JS File -->
  <script src="../assets/js/scripts.js"></script>
  <!-- Custom JS File -->
  <script src="../assets/js/custom.js"></script>
</body>


<!-- datatables.html  21 Nov 2019 03:55:25 GMT -->
</html>