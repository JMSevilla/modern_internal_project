<el-input clearable type="text" placeholder="Search" style="margin-top: 10px; margin-bottom: 10px;" v-model="searchable"></el-input>
<table class="table table-bordered table-hover table-outline">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Firstname</th>
        <th scope="col">Lastname</th>
        <th scope="col">Handle</th>
    </tr>
    </thead>
    <tbody>
    <tr v-for="item in pagedTableData" :key="item.id">
        <th scope="row">{{item.id}}</th>
        <td>{{item.firstname}}</td>
        <td>{{item.lastname}}</td>
        <td>@mdo</td>
    </tr>
    </tbody>
</table>