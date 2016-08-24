</div>
					</section>
					<footer id="footer" class="noprint">
					<div class="pprint"></div>
				<div class="container">
					<ul class="copyright">
					
						<li>&copy; Diplomatic Shuttle Service. All rights reserved.</li>

					</ul>
				</div>
			</footer>
<script language="javascript">

//print without dialoge box

function Print()

{

if (document.all)

{

WebBrowser1.ExecWB(6,6); //use 6, 1 to prompt the print dialog or 6, 6 to omit it;

WebBrowser1.outerHTML = "";

}

else

{

window.print();

}

}

</script>
					<!--[if lte IE 8]><script src="<?php echo $sitepath;  ?>/assets/js/html5shiv.js"></script><![endif]-->
		<script src="<?php echo $sitepath;  ?>/assets/js/jquery.min.js"></script>
			<script src="<?php echo $sitepath;  ?>/assets/js/jquery.dataTables.min.js"></script>
			<script src="<?php echo $sitepath;  ?>/assets/js/dataTables.tableTools.js"></script>
			
		<script src="<?php echo $sitepath;  ?>/assets/js/jquery-ui.min.js"></script>
		<script src="<?php echo $sitepath;  ?>/assets/js/skel.min.js"></script>
		<script src="<?php echo $sitepath;  ?>/assets/js/skel-layers.min.js"></script>
		<script src="<?php echo $sitepath;  ?>/assets/js/init.js"></script>
		<script src="<?php echo $sitepath;  ?>/assets/js/ajaxupload.js"></script>
	</body>
</html>

<?php 
 cache_bottom(); 
 ?>