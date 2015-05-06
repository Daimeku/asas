
@extends('lecturers.master')

@section('content')
<div class="section-heading">
	<h1 id="heading">Tests Created </h1>
	<hr/>
 </div>

<!--Ashani:  This view will show all the submissions for each module that the lecturer teaches-->
  <div class="main-content">   
    
      <!--Search Bar-->
      <div class="container search">
           <div class="input-group">
              <div class="input-group-btn search-panel">
                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                     	<span id="search_concept">Filter by</span> <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Module</a></li>
                    <li><a href="#">Student ID</a></li>
                    <li><a href="#">Test Name</a>
                  </ul>
              </div>
              
              <input id="txtSearch" type="text" class="form-control" placeholder="Search">
              <span class="input-group-btn pull-left">
                  <button class="btn btn-default" type="button"><span class="fa fa-search"></span></button>
              </span>
          </div>
       </div>
        
       <div class="container">
            <div class="row">
                <div class="col-md-8">
                  <h2>Course Name</h2>
                  <h4><em>Group: UN1 </em></h4>
                  
                   <div class="btn-group">
        						<button type="button" class="btn btn-primary">Edit</button> 
        						<button type="button" class="btn btn-danger">Delete</button>
                   </div>
                </div> 
                
                <div class="col-md-4">
                  <h4><strong>Test Date:</strong> Friday, May 8, 2015</h4>
                  <h4><strong>Classroom:</strong> LT-2B1</h4>
                  <h4><strong>Test Time:</strong> 2 pm </h4>
                </div>
            </div>
        </div>
        
      <hr/>
    
   </div>
 @stop