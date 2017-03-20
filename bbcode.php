<!-- You can delete all commentary
Crée par Rubissar

Sources: https://github.com/Rubissar/BBCodeParser/

contact: mi-zifre@code10.fr

Vous pouvez modifier, réutiliser, republier ce programme, mais me mensionner.
-->

<form method='post'> <!-- le formulaire d'entrée -->
<textarea name='text' cols="60" rows="10"><?php if (isset($_POST['text'])) {echo $_POST['text']; } else {echo "Ce parseur permet de faire du [b]gras[/b], de l'[i]italique[/i], du [u]souligné[/u], du [s]barré[/s], des [r]retours [r]à la ligne [r][r]des #hashtags, des mentions @Rubiss, des images (pas très fonctionnel) [img image.jpeg] (support gif, png, jpeg (jpg), svg) et des liens https://fr.wikipedia.org/wiki/PHP (déconne un peu)"; }?></textarea>
<input type='submit' value='Valider'>
</form>
<?php
$text = $_POST['text']; // Récupération
$text = htmlspecialchars($text); 
$regex = '#\[ima?ge? (https?:\/\/(\w+\.)?(\w+)(\.\w{2,4})(\/[\w-]+)*\.(png|jpe?g|gif|svg)|(\/?[\w-]+)*\.(png|jpe?g|gif|svg))( ([\w-&?%]+))?\]#'; // Regex Image [img]
$text = preg_replace($regex, "<img src='$1' alt='<[$10]>'>", $text);
$regex = "#\[b\]([\w-\@\&\#\%*]*)\[\/b\]#"; // Regex gras (bold) [b]
$text = preg_replace($regex, "<b>$1</b>", $text);
$regex = "#\[s\]([\w-\@\&\#\%*'\"]*)\[\/s\]#"; // Regex barré (strike) [s]
$text = preg_replace($regex, "<s>$1</s>", $text);
$regex = "#\[u\]([\w-\@\&\#\%*]*)\[\/u\]#"; // Regex sousligné (underline) [u]
$text = preg_replace($regex, "<u>$1</u>", $text);
$regex = "#\[i\]([\w-\@\&\#\%*]*)\[\/i\]#"; // Regex italique (italic) [i]
$text = preg_replace($regex, "<i>$1</i>", $text);
$regex = '#@([\w-]+)#'; 
$text = preg_replace($regex, "<a href='/user/?pseudo=$1'>$0</a>", $text);
$regex = '#\#([\w-]+)#';
$text = preg_replace($regex, "<a href='/sujet/?hashtag=$1'>$0</a>", $text);
$regex = '/((?:(https?):\/\/)?((25[0-5]|2[0-4][0-9]|1[0-9][0-9]|[0-9][0-9]|[0-9])\.(?:(?:25[0-5]|2[0-4][0-9]|1[0-9][0-9]|[0-9][0-9]|[0-9])\.)((?:25[0-5]|2[0-4][0-9]|1[0-9][0-9]|[0-9][0-9]|[0-9])\.)(?:(?:25[0-5]|2[0-4][0-9]|1[0-9][0-9]|[0-9][0-9]|[0-9]))|(?:(?:(?:\w+\.){1,2}[\w]{2,3})))(:(\d+))?((?:\/[\w]+)*)(\/|(\/[\w]+\.[\w]{3,4})|(\?(?:([\w]+=[\w]+)&)*([\w]+=[\w]+))?|\?(?:(wsdl|wadl))))/';
$subst = '<a href=\'$0\'>$3/$8</a>';
$text = preg_replace($regex, $subst, $text);
$text = preg_replace('#\[r\]#', '<br>', $text);
echo $text; // Affichage du résultat
?>
