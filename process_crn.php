<?php
include('dconnection.php');
$course = $_POST['offered_course'];

if(!$course) {

	return false;
}


$sql = "SELECT CRN FROM courses WHERE Title = '$course' and Term = 6172";
$result = $mysqli->query($sql);

?>

<label>CRN</label><i class="fa fa-asterisk text-danger">*</i>
<select multiple name="crn[]" class="form-control" required>
	<option value="">Please Select</option>
	<?php
	while ($crn = $result->fetch_assoc()) {
		?>
		<option value="<?php echo $crn['CRN']; ?>"><?php echo $crn['CRN']; ?></option>
		<?php 
	}
	?>
</select>