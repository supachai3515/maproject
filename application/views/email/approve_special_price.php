<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Order Tos</title>
	</head>
	<body>
		<div>
			<table style="width:100%;border-spacing:0" cellpadding="0" cellspacing="0">
				<tbody>
					<tr>
					<th style="border-top:solid 5px #f56400;font-weight:normal;text-align:center;background:#ffffff;border-bottom:solid 1px #e3e5e1">
						<table style="width:100%;max-width:596px;border-spacing:0;margin:0 auto" cellpadding="0" cellspacing="0" align="center">
							<tbody>
								<tr>
									<td>
										<table style="margin:0%;width:100%;border-spacing:0;table-layout:fixed" cellpadding="0" cellspacing="0">
											<tbody>
												<tr>
													<td style="padding:17px 3.358% 15px">
														<cite style="text-align:center;display:block;font-style:normal">
															<span style="font-size:1px;min-height:0;color:#fff;width:0;display:block">Just one more step.</span>
															<dl style="list-style-type:none;padding:0;overflow:hidden;margin:0">
																<dt style="font-size:15px;display:inline-block;width:100%;margin:0;padding:0 0 12px 0;vertical-align:top;padding-bottom:0!important">
																	<a href="<?php echo base_url(); ?>" title="WISADEV" style="display:inline-block" target="_blank">WISADEV</a>
																</dt>
																<div style="font-size:15px;display:inline-block;width:100%;margin:0;vertical-align:top"></div>
															</dl>
														</cite>
													</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
							</tbody>
						</table>
					</th>
					</tr>
					<tr><th style="background:#f5f5f1;height:28px"></th></tr>
					<tr>
					<th style="background:#f5f5f1;font-weight:normal;text-align:left">
						<table style="width:100%;max-width:596px;border-spacing:0;margin:0 auto" cellpadding="0" cellspacing="0" align="center">
							<tbody>
								<tr>
									<td>
										<table style="margin:0%;width:100%;border-spacing:0;table-layout:fixed" cellpadding="0" cellspacing="0">
											<tbody>
												<tr>
													<td style="font-size:15px;color:#555;line-height:24px">
														<div style="padding:24px 3.6% 24px;background:#fff;border:1px solid #e3e5e1">
															<p style="font-weight: bold; font-size: 20px; border-bottom: 1px solid#333;">Order Info</p>
															<table style="width: 100%;">
																<tbody>
																	<tr>
																		<td style="font-weight: bold; width: 50%; text-align: right; padding-right: 5px;">Email:</td>
																		<td style="width: 50%;"><?php echo $order_data['email']; ?></td>
																	</tr>
																	<tr>
																		<td style="font-weight: bold; width: 50%; text-align: right; padding-right: 5px;">Name / Company Name:</td>
																		<td style="width: 50%;"><?php echo $order_data['company']; ?></td>
																	</tr>
																	<tr>
																		<td style="font-weight: bold; width: 50%; text-align: right; padding-right: 5px;">Tel:</td>
																		<td style="width: 50%;"><?php echo $order_data['tel']; ?></td>
																	</tr>
																</tbody>
															</table>
															<p style="font-weight: bold; font-size: 20px; border-bottom: 1px solid#333;">Order Detail</p>
															<?php foreach ($order_detail_data as $model): ?>
																<div style="padding: 10px;margin-bottom: 10px;">
																	<p style="margin-bottom: 30px;padding-left: 10px;border-left: 3px solid #1779ba;">Product: <span style="color: #428bca;"><?php echo $model['product_name'] ?></span></p>
																	<table style="width: 100%;">
																		<tbody>
																			<tr>
																				<td style="font-weight: bold; width: 50%; text-align: right; padding-right: 5px;">Part Number:</td>
																				<td style="width: 50%;"><?php echo $model['part_number']; ?></td>
																			</tr>
																			<tr>
																				<td style="font-weight: bold; width: 50%; text-align: right; padding-right: 5px;">Type:</td>
																				<td style="width: 50%;"><?php echo $model['type_name']; ?></td>
																			</tr>
																			<tr>
																				<td style="font-weight: bold; width: 50%; text-align: right; padding-right: 5px;">Product Name:</td>
																				<td style="width: 50%;"><?php echo $model['product_name']; ?></td>
																			</tr>
																			<tr>
																				<td style="font-weight: bold; width: 50%; text-align: right; padding-right: 5px;">LB Year QTY:</td>
																				<td style="width: 50%;"><?php echo $model['lb_year_qty']; ?></td>
																			</tr>
																			<tr>
																				<td style="font-weight: bold; width: 50%; text-align: right; padding-right: 5px;">จังหวัด:</td>
																				<td style="width: 50%;"><?php echo $model['province_name']; ?></td>
																			</tr>
																			<tr>
																				<td style="font-weight: bold; width: 50%; text-align: right; padding-right: 5px;">QTY:</td>
																				<td style="width: 50%;"><?php echo $model['qty']; ?></td>
																			</tr>
																			<tr>
																				<td style="font-weight: bold; width: 50%; text-align: right; padding-right: 5px;">PM Time QTY:</td>
																				<td style="width: 50%;"><?php echo $model['pm_time_qty']; ?></td>
																			</tr>
																			<tr>
																				<td colspan="2" style="font-weight: bold; width: 50%; text-align: right; padding-right: 5px;">Total: <span style="font-weight: normal;"><?php echo number_format($model['total'],0) ?></span></td>
																			</tr>
																		</tbody>
																	</table>
																</div>
															<?php endforeach; ?>
															<p>เราได้ทำการปรับราคาพิเศษสินค้า ตามที่ท่านได้ขอราคาพิเศษมาแล้ว <a href="<?php echo base_url(); ?>tos_cal/special_price/<?php echo $order_data['ref_id']; ?>" target="_blank">คลิกที่นี้</a> เพื่อไปยังหน้าสินค้า</p>
														</div>
													</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
							</tbody>
						</table>
						<div class="yj6qo"></div>
						<div class="adL"></div>
					</th>
					</tr>
					<tr><th style="background:#f5f5f1;height:28px"></th></tr>
					<tr><th style="background:#f5f5f1;height:28px"></th></tr>
				</tbody>
			</table>
		</div>
	</body>
</html>
