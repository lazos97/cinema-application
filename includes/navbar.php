<?php


function navbar($user)
{
    $navbar = '
      <nav class="navbar navbar-expand-lg navbar-dark mb-3 bg-dark">
          <div class="container">
              <a class="navbar-brand" href="../pages/home.php">iCinema</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                  <ul class="navbar-nav me-auto mb-2 mb-lg-0">';

    // Add Admin Panel link for admin user
    if ($user['usertype'] == 'admin') {
        $navbar .= '<li class="nav-item">
                      <a class="nav-link" aria-current="page" href="../pages/admin_panel.php">Admin Panel</a>
                  </li>';
    }

    $navbar .= '  </ul>
                 <a href="../logout.php" class="btn btn-danger">Logout</a>
              </div>
            </div>
      </nav>';

    return $navbar;
}
