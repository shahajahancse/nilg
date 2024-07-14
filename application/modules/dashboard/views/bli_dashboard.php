<?php 
    $query = $this->db->select('
                        SUM(CASE WHEN type = 1 THEN quantity ELSE 0 END) AS total_in,
                        SUM(CASE WHEN type = 2 THEN quantity ELSE 0 END) AS total_sale,
                        SUM(CASE WHEN type = 3 THEN quantity ELSE 0 END) AS total_gift,
                        SUM(CASE WHEN type = 4 THEN quantity ELSE 0 END) AS total_sell_by_kg,

                        SUM(CASE WHEN type = 1 THEN amount ELSE 0 END) AS total_in_amount,
                        SUM(CASE WHEN type = 2 THEN amount ELSE 0 END) AS total_sale_amount,
                        SUM(CASE WHEN type = 3 THEN amount ELSE 0 END) AS total_gift_amount,
                        SUM(CASE WHEN type = 4 THEN amount ELSE 0 END) AS total_sell_by_kg_amount
                    ')
                    ->get('budget_j_publication_register_details')
                    ->row();
    //book_card info 
    $total_in = $query->total_in;
    $total_sale = $query->total_sale;
    $total_gift = $query->total_gift;
    $total_sell_by_kg = $query->total_sell_by_kg;
    $balance = $total_in - ($total_sale + $total_gift + $total_sell_by_kg);

    //book_amont_card info
    $total_in_amount = $query->total_in_amount;
    $total_sale_amount = $query->total_sale_amount;
    $total_gift_amount = $query->total_gift_amount;
    $total_sell_by_kg_amount = $query->total_sell_by_kg_amount;
    $balance_amount = $total_in_amount - ($total_sale_amount + $total_gift_amount + $total_sell_by_kg_amount);

?>
<style>
.card {
    background-color: white;
    color: black;
    border-radius: 5px;
    padding: 20px;
    margin: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.card-header {
    font-size: 1.7em;
    font-weight: bold;
    text-align: left;
    margin-bottom: 20px;
    padding-left: 4px;
    border-bottom: 2px solid;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th,
td {
    padding: 10px;
    text-align: left;
}
th{
    font-size: 14px;
    font-weight: bolder;
}

.card-container {
    display: flex;
    justify-content: space-around;
}
</style>
<div class="page-content">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <h1 style="text-align: left; color: #333;">স্বাগতম, এনআইএলজি (এমআইএস) | জাতীয় স্থানীয় সরকার ইনস্টিটিউট
                </h1>
            </div>
        </div>
        <div class="row">
            <div class="card-container col-md-12">
                <div class="card col-md-6">
                    <div class="card-header">বই এর হিসাব</div>
                    <table>
                        <tr>
                            <th>মোট প্রাপ্তি</th>
                            <td>:</td>

                            <td><?php echo eng2bng($total_in); ?></td>
                        </tr>
                        <tr>
                            <th>মোট বিক্রয়</th>
                            <td>:</td>

                            <td><?php echo eng2bng($total_sale); ?></td>
                        </tr>
                        <tr>
                            <th>মোট উপহার</th>
                            <td>:</td>

                            <td><?php echo eng2bng($total_gift); ?></td>
                        </tr>
                        <tr>
                            <th>কেজি দ্বারা বিক্রয়</th>
                            <td>:</td>

                            <td><?php echo eng2bng($total_sell_by_kg); ?></td>
                        </tr>
                        <tr>
                            <th>ব্যালান্স</th>
                            <td>:</td>

                            <td><?php echo eng2bng($balance); ?></td>
                        </tr>
                    </table>
                </div>
                <div class="card col-md-6">
                    <div class="card-header">অর্থের হিসাব</div>
                    <table>
                        <tr>
                            <th>মোট প্রাপ্তি</th>
                            <td>:</td>
                            <td><?php echo eng2bng($total_in_amount); ?></td>
                        </tr>
                        <tr>
                            <th>মোট বিক্রয়</th>
                            <td>:</td>

                            <td><?php echo eng2bng($total_sale_amount); ?></td>
                        </tr>
                        <tr>
                            <th>মোট উপহার</th>
                            <td>:</td>

                            <td><?php echo eng2bng($total_gift_amount); ?></td>
                        </tr>
                        <tr>
                            <th>কেজি দ্বারা বিক্রয়</th>
                            <td>:</td>

                            <td><?php echo eng2bng($total_sell_by_kg_amount); ?></td>
                        </tr>
                        <tr>
                            <th>ব্যালান্স</th>
                            <td>:</td>

                            <td><?php echo eng2bng($balance_amount); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>