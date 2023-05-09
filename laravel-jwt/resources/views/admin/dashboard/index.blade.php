<!DOCTYPE html>
<html lang="">
<head>
    <title>Project 1 Dashboard</title>
</head>
<body>
<h1>Project 1 Dashboard</h1>
<div>
    <label for="select">Select Project:</label>
    <select id="select">
        <option value="">Please Select</option>
        <option value="Project2">Project 2</option>
    </select>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
        $('#select').change(function() {
            $.ajax({
                url: 'http://127.0.0.1:8001/api/dashboard',
                type: 'POST',
                headers: {
                    'Authorization': 'Bearer ' + '{{ csrf_token() }}'
                },
                success: function(response) {
                },
                error: function(xhr) {
                }
            });
        });
</script>
</body>
</html>


