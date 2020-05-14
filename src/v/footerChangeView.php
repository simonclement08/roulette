<a href="index.php"><input type="button" value="RETOUR A L'INDEX" name="Index"></a>

<?php
$content = ob_get_clean();

require 'src/v/template.php';
?>