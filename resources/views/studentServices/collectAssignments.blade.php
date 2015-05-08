@extends('studentServices.master')


@section('content')
<div class="container text-center">
     <div class="section-heading">
       <h1>Collect Assignments</h1>
       <hr/>
    </div>
	
	<table align="center">
	  <tr>
	   <td>
		 <p>
			<div id="header">
				<form id="newsearch">
				   <input type="text" class="form-control" placeholder="Enter Submission ID">
				</form>
			    <div class="tfclear"></div>
			</div>
		 </p>
	     <p>
			<div id="header">
				<form id="newsearch">
				   <input type="text" class="form-control" placeholder="Enter Student ID">	
				</form>
			    <div class="tfclear"></div>		
		   </div>
	    </p>	
	    <br>
	
	    <form align="center">
			   &nbsp; &nbsp; &nbsp; 
			<input type="reset" value="Clear" class="btn btn-info"/>
		       &nbsp; &nbsp; &nbsp; &nbsp;		
			<input type="button"  value="Remove" target="Changeable" class="btn btn-danger"/>
			    &nbsp; &nbsp; &nbsp; &nbsp;		
		    <input type="submit" value="Accept" target="Changeable" class="btn btn-success"/>	
			    &nbsp; &nbsp; &nbsp;		
			<input type="submit" value="Search" target="Changeable" class="btn btn-default"/>				
    </td>
	<td>
		<br><br><br><br><br>
		&nbsp; &nbsp; &nbsp; &nbsp;	&nbsp; &nbsp; &nbsp; &nbsp;	
		<iframe src="" scrolling="no" width="255" height="227" align="middle" frameborder="1" style="border-color:black;"  marginheight=50" name="Changeable"></iframe> 
		<br><br>	
	    <p align="center">	
			&nbsp; &nbsp; &nbsp; &nbsp;	&nbsp; &nbsp; &nbsp;	
			<textarea readonly   rows="5" cols="34" draggable="false" style="resize: none;  border-color:black; border-width:2px;"> Module  information will be displayed here  </textarea>
		</p>
	</td>
  </tr>
</table>

	 
		 
</div>
@stop



