<div id="v_nav">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <!-- Container wrapper -->
        <div class="container">
            <!-- Navbar brand -->
            <a class="navbar-brand me-2" href="https://mdbgo.com/">
                <img src="resources/assets/large_modernresolve.png" height="50" alt="MDB Logo" loading="lazy" style="margin-top: -1px;" />
            </a>
            <!-- Toggle button -->
            <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarButtonsExample" aria-controls="navbarButtonsExample" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <!-- Collapsible wrapper -->
            <div class="collapse navbar-collapse" id="navbarButtonsExample">
                <!-- Left links -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/modern_web/">Modern Resolve <el-tag type="success">BETA v1.0</el-tag></a>
                    </li>
                </ul>
                <!-- Left links -->
                <div class="d-flex align-items-center">
                    <button @click="navigateLogin()" type="button" class="btn btn-link px-3 me-2">
                        Login
                    </button>
                    <button @click="onclientproposal()" type="button" class="btn btn-primary me-3">
                        Client Proposal
                    </button>
                    <a class="btn btn-dark px-3" href="https://github.com/mdbootstrap/mdb-ui-kit" role="button"><i class="fab fa-github"></i></a>
                </div>
            </div>
            <!-- Collapsible wrapper -->
        </div>
        <!-- Container wrapper -->
    </nav>
</div>