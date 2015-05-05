<html>

<head>
<style>
#BlueTopHead{
   position:fixed;
   top:0;
   left:0;
   width:100%;
   height:50px;
   background-color:#10576d;
}

#BluebottomHead{
   position:fixed;
   bottom:0;
   left:0;
   width:100%;
   height:60px;
   background-color:#10576d;
}
#head{
	text-align: center;
	font-size: 30px;
	color:#2cbffd;
}

h1 {
    text-align: center;
}
h2 {
    text-align: center;
}

table{

	align: center;
}

</style>
</head>

<body>


<div id="BlueTopHead">
<p style="color:white; font-size:xx-large; position:fixed; top:-25px; left:10px;"> <strong> ASAS  </strong> 
		
<li style="text-align:right; list-style-type: none; position:fixed; top:15px; right:35px;"> <a href="Month.html" style="color:white; text-decoration: none;" >Sign Out</a></li>							
</p>			

</div> 
<table align="center">
<tr>
<td>
<p>
<br><br><br>
	<h1 ID="head">STUDENT'S ENTRY</h1>
	<h2> {{$course->name}}</h2>
	
</p>

<table  align="center">
<tr> 
<td>Date: {{{$test->start_date}}} </td>
<td> </td>
<td> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Time: 5:00pm</td>
</tr>
<tr> 
<td>Duration: 2 hours </td>
<td> </td>
<td>  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Venue: 2b7 </td>
</tr>

<tr>

<td>Type: Test </td>
<td> </td>
<td> </td>

</tr>
</table>


<br>
<form align="center">
Student's ID: <input type="text" name="StudId"><br><br>
<input type="reset" value="CLEAR" action="{{{route('invigilators/studentEntry',['assessment_id'=>$test->id,'user_id'=>]) }}}" style="color:BLACK; background-color:#D3D3D3;

        border: 2px solid #2cbffd;

        padding: 2px 5px;  width:100px;height:30px"/>
&nbsp; &nbsp; &nbsp; &nbsp;		
<input type="submit" value="VERIFY" action="shellyp.jpg" target="Changeable" style="color:BLACK; background-color:#D3D3D3;

        border: 2px solid #2cbffd;

        padding: 2px 5px; width:100px;height:30px"/>	

</td>
<td>
<br><br><br><br><br><br>
&nbsp; &nbsp; &nbsp; &nbsp;	&nbsp; &nbsp; &nbsp; &nbsp;	
<div scrolling="no" width="255" height="227" align="middle" frameborder="1" style="border-color:black;"  marginheight=50" name="Changeable"></div>
<br><br>	
&nbsp; &nbsp; &nbsp; &nbsp;	&nbsp; &nbsp; &nbsp; &nbsp;	&nbsp; &nbsp; &nbsp;	&nbsp; &nbsp; &nbsp;	&nbsp; &nbsp;&nbsp; &nbsp;
<input type="submit" value="SUBMIT" action="http://www.google.com" align="center" style="color:BLACK; background-color:#D3D3D3;

        border: 2px solid #2cbffd;

        padding: 2px 5px; width:100px;height:30px"/>
</form>
</td>
</tr>
</table>
<div id="BluebottomHead"> 
<ul>
				<li align="middle" style="list-style-type: none; "><a href="PaperCollection.html" style="color:white; text-decoration: none;" >SCRIPT COLLECTION</a></li>
</ul>
</div>  
</body>
</html>