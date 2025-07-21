<?php
require_once('config/config.php');
$currentPage = basename($_SERVER['PHP_SELF']);
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>Material Design for Bootstrap</title>
  <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
  <!-- Google Fonts Roboto -->
  <link
    rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" />
  <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/mdb.min.css" />
  <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/new-prism.css" />
  <style>
    @media (min-width: 1400px) {

      main,
      header,
      #main-navbar {
        padding-left: 240px;
      }
    }
  </style>
</head>

<body>
  <!--Main Navigation-->
  <header>
    <!-- Sidenav -->
    <div
      id="sidenav-1"
      class="sidenav"
      role="navigation"
      data-hidden="false"
      data-accordion="true">
      <a
        class="ripple d-flex justify-content-center py-4"
        href="#!"
        data-ripple-color="primary">
        <img
          id="MDB-logo"
          src="https://mdbootstrap.com/wp-content/uploads/2018/06/logo-mdb-jquery-small.png"
          alt="MDB Logo"
          draggable="false" />
      </a>

      <ul class="sidenav-menu">
        <li class="sidenav-item">
          <a class="sidenav-link" href="">
            <i class="fas fa-chart-area pr-3"></i><span>Webiste traffic</span></a>
        </li>
        <li class="sidenav-item">
          <a class="sidenav-link"><i class="fas fa-cogs pr-3"></i><span>Settings</span></a>
          <ul class="sidenav-collapse">
            <li class="sidenav-item">
              <a class="sidenav-link">Profile</a>
            </li>
            <li class="sidenav-item">
              <a class="sidenav-link">Account</a>
            </li>
          </ul>
        </li>
        <li class="sidenav-item">
          <a class="sidenav-link"><i class="fas fa-lock pr-3"></i><span>Password</span></a>
          <ul class="sidenav-collapse">
            <li class="sidenav-item">
              <a class="sidenav-link">Request password</a>
            </li>
            <li class="sidenav-item">
              <a class="sidenav-link">Reset password</a>
            </li>
          </ul>
        </li>
      </ul>
    </div>