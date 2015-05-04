
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
                 <h4 class="pull-right"><strong>Assignment Name<strong></h4>
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
                    <td>Feedback</td>
              
                    <tr> 
                       <td>1104473</td>
                       <td>Romario Raffington</td>
                       <td>Jan. 4 2014</td>
                       <td>2:03pm</td>
                       <td><a href="#">Download</td>
                       <td><a href="#" data-toggle="modal" data-target="#modalGradeAssessment">Give Feedback</td>
                    </tr>
                 </tbody>
             </table>
         </div>
      <hr/>
  </div>	
  
  
  <!--Modal for to Feedback-->
  <div id="modalGradeAssessment" class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="exampleModalLabel">Feedback</h4>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="recipient-name" class="control-label">Recipient: Romario Raffington, Ashani Kentish</label>
            </div>
            <div class="form-group">
              <label for="message-text" class="control-label">Message:</label>
              <textarea class="form-control" id="message-text"></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Send Feedback</button>
        </div>
      </div>
    </div>
  </div>
 @stop