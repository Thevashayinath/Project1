<script type="text/javascript" src="https://code.jquery.com/jquery-1.7.1.min.js"></script>

<p>Project 1 Dashboard</p>

<label for="my-select">
    Select Project
</label><select name="my-select" id="my-select">
    <option value="Project2">Project 2</option>
</select>

<!-- Your JavaScript code to handle the AJAX request -->
<script>
    // Get a reference to the select element
    var xsrfToken = "{{ csrf_token() }}";
    var select = document.getElementById("my-select");

    // Add an event listener that triggers when the select's value is changed
    select.addEventListener("change", function() {
        debugger
        // Get the selected option's value
        var selectedOption = select.options[select.selectedIndex].value;

        // Send an AJAX request to the server
        $.ajax({
            url: 'http://127.0.0.1:8001/api/login',
            type: 'POST',
            headers: {
                    'Authorization': 'Bearer ' + xsrfToken
                },
            success: function(response) {
                debugger
                // Handle the server's response here
            },
            error: function(xhr, status, error) {
                debugger
                // Handle any errors that occur during the AJAX request
            }
        });
    });
</script>
