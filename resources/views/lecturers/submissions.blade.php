
@extends('lecturers.master')

@section('content')
<div class="section-heading">
	<h1 id="heading">Submissions </h1>
	<hr/>
 </div>

<!--Ashani:  This view will show all the submissions for each module that the lecturer teaches-->
  <div class="main-content">   
    
  <!--Search Bar-->
  <div class="container">
       <div class="input-group">
          <div class="input-group-btn search-panel">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                 	<span id="search_concept">Filter by</span> <span class="caret"></span>
              </button>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Module</a></li>
                <li><a href="#">Student ID</a></li>
                <li><a href="#">Assignment Name</a>
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
              <div class="col-md-6"> 
                 <h2>Course Name</h2>          
                 <h4><em>Occurence:</em> UN1</h4>
              </div>
              <div class="col-md-6 pull-right">
                 <h4 class="pull-right">Assignment Name</h4>
                 <h4 class=class="pull-right"><strong>Group Assesment:</strong> Yes</h4>
              </div>
            </div>
            
            <table class="table">
               <tbody class="striped">
                    <td> ID Number </td>
                    <td> Student Name </td>
                    <td> Submission Date </td>
                    <td> Submission Date </td>
                    <td><a href="#"> Download All</a></td>
                    <td>Grade</td>
              
                    <tr> 
                       <td>1104473</td>
                       <td>Romario Raffington</td>
                       <td>Jan. 4 2014</td>
                       <td>2:03pm</td>
                       <td><a href="#">Download</td>
                       <td><a href="#">Grade</td>
                    </tr>
                </tbody>
             </table>
         </div>
      <hr/>
  </div>	 	 
 @stop