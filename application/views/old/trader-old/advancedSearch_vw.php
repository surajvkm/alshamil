<?php $cat_qry = $this->Trader_mdl->get_categories(); ?>
<form method="post" action="<?php echo base_url() ?>Trader/search">
                <div class="widget" id="widget_advsrch">
                    <p id="adsrchtitle">Advanced Search</p>
                    <select class="form-control input-lg" name="category" id="srchcat1">
                        <option value="">select Category</option>
                        <?php
                        foreach ($cat_qry as $r) {
                            ?>
                            <option value="<?php echo $r->productCategoryID ?>"><?php echo $r->category_name ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <br>
                    <select class="form-control input-lg" name="brand" id="srchcat2">
                        <option value="">Select Brand</option>

                    </select>
                    <br>
                    <select class="form-control input-lg" name="model" id="srchcat3">
                        <option value="">Select Model</option>

                    </select>
                    <br>
                    <select class="form-control input-lg" name="from" id="srchcat4">
                        <option value="">From Year</option>
                        <option value="1970">1970</option>
                        <option value="1987">1987</option>
                        <option value="1987">1987</option>
                        <option value="2000">2000</option>

                    </select>

                    <br>
                    <select class="form-control input-lg" name="to" id="srchcat5">
                        <option value="">To Year</option>
                        <option value="2011">2011</option>
                        <option value="2016">2016</option>
                        <option value="2017">2017</option>

                    </select>
                    <button type="submit" class="btn btn-default" id="btnsrchpost">SEARCH</button>
                </div><!-- end widget -->
                </form>
<script>
 $(document).ready(function ()
    {
      
        $('#srchcat1').change(function () {
            var category = $("#srchcat1").val();
            if ((category == '3') || (category == '6') || (category == '9'))
            {
                $('#srchcat2').css('display', 'none');
                $('#srchcat3').css('display', 'none');
                $('#srchcat4').css('display', 'none');
                $('#srchcat5').css('display', 'none');
            } else
            {
                $('#srchcat2').css('display', 'block');
                $('#srchcat3').css('display', 'block');
                $('#srchcat4').css('display', 'block');
                $('#srchcat5').css('display', 'block');

                var data = 'category=' + category;
                if (category != "") {
                    $.ajax({
                        type: "POST",
                        dataType: 'json',
                        data: data,
                        url: "<?php echo base_url('Trader/fetch_brand'); ?>",
                        success: function (data) {
                            //console.log(data);return false;
                            $('#srchcat2').empty();

                            $.each(data, function (id, city)
                            {
                                var opt = $('<option />'); // here we're creating a new select option for each group
                                opt.val(city);
                                opt.text(city);
                                $('#srchcat2').append(opt);
                            });

                        }

                    });
                }
            }
        });
        $('#srchcat2').change(function () {
            var brand = $("#srchcat2").val();

            var data = 'brand=' + brand;
            if (brand != "") {
                $.ajax({
                    type: "POST",
                    dataType: 'json',
                    data: data,

                    url: "<?php echo base_url('Trader/fetch_model'); ?>",
                    success: function (data) {

                        $('#srchcat3').empty();

                        $.each(data, function (id, city)
                        {
                            var opt = $('<option />'); // here we're creating a new select option for each group
                            opt.val(id);
                            opt.text(city);
                            $('#srchcat3').append(opt);
                        });

                    }

                });
            }
        });
    });
</script>