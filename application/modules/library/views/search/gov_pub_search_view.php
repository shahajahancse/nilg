

<?PHP

  $title = 'unchecked';
  $subtitle = 'unchecked';
  $first_author = 'unchecked';
  $snd_author = 'unchecked';
  $thrd_author = 'unchecked';
  $first_subject = 'unchecked';
  $snd_subject = 'unchecked';
  $thrd_subject = 'unchecked';
  $language = 'unchecked';
  $publisher = 'unchecked';
  $year_publication = 'unchecked';
  $isbn = 'unchecked';
  $call_no = 'unchecked';
  $acc_no = 'unchecked';
  $edition = 'unchecked';
  $source = 'unchecked';
  $price = 'unchecked';
  $accession_no = 'unchecked';
  $editor = 'unchecked';
  $compiler = 'unchecked';
  $cd = 'unchecked';

  $selected_radio = $this->session->userdata('search_key');

  if ($selected_radio == 'title') {
  $title = 'checked';
  }
  else if ($selected_radio == 'subtitle') {
  $subtitle = 'checked';
  }
  else if ($selected_radio == 'first_subject') {
  $first_subject = 'checked';
  }
  else if ($selected_radio == 'snd_subject') {
  $snd_subject = 'checked';
  }
  else if ($selected_radio == 'thrd_subject') {
  $thrd_subject = 'checked';
  }
  else if ($selected_radio == 'language') {
  $language = 'checked';
  }
  else if ($selected_radio == 'publisher') {
  $publisher = 'checked';
  }
  else if ($selected_radio == 'year_publication') {
  $year_publication = 'checked';
  }
  else if ($selected_radio == 'isbn') {
  $isbn = 'checked';
  }
  else if ($selected_radio == 'call_no') {
  $call_no = 'checked';
  }
  else if ($selected_radio == 'acc_no') {
  $acc_no = 'checked';
  }
  else if ($selected_radio == 'first_author') {
  $first_author = 'checked';
  }
  else if ($selected_radio == 'snd_author') {
  $snd_author = 'snd_author';
  }
  else if ($selected_radio == 'thrd_author') {
  $thrd_author = 'thrd_author';
  }
  else if ($selected_radio == 'compiler') {
  $compiler = 'checked';
  }
  else if ($selected_radio == 'price') {
  $price = 'checked';
  }

  else if ($selected_radio == 'editor') {
  $editor = 'checked';
  }
  else if ($selected_radio == 'cd') {
  $cd = 'checked';
  }
?>


<div class="page-content">     
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> ড্যাশবোর্ড </a> </li>
      <li> <a href="<?=base_url('evaluation')?>" class="active"> সরকারি প্রকাশনা </a></li>
      <li><?=$meta_title; ?> </li>
    </ul>

    <div class="grid simple horizontal red">
      <div class="grid-title">
        <h4><span class="semi-bold">সরকারি প্রকাশনা অনুসন্ধান</span></h4>
      </div>
      <div class="grid-body tableresponsive">
                  
        <div align="center" style="margin:0 auto; width:100%; overflow:hidden; ">
          <fieldset style=';border:3px #004040 solid; padding:10px;border-radius:5px;'>
            <legend><font size='+1'><b>অনুসন্ধান করুন</b></font></legend>
            <form  name='search_book' action="<?php echo base_url(); ?>library/search_con/govt_pub_search_view"  method="post">
              <table width='100%' border='0' align='center' style='padding:10px; color: #004040; font-weight:bold; font-size:13px;'>
                <tr>
                  <td><input type="radio" name="radioValue" value="isbn" id="isbn" checked required />Search By ISBN</td>
                  <td><input type="radio" name="radioValue" value="call_no" id="call_no" <?PHP print $call_no; ?> required />Search By Call No</td>
                  <td><input type="radio" name="radioValue" value="acc_no" id="acc_no" <?PHP print $acc_no; ?> required />Search  By Accession No </td>
                </tr>

                <tr>
                  <td><input type="radio" name="radioValue" value="first_author" id="first_author"  <?PHP print $first_author; ?> required />Search By 1st Author </td>
                  <td width="33%"><input type="radio" name="radioValue"  id="snd_author" value="snd_author" <?PHP print $snd_author; ?>required />Search By 2nd Author </td>
                  <td width="38%"><input type="radio" name="radioValue" value="thrd_author" id="thrd_author" <?PHP print $thrd_author; ?> required />Search By 3rd Author</td>
                </tr>

                <tr>
                  <td><input type="radio" name="radioValue" value="first_subject" id="first_subject"  <?PHP print $first_subject; ?> required />Search By 1st Subject </td>
                  <td width="33%"><input type="radio" name="radioValue"  id="snd_subject" value="snd_subject" <?PHP print $snd_subject; ?>required />Search By 2nd Subject </td>
                  <td width="38%"><input type="radio" name="radioValue" value="thrd_subject" id="thrd_subject" <?PHP print $thrd_subject; ?> required />Search By 3rd Subject</td>
                </tr>

                <tr>
                  <td><input type="radio" name="radioValue" value="title" id="title"  <?PHP print $title; ?> required />Search By Title </td>
                  <td width="33%"><input type="radio" name="radioValue"  id="subtitle" value="subtitle" <?PHP print $subtitle; ?> required />Search By Subtitle</td>
                  <td width="38%"><input type="radio" name="radioValue" value="compiler" id="compiler" <?PHP print $compiler; ?> required />Search By Compiler</td>
                </tr>
                <tr>
                  <td><input type="radio" name="radioValue" value="language" id="language" <?PHP print $language; ?> required />Search By Language</td>
                  <td><input type="radio" name="radioValue" value="publisher"  id="publisher" <?PHP print $publisher; ?> required />Search By Publisher</td>
                  <td><input type="radio" name="radioValue" value="year_publication" id="year_publication" <?PHP print $year_publication; ?> required />Search By Year of Publication</td>
                </tr>



                <tr>
                  <td><input type="radio" name="radioValue" value="price"  id="price" <?PHP print $price; ?> required />Search By Price</td>
                  <td><input type="radio" name="radioValue" value="cd" id="cd" <?PHP print $cd; ?> required />Search  By CD </td>
                  <td><input type="radio" name="radioValue" value="editor" id="editor" <?PHP print $editor; ?> required />Search By Editor </td>
                </tr>

                <tr >
                 <td height="20"></td>
                </tr>

                <tr>
                  <td align='right' width='29%'>কীওয়ার্ড অনুসন্ধান করুন</td>
                  <td> <input style='background-color:#cccccc;' type='text' size='27px' name='check_key_name' id='check_key_name' placeholder="অনুসন্ধান কী লিখুন" value="<?php if (isset($_POST['check_key_name'])){echo $_POST['check_key_name'];} else{ echo $this->session->userdata('search_value');} ?>" required  ></td>
                  <td><input  type="submit" name='search' class="btn btn-success"  value='Search' class="submit" /> </td>
                </tr>  
              </table>
            </form>
          </fieldset>

          <!-- search book show here -->
          <?php if (!empty($search_query)) { $this->load->view('search/gov_pub_show', $search_query); } ?>
        </div>
      </div>
    </div>

  </div> <!-- END ROW -->
</div>