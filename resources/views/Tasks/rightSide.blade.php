<h2>Add new tasks</h2>
                <form enctype="multipart/form-data" id="formUploadHandshake" onSubmit="Task.ajaxSendForm(this, 'handshake');">
                    <input type="hidden" name="source" value="upload">
                    <input type="hidden" name="action" value="addfile">
                    <div class="panel panel-default">
                        <table class="table table-bordered table-nonfluid" id="tableUploadHandshake">
                            <tbody>
                            <tr>
                                <th>Upload handshake file (cap, hccapx only)</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" class="form-control" name="task_name" required="" placeholder="Enter task name">
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label for="exampleSelect1">Select priority</label>
                                    <select class="form-control" id="tasksSelectPriority">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                        <option>6</option>
                                        <option>7</option>
                                        <option>8</option>
                                        <option>9</option>
                                        <option>10</option>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <input type="file" class="form-control fileinput" name="upfile" required="" id="upfile" accept=".cap, .hccapx">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="submit" class="btn btn-primary" value="Upload files" name="buttonUploadFile" id="buttonUploadFile">
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </form>

                <h2>NTLM Hash</h2>
                <form enctype="multipart/form-data" id="formUploadNTLMHash" onSubmit="Task.ajaxSendForm(this, 'ntlm');">
                    <input type="hidden" name="source" value="upload">
                    <input type="hidden" name="action" value="addfile">
                    <div class="panel panel-default">
                        <table class="table table-bordered table-nonfluid" id="tableUploadHash">
                            <tbody>
                            <tr>
                                <th>Set username, challenge, response</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" class="form-control" name="taskname" required="" placeholder="Enter taskname">
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <input type="text" class="form-control" name="username" required="" placeholder="Username">
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <input type="text" class="form-control" name="challenge" required="" placeholder="Challenge">
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <input type="text" class="form-control" name="response" required="" placeholder="Response">
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label for="exampleSelect1">Select priority</label>
                                    <select class="form-control" id="tasksSelectPriority">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                        <option>6</option>
                                        <option>7</option>
                                        <option>8</option>
                                        <option>9</option>
                                        <option>10</option>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <input type="submit" class="btn btn-primary" value="Upload hash" name="buttonUploadHash" id="buttonUploadHash">
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </form>