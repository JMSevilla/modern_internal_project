<div class="row">
    <div class="col-sm">
        <span>Firstname </span>
        <el-input type="text" placeholder="Enter firstname" clerable v-model="adduserObj.firstname" style="margin-top: 10px; margin-bottom : 10px;"></el-input>
    </div>
    <div class="col-sm">
        <span>Lastname </span>
        <el-input type="text" placeholder="Enter lastname" clerable v-model="adduserObj.lastname" style="margin-top: 10px; margin-bottom : 10px;"></el-input>
    </div>
</div>
<div style="margin-top: 10px;" class="row">
    <div class="col-sm">
        <span>Roles </span>
        <el-select style="margin-top: 10px; margin-bottom: 10px; width: 100%;" v-model="adduserObj.roles" filterable placeholder="Select user role">
            <el-option v-for="item in Optionroles" :key="item.roleName" :label="item.roleName" :value="item.roleName">
            </el-option>
        </el-select>
    </div>
    <div class="col-sm">
        <span>Occupation </span>
        <el-select style="margin-top: 10px; margin-bottom: 10px; width: 100%;" v-model="adduserObj.occupation" filterable placeholder="Select user occupation">
            <el-option v-for="item in OptionOccupation" :key="item.occupationName" :label="item.occupationName" :value="item.occupationName">
            </el-option>
        </el-select>
    </div>
</div>
<div style="margin-top: 10px;" class="row">
    <div class="col-sm">
        <span>Email </span>
        <el-input type="email" placeholder="Enter email" clerable v-model="adduserObj.email" style="margin-top: 10px; margin-bottom : 10px;"></el-input>
    </div>
    <div class="col-sm">
        <span>Address </span>
        <el-input type="textarea" :rows="2" placeholder="Enter address" v-model="adduserObj.address" style="margin-top: 10px; margin-bottom : 10px;width: 100%;">
        </el-input>
    </div>
</div>
<div style="margin-top: 10px;" class="row">
    <div class="col-sm">
        <span>Password </span>
        <el-input type="password" placeholder="Enter email" clerable v-model="adduserObj.password" style="margin-top: 10px; margin-bottom : 10px;"></el-input>
    </div>
    <div class="col-sm">
        <span>Confirm Password </span>
        <el-input type="password" placeholder="Confirm Password" clerable v-model="adduserObj.cpass" style="margin-top: 10px; margin-bottom : 10px;"></el-input>
        </el-input>
    </div>

</div>
<div style="margin-top: 10px; margin-bottom: 10px;">
    <span>Account Status</span> :
    <el-switch
            v-model="adduserObj.istypeswitch"
            active-text="Activate"
            inactive-text="Deactivate">
    </el-switch>
</div>

<el-button type="primary" v-loading.fullscreen.lock="fullscreenLoading" plain style="float: right; margin-bottom: 20px; margin-top: 10px;" @click="onsave" size="medium">Save</el-button>