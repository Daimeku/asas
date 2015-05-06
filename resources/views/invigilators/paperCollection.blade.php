
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


        ul {
            list-style: none;
            position:relative;
            left:50%;top:0;
            margin-left:-150px;

            display: inline-table;
        }

        .button-container form,
        .button-container form div {
            display: inline;
        }

        .button-container button {
            display: inline;
            vertical-align: middle;
        }
    </style>
</head>

<body>


<p>

<h1 ID="head">SCRIPT COLLECTION</h1>
<h2> OPERATING SYSTEM</h2>

</p>

<table  align="center">
    <tr>
        <td>Date: October 6, 2015 </td>
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


<br><br>
<p align="center">

<div align="center">
    {!! Form::open(['method'=>'POST','route'=>['invigilators/collectPaper',$test->id]]) !!}
    <label>Student ID</label>
    <input type="text" name="student_id"/>
    <label>Paper ID</label>
    <input type="text" name="paper_id"/>
    {!! Form::submit('verify') !!}
    {!! Form::close() !!}
</div>

<div align="center" class="button-container">





            <a href="#" style="color:BLACK; background-color:#D3D3D3;

					border: 2px solid #2cbffd;

					padding: 2px 0px; width:150px;height:30px"/> STUDENT'S ENTRY</a>



    <form action="invigilatorIndex.html" target="_parent" >
        <div>
            <button value="SCRIPT COLLECTION"  action="ScripCollection.html" target="_parent" style="color:BLACK; background-color:#D3D3D3;

					border: 2px solid #2cbffd;

					padding: 2px 0px; width:150px;height:30px"/> END COLLECTION</button>
        </div>
    </form>

</div>
</p>

</body>
</html>

 