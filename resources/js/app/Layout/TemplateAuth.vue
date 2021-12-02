<template>
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Cointramin <sup>Regalos</sup></div>
            </a>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <router-link :to="{name: 'Inicio'}" class="nav-link collapsed" href="#" data-toggle="collapse"
                             data-target="#collapseUtilities"
                             aria-expanded="false" aria-controls="collapseUtilities">
                    <i class="fas fa-home"></i>
                    <span>Inicio</span>
                </router-link>
            </li>

            <template v-if="$store.state.Auth.user.type >= 1">
                <li class="nav-item">
                    <router-link :to="{name: 'Asociados'}" class="nav-link collapsed" href="#" data-toggle="collapse"
                                 data-target="#collapseUtilities"
                                 aria-expanded="false" aria-controls="collapseUtilities">
                        <i class="fas fa-user"></i>
                        <span>Asociados</span>
                    </router-link>
                </li>

                <li class="nav-item">
                    <router-link :to="{name: 'Administradores'}" class="nav-link collapsed" href="#"
                                 data-toggle="collapse" data-target="#collapseUtilities"
                                 aria-expanded="false" aria-controls="collapseUtilities">
                        <i class="fas fa-users"></i>
                        <span>Administradores</span>
                    </router-link>
                </li>
            </template>

        </ul>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <Logout/>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->
                <router-view/>
            </div>
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Fycls Ingenieria 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Logout from "./Logout";

export default {
    name: "TemplateAuth",
    components: {Logout},
}
</script>

<style scoped>

</style>
