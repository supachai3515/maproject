<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>TOS Order</title>
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
													<td style="font-size:15px;color:#555;">

														<div style="border-top:3px solid #3c8dbc;position: relative;border-radius: 3px;background: #ffffff;margin-bottom: 20px;width: 100%;">
						                    <div style="color: #444;display: block;padding: 10px;position: relative;border-bottom: 1px solid #f4f4f4;">
						                        <p style="display: inline-block;font-size: 18px;margin: 0;line-height: 1;">Order Info</p>
						                    </div>
						                    <div style="border-top-left-radius: 0;border-top-right-radius: 0;border-bottom-right-radius: 3px;border-bottom-left-radius: 3px;padding: 10px;">
				                            <div style="overflow: hidden;">
				                                <p style="margin-bottom: 0;text-align: right;width: 41.66666667%;float: left;margin-right: 10px;font-weight: bold;">Email:</p>
				                                <div style="float: left;">
				                                    <p style="padding-bottom: 7px;margin-bottom: 0;"><?php echo $order_data['email']; ?></p>
				                                </div>
				                            </div>
				                            <div style="overflow: hidden;">
				                                <p style="margin-bottom: 0;text-align: right;width: 41.66666667%;float: left;margin-right: 10px;font-weight: bold;">Name/Company Name:</p>
				                                <div style="float: left;">
				                                    <p style="padding-bottom: 7px;margin-bottom: 0;"><?php echo $order_data['company']; ?></p>
				                                </div>
				                            </div>
				                            <div style="overflow: hidden;">
				                                <p style="margin-bottom: 0;text-align: right;width: 41.66666667%;float: left;margin-right: 10px;font-weight: bold;">Tel:</p>
				                                <div style="float: left;">
				                                    <p style="padding-bottom: 7px;margin-bottom: 0;"><?php echo $order_data['tel']; ?></p>
				                                </div>
				                            </div>
						                    </div>
														</div>
														<div style="border-top:3px solid #3c8dbc;position: relative;border-radius: 3px;background: #ffffff;margin-bottom: 20px;width: 100%;">
						                    <div style="color: #444;display: block;padding: 10px;position: relative;border-bottom: 1px solid #f4f4f4;">
						                        <p style="display: inline-block;font-size: 18px;margin: 0;line-height: 1;">Order Detail</p>
						                    </div>
						                    <div style="border-top-left-radius: 0;border-top-right-radius: 0;border-bottom-right-radius: 3px;border-bottom-left-radius: 3px;padding: 10px;">
																	<?php foreach ($order_detail_data as $model): ?>
																		<div style="border: 1px solid #3c8dbc;border-radius: 3px;margin-bottom: 20px;">
																			<p style="color: #fff;background: #3c8dbc;background-color: #3c8dbc;margin:0;padding: 10px;"><span style="font-weight: bold;">Product Type:</span>
																				<?php if ($model['is_have_product'] == 1): ?>
																					<span style="color: #3c8dbc;color: #fff;">Product</span>
																				<?php else: ?>
																					<span style="color: #3c8dbc;color: #fff;">Product Manually</span>
																				<?php endif; ?>
																			</p>
																			<div style="padding: 10px;margin-bottom: 10px;">
																				<table style="width: 100%;">
																					<tbody>
																						<tr>
																							<td style="font-weight: bold; width: 50%; text-align: right; padding-right: 5px;width: 30%;">Part Number:</td>
																							<td style="width: 50%;">
																								<?php if (!empty($model['part_number'])): ?>
						                                      <?php echo $model['part_number']; ?>
						                                    <?php else: ?>
						                                      <?php echo '-'; ?>
						                                    <?php endif; ?>
																							</td>
																						</tr>
																						<tr>
																							<td style="font-weight: bold; width: 50%; text-align: right; padding-right: 5px;width: 30%;">Type:</td>
																							<td style="width: 50%;">
																								<?php if (!empty($model['type_name'])): ?>
						                                      <?php echo $model['type_name']; ?>
						                                    <?php else: ?>
						                                      <?php echo '-'; ?>
						                                    <?php endif; ?>
																							</td>
																						</tr>
																						<tr>
																							<td style="font-weight: bold; width: 50%; text-align: right; padding-right: 5px;width: 30%;">Product Name:</td>
																							<td style="width: 50%;">
																								<?php if (!empty($model['product_name'])): ?>
						                                      <?php echo $model['product_name']; ?>
						                                    <?php else: ?>
						                                      <?php echo '-'; ?>
						                                    <?php endif; ?>
																							</td>
																						</tr>
																						<tr>
																							<td style="font-weight: bold; width: 50%; text-align: right; padding-right: 5px;width: 30%;">Product Description:</td>
																							<td style="width: 50%;">
																								<?php if (!empty($model['product_description'])): ?>
						                                      <?php echo $model['product_description']; ?>
						                                    <?php else: ?>
						                                      <?php echo '-'; ?>
						                                    <?php endif; ?>
																							</td>
																						</tr>
																						<tr>
																							<td style="font-weight: bold; width: 50%; text-align: right; padding-right: 5px;width: 30%;">Comment:</td>
																							<td style="width: 50%;">
																								<?php if (!empty($model['comment'])): ?>
						                                      <?php echo $model['comment']; ?>
						                                    <?php else: ?>
						                                      <?php echo '-'; ?>
						                                    <?php endif; ?>
																							</td>
																						</tr>
																						<tr>
																							<td style="font-weight: bold; width: 50%; text-align: right; padding-right: 5px;width: 30%;">จังหวัด:</td>
																							<td style="width: 50%;"><?php echo $model['province_name']; ?></td>
																						</tr>
																						<tr>
																							<td style="font-weight: bold; width: 50%; text-align: right; padding-right: 5px;width: 30%;">LB Year QTY:</td>
																							<td style="width: 50%;"><?php echo $model['lb_year_qty']; ?></td>
																						</tr>
																						<tr>
																							<td style="font-weight: bold; width: 50%; text-align: right; padding-right: 5px;width: 30%;">QTY:</td>
																							<td style="width: 50%;"><?php echo $model['qty']; ?></td>
																						</tr>
																						<tr>
																							<td style="font-weight: bold; width: 50%; text-align: right; padding-right: 5px;width: 30%;">PM Time QTY:</td>
																							<td style="width: 50%;"><?php echo $model['pm_time_qty']; ?></td>
																						</tr>
																						<tr>
																							<td colspan="2" style="font-weight: bold; width: 50%; text-align: right; padding-right: 5px;">Total: <span style="font-weight: normal;"><?php echo number_format($model['total'],0) ?></span></td>
																						</tr>
																					</tbody>
																				</table>
																			</div>
																		</div>
																	<?php endforeach; ?>
																	<p>ท่านได้ทำการขอราคาพิเศษเรียบร้อยแล้ว <a href="<?php echo base_url(); ?>tos_cal/special_price/<?php echo $order_data['ref_id']; ?>" target="_blank">คลิกที่นี้</a> เพื่อไปยังหน้าสินค้า</p>
						                    </div>
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
