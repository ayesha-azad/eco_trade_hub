<h2 style="color: #0A1F44; font-weight: 800" class="text-center mt-5 mb-2">GENERATE SALES REPORTS</h2>

<!-- Form -->
<div class="row d-flex justify-content-center">
    <form class="row g-3 mb-3 col-lg-6" method="post">
        <div class="form-group">
            <label for="start_date" class="form-label">Start Date</label>
            <input type="date" class="form-control" id="start_date" name="start_date">
        </div>

        <div class="form-group">
            <label for="end_date" class="form-label">End Date</label>
            <input type="date" class="form-control" id="end_date" name="end_date">
        </div>

        <div class="text-center">
            <input class="btn btn-panel text-white" id="generateReport" name="generate_report" type="submit" value="Generate"/>
        </div>
    </form>
</div>

<!-- Report Table -->
<div class="d-flex justify-content-center mt-4">
    <div class="col-lg-6">
    <?php 
    if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
        // Retrieve and sanitize input dates
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];

        // Database query
        $query = "SELECT order_date, SUM(amount_due) AS total_sales FROM user_orders WHERE order_date BETWEEN '$start_date' AND '$end_date' GROUP BY order_date";
        $result_query = mysqli_query($conn, $query);

        // Check if query returns results
        if ($result_query && mysqli_num_rows($result_query) > 0) {
            echo '<table class="table table-striped text-center">';
            echo '<thead><tr><th>Order Date</th><th>Total Sales</th></tr></thead>';
            echo '<tbody>';

            // Fetch rows and display each row in the table
            while ($row = mysqli_fetch_assoc($result_query)) {
                echo '<tr>';
                echo '<td>' . date("Y-m-d H:i:s", strtotime($row['order_date'])) . '</td>';
                echo '<td>' . number_format($row['total_sales'], 2) . '</td>';
                echo '</tr>';
            }

            echo '</tbody></table>';
        } else {
            echo '<p class="text-center"><strong>No data found for the selected dates.</strong></p>';
        }
    }
    ?>
    </div>
</div>
