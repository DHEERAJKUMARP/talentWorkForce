<table class="table table-striped table-bordered table-hover"  id="user_datatable_ajax">
                                    <thead>
                                        <tr role="row" class="filter">                  
                                            <td><input type="text" class="form-control" name="id" id="id" autocomplete="off"></td>                    
                                            <td><input type="text" class="form-control" name="name" id="name" autocomplete="off"></td>
                                            <td><input type="text" class="form-control" name="email" id="email" autocomplete="off"></td>
                                            <td><input type="text" class="form-control" name="phone" id="phone" autocomplete="off"></td>
                                            <!-- <td><input type="text" class="form-control" name="degree_level" id="degree_level" autocomplete="off"></td> -->
                                            <td><input type="text" class="form-control" name="job_experience" id="job_experience_id" autocomplete="off"></td>
                                            <td><input type="text" class="form-control" name="functional_area" id="functional_area_id" autocomplete="off"></td>
                                            <td><input type="text" class="form-control" name="current_salary" id="current_salary" autocomplete="off"></td>
                                            <td><input type="text" class="form-control" name="expected_salary" id="expected_salary" autocomplete="off"></td>
                                            <td></td>
                                        </tr>
                                        <tr role="row" class="heading"> 
                                            <th>Id</th>                                        
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <!-- <th>Qualification</th> -->
                                            <th>Experience</th>
                                            <th>Job Role</th>
                                            <th>Current Salary</th>
                                            <th>Expected Salary</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                        <tr>
                                            <td>{{$user->id}}</td>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->phone}}</td>
                                            <td>{{$user->job_experience}}</td>
                                            <td>{{$user->functional_area}}</td>
                                            <td>{{$user->current_salary}}</td>
                                            <td>{{$user->expected_salary}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>