<div class="col-md-12">

    <!--Card-->
    <div class="mask rgba-white-slight card mb-4">
        <!--Card header-->
        <div class="h6 card-header text-left">
            <span id="card_title" style="color: #0b5570; font-size: 18px;"> Configuration </span>
        </div>
        <!--Card header end-->

            <!--Card content-->
            <div class="card-body">
                      <div class="pb-3">
                        <div class="row mt-3">
                        </div>
                        <div class="table-responsive">
                          <table class="fixed_head table table-hover table-bordered">
                            <thead>
                              <tr>
                                <th>Entity</th>
                                <th>Description</th>
                                <th>Actions</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>
                                  <span>Companies</span>
                                </td>
                                <td>
                                  <span>Companies Registered With Us</span>
                                </td>
                                <td class="actions">
                                  <div class="my-auto" style="display: flex; flex-direction: row; justify-content: flex-start; vertical-align: middle;">
                                    <div>
                                      <a href="{{ route('companies.index') }}">
                                        <button class="btn btn-primary">View</button>
                                      </a>
                                    </div>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <span>Services</span>
                                </td>
                                <td>
                                  <span>SenderID, Shortcodes and Subscribable products</span>
                                </td>
                                <td class="actions">
                                  <div class="my-auto" style="display: flex; flex-direction: row; justify-content: flex-start; vertical-align: middle;">
                                    <div>
                                      <a href="{{ route('content.bulk') }}">
                                        <button class="btn btn-primary">View</button>
                                      </a>
                                    </div>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <span>Passwords</span>
                                </td>
                                <td>
                                  <span>SDP Passwords</span>
                                </td>
                                <td class="actions">
                                  <div class="my-auto" style="display: flex; flex-direction: row; justify-content: flex-start; vertical-align: middle;">
                                    <div>
                                      <a href="{{ route('sdp.passwords') }}">
                                        <button class="btn btn-primary">View</button>
                                      </a>
                                    </div>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <span>Users</span>
                                </td>
                                <td>
                                  <span>Registered Users.</span>
                                </td>
                                <td class="actions">
                                  <div class="my-auto" style="display: flex; flex-direction: row; justify-content: flex-start; vertical-align: middle;">
                                    <div>
                                      <a class="btn btn-primary" href="{{ route('users.index') }}">View</a>
                                    </div>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <span>Api Tokens</span>
                                </td>
                                <td>
                                  <span>Tokens for sending sms via API</span>
                                </td>
                                <td class="actions">
                                  <div class="my-auto" style="display: flex; flex-direction: row; justify-content: flex-start; vertical-align: middle;">
                                    <div>
                                      <a class="btn btn-primary" href="{{ route('tokens.index') }}">View</a>
                                    </div>
                                  </div>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
            </div>
            <!--Card content-->
    </div>
    <!--/.Card-->                   
</div>
