<p>Заголовок <strong><?=$model->title?></strong></p>
<?php
foreach ($model->files as $file) {
   echo "<img src=\"/images/$file\" width=\"300\" alt=\"image\">";
}

