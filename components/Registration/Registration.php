<div id="index_app">
    <div class="row">
        <h3>Registration</h3>
        <div class="col-sm-6">
            <label for="">Fisrtname</label>
            <el-input
            placeholder="Enter Fisrtname"
            v-modal="firstname"
            ></el-input>
        </div>
        <div class="col-sm-6">
            <label for="">Lastname</label>
            <el-input
            placeholder="Enter Lastname"
            v-modal="lastname"
            ></el-input>
        </div>
        <div class="col-sm-6">
            <label for="">Email</label>
            <el-input
            placeholder="Enter Email"
            v-modal="email"></el-input>
        </div>
        <div class="col-sm-6">
            <label for="">Address</label>
            <el-input
            placeholder="Enter Address"
            v-modal="address"
            ></el-input>
        </div>
        <div class="col-sm-6">
            <label for="">Desired Roles</label>
            <el-select v-model="value" placeholder="Desired Roles" style="width: 100%;">
                <el-option
                v-for="item in options"
                :key="item.value"
                :label="item.label"
                :value="item.value">
                </el-option>
            </el-select>
        </div>
        <div class="col-sm-6">
            <label for="">Occupation</label>
            <el-select v-model="value" placeholder="Occupation" style="width: 100%;">
                <el-option
                v-for="item in options"
                :key="item.value"
                :label="item.label"
                :value="item.value">
                </el-option>
            </el-select>
        </div>
        <div class="col-sm-6">
            <label for="">Password</label>
            <el-input
            placeholder="Enter Password"
            v-modal="password"
            ></el-input>
        </div>
        <div class="col-sm-6">
        <label for="">Confirm Password</label>
            <el-input
            placeholder="Confirm Password"
            v-modal=""></el-input>
        </div>
        <div class="col-sm-6"></div>
    </div>
</div>

<script>
    export default {
        data() {
            return {
                
            }
        }
    }
</script>