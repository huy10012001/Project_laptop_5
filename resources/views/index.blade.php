
<?php
use App\category;
foreach(category::withTrashed()
->get()
 as $c)
{
    echo $c;
}
?>
</body>
