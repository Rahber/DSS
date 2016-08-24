<?

error_reporting(E_ALL & ~E_NOTICE);
if($_POST['start_date'] and $_POST['end_date']!=''){
 $sdate=strtotime($_POST['start_date']); 
 $edate=strtotime($_POST['end_date']);
$start_date=date('Y-m-d', $sdate);echo "<br />";
$end_date=date('Y-m-d', $edate);
$where ="and t.date between '".$start_date."' and '".$end_date."'";
$msg="Report By Date";
if($_POST['counter']!=''){
	
	
$where .=" and t.printedby='".$_POST['counter']."'";
$msg="Report By Counter & Date";
}
if($_POST['embassay']!=''){
$where .=" and t.embassy='".$_POST['embassay']."'";
$msg="Report By Embassy";
}


$order="order by date";
}
if($_POST['id']!=''){
$where ="and t.cnic='".$_POST['passp']."'";
$msg="Report By Passport#/CNIC#";
$order="order by t.date desc";
}

if($_POST['passenger']!=''){
$where .=" and (fname like '%".$_POST['passenger']."%' or lname like '%".$_POST['passenger']."%')";
$msg="Report By Passenger";
}
if($_POST['start_ticket'] and $_POST['end_ticket']!=''){
$where ="t.id between '".$_POST['start_ticket']."' and '".$_POST['end_ticket']."'";
$msg="Report By Coupon#";
$order="order by id";
}
if($_POST['search']==''){
$sql = $mysqli->query("select t.id, t.date,t.t, p.fname, p.cnic, p.cnic, t.embassy, t.express, t.printedby from userrecord p, printrecord t where p.id=t.uid order by id");
$num=mysqli_num_rows($sql);
$msg="Report By All Passenger";
}else{
if($where!=''){
	
	 $mtc = "select t.id, t.uid,t.t, t.date, p.fname, p.lname, p.cnic, p.cnic, t.embassy, t.express, t.printedby from userrecord p, printrecord t where p.id=t.uid $where $order";
$sql = $mysqli->query($mtc);
$num=mysqli_num_rows($sql);
}
}
$aa = get_name($_SESSION['id']);
$contents.= "<table border='1' align='center' class='table' cellpadding='2' id='nsfw'><tr><td colspan='10' style='border-left:hidden; border-right:hidden; border-top:hidden; font-size:14px;' align='center'>&nbsp;<br>Report By <b>".$aa[0]."</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date:&nbsp;
        ".date('F d, Y')." &nbsp;&nbsp;&nbsp;
Time:&nbsp;".date('h:i:s A',(time()))."<br /><br />".$msg."</td></tr>";	
if($num!=''){
$contents.= "<tr bgcolor='#f4faff'>
<td><b>Sr#</b></td>
<td><b>Coupon#</b></td>
<td><b>Date</b></td>
<td><b>Time</b></td>
<td><b>Name</b></td>
<td><b>Passport#</b></td>
<td><b>CNIC#</b></td>
<td><b>Embassy</b></td>";
if($_POST['search']=='money'){
$contents.="<td><b>Service Charges</b></td>";
}
$contents.="<td><b>Counter</b></td>
</tr>";
$i=1; 
while($row = $sql->fetch_object()){
$charges=$row->express;
$date=strtotime($row->date);
 $time=$row->t;
$contents.= "<tr>
<td>$i</td>
<td>";

if($row->id=='0'){
$contents.= "N/A";
}else{$contents.= $row->id; }
$contents.="</td>
<td>"
.date('M d, y', $date).
"</td>
<td>".date('h:i A',$row->t)."</td>
<td>".$row->fname." ".$row->lname."</td>
<td>".$row->passp."</td>
<td>".$row->cnic."</td>
<td>".$row->embassy."</td>";
if($_POST['search']=='money'){
$contents.="<td>";
if($charges=='0'){
$contents.= "FREE";}
else{ $contents.= $charges;}
$contents.= "</td>";
}

$aa =get_name($row->printedby);
$contents.= "
<td>".$aa[0]."</td>
</tr>";
$total=$total+$charges;
$i++;
} }
if($_POST['search']=='money'){
$contents.= "<tr><td colspan='10' align='right'><b>Total Service Charges:</b>&nbsp;<b>$total</b></td></tr>";
}
$contents.= "</table>
</body>";
header("Content-type: application/octet-stream");
header("Content-type:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");

header("Content-Disposition: attachment; filename=export.xls");
 header('Content-type:application/vnd.ms-excel');
header("Content-Type: text/plain"); 
header("Pragma: no-cache");//Prevent Caching
header("Expires: 0");//Expires and 0 mean that the browser will not cache the page on your hard drive 
print $contents;
exit;

?>
