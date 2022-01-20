<div id="index_app">
    <div class="row">

        <div class="col-sm-6">
            <label for="">Fisrtname</label>
            <el-input placeholder="Enter Fisrtname" v-model="task.firstname"></el-input>
        </div>
        <div class="col-sm-6">
            <label for="">Lastname</label>
            <el-input placeholder="Enter Lastname" v-model="task.lastname"></el-input>
        </div>
        <div class="col-sm-6">
            <label for="">Email</label>
            <el-input placeholder="Enter Email" type="email" v-model="task.email"></el-input>
        </div>
        <div class="col-sm-6">
            <label for="">Address</label>
            <el-input placeholder="Enter Address" v-model="task.address"></el-input>
        </div>
        <div class="col-sm-6">
            <label for="">Desired Roles</label>
            <el-select v-model="task.roles" placeholder="Desired Roles" style="width: 100%;">
                <el-option v-for="item in Optionroles" :key="item.value" :label="item.label" :value="item.value">
                </el-option>
            </el-select>
        </div>
        <div class="col-sm-6">
            <label for="">Occupation</label>
            <el-select v-model="task.occupation" placeholder="Occupation" style="width: 100%;">
                <el-option v-for="item in OptionOccupation" :key="item.value" :label="item.label" :value="item.value">
                </el-option>
            </el-select>
        </div>
        <div class="col-sm-6">
            <label for="">Password</label>
            <el-input placeholder="Enter Password" v-model="task.password" type="password" clearable></el-input>
        </div>
        <div class="col-sm-6">
            <label for="">Confirm Password</label>
            <el-input placeholder="Confirm Password" type="password" clearable v-model="task.cpass"></el-input>
        </div>
        <div class="col-sm-6"></div>
    </div>
</div>