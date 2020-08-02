<!DOCTYPE html>
<html>
<body>

<p>Modify the text in the input field, then click outside the field to fire the onchange event.</p>

Enter some text: <input type="text" name="txt" value="Hello" onchange="myFunction(this.value)">

<script>
function myFunction(val) {
 location.reload();
}
</script>

</body>
</html>
