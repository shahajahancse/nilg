<div class="page-content">

    <div class="content">
        <?php 
      $user = $this->ion_auth->user()->row();
      $dept_id = $user->crrnt_dept_id;
      $this->db->select('
      SUM(CASE WHEN status = 1 THEN amount ELSE 0 END) AS total_amount,
      ');
      $this->db->where('dept_id', $dept_id);
      $total_amount = $this->db->get('budget_field')->row();

      $this->db->select('
      SUM(CASE WHEN type = 1 THEN amount ELSE 0 END) AS total_amount,
      SUM(CASE WHEN type = 1 THEN 1 ELSE 0 END) AS count,
      ');
      $total_amount_ay = $this->db->get(' budget_j_hostel_register')->row();


    ?>
        <div class="row">
            <div class="col-md-12">
                <h1 style="text-align: center; color: #333;">স্বাগতম, এনআইএলজি (এমআইএস) | জাতীয় স্থানীয় সরকার ইনস্টিটিউট
                </h1>
                <!-- <img src="<?=base_url('awedget/assets/img/nilg-logo.png')?>" width="50" style="float: left; margin-right: 20px;"> -->
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-default text-center"
                    style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2); transition: 0.3s; border: none; border-radius: 10px; background-color: #fff; padding: 20px;">
                    <div class="panel-body">
                        <h3 style="color: #53d769; font-weight: bold; font-size: 36px; margin-bottom: 10px;"
                            id="incomeCounter">৳
                            <?=($total_amount_ay->total_amount!='')?eng2bng($total_amount_ay->total_amount):'০.০০'?>
                        </h3>
                        <h4 style="color: #555; font-size: 20px; margin-bottom: 0;">মোট আয় </h4>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default text-center"
                    style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2); transition: 0.3s; border: none; border-radius: 10px; background-color: #fff; padding: 20px;">
                    <div class="panel-body">
                        <h3 style="color: #ff6f61; font-weight: bold; font-size: 36px; margin-bottom: 10px;"
                            id="expenseCounter">৳
                            <?=($total_amount->total_amount!='')?eng2bng($total_amount->total_amount):'০.০০'?></h3> 
                        <h4 style="color: #555; font-size: 20px; margin-bottom: 0;">মোট খরচ </h4>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default text-center"
                    style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2); transition: 0.3s; border: none; border-radius: 10px; background-color: #fff; padding: 20px;">
                    <div class="panel-body">
                        <h3 style="color: #4a90e2; font-weight: bold; font-size: 36px; margin-bottom: 10px;"
                            id="entryCounter"><?=($total_amount_ay->count!='')?eng2bng($total_amount_ay->count):'০.০০'?>
                        </h3>
                        <h4 style="color: #555; font-size: 20px; margin-bottom: 0;">মোট হোস্টেল রেজিস্টার এন্ট্রি</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.panel.panel-default:hover {
    transform: scale(1.05);
    box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
}

.panel.panel-default:hover .panel-body {
    background-color: #f5f5f5;
}

.panel-body {
    transition: background-color 0.3s ease-in-out;
}
</style>
<!-- <script>
    function animateValue(id, start, end, duration) {
        if (start === end) return;
        var range = end - start;
        var current = start;
        var increment = end > start ? 1 : -1;
        var stepTime = Math.abs(Math.floor(duration / range));
        var obj = document.getElementById(id);
        var timer = setInterval(function() {
            current += increment;
            obj.textContent = current;
            if (current == end) {
                clearInterval(timer);
            }
        }, stepTime);
    }

    animateValue("expenseCounter", 0, 1000, 300); // Replace 1000 with the desired end value
    animateValue("incomeCounter", 0, 3000, 300); // Replace 3000 with the desired end value
    animateValue("entryCounter", 0, 10, 300); // Replace 10 with the desired end value
</script> -->