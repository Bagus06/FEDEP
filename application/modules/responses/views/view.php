<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="col-md-12">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Response anda</h3>
			</div>
			<div class="card-body">
				<?php foreach ($data as $key => $value): ?>
					<div class="col-md-12 row">
						<p><?php echo $value['number'] ?>. </p>
						<p><?php echo $value['title'] ?></p>
					</div>
					<?php if ($value['sub_question'] == 1): ?>
						<p style="margin-top: -20px; padding-left: 12px"><?php echo $value['question_title_sub'] ?></p>
					<?php endif ?>
					
					<?php if ($value['type_jawaban'] == 1): ?>
						<div style="margin-top: -35px; padding-left: 22px" class="col-md-12 row">
							<p>Response :  </p>
							<?php if (empty($value['isian'])): ?>
								<p>Belum di isi</p>
							<?php else: ?>
								<p><?php echo $value['isian']; ?></p>
							<?php endif ?>
						</div>
					<?php elseif($value['type_jawaban'] == 2): ?>
						<div style="margin-top: -35px; padding-left: 22px" class="col-md-12 row">
							<p>Response :  </p>
							<?php if (empty($value['ceklist'])): ?>
								<p>Belum di isi</p>
							<?php else: ?>
								<p><?php echo $value['ceklist']; ?></p>
							<?php endif ?>
						</div>
					<?php elseif($value['type_jawaban'] == 3): ?>
						<div style="margin-top: -35px; padding-left: 22px" class="col-md-12 row">
							<p>Files :  </p>
							<?php if (empty($value['img'])): ?>
								<p>Belum di isi</p>
							<?php else: ?>
								<p><?php echo $value['img']; ?></p>
							<?php endif ?>
						</div>
					<?php endif ?>
					<div style="margin-top: -35px; padding-left: 22px" class="col-md-12 row">
						<p>keterangan :  </p>
						<?php if (empty($value['ket'])): ?>
							<p>Tanpa keterangan</p>
						<?php else: ?>
							<p><?php echo $value['ket']; ?></p>
						<?php endif ?>
					</div>

				<?php endforeach ?>
			</div>
		<!-- /.card-body -->
		</div>
	<!-- /.card -->
	</div>
</div>