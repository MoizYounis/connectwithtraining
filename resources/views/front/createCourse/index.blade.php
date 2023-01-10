@extends('front.layouts.master')
@section('title')Latest Courses | {{$gs->title}} @endsection
@section('content')


<section class="breadcrums">
        <div class="container" style="max-width: 1223px;">
            <h2 >Create a course</h2>    
        </div>
    </section>
    <section class="course_slider">
        <div class="row">
            <div class="col-md-12">
                <div class="create">
                    <div class="col-md-2">
                        <div class="create-radio">
                            <input type="radio" name="1">
                        </div>
                        <div class="create-border">
                            <div class="create-head">
                                <h2>create</h2>
                            </div>
                            <div class="create-bodt">
                                <p>We help Create </p>
                            </div>  
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="create-radio">
                            <input type="radio" name="1">
                        </div>
                        <div class="create-border">
                            <div class="create-head">
                                <h2>invite</h2>
                            </div>
                            <div class="create-bodt">
                                <p>Instructor Joins </p>
                            </div>  
                        </div>    
                    </div>
                    <div class="col-md-2">
                        <div class="create-radio">
                            <input type="radio" name="1">
                        </div>
                        <div class="create-border">
                            <div class="create-head">
                                <h2>build</h2>
                            </div>
                            <div class="create-bodt">
                                <p>Instructor edits created course </p>
                            </div>  
                        </div>    
                    </div>
                    <div class="col-md-2">
                        <div class="create-radio">
                            <input type="radio" name="1">
                        </div>
                        <div class="create-border">
                            <div class="create-head">
                                <h2>Define</h2>
                            </div>
                            <div class="create-bodt">
                                <p>Instructor edits created course </p>
                            </div>  
                        </div>   
                    </div>
                    <div class="col-md-2">
                        <div class="create-radio">
                            <input type="radio" name="1">
                        </div>
                        <div class="create-border">
                            <div class="create-head">
                                <h2>Go live</h2>
                            </div>
                            <div class="create-bodt">
                                <p>Course is published </p>
                            </div>  
                        </div>    
                    </div>
                </div>
                <div class="process-text">
                    <div class="process-content">
                        <div class="process-head">
                            <h2>Creating a Course Process Simplified</h2>
                        </div>
                        <div class="process-body">
                            <div class="process-number">
                                <div class="number-circle">
                                    <div class="number1">
                                        01
                                    </div>
                                    <div class="number-text1">
                                        <p>Become a part of our market place by Identifying with Us </p>
                                    </div>
                                    
                                </div>
                                <div class="number-circle">
                                    <div class="number2">
                                        02
                                    </div>
                                    <div class="number-text2">
                                        <p>Become a part of our market place by Identifying with Us </p>
                                    </div>
                                </div>
                                <div class="number-circle">
                                    <div class="number3">
                                        03
                                    </div>
                                    <div class="number-text3">
                                        <p>Become a part of our market place by Identifying with Us </p>
                                    </div>
                                </div>
                                <div class="number-circle">
                                    <div class="number4">
                                        04
                                    </div>
                                    <div class="number-text4">
                                        <p>Become a part of our market place by Identifying with Us </p>
                                    </div>
                                </div>
                                <div class="number-circle">
                                    <div class="number5">
                                        05
                                    </div>
                                    <div class="number-text5">
                                        <p>Become a part of our market place by Identifying with Us </p>
                                    </div>
                                </div>
                                <div class="number-circle">
                                    <div class="number6">
                                        06
                                    </div>
                                    <div class="number-text6">
                                        <p>Become a part of our market place by Identifying with Us </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="process-btb">
                            <button type="button" onclick="show('popup')">Start Creating a Course</button>
                            <div class="popup" id="popup">
                              <div class="create-form">
                                  <div class="crt-form-head">
                                      <h2>Create a Course - Get started</h2>
                                      <i class="fa fa-times" onclick="closeForm()" aria-hidden="true"></i>
                                  </div>
                                  <div class="crt-form-body">
                                    <div class="side-text">
                                      <h2>Create Course</h2>                                        
                                    </div>
                                    <div class="body-content">
                                        <div class="crt-search">
                                            <input type="text" placeholder="Has anyone created this course?">
                                            <i class="fa fa-search"  aria-hidden="true"></i>
                                        </div>
                                        <div class="input-field">
                                            <input type="text" name="" placeholder="Enter Course Title: Introduction to SQL">
                                        </div>
                                        <div class="course-date">
                                            <div class="start-date">
                                                <p>Course starts on</p>
                                                <input type="date" name="">
                                            </div>
                                            <div class="from-date">
                                                <p>Course ends on</p>
                                                <input type="date" name="">
                                            </div>
                                        </div>
                                    </div>
                                  </div>
                                  <div class="crt-form-footer">
                                        <a href="">Create a course</a>
                                        <a href="">Create it for me</a>
                                    </div>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection