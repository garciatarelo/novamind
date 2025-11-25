<header class="pt-3">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container-fluid">
                    <a href="" class="navbar-brand">Mi Dashboard</a>
                    
                    <div class="collapse navbar-collapse justify-content-end">
                        <ul class="navbar-nav">
                            <li class="navbar-item mx-4">
                                <button type="button" class="btn btn-ligth position-relative">
                                    <i class="bi bi-bell-fill"></i>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                      99+
                                      <span class="visually-hidden">unread messages</span>
                                    </span>
                                  </button>
                                
                            </li>
                            <li class="navbar-item mx-1">
                                <img style="border-radius: 50%; border: 3px solid rgb(0, 90, 0); width:50px; 
                                height: 50px;" src="../img/admin.jpg" alt="">
                            </li>
                            <li class="navbar-item droptown">
                                <a href="" class="nav-link dropdown-toggle" id="userDropdown" role="button" 
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <?php echo $user_data['name'].' ' .$user_data['ap'];?>
                            </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                    <li>
                                        <a href="" class="dropdown-item">
                                            <i class="bi bi-person-fill"></i> 
                                            Perfil</a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">

                                    </li>
                                    <li>
                                        <a href="../php/cerrar-sesion.php" class="dropdown-item">
                                            <i class="bi bi-box-arrow-left"></i>
                                            Cerrar Sesión</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>