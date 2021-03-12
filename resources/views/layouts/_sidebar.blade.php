<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <router-link to="/home" class="brand-link">
      <img src="storage/images/{{config('app.logo')}}" alt="Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </router-link>

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
          @if (Auth::user()->role === 'Admin')

            <li class="nav-header">PERSONNEL</li>
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
                    <i class="nav-icon ion ion-ios-people-outline" style="font-size:28px !important"></i>

                    <p>
                        Employés
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
                <router-link to="/reunion" class="nav-link">
                    <i class="nav-icon fa fa-handshake"></i>
                    <p>
                        Réunion
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

            @endif
          @if (Auth::user()->role === 'Admin' || Auth::user()->role === 'Commercial')

          <li class="nav-header">COMMERCIAL</li>
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
                <router-link to="/prospect" class="nav-link">
                    <i class="nav-icon fa fa-tty"></i>
                <p>
                    Prospect
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

            @endif

            @if (Auth::user()->role === 'Admin' || Auth::user()->role === 'Comptable')

            <li class="nav-header">COMPTABLE</li>
            <li class="nav-item">
                <router-link to="/vente" class="nav-link">
                    <i class="ion ion-ios-cart-outline" style="font-size: 28px!important;"></i>
                    <p>
                        Ventes
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
                <router-link to="/rapport" class="nav-link">
                    <i class="nav-icon fas fa-chart-bar"></i>
                    <p>
                        Rapport
                        <span class="right badge badge-danger">New</span>
                    </p>
                </router-link>
            </li>
            @endif

            <li class="nav-item">
                <router-link to="/setting" class="nav-link">
                    <i class="ion ion-ios-gear-outline" style="font-size: 28px !important;"></i>
                    <p>
                        Paramètres
                        <span class="right badge badge-danger">New</span>
                    </p>
                </router-link>
            </li>


        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
