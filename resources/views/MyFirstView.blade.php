<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript" async
  src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/latest.js?config=TeX-MML-AM_CHTML">
</script>
</head>
<h1>Hello Laravel</h1> 
<h2>Select All</h2> 


<!--@foreach($data as $row)
         <div> 
                Câu hỏi: {!!$row->question!!}
          </div>
        @endforeach-->
        
        
<table>
    <tr>
        <th>Câu hỏi</th>
        <th>A</th>
        <th>B</th>
        <th>C</th>
        <th>D</th>
        <th>Đáp án</th>
    </tr>
    <?php
    $i = 0;
    foreach ($data as $row) {
        echo "<tr>";
        echo "<td>" . $row['question'] . "</td><td>" . $row['a'] . "</td><td>" . $row['b'] . "</td><td>" . $row['c'] . "</td><td>" . $row['d'] . "</td><td>" . $row['answer'] . "</td>";
        echo "</tr>";
        $i++;
    }
    ?>
</table>