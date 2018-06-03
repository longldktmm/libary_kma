<!DOCTYPE html>
<html lang="en">
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
<body>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container">
  <h2>Nhập câu hỏi</h2>
  <form action="{{url('addMaths')}}" method="POST" role="form">
      {{csrf_field()}}
    <div class="form-group">
      <label for="cauHoi">Câu hỏi:</label>
      <input type="text" class="form-control" id="cauHoi" placeholder="Nhập câu hỏi" name="cauHoi">
    </div>
    <div class="form-group">
      <label for="A">Đáp án A:</label>
      <input type="text" class="form-control" id="A" placeholder="Đáp án A:" name="A">
    </div>
          <div class="form-group">
      <label for="B">Đáp án B:</label>
      <input type="text" class="form-control" id="B" placeholder="Đáp án B:" name="B">
    </div>
          <div class="form-group">
      <label for="C">Đáp án C:</label>
      <input type="text" class="form-control" id="C" placeholder="Đáp án C" name="C">
    </div>
          <div class="form-group">
      <label for="D">Đáp án D:</label>
      <input type="text" class="form-control" id="D" placeholder="Đáp án D" name="D">
    </div>
          <div class="form-group">
      <label for="dapAn">Đáp án:</label>
      <input type="text" class="form-control" id="dapAn" placeholder="Đáp án A" name="dapAn">
    </div>
          <div class="form-group">
      <label for="pwd">Giải thích:</label>
      <input type="text" class="form-control" id="giaiThich" placeholder="Giải thích" name="giaiThich">
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
  </form>
</div>

</body>
</html>
