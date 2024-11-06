</div>
<!-- /.content-wrapper -->
<footer class="main-footer">
	جميع الحقوق &copy; 2019-2023 <a href="https://Moaddi.net" target="_blank"> Moaddi </a>.
	<div class="float-right d-none d-sm-inline-block">
		Developed by :
		<abbr title="برمجة علاء عامر ">
			<a href="https://api.whatsapp.com/send?phone=201014714795&amp;" target="_balnk"> Alaa Amer</a> &brvbar; &reg;
		</abbr>
		Version:
		<abbr title="الاصدار">
			<a  class="swalDefaultInfo"><?php echo jsVersion()?></a>
		</abbr>

	</div>
	<script type="text/javascript">
		$(function() {
			const Toast = Swal.mixin({
				toast: true,
				icon: 'info',
				position: 'top-end',
				showConfirmButton: false,
				timer: 3000
			});
			$('.swalDefaultInfo').click(function() {
				Toast.fire({
					type: 'info',
					title: 'الاصدار الثالث : 3.0.1'
				})
			});
		});
	</script>
</footer>
</div>