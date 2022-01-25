<el-input clearable type="text" placeholder="Search" style="margin-top: 10px; margin-bottom: 10px;" v-model="searchable"></el-input>
<el-table
        :key="0"
        v-loading="listLoading"
        :data="pagedTableData"
        border
        fit
        highlight-current-row
        style="width: 100%;"

>
    <el-table-column label="ID" prop="id" align="center"  >
        <template slot-scope="{row}">
            <span>{{ row.id }}</span>
        </template>
    </el-table-column>


    <el-table-column label="First name" align="center" >

        <template slot-scope="{row}">
            <span class="link-type" >{{ row.firstname }}</span>
            <!-- <el-tag>{{ row.type | typeFilter }}</el-tag> -->
        </template>
    </el-table-column>

    <el-table-column label="Last name"  align="center">
        <template slot-scope="{row}">
            <span class="link-type" >{{ row.lastname }}</span>
            <!-- <el-tag>{{ row.type | typeFilter }}</el-tag> -->
        </template>
    </el-table-column>

    <el-table-column label="User Level" width="150" align="center">
        <template slot-scope="{row}">
            <div v-if="row.istype == 1">
                <el-tag type="success">
                    Administrator
                </el-tag>
            </div>
            <div v-else>
                <el-tag type="warning">
                    User
                </el-tag>
            </div>

        </template>
    </el-table-column>

    <el-table-column label="Status" width="150" align="center">
        <template slot-scope="{row}">
            <div v-if="row.status == 1">
                <el-tag type="success">
                    Activated
                </el-tag>
            </div>
            <div v-else>
                <el-tag type="danger">
                    Deactivated
                </el-tag>
            </div>

        </template>
    </el-table-column>

    <el-table-column width="400" label="More Actions"  align="center">
        <template slot-scope="{row}">
            <div class="row">
                <div class="col-md-6">
                    <div v-if="row.status == 0 && row.istype == 2">
                        <div style="display: inline-flex">
                            <el-button type="success" size="small">Activate</el-button>&nbsp;
                            <el-button type="info" size="small">Make as admin</el-button>&nbsp;
                            <el-button type="danger" size="small">Remove</el-button>&nbsp;
                        </div>
                    </div>
                    <div v-else-if="row.status == 1 && row.istype == 2">
                        <div style="display: inline-flex">
                            <el-button type="danger" size="small">Deactivate</el-button>
                            <el-button type="info" size="small">Make as admin</el-button>&nbsp;
                            <el-button type="danger" size="small">Remove</el-button>&nbsp;
                        </div>
                    </div>
                </div>
<!--                <div class="col-md-6">-->
<!--                    <el-button type="warning" size="small">Change Password</el-button>-->
<!--                </div>-->
            </div>
        </template>
    </el-table-column>

</el-table>
<el-pagination layout="prev, pager, next" :page-size="propPageSize" :total="this.propListArray.length" @current-change="setPage">
</el-pagination>