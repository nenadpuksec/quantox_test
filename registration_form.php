<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <title>Registration</title>
    <script>

        function registracija()
        {
            var name = document.getElementById('name').value;
            var board_type_id = document.getElementById('board_type_id').value;

            $.ajax({
                url: "functions/school_board_functions.php?function=registration",
                type: "post",
                data: {
                    name: name,
                    board_type_id: board_type_id
                },
                success: function (ret)
                {
                    var data = ret['message'];
                    alert(data);
                   console.log(data);
                }
            });
        }
    </script>
</head>
<body>
<div class="row">
    <div class="offset-md-4 col-md-4">

            <h4>Registration</h4>
            <hr>
            <div class="form-group">
                <label for="name">Student name</label>
                <input type="text" name="name" class="form-control" id="name"  placeholder="Student Name">
            </div>
            <div class="form-group">
                <label for="board_type_id">School Board</label>
                <select name="board_type_id" class="form-control" id="board_type_id">
                    <option value="Not Selected">Choose Board</option>
                    <option value="1">CSM</option>
                    <option value="2">CSMB</option>
                </select>
            </div>
            <button type="submit" name="btn_submit" class="btn btn-primary" onclick="registracija();">Register</button>

    </div>
</div>
</body>
</html>
