<div id="v_adduser">
    <div class="container">
        <div class="app-page-title" style="margin-top : 30px;">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-user icon-gradient bg-mean-fruit">
                        </i>
                    </div>
                    <div>Modern | Add new user
                        <div class="page-title-subheading">Here you can add new team member/developers on our system.
                        </div>
                    </div>
                </div>
                <div class="page-title-actions">

                </div>
            </div>
        </div>
    </div>
    <!-- contents -->
    <div class="container-fluid">
        <el-card shadow="always" style="margin-bottom : 40px;">
            <h3>Information Form</h3>
            <?php include("components/admin_components/admin_add_user/addform.php"); ?>
        </el-card>

        <el-card shadow="always" style="margin-bottom : 40px;">
            <h3>List of users</h3>
            <?php include("components/admin_components/admin_add_user/userList.php"); ?>
        </el-card>
    </div>

    <!-- end contents -->
</div>