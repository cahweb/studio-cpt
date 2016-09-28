<div class="inner-meta">
	<h4>General Information</h4>

	<!-- Twitter Handle -->
	<label>Twitter Handle:</label>
	<input type="text" name="twitter" value="<?php echo $custom['twitter'][0]; ?>" >
	<br>

	<!-- Instagram Handle -->
	<label>Instagram Handle:</label>
    <input type="text" name="instagram" value="<?php echo $custom['instagram'][0]; ?>" >
    <br>

</div>

<div class="inner-meta">
    <h4>Category</h4>

    <!-- Type -->
    <label>Type:</label>
    <input type="radio" name="type" value="Percussion" <?php if ($custom['type'][0] == 'Percussion') echo 'checked'; ?>>Percussion
    <input type="radio" name="type" value="Brass" <?php if ($custom['type'][0] == 'Brass') echo 'checked'; ?>>Brass
    <input type="radio" name="type" value="Woodwinds" <?php if ($custom['type'][0] == 'Woodwinds') echo 'checked'; ?>>Woodwinds
    <input type="radio" name="type" value="Piano" <?php if ($custom['type'][0] == 'Piano') echo 'checked'; ?>>Piano
    <input type="radio" name="type" value="Voice" <?php if ($custom['type'][0] == 'Voice') echo 'checked'; ?>>Voice
    <input type="radio" name="type" value="Strings" <?php if ($custom['type'][0] == 'Strings') echo 'checked'; ?>>Strings

</div>