<?php
tcpdf();
$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$title = "Vietmark.net";
$obj_pdf->SetTitle($title);
$obj_pdf->SetHeaderData('', '', $title, '');
$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$obj_pdf->SetDefaultMonospacedFont('freemonob');
$obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$obj_pdf->SetFont('freemonob', '', 10);
$obj_pdf->setFontSubsetting(false);
$obj_pdf->AddPage();
$html = <<<EOD
		<HTML>
		<h1 align="center">PHIẾU NHẬP HÀNG</h1>
			<p style="margin-top:100px;">Mã phiếu: PN$id</p>
			<p>Ngày tạo: $entry</p>
			<p>Người tạo: $user</p>
			<p>Nhà cung cấp: $supplier</p>
			<div style='padding-top:50px;'>
				<table  cellspacing="1" cellpadding="4">
				<tr>
					<th>Mã sản phẩm</th>
					<th>Tên sản phẩm</th>
					<th>Số lượng</th>
					<th>Giá vốn</th>
					<th>Giá bán</th>
				</tr>
				$tb
				</table>
			</div>
			<div>
				<p>Tổng số lượng sản phẩm: <span style="float:right">$total_quantity<span></p>
				<p>Tổng tiền hàng: <span style="font-weight: bold; float:right">$total_money</span></p>
				<p>Đã trả nhà cung cấp: <span style="font-weight:bold;">$paid</span></p>
				<p>Còn nợ nhà cung cấp: <span style="font-weight:bold;">$own</span></p>
			</div>
			Ghi chú:<br>
			<div>$row->note</div>
			</div>
		</HTML>
EOD;

// Print text using writeHTMLCell()
$obj_pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
ob_start();
    // we can have any view part here like HTML, PHP etc
    $content = ob_get_contents();
ob_end_clean();
$obj_pdf->writeHTML($content, true, false, true, false, '');
$obj_pdf->Output('output.pdf', 'I');