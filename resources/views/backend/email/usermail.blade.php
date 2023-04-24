<!DOCTYPE html>
<html>
<head>
    <title>ItsolutionStuff.com</title>
</head>
<style type="text/css">
    td{
        font-size: 14px;
        padding-left:10px;
    }
</style>
<body>
    <h4>Time Sheet Detail</h4>
    <p><b>Dear {{$managerDetails['name'].' ' ?? ''}}{{$managerDetails['surname'] ?? ''}},</b></p>
    <p>Please check below daily report of 
    {{date('d-m-Y',strtotime($userDetails['submitted_date'])) }}.</p>
    <p><b>Employee Name:  </b>{{$userDetails['employeeName'] ?? ''}}</p>
    <table border="1" width="80%">
        <thead>
            <th>Project Name</th>
            <th>Task Detail</th>
            <th>Task Status</th>
            <th>Hours</th>
        </thead>
        <tbody>
            @foreach($mainArray as $r)
            <tr>
                <td>{{$r['projectName'] ?? ''}}</td>
                <td>{{$r['taskDetails'] ?? ''}}</td>
                <td>
                    @if(isset($r['status']) && $r['status'] == 1)
                        {{'Completed'}}
                    @elseif(isset($r['status']) && $r['status'] == 0)
                        {{'Pending'}} 
                    @endif
                </td>
                <td>{{$r['hour'] ?? ''}}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="3" class="text-right"><b>Total Hours</b></td>
                <td><b>{{$userDetails['total_hours'] ?? ''}}</b></td>
            </tr> 
        </tbody>
    </table>
    <p>{{$userDetails['employeeName'].' ' ?? '-'}}  |  {{$userDetails['designation'] ?? '-'}}</p>
    <p>Mobile: {{$userDetails['employeePhone'] ?? '-'}}</p>
    <p>Skype: {{$userDetails['employeeEmail'] ?? '-'}}</p>
</body>
</html>