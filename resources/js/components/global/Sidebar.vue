<template>
    <div>
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="/" class="brand-link">
                <img src="https://adminlte.io/themes/v3/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light">AdminLTE 3</span>
            </a>
            <!-- Sidebar -->
            <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                <img src="https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                <a href="#" class="d-block">{{ user.name }}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                        with font-awesome or any other icon font library -->
                        <li class="nav-item">
                        <a href="/home" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                        </a>
                    </li><li class="nav-item">
                        <a href="/mesas" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Mesas</p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Gestion
                            <i class="fas fa-angle-left right"></i>
                        </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="/cliente" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Clientes</p>
                            </a>
                        </li>
                       
                        <li class="nav-item">
                            <a href="/admin/producto" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Productos</p>
                            </a>
                        </li>
                         <!-- <li class="nav-item">
                            <a href="/admin/producto" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Modelo</p>
                            </a>
                        </li> -->
                          <li class="nav-item">
                            <a href="/admin/categoria" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Categoria</p>
                            </a>
                        </li>
                          <!-- <li class="nav-item">
                            <a href="/admin/producto" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Proveedores</p>
                            </a>
                        </li> -->
                        </ul>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Ventas
                            <i class="fas fa-angle-left right"></i>
                        </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="/api/ventas" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Ventas y Facturacion</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/api/proformas" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Proformas</p>
                            </a>
                        </li>
                       
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Comprobantes
                            <i class="fas fa-angle-left right"></i>
                        </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: none;">
                            <li class="nav-item">
                                <a href="/comprobante/factura" class="nav-link">
                                <i class="far fa-file nav-icon"></i>
                                <p>Factura</p>
                                </a>
                            </li>
                            <!-- <li class="nav-item">
                                <a href="pages/examples/profile.html" class="nav-link" v-if=" user.roles[0].id===3">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Nota Cr&eacute;dito</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages/examples/e-commerce.html" class="nav-link" v-if=" user.roles[0].id===3">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Nota D&eacute;bito</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages/examples/projects.html" class="nav-link" v-if=" user.roles[0].id===3">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Retenci&oacute;n</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages/examples/project-add.html" class="nav-link" v-if=" user.roles[0].id===3">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Guias</p>
                                </a>
                            </li> -->
                           
                        </ul>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Compras
                            <i class="fas fa-angle-left right"></i>
                        </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="/api/ingresos" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Ingresos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/api/proveedor" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Proveedor</p>
                            </a>
                        </li>
                       
                        </ul>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Reportes
                            <i class="fas fa-angle-left right"></i>
                        </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="/reportes/reporteventas" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Reporte ventas</p>
                            </a>
                        </li>
                       <li class="nav-item">
                            <a href="/reportes/compras" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Reporte Compras</p>
                            </a>
                        </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-circle"></i>
                        <p>
                            Configuracion
                            <i class="right fas fa-angle-left"></i>
                        </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: none;">
                            <li class="nav-item"  >
                                <a href="/admin/usuario" class="nav-link" v-if=" user.roles[0].id===3">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Usuarios</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/empresa" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Empresa </p>
                                </a>
                            </li>
                             <li class="nav-item">
                                <a href="/admin/puntodeemision" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p> Punto de Emision </p>
                                </a>
                            </li>
                            <!-- <li class="nav-item">
                                <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                   Level 2
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                                </a>
                                <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Level 3</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Level 3</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Level 3</p>
                                    </a>
                                </li>
                                </ul>
                            </li>
                            -->
                        </ul>
                    </li>
                    <!-- <li class="nav-item text-center mt-3">
                        <a href="https://buymeacoffee.com/hbakouane" target="_blank">
                            <img class="img-fluid rounded-pill border" style="height: 70px;" src="https://influencermarketinghub.com/wp-content/uploads/2021/03/skiptheflip_buymeacoffee3_creativeworkdonations.png">
                        </a>
                    </li> -->
               

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
    </div>
</template>

<script>
export default {
    name: "Sidebar",
    props: ['user']
}
</script>