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

<table align="center">
    <tr>

        <td>
            <p>
            <h1 ID="head">STUDENT'S ENTRY</h1>
            <h2> {{$course->name}}</h2>
            </p>

            <table align="left">
                <tr>
                    <td>Date: {{{$test->start_date}}} </td>
                    <td > &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp;  Time: 5:00pm</td>
                </tr>

                <tr>
                    <td>Duration: 2 hours </td>
                    <td>  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp;   Venue: 2b7 </td>
                </tr>

                <tr>
                    <td>Type: Test </td>
                </tr>
            </table>

            <br> <br>

            <div class="button-container">


                {!! Form::open(['method'=>'POST','route'=>['invigilators/searchStudent',$test->id]]) !!}
                        <table>
                            <tr>
                                <td><input type="text" name="student_id"/></td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="submit" value="find student"/>
                                </td>
                            </tr>
                        </table>

                {!! Form::close() !!}


                    <div>

                        <button value="SCRIPT COLLECTION"  action="ScripCollection.html" target="_self" style="color:BLACK; background-color:#D3D3D3;

					border: 2px solid #2cbffd;

					padding: 2px 0px; width:150px;height:30px"/> SCRIPT COLLECTION</button>
                    </div>


            </div>
        </td>

        <td>
            <br>
            &nbsp; &nbsp; &nbsp; &nbsp;	&nbsp; &nbsp; &nbsp; &nbsp;
            @if($error ===null)
            <img src="{{$student->image_file_path}}" scrolling="no" width="255" height="227" align="middle" frameborder="1" style="border-color:black;"  marginheight=50" name="Changeable">
            @endif
            <br><br>
            &nbsp; &nbsp; &nbsp; &nbsp;	&nbsp; &nbsp; &nbsp; &nbsp;	&nbsp; &nbsp; &nbsp;	&nbsp; &nbsp; &nbsp;	&nbsp; &nbsp;&nbsp; &nbsp;

                @if($error === null)
                <a href="{{{route('invigilators/enterTest',['test_id'=>$test->id, 'user_id'=>$student->id])}}}"   type="submit" value="SUBMIT"  align="center" style="color:BLACK; background-color:#D3D3D3;border: 2px solid #2cbffd;padding: 2px 5px; width:100px;height:30px"/>
                submit </a>
                @endif


            <div align="middle">
                @if($error === null)
                   <table style="padding-top:10px">
                       <tr>
                           <td><b>Student Name:</b></td>
                           <td>{{$student->name}}</td>
                       </tr>
                       <tr>
                           <td><b>Student ID:</b></td>
                           <td>{{$student->id}}</td>
                       </tr>
                   </table>
                    @elseif($error !=null)
                    <table style="padding-top:10px">
                        <tr>
                            <td>Error</td>
                        </tr>
                        <tr>
                            <td><b>{{$error->errorMessage}}</b></td>
                        </tr>
                    </table>
                @endif


            </div>

        </td>
    </tr>
</table>

</body>
</html>



