<div class="row">
    <div class="alert" style="display:none;"></div>
    <div class="col-md-6">
        <h5 class="green-text heading-underline"> General Setting</h5>
        <div class="form-group">
            <label>Notification</label>
            <div>
                <?php
                $data = array(
                    'name' => 'notRadios',
                    'id' => 'notiOn',
                    'value' => 1,
                    'type' => 'radio',
                    'checked' => $row->notification == 1 ? TRUE : FALSE,
                );
                echo form_checkbox($data);
                ?>
                <label for="notiOn">On</label>
                <?php
                $data = array(
                    'name' => 'notRadios',
                    'id' => 'notiOff',
                    'value' => 0,
                    'type' => 'radio',
                    'checked' => $row->notification == 0 ? TRUE : FALSE,
                );
                echo form_checkbox($data);
                ?>
                <label for="notiOff">Off</label>
            </div>
        </div>
        <div class="form-group">
            <label>Publish Profile</label>
            <div>
                <?php
                $data = array(
                    'name' => 'pubRadios',
                    'id' => 'notiOn',
                    'value' => 1,
                    'type' => 'radio',
                    'checked' => $row->published == 1 ? TRUE : FALSE,
                );

                echo form_checkbox($data);
                ?>
                <label for="notiOn">On</label>
                <?php
                $data = array(
                    'name' => 'pubRadios',
                    'id' => 'notiOff',
                    'value' => 0,
                    'type' => 'radio',
                    'checked' => $row->published == 0 ? TRUE : FALSE,
                );
                echo form_checkbox($data);
                ?>
                <label for="notiOff">Off</label>
            </div>
        </div>
<?php if($this->ion_auth->is_admin() || $this->ion_auth->is_sadmin()){ ?>
        <h5 class="green-text heading-underline"> Only Admin Setting</h5>
        <div class="form-group">
            <label>Profile Status</label>
            <div>
                <?php
                $data = array(
                    'name' => 'stuRadios',
                    'id' => 'stuOn',
                    'value' => 1,
                    'type' => 'radio',
                    'checked' => $row->status == 1 ? TRUE : FALSE,
                );
                echo form_checkbox($data);
                ?>
                <label for="stuOn">Enable / Approved</label>
                <br>
                <?php
                $data = array(
                    'name' => 'stuRadios',
                    'id' => 'stuOff',
                    'value' => 2,
                    'type' => 'radio',
                    'checked' => $row->status == 2 ? TRUE : FALSE,
                );
                echo form_checkbox($data);
                ?>
                <label for="stuOff">Not Approved</label>
                <br>
                <?php
                $data = array(
                    'name' => 'stuRadios',
                    'id' => 'stuOff',
                    'value' => 0,
                    'type' => 'radio',
                    'checked' => $row->status == 0 ? TRUE : FALSE,
                );
                echo form_checkbox($data);
                ?>
                <label for="stuOff">Disable</label>
            </div>
        </div>
        <div class="form-group">
            <label>Recommended Profile</label>
            <div>
                <?php
                $data = array(
                    'name' => 'recmRadios',
                    'id' => 'recmOn',
                    'value' => 1,
                    'type' => 'radio',
                    'checked' => $row->recmnd == 1 ? TRUE : FALSE,
                );

                echo form_checkbox($data);
                ?>
                <label for="notiOn">On</label>
                <?php
                $data = array(
                    'name' => 'recmRadios',
                    'id' => 'recmOff',
                    'value' => 0,
                    'type' => 'radio',
                    'checked' => $row->recmnd == 0 ? TRUE : FALSE,
                );
                echo form_checkbox($data);
                ?>
                <label for="notiOff">Off</label>
            </div>
        </div>
<?php } ?>
    </div> <!-- col-md-6 -->

    <div class="col-md-6"> 
        <h5 class="green-text heading-underline"> Profile Contact Setting</h5>
        <div class="form-group">
            <label for="name">Contact Name</label>
            <?php
            $data = array(
                'name' => 'name',
                'id' => 'name',
                'class' => 'form-control',
                'type' => 'text',
                'value' => $row->contact_name,
                'placeholder' => 'Contact Name',
            );
            echo form_input($data);
            ?>
        </div>
        <div class="form-group">
            <label for="email">Contact Email</label>
            <?php
            $data = array(
                'name' => 'email',
                'id' => 'email',
                'class' => 'form-control',
                'parsley-type' => 'email', 
                'parsley-trigger' => "change",
                'parsley-minlength' => "4",
                'parsley-validation-minlength' => "2",
                'type' => 'email',
                'value' => $row->contact_email,
                'placeholder' => 'Contact Email Address',
            );
            echo form_input($data);
            ?>
        </div>
        <div class="form-group">
            <label for="number">Contact Number</label>
            <?php
            $data = array(
                'name' => 'number',
                'id' => 'number',
                'class' => 'form-control',
                'type' => 'text',
                'value' => $row->contact_number,
                'placeholder' => 'Contact Number',
            );
            echo form_input($data);
            ?>
        </div>                                                                        
    </div> <!-- col-md-6 -->
</div>