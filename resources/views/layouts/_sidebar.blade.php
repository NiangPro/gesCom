<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Gescom</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item ">
            <router-link to="/home" exact class="nav-link ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Tableau de bord
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/staticdata" class="nav-link">
              <i class="nav-icon fas fa-database"></i>
              <p>
                Données statiques
              </p>
            </router-link>
          </li>
           <li class="nav-item">
            <router-link to="/employe" class="nav-link">
              <i class="nav-icon ion ion-ios-people-outline" style="font-size:28px !important;"></i>

              <p>
                Employés
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/client" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Clients
              </p>
            </router-link>
          </li>
            <li class="nav-item">
                <router-link to="/fournisseur" class="nav-link">
                <i class="nav-icon fas fa-street-view"></i>
                <p>
                    Fournisseurs
                </p>
                </router-link>
            </li>
            <li class="nav-item">
                <router-link to="/product" class="nav-link">
                <i class="nav-icon fab fa-product-hunt"></i>
                <p>
                    Produits/Services
                </p>
                </router-link>
            </li>
            <li class="nav-item">
                <router-link to="/task" class="nav-link">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                    Tâches
                </p>
                </router-link>
            </li>
            <li class="nav-item">
                <router-link to="/prospect" class="nav-link">
                <i class="nav-icon fa fa-tty"></i>
                <p>
                    Prospect
                </p>
                </router-link>
            </li>
            <li class="nav-item">
                <router-link to="/expense" class="nav-link">
                <i class="nav-icon fa fa-file"></i>
                <p>
                    Dépenses
                </p>
                </router-link>
            </li>
            <li class="nav-item">
                <router-link to="/reunion" class="nav-link">
                <i class="nav-icon fa fa-handshake"></i>
                <p>
                    Réunion
                </p>
                </router-link>
            </li>

            <li class="nav-item">
                <router-link to="/vente" class="nav-link">
                    <i class="ion ion-ios-cart-outline" style="font-size: 28px!important;"></i>
                <p>
                    Ventes
                </p>
                </router-link>
            </li>
            <li class="nav-item">
                <router-link to="/history" class="nav-link">
                <i class="nav-icon fas fa-history"></i>
                <p>
                    Historique
                    <span class="right badge badge-danger">New</span>
                </p>
                </router-link>
            </li>

            <li class="nav-item">
                <router-link to="/devis" class="nav-link">
                <i class="nav-icon fa fa-file-invoice"></i>
                <p>
                    Devis
                    <span class="right badge badge-danger">New</span>
                </p>
                </router-link>
            </li>

            <li class="nav-item">
                <router-link to="/setting" class="nav-link">
                <i class="ion ion-ios-gear-outline" style="font-size: 28px !important;"></i>
                <p>
                    Paramètres
                    <span class="right badge badge-danger">New</span>
                </p>
                </router-link>
            </li>

            <li class="nav-item">
                <router-link to="/rapport" class="nav-link">
                <i class="nav-icon fas fa-chart-bar"></i>
                <p>
                    Rapport
                    <span class="right badge badge-danger">New</span>
                </p>
                </router-link>
            </li>

          <li class="nav-header">Rapport</li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-envelope"></i>
              <p>
                Mailbox
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/mailbox/mailbox.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Inbox</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/mailbox/compose.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Compose</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/mailbox/read-mail.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Read</p>
                </a>
              </li>
            </ul>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
