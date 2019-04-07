<div class="col-md-12">

  <div class="dropD w-100 pr-5" style="z-index: 1">
    <div class="prof_menu text-white text-right d-flex justify-content-end">
        <div id="menu-pop" class="" style="border-radius: 0 0 0 20px; display: none; position: absolute; background-color: #0b3a4b; box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.1), 0 2px 7px 0 rgba(0, 0, 0, 0.15);">
            <ul class="list-unstyled ml-2 mt-2 mb-2 text-left">
                <li class="pl-2 pr-4 mt-1" onclick="changePass()">
                    <i class="pr-1"></i> Change Password
                </li>
                <li class="mt-2 px-2" onclick="support()">
                    <i class="pr-1"> </i> Support
                </li>
                <li class="mt-2 px-2" onclick="logout()">
                    <i class="pr-1"> </i> Logout
                </li>
            </ul>
        </div>
    </div>
</div>

    <!--Card-->
    <div class="mask rgba-white-slight card mb-4">
        <!--Card header-->
        <div class="h6 card-header text-left">
            <span id="card_title" style="color: #0b5570; font-size: 18px;"> Manage Contacts </span><br>
        </div>
        <!--Card header end-->
        <form>

            <!--Card content-->
            <div class="card-body">
              <div class="panel">
                <!-- Nav tabs -->
                <div class="panel-heading">
                    <ul class="nav nav-tabs">
                    <li class="nav-item"><a class="nav-link active"><span class="fa fa-upload mr-2"></span>Upload</a></li>
                    <li class="nav-item ml-2"><a class="nav-link"><span class="fa fa-group mr-2"></span>Groups</a></li>
                    <li class="nav-item ml-2"><a class="nav-link"><span class="fa fa-list-alt mr-2"></span>Group Contacts</a></li>
                  </ul>     
                </div>
                <!-- Nav tabs end -->

                <!-- Tab panes -->
                <div class="panel-body border border-top-0 rounded-bottom" style="background-color: #f4f7f9;">
                  <div class="tab-content mx-3">

                    <!-- Tab 1 -->
                    <div id="home" class="tab-pane active">
                      <div class="pt-4 pb-3">
                        <div class="row">
                          <span class="col-sm-3 my-auto text-md-right text-left" style="color: #887788;">Group Name<span style="color: #ff312b;"> *</span></span>

                          <div class="col-sm-4">
                            <input type="text" class="form-control" placeholder="Enter New Group Name" onkeypress="return isLetterKey(event)">
                          </div>

                          <span class="col-sm-1 my-auto text-center">OR</span>

                          <div class="col-sm-4">
                            <select class="custom-select">
                              <option value="ELEZA"> ELEZA </option>
                            </select>
                          </div>
                        </div>
                        <div class="row mt-3">
                          <span class="col-sm-3 my-auto text-md-right text-left" style="color: #887788;">Customer Account<span style="color: #ff312b;"> *</span></span>

                          <div class="col-sm-9">
                            <input type="text" class="form-control" type="text" value="810" disabled style="cursor: not-allowed;">
                          </div>
                        </div>
                        <div class="row mt-3">
                          <span class="col-sm-3 my-auto text-md-right text-left" style="color: #887788;">Alphanumeric<span style="color: #ff312b;"> *</span></span>

                          <div class="col-sm-9">
                            <select class="custom-select">
                                <option value="ELEZA"> ELEZA </option>
                            </select>
                          </div>
                        </div>
                        <div class="row mt-3">
                          <span class="col-sm-3 my-auto text-md-right text-left" style="color: #887788;">Contact File</span>

                          <div class="col-sm-9">
                            <p class="my-auto ml-0 ml-auto">[Maximum 128MB .csv ]</p>
                            <input type="file" class="pr-0" accept=".csv">
                          </div>
                        </div>
                        <hr class="divider my-3">
                        <div class="row">
                          <div class="w-100">
                            <div style="display: flex; flex-direction: row; justify-content: center; align-items: center;">
                              <div class="col-sm-6 mr-2 text-center">
                                <input value="Reset" class="btn_grey btn" type="submit">
                              </div>
                              <div class="col-sm-6 mr-2 text-center">
                                <input value="Save" class="btn_blue btn" type="submit">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- Tab 2 -->
                    <div id="menu1" class="tab-pane">
                      <div class="pt-4 pb-3">
                        <button class="btn btn-primary" id="addGroup"> Add Group <i class="fa fa-plus ml-1"></i></button>    
                        <div class="row mt-3">
                          <div class="col-md-6 mb-3" style="display: flex; flex-direction: row;">
                            <select class="sel form-control">
                              <option>10</option>
                              <option>25</option>
                              <option>50</option>
                              <option>100</option>
                            </select>
                            <span class="ml-2 my-auto">records per page</span>
                          </div>
                          <div class="col-md-6 mb-3 d-flex justify-content-center align-items-center">
                            <input required class="form-control" style="border-top-right-radius: 0; border-bottom-right-radius: 0;" placeholder="Search" name=" search_scheduled" type="text">
                            <span class="input-group-addon m-auto">
                              <span style="font-size: 1.55em;" class="ti-search"></span>
                            </span>
                          </div>
                        </div>
                        <div class="table-responsive">
                          <table class="fixed_head table table-hover table-bordered">
                            <thead>
                              <tr>
                                <th class="sort-by">Group name</th>
                                <th class="sort-by">Group count</th>
                                <th class="sort-by">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td> BIG
                                  <input type="text" class="form-control" required placeholder="Group name" onkeypress="return isLetterKey(event)" hidden>
                                </td>
                                <td> 0
                                  <select class="custom-select" hidden>
                                    <option value="ELEZA"> ELEZA </option>
                                  </select>
                                </td>
                                <td class="actions">
                                  <div class="my-auto" style="display: flex; flex-direction: row; justify-content: flex-start; vertical-align: middle;">
                                    <div>
                                      <span class="table_action p-1"><i class="fa fa-pencil"></i> Edit</span>
                                      <span class="table_action p-1"><i class="fa fa-trash"></i> Delete</span>
                                      <span class="table_action p-1" hidden><i class="fa fa-save"></i> Save</span>
                                      <span class="table_action p-1" hidden><i class="fa fa-close"></i> Close</span></div>
                                  </div>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                          <span class="d-flex float-left pt-2" style="font-size: 0.8em">Showing 0 to 0 of 0 entries</span>
                          <span class="arrows float-right mt-1 ti-angle-right rounded-right p-2" style="border-right: 1px solid #d0d4d8; border-left: 0.5px solid #d0d4d8;"></span>
                          <span class="arrows float-right mt-1 ti-angle-left rounded-left p-2" style="border-left: 1px solid #d0d4d8; border-right: 0.5px solid #d0d4d8;"></span>
                        </div>
                      </div>
                    </div>

                    <!-- Tab 3 -->
                    <div id="menu2" class="tab-pane">
                      <div class="pt-4 pb-3">
                        <div class="row">
                          <div class="col-md-6" style="display: flex; flex-direction: row;">
                            <button class="btn btn-primary" id="addGroup"> Add Contact <i class="fa fa-plus ml-1"></i></button> 
                          </div>
                          <div class="col-md-6 d-flex justify-content-end">
                            <button class="btn btn-primary" id="addGroup"> Export <i class="fa fa-file-excel-o ml-1"></i></button> 
                          </div>
                        </div>
                        <div class="row mt-3">
                          <div class="col-md-6 mb-3" style="display: flex; flex-direction: row;">
                            <select class="sel form-control">
                              <option>10</option>
                              <option>25</option>
                              <option>50</option>
                              <option>100</option>
                            </select>
                            <span class="ml-2 my-auto">records per page</span>
                          </div>
                          <div class="col-md-6 mb-3 d-flex justify-content-center align-items-center">
                            <input required class="form-control" style="border-top-right-radius: 0; border-bottom-right-radius: 0;" placeholder="Search" name=" search_scheduled" type="text">
                            <span class="input-group-addon m-auto">
                              <span style="font-size: 1.55em;" class="ti-search"></span>
                            </span>
                          </div>
                        </div>
                        <div class="table-responsive">
                          <table class="fixed_head table table-hover table-bordered">
                            <thead>
                              <tr>
                                <th class="sort-by">Phone number</th>
                                <th class="sort-by">Group name</th>
                                <th class="sort-by">Date created</th>
                                <th class="sort-by">Title</th>
                                <th class="sort-by">Names</th>
                                <th class="sort-by">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>A</td>
                                <td>B</td>
                                <td>C</td>
                                <td>D</td>
                                <td>E</td>
                                <td>F</td>
                              </tr>
                            </tbody>
                          </table>
                          <span class="d-flex float-left pt-2" style="font-size: 0.8em">Showing 0 to 0 of 0 entries</span>
                          <span class="arrows float-right mt-1 ti-angle-right rounded-right p-2" style="border-right: 1px solid #d0d4d8; border-left: 0.5px solid #d0d4d8;"></span>
                          <span class="arrows float-right mt-1 ti-angle-left rounded-left p-2" style="border-left: 1px solid #d0d4d8; border-right: 0.5px solid #d0d4d8;"></span>
                        </div>
                      </div>
                    </div>
                </div>
                <!-- Tab panes end -->
              </div>
            </div>
            <!--Card content-->

        </form>
    </div>
    <!--/.Card-->
</div>