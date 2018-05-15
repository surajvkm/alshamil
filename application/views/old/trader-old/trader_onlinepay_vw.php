<!DOCTYPE html>
<html>
<body>
	 <div class="col-sm-2 vertical-align text-left hidden-xs">
                            <a href="javascript:void(0);">
                                <img id="als_logo" src="http://localhost/alshamil/img/Logo.png" alt="" width="160">
                            </a>
                        </div>
<form action="<?php echo $url; ?>" method="post" name="network_online_payment" id="network_online_payment">
<input type="hidden" name="requestParameter" value="<?php echo $req_param; ?>">
  <input style="display: none;" type="submit" value="Submit">
</form>
<div><p style="color: #f9a100;font-size: 20px;text-align: center;">You will be redirected in 5 seconds</p></div>
<script type="text/javascript">
	window.onload = function(){
  document.forms['network_online_payment'].submit();
}
</script>
</body>
</html>
